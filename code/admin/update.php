<!--- update.php -->
<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$email_check_query = "SELECT * FROM admins WHERE email = '$email' AND email != '$_SESSION[email]'";
$email_check_result = mysqli_query($connection, $email_check_query);

$mobile_check_query = "SELECT * FROM admins WHERE mobile = '$mobile' AND email != '$_SESSION[email]'";
$mobile_check_result = mysqli_query($connection, $mobile_check_query);

if (mysqli_num_rows($email_check_result) > 0) {
    ?>
    <script type="text/javascript">
        alert("The email address is already taken. Please use another.");
        window.location.href = "edit_profile.php";
    </script>
    <?php
} elseif (mysqli_num_rows($mobile_check_result) > 0) {
    ?>
    <script type="text/javascript">
        alert("The mobile number is already taken. Please use another.");
        window.location.href = "edit_profile.php";
    </script>
    <?php
} else {
    $update_query = "UPDATE admins SET name='$name', email='$email', mobile='$mobile' WHERE email='$_SESSION[email]'";
    $update_result = mysqli_query($connection, $update_query);

    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    ?>
    <script type="text/javascript">
        alert("Profile updated successfully.");
        window.location.href = "admin_dashboard.php";
    </script>
    <?php
}
?>