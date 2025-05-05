<!--- edit_profile.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $email = $mobile = "";
$query = "SELECT * FROM admins WHERE email = '{$_SESSION['email']}'";
$query_run = mysqli_query($connection, $query);
if ($row = mysqli_fetch_assoc($query_run)) {
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
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
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <form action="update.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name"
                            value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" name="mobile"
                            value="<?php echo htmlspecialchars($mobile); ?>" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>