<!--- update.php -->
<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");
$query = "UPDATE users SET name='$name', email='$email', mobile='$mobile', address='$address' WHERE email='$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);
?>
<script type="text/javascript">
    alert("Updated successfully...");
    window.location.href = "user_dashboard.php";
</script>