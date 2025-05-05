<!--- index.php -->
<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // Checks if password matches and applied role as user
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['role'] = 'user';
        header("Location: user_dashboard.php");
        exit();
    } else {
        $login_error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login | Library Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<!--- Top navigation --->

<body style="background-color: #f8f9fa;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Library Management System (LMS)</a>
            <div class="ms-auto">
                <a class="btn btn-outline-light me-2" href="index.php">User Login</a>
                <a class="btn btn-outline-light me-2" href="../code/admin/admin_login.php">Admin Login</a>
                <a class="btn btn-outline-light" href="signup.php">Signup</a>
            </div>
        </div>
    </nav>
    <!--- Form --->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>User Login</h4>
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
                            <div class="d-grid gap-2">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <span>Don't have an account?</span> <a href="signup.php">Sign up here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>