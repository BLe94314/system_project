<!-- return_book.php -->
<?php
require_once("auth.php");
require_role('user', 'index.php');

$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['s_no']) && is_numeric($_GET['s_no'])) {
    $s_no = intval($_GET['s_no']);
    $student_id = $_SESSION['id'];

    $query = "UPDATE issued_books 
              SET status = 0, return_date = NOW()
              WHERE s_no = $s_no AND student_id = $student_id AND status = 1";

    $result = mysqli_query($connection, $query);

    if (mysqli_affected_rows($connection) > 0) {
        header("Location: view_issued_book.php?msg=returned");
    } else {
        header("Location: view_issued_book.php?msg=error");
    }
    exit();
} else {
    header("Location: view_issued_book.php?msg=invalid");
    exit();
}
?>