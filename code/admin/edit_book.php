<!-- edit_book.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$book_no = intval($_GET['bn']);
$query = "SELECT * FROM books WHERE book_no = $book_no";
$result = mysqli_query($connection, $query);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "<script>alert('Book not found.'); window.location.href='manage_book.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Book</title>
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
                <h4>Edit Book</h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Book Number (ISBN)</label>
                        <input type="text" class="form-control"
                            value="<?php echo htmlspecialchars($book['book_no']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Book Name</label>
                        <input type="text" name="book_name" class="form-control" required
                            value="<?php echo htmlspecialchars($book['book_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Author</label>
                        <select name="author_id" class="form-control" required>
                            <option value="">-- Select Author --</option>
                            <?php
                            $authors = mysqli_query($connection, "SELECT * FROM authors");
                            while ($a = mysqli_fetch_assoc($authors)) {
                                $selected = ($a['author_id'] == $book['author_id']) ? "selected" : "";
                                echo "<option value='{$a['author_id']}' $selected>{$a['author_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="cat_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php
                            $categories = mysqli_query($connection, "SELECT * FROM category");
                            while ($c = mysqli_fetch_assoc($categories)) {
                                $selected = ($c['cat_id'] == $book['cat_id']) ? "selected" : "";
                                echo "<option value='{$c['cat_id']}' $selected>{$c['cat_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Book Price</label>
                        <input type="text" name="book_price" class="form-control" required
                            value="<?php echo htmlspecialchars($book['book_price']); ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-primary">Update Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// If update is selected and the system is connected to the database, update the book
if (isset($_POST['update'])) {
    $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
    $author_id = intval($_POST['author_id']);
    $cat_id = intval($_POST['cat_id']);
    $book_price = floatval($_POST['book_price']);

    $update_query = "UPDATE books 
                     SET book_name = '$book_name',
                         author_id = $author_id,
                         cat_id = $cat_id,
                         book_price = $book_price
                     WHERE book_no = $book_no";

    if (mysqli_query($connection, $update_query)) {
        echo "<script>alert('Book updated successfully.'); window.location.href='manage_book.php';</script>";
    } else {
        echo "<script>alert('Error updating book.');</script>";
    }
}
?>