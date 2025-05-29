<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: Main_Login.html");
    exit();
}

// If logged in, redirect to the buy page
$id = isset($_GET['id']) ? urlencode($_GET['id']) : '';
header("Location: Ordered.php?id=$id");
exit();
?>
