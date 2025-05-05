<!-- add_book.php -->
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
    <title>Add New Book</title>
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
    <div class="container">

        <!--- Form --->
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>Add a New Book</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="book_name" class="form-label">Book Name:</label>
                        <input type="text" name="book_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="book_author" class="form-label">Select Author:</label>
                        <select name="book_author" class="form-control" required>
                            <option value="">-- Select Author --</option>
                            <?php
                            $query = "SELECT author_id, author_name FROM authors";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['author_id']}'>{$row['author_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="book_category" class="form-label">Select Category:</label>
                        <select name="book_category" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $query = "SELECT cat_id, cat_name FROM category";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="book_no" class="form-label">ISBN Number:</label>
                        <input type="text" name="book_no" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="book_price" class="form-label">Book Price:</label>
                        <input type="text" name="book_price" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Determines if book already exists in the database
if (isset($_POST['add_book'])) {
    $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
    $author_id = intval($_POST['book_author']);
    $category_id = intval($_POST['book_category']);
    $book_no = intval($_POST['book_no']);
    $book_price = floatval($_POST['book_price']);

    $check = "SELECT * FROM books WHERE book_no = $book_no OR LOWER(book_name) = LOWER('$book_name')";
    $result = mysqli_query($connection, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Book already exists (duplicate ISBN or title).');</script>";
    } else {
        $insert_query = "INSERT INTO books VALUES (
            NULL,
            '$book_name',
            $author_id,
            $category_id,
            $book_no,
            $book_price
        )";

        if (mysqli_query($connection, $insert_query)) {
            echo "<script>alert('Book added successfully.'); window.location.href='manage_book.php';</script>";
        } else {
            echo "<script>alert('Failed to add book.');</script>";
        }
    }
}
?>