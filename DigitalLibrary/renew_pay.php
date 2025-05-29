<?php
session_start();
include "conn.php";

// Retrieve the PDF ID from query parameters
$pdf_id = isset($_GET['pdf_id']) ? intval($_GET['pdf_id']) : 0;

if ($pdf_id <= 0) {
    die("Invalid PDF ID.");
}

// Prepare and execute the query to fetch data
$stmt = $conn->prepare("SELECT name, cost, email, contact FROM payments WHERE pdf_id = ?");
$stmt->bind_param("i", $pdf_id);
$stmt->execute();
$stmt->bind_result($name, $cost, $email, $contact);
$stmt->fetch();
$stmt->close();

// Check if the necessary data was fetched
if (empty($name) || empty($cost) || empty($email) || empty($contact)) {
    die("Required data is missing.");
}

// Stripe API configuration
require 'vendor/autoload.php'; // Include Composer's autoloader
\Stripe\Stripe::setApiKey('sk_test_51Q8uua07CIuzAORvoSqGHBKwha3AcjbDcvsI4qwpAtViFMp3dhFq8TUq1PUnlSq5dTeAbTEjwfmfpugUd159Z3Mk009H1nXMUh');

try {
    // Create a PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $cost * 100, // Stripe expects the amount in cents
        'currency' => 'usd', // Adjust currency as needed
        'payment_method_types' => ['card'],
    ]);

    // Redirect to the payment page
    header("Location: make_payment.php?client_secret=" . $paymentIntent->client_secret . "&pdf_id=" . $pdf_id);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle API error
    echo json_encode(['error' => $e->getMessage()]);
}
?>
