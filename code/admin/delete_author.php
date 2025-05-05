<!--- delete_author.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "", "lms");

// Checks if author is linked to a book in the system
// Deletes if not
if (isset($_GET['author_id'])) {
    $author_id = intval($_GET['author_id']);

    $check_query = "SELECT * FROM books WHERE author_id = $author_id";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Cannot delete this author because they are linked to one or more books.');
                window.location.href='manage_author.php';
              </script>";
    } else {
        $delete_query = "DELETE FROM authors WHERE author_id = $author_id";
        if (mysqli_query($connection, $delete_query)) {
            echo "<script>
                    alert('Author deleted successfully.');
                    window.location.href='manage_author.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error deleting author.');
                    window.location.href='manage_author.php';
                  </script>";
        }
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href='manage_author.php';
          </script>";
}
?>