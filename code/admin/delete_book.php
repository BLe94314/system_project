<!--- delete_book.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bn'])) {
    $connection = mysqli_connect("localhost", "root", "", "lms");

    $book_no = intval($_POST['bn']);
    $query = "DELETE FROM books WHERE book_no = $book_no";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Book deleted successfully.'); window.location.href='manage_book.php';</script>";
    } else {
        echo "<script>alert('Error deleting book.'); window.location.href='manage_book.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='manage_book.php';</script>";
}
?>