<!--- functions.php -->
<?php
function ensure_admin_session()
{
    if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die("Unauthorized access.");
    }
}

function get_db_connection()
{
    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    return $connection;
}

function get_author_count()
{
    $connection = get_db_connection();
    $query = "SELECT COUNT(*) as author_count FROM authors";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result)['author_count'] ?? 0;
}

function get_user_count()
{
    $connection = get_db_connection();
    $query = "SELECT COUNT(*) as user_count FROM users";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result)['user_count'] ?? 0;
}

function get_book_count()
{
    $connection = get_db_connection();
    $query = "SELECT COUNT(*) as book_count FROM books";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result)['book_count'] ?? 0;
}
function get_issue_book_count()
{
    $connection = get_db_connection();
    $query = "SELECT COUNT(*) as issue_book_count FROM issued_books WHERE status = 1";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result)['issue_book_count'] ?? 0;
}

function get_category_count()
{
    $connection = get_db_connection();
    $query = "SELECT COUNT(*) as cat_count FROM category";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result)['cat_count'] ?? 0;
}
?>