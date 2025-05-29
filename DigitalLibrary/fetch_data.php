<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "conn.php";

$pdf_id = isset($_GET['pdf_id']) ? intval($_GET['pdf_id']) : 0;

if ($pdf_id <= 0) {
    die("Invalid PDF ID.");
}

// Prepare and execute the query
$stmt = $conn->prepare("SELECT name, cost, email, contact FROM payments WHERE pdf_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $pdf_id);
$stmt->execute();
$stmt->bind_result($name, $cost, $email, $contact);
$stmt->fetch();
$stmt->close();

// Check if the necessary data was fetched
if (empty($name) || empty($cost) || empty($email) || empty($contact)) {
    die("Required data is missing.");
}

// Redirect to make_payment.php with query parameters
header("Location: make_payment.php?pdf_id=$pdf_id&name=" . urlencode($name) . "&cost=" . urlencode($cost) . "&email=" . urlencode($email) . "&contact=" . urlencode($contact));
exit();
?>
