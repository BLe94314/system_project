<!--- issue_book.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Issue Book</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <!--- Prevents caching --->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!--- Prevents back navigation if admin is not logged in --->
    <script>
        window.addEventListener("pageshow", function (event) {
            if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
                window.location.reload();
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: #f8f9fa;">
    <!--- Top Navigation --->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
            </div>
            <font style="color: white"><span><strong>Welcome:
                        <?php echo $_SESSION['name']; ?>
                    </strong></span></font>
            <font style="color: white"><span><strong>Email:
                        <?php echo $_SESSION['email']; ?>
                    </strong></font>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown">
                        My Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view_profile.php">View Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="change_password.php">Change Password</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--- Secondary Navigation --->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Books</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_book.php">Add New Book</a></li>
                        <li><a class="dropdown-item" href="manage_book.php">Manage Books</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Category</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_cat.php">Add New Category</a></li>
                        <li><a class="dropdown-item" href="manage_cat.php">Manage Category</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Authors</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_author.php">Add New Author</a></li>
                        <li><a class="dropdown-item" href="manage_author.php">Manage Author</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="issue_book.php">Issue Book</a></li>
            </ul>
        </div>
    </nav><br>

    <!--- Form --->
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>Issue Book</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="book_no" class="form-label">Select Book:</label>
                        <select name="book_no" class="form-control" required>
                            <option value="">-- Select Book --</option>
                            <?php
                            $book_query = "SELECT book_no, book_name FROM books";
                            $book_result = mysqli_query($connection, $book_query);
                            while ($book = mysqli_fetch_assoc($book_result)) {
                                echo "<option value='{$book['book_no']}'>{$book['book_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select User:</label>
                        <select name="student_id" class="form-control" required>
                            <option value="">-- Select User --</option>
                            <?php
                            $user_query = "SELECT id, name FROM users";
                            $user_result = mysqli_query($connection, $user_query);
                            while ($user = mysqli_fetch_assoc($user_result)) {
                                echo "<option value='{$user['id']}'>{$user['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="issue_date" class="form-label">Issue Date:</label>
                        <input type="text" name="issue_date" class="form-control" value="<?= date('Y-m-d'); ?>"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="issue_book" class="btn btn-primary">Issue Book:</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['issue_book'])) {
    $book_no = intval($_POST['book_no']);
    $student_id = intval($_POST['student_id']);
    $issue_date = mysqli_real_escape_string($connection, $_POST['issue_date']);

    $check_query = "SELECT * FROM issued_books 
                    WHERE book_no = $book_no AND student_id = $student_id AND status = 1";
    $check_result = mysqli_query($connection, $check_query);

    // Checks if the issuing book is the same as the currently issued book
    // User can only have one of the same book checked out at a time
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This book is already issued to this user.');</script>";
    } else {
        $book_query = "SELECT book_name, author_id FROM books WHERE book_no = $book_no LIMIT 1";
        $book_result = mysqli_query($connection, $book_query);
        $book = mysqli_fetch_assoc($book_result);

        if ($book) {
            $author_query = "SELECT author_name FROM authors WHERE author_id = {$book['author_id']} LIMIT 1";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            $author_name = $author ? $author['author_name'] : "Unknown";

            $insert_query = "INSERT INTO issued_books (
                book_no, book_name, book_author, student_id, status, issue_date
            ) VALUES (
                $book_no,
                '" . mysqli_real_escape_string($connection, $book['book_name']) . "',
                '" . mysqli_real_escape_string($connection, $author_name) . "',
                $student_id,
                1,
                '$issue_date'
            )";

            if (mysqli_query($connection, $insert_query)) {
                echo "<script>alert('Book issued successfully.'); window.location.href='admin_dashboard.php';</script>";
            } else {
                echo "<script>alert('Failed to issue book. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Book not found in the database.');</script>";
        }
    }
}
?>