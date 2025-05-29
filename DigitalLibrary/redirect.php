<?php
require 'vendor/autoload.php'; // Include Stripe PHP library
include "conn.php";

\Stripe\Stripe::setApiKey('sk_test_51Q8uua07CIuzAORvoSqGHBKwha3AcjbDcvsI4qwpAtViFMp3dhFq8TUq1PUnlSq5dTeAbTEjwfmfpugUd159Z3Mk009H1nXMUh'); // Replace with your Stripe Secret Key

session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: Main_Login.html");
    exit();
}

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session.";
    exit();
}

$user_id = $_SESSION['user_id']; // Use user ID from session

// Retrieve PDF ID and payment intent ID from the GET request
$pdf_id = $_GET['pdf_id'];
$paymentIntentId = $_GET['payment_intent'];

if (empty($paymentIntentId)) {
    echo "Payment intent ID is missing.";
    exit();
}

try {
    // Retrieve the payment intent from Stripe
    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);



    // Check the payment status
    if ($paymentIntent->status === 'succeeded') {
        // Payment was successful, insert into database
        // Assign metadata values to variables
        $name = $paymentIntent->metadata->name ?? 'Unknown Book'; // Fallback if name is missing
        $cost = $paymentIntent->amount / 100; // Amount is in cents, convert to dollars
        $email = $paymentIntent->metadata->email ?? 'No email provided';
        $phone = $paymentIntent->metadata->phone ?? 'No phone provided';
        $paymentId = $paymentIntent->id;
        $purchaseTime = date('Y-m-d H:i:s');
        $dateOneMonthLater = date('Y-m-d', strtotime('+1 month'));

        // Check if the user has already purchased this book
        $sql_check_purchase = "
            SELECT * 
            FROM payments
            WHERE pdf_id = ? AND user_id = ?
        ";
        $stmt_check_purchase = $conn->prepare($sql_check_purchase);
        $stmt_check_purchase->bind_param("ii", $pdf_id, $user_id);
        $stmt_check_purchase->execute();
        $result_check_purchase = $stmt_check_purchase->get_result();

        if ($result_check_purchase->num_rows === 0) { // Proceed only if not purchased yet
            $sql_insert_payment = "
                INSERT INTO payments (name, cost, email, contact, payment_id, purchase_time, date_one_month_later, pdf_id, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";
            $stmt_insert_payment = $conn->prepare($sql_insert_payment);
            $stmt_insert_payment->bind_param(
                "sdsdsssis",
                $name,
                $cost,
                $email,
                $phone,
                $paymentId,
                $purchaseTime,
                $dateOneMonthLater,
                $pdf_id,
                $user_id
            );

            if ($stmt_insert_payment->execute()) {
                // Generate and store the full URL to the PDF display page
                $pdf_url = "https://digitallibrarymanagement.kesug.com/view_pdf.php?id=" . urlencode($pdf_id);
                $sql_insert_pdf = "
                    INSERT INTO purchase_pdf (user_id, pdf_url, name)
                    VALUES (?, ?, ?)
                ";
                $stmt_insert_pdf = $conn->prepare($sql_insert_pdf);
                $stmt_insert_pdf->bind_param("iss", $user_id, $pdf_url, $name);
                $stmt_insert_pdf->execute();

                // Redirect to the PDF display page
                header("Location: view_pdf.php?id=$pdf_id");
                exit();
            } else {
                echo "<h1>Error saving payment information.</h1>";
            }
        } else {
            echo "<h1>You have already purchased this book.</h1>";
        }
    } else {
        echo "<h1>Payment Status: {$paymentIntent->status}</h1>";
        // Handle other payment statuses as needed
    }
} catch (\Stripe\Exception\InvalidRequestException $e) {
    echo "Invalid Request: " . $e->getMessage();
} catch (\Exception $e) {
    echo "Error retrieving payment: " . $e->getMessage();
}

$conn->close();
?>
