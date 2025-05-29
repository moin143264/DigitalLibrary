<?php
session_start();
include "conn.php";

// Fetch the current user ID
$user_id = $_SESSION['user_id']; // Adjust this according to your session handling

// Fetch the PDF ID from a GET request
$pdf_id = isset($_GET['pdf_id']) ? $_GET['pdf_id'] : null;

if ($pdf_id) {
    // Fetch the expiry date from the database based on user_id and pdf_id
    $query = "SELECT * FROM payments WHERE user_id = ? AND pdf_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $pdf_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
        $current_expiry_date = $row['date_one_month_later'];
        $current_date = date('Y-m-d');

        // Check if the expiry date has passed
        if ($current_date >= $current_expiry_date) {
            // If expired, update the expiry date to one month from today
            $new_expiry_date = date('Y-m-d', strtotime('+1 month'));

            // Update the expiry date in the database for this user and PDF
            $update_query = "UPDATE payments SET date_one_month_later = ? WHERE user_id = ? AND pdf_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("sii", $new_expiry_date, $user_id, $pdf_id);
            $update_stmt->execute();

            echo "Expiry date updated to: " . $new_expiry_date;
            echo "<div style='text-align: center; margin-top: 20px;'>
                    <h3>Your access to this PDF has been renewed.</h3>
                    <p>To continue viewing this PDF, click the link below:</p>
                    <br><a href='purch.php?pdf_id=" . $pdf_id . "'>View PDF</a>
                  </div>";
        } else {
            echo "Link is still valid until: " . $current_expiry_date;
        }
    } else {
        echo "No expiry data found for this user and PDF.";
    }

    $stmt->close();
} else {
    echo "Invalid or missing PDF ID.";
}

$conn->close();
?>
