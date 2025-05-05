<!--- register.php -->
<?php
$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$mobile = htmlspecialchars($_POST['mobile']);
$address = htmlspecialchars($_POST['address']);

$email_check = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connection, $email_check);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Email already registered. Please login or use another email.'); window.location.href = 'signup.php';</script>";
    exit();
}

$query = "INSERT INTO users (name, email, password, mobile, address) 
          VALUES ('$name', '$email', '$password', '$mobile', '$address')";
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    echo "<script>alert('Registration successful! You may now log in.'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Registration failed. Please try again.'); window.location.href = 'signup.php';</script>";
}
?>