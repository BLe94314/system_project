<!--- view_profile.php -->
<?php
require_once("auth.php");
require_role('user', 'index.php');

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $email = $mobile = $address = "";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT name, email, mobile, address FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $address = $row['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <!--- Prevents caching --->

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!--- Prevents back navigation if usesr is logged out --->
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
    <!--- Top navigation --->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_dashboard.php">Library Management System (LMS)</a>
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
                        data-bs-toggle="dropdown" aria-expanded="false">
                        My Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="view_profile.php">View Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <!--- Form --->
    <div class="container">
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center">
                <h4>User Profile Details</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" value="<?php echo $name; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $email; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile:</label>
                        <input type="text" class="form-control" value="<?php echo $mobile; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <input type="text" class="form-control" value="<?php echo $address; ?>" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>