<!--- update_password.php -->
<?php
require_once("../auth.php");
require_role('admin', 'admin_login.php');

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

$current_password = "";

$query = "SELECT password FROM admins WHERE email = '$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($query_run)) {
    $current_password = $row['password'];
}

if ($current_password == $_POST['old_password']) {
    $new_password = $_POST['new_password'];
    $update_query = "UPDATE admins SET password='$new_password' WHERE email='$_SESSION[email]'";
    $update_result = mysqli_query($connection, $update_query);
    ?>
    <script type="text/javascript">
        alert("Password updated successfully.");
        window.location.href = "admin_dashboard.php";
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