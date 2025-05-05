<!--- auth.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Prevents caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Checks if role matches the user and permits access to webpage
function require_role($expected_role, $redirect_to)
{
    if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== $expected_role) {
        header("Location: $redirect_to");
        exit();
    }
}
?>