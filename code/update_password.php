<!--- update_password.php -->
<?php
require_once("auth.php");
require_role('user', 'index.php');

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

$current_password = "";
$query = "SELECT password FROM users WHERE email = '$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
    $current_password = $row['password'];
}

// Checks if old password matches and changes to new password
// Hashes the new password to database
if (password_verify($_POST['old_password'], $current_password)) {
    $new_password_hashed = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$new_password_hashed' WHERE email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection, $query);
    ?>
    <script type="text/javascript">
        alert("Password updated successfully.");
        window.location.href = "user_dashboard.php";
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Incorrect current password.");
        window.location.href = "change_password.php";
    </script>
    <?php
}
?>