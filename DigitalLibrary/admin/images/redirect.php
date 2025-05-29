<?php
session_start();
include "conn.php";

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

// Check if pdf_id is set in the GET request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "PDF ID is not specified.";
    exit();
}

$pdf_id = $_GET['id']; // PDF ID from request

// Check if payment_id and payment_status are set in the GET request
if (!isset($_GET['payment_id']) || !isset($_GET['payment_status'])) {
    echo "Payment information is missing.";
    exit();
}

$payment_id = $_GET['payment_id']; // Payment ID from request
$payment_status = $_GET['payment_status']; // Payment status from request

if ($payment_status == 'Credit') {
    // Check if the user has already purchased this book
    $sql_check_purchase = "
        SELECT COUNT(*) AS purchase_count
        FROM payments
        WHERE pdf_id = ? AND user_id = ?
    ";
    $stmt_check_purchase = $conn->prepare($sql_check_purchase);
    $stmt_check_purchase->bind_param("ii", $pdf_id, $user_id);
    $stmt_check_purchase->execute();
    $result_check_purchase = $stmt_check_purchase->get_result();
    $purchase_info = $result_check_purchase->fetch_assoc();

  
    // Fetch payment details from Instamojo
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://test.instamojo.com/v2/payments/$payment_id/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer zeeGbzPPyZTldftpjXczuxxMncinyBQu_m6kc48pFO8.MIbuAnipNSRk8RGlGo_s3nVx9aO1Kr4BTIU_mYmkg7I'));

    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    if (isset($response['title']) && isset($response['amount']) && isset($response['email']) && isset($response['phone'])) {
        $book_name = $response['title'];
        $cost = $response['amount'];
        $email = $response['email'];
        $contact = $response['phone'];

        $purchase_time = date('Y-m-d H:i:s');
        $date_one_month_later = date('Y-m-d', strtotime('+1 month'));

        // Insert payment record
        $sql_insert_payment = "
            INSERT INTO payments (name, cost, email, contact, payment_id, purchase_time, date_one_month_later, pdf_id, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $stmt_insert_payment = $conn->prepare($sql_insert_payment);
        $stmt_insert_payment->bind_param("sdsdsssis", $book_name, $cost, $email, $contact, $payment_id, $purchase_time, $date_one_month_later, $pdf_id, $user_id);
        $stmt_insert_payment->execute();

        if ($stmt_insert_payment->affected_rows > 0) {
            // Generate and store the full URL to the PDF display page
            $pdf_url = "http://digitallibrarymanagement.kesug.com/view_pdf.php?id=" . urlencode($pdf_id);
            $sql_insert_pdf = "
                INSERT INTO purchase_pdf (user_id, pdf_url,name)
                VALUES (?, ?,?)
            ";
            $stmt_insert_pdf = $conn->prepare($sql_insert_pdf);
            $stmt_insert_pdf->bind_param("iss", $user_id, $pdf_url,$book_name);
            $stmt_insert_pdf->execute();

            // Redirect to the PDF display page
            header("Location: view_pdf.php?id=$pdf_id");
            exit();
        } else {
            echo "Failed to update payment record.";
        }
    } else {
        echo "Payment data is incomplete.";
    }
} else {
    echo "Invalid payment status.";
}

$conn->close();
?>
