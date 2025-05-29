<?php

include "conn.php";



// Check if necessary parameters are present
if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['payment_id']) || !isset($_GET['payment_request_id'])) {
    echo "Missing parameters. Please ensure the redirect URL includes all required parameters.";
    exit;
}

$id = $_GET['id'];
$payment_id = $_GET['payment_id'];
$payment_request_id = $_GET['payment_request_id'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/v2/payment_requests/' . $payment_request_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer Kevmvlqc8Z4YglxCxJWpyDgkyayvXCVDTkkn2am6bbg.8DH0EViXqtpBiHTIQ0JO3PjciN30NdUzLQoGFKk7BnY'
));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

$response = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON decode error: ' . json_last_error_msg();
    exit;
}

if (isset($response['payments'][0])) {
    $payment_url = $response['payments'][0];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $payment_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer Kevmvlqc8Z4YglxCxJWpyDgkyayvXCVDTkkn2am6bbg.8DH0EViXqtpBiHTIQ0JO3PjciN30NdUzLQoGFKk7BnY'
    ));

    $payment_response = curl_exec($ch);
    curl_close($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        exit;
    }

    $payment_response = json_decode($payment_response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'JSON decode error: ' . json_last_error_msg();
        exit;
    }

    if (isset($payment_response['status']) && $payment_response['status'] == 'Credit') {
        $name = $response['purpose'];
        $cost = $response['amount'];
        $email = $payment_response['email'];
        $contact = $payment_response['phone'];

        $purchase_time = date('Y-m-d H:i:s');
        $date_one_month_later = date('Y-m-d', strtotime('+1 month'));

        $sql = "insert into payments values(null,'$name','$cost','$email','$contact','$payment_id','$purchase_time','$date_one_month_later','$pdf_id','$user_id')";

        if (mysqli_query($conn, $sql)) {
            // Fetch product details using the id
            $stmt = $conn->prepare("SELECT * FROM card WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $product_link = htmlspecialchars($row['link']);
                echo"sUCCESSS
                
                ";
                

















               
            } else {
                echo "Failed to retrieve product details.";
            }
        } else {
            echo "Failed to store payment details: " . mysqli_error($conn);
        }
    } else {
        echo "Payment not successful.";
    }
} else {
    echo "No payments found or response format is incorrect.";
}

$conn->close();
?>
