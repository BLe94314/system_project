<!--- delete_author.php -->
<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_GET['author_id'])) {
    $author_id = $_GET['author_id'];

    $delete_query = "DELETE FROM authors WHERE author_id = $author_id";
    if (mysqli_query($connection, $delete_query)) {
        echo "<script>alert('Author deleted successfully!'); window.location.href='manage_author.php';</script>";
    } else {
        echo "<script>alert('Error deleting author.'); window.location.href='manage_author.php';</script>";
    }
} else {
    echo "<script>alert('Invalid author ID.'); window.location.href='manage_author.php';</script>";
}
?>