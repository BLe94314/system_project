<!--- index.php -->
<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Library Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap 5 JS (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style type="text/css">
    #main_content {
        background: rgba(245, 245, 245, 0.9);
        padding: 50px;
    }

    #side_bar {
        background: rgba(245, 245, 245, 0.9);
        padding: 50px;
    }

    body {
        background: rgba(245, 245, 245, 0.4);
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Library Management System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../code/admin/admin_login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php"></span>Signup</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="col-md-12" id="main_content">
        <center>
            <h3><u>User Login Form</u></h3>
        </center>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email ID:</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div><br>
            <center>
                <div class="button-group">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>&emsp;
                    <a href="signup.php">Sign Up</a>
                </div>
            </center>
        </form>
        <?php
        if (isset($_POST['login'])) {
            $connection = mysqli_connect("localhost", "root", "");
            $db = mysqli_select_db($connection, "lms");
            $query = "select * from users where email = '$_POST[email]'";
            $query_run = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($query_run)) {
                if ($row['email'] == $_POST['email']) {
                    if ($row['password'] == $_POST['password']) {
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['id'] = $row['id'];
                        header("Location: user_dashboard.php");
                    } else {
                        ?>
                        <br><br>
                        <center><span class="alert-danger">Wrong Password !!</span></center>
                        <?php
                    }
                }
            }
        }
        ?>
    </div>
</body>

</html>