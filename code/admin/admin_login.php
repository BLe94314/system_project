<!--- admin_login.php -->
<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($connection, "SELECT name, email, password FROM admins WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $email_db, $db_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Assigns role to admin if password matches the database
    if ($password === $db_password) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email_db;
        $_SESSION['role'] = 'admin';
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href='admin_login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login | Library Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: #f8f9fa;">
    <!--- Top Navigation --->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Library Management System (LMS)</a>
            <div class="ms-auto">
                <a class="btn btn-outline-light me-2" href="../index.php">User Login</a>
                <a class="btn btn-outline-light me-2" href="admin_login.php">Admin Login</a>
                <a class="btn btn-outline-light" href="../signup.php">Signup</a>
            </div>
        </div>
    </nav>

    <!--- Form --->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($login_error)): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $login_error; ?>
                        </div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>