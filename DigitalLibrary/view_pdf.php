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

// Query to get the PDF file name and payment information from the database
$sql = "
    SELECT p.pdf_id, p.purchase_time, p.date_one_month_later, c.link AS pdf_name
    FROM payments p
    JOIN card c ON p.pdf_id = c.id
    WHERE p.pdf_id = ? AND p.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $pdf_id, $user_id); 
$stmt->execute();
$result = $stmt->get_result();
$payment_info = $result->fetch_assoc();

if ($payment_info) {
    $pdf_name = $payment_info['pdf_name'];
    $date_one_month_later = new DateTime($payment_info['date_one_month_later']);
    $purchase_time = new DateTime($payment_info['purchase_time']);
    $current_time = new DateTime();

    // Check if current time is before the date one month later
    if ($current_time < $date_one_month_later) {
        // Serve the PDF file
        $pdf_url = "https://digitallibrarymanagement.kesug.com/admin/dash_pdf/" . urlencode($pdf_name); // Use urlencode for safe URL

        // Debug output to check file path
        // Use file_exists for debugging (optional)
        // $file_path = 'admin/dash_pdf/' . urlencode($pdf_name);
        // if (!file_exists($file_path)) {
        //     echo "PDF file not found: " . $file_path;
        //     exit();
        // }
    
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />
<link rel="stylesheet" href="animate.css?v=1.0" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WATCH</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .pdf-container {
            width: 100%;
            height: 100vh; /* Full viewport height */
        position: relative;
            border: 1px solid #ccc;
            
        }
        .close-button {
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .close-button:hover {
            background-color: #0056b3;
            }
            /* Container for the PDF viewer */

    /* Overlay to block the toolbar */
    .toolbar-overlay {
        position: absolute;
        top: 0; /* Ensure it covers the top toolbar */
        left: 0;
        width: 100%;  /* Cover the full width */
        height: 60px; /* Adjust this to match the height of the Google Docs toolbar */
        background-color: white; /* Can be transparent if needed, but white will hide it completely */
        z-index: 10; /* Ensure it sits above the iframe */
        pointer-events: none; /* Make sure it blocks clicks only on the toolbar */
    }

    /* Responsive adjustment for mobile */
    @media (max-width: 768px) {
        .toolbar-overlay {
            height: 70px; /* Slightly increase height for mobile if needed */
        }
    }

    @media (max-width: 480px) {
        .toolbar-overlay {
            height: 80px; /* Further increase for small screens */
        }
    }
    </style>


</head>
<link rel="stylesheet" href="style.css">
<body  class="ocean-breeze">
<header>
<nav class="navbar navbar-expand-sm">
    <div class="container">
    <span
    class='fa-solid'
        style="
         
          color: #003366;
          
          text-shadow: 2px 2px 4px #ddd;
          text-shadow: #ddd;
        "
      >
      <i class="fas fa-university" style="font-size: 1.0em; color: #003366;">   Digital  Library</i>

      </span>



      <button
        class="navbar-toggler d-lg-none"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#collapsibleNavId"
        aria-controls="collapsibleNavId"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 mx-5">
        <li class="nav-item me-auto">
            <a class="nav-link" href="Main.php"
              ><i style="color: #003366" class="fa-solid fa-book"
                >Library</i
              ></a
            >
          </li>
        
 
          <li class="nav-item me-auto">
          
          <a class="nav-link" href="Main_logout.php" >
              <i class="fa-solid fa-right-from-bracket"  style="color: #003366">Logout</i> 
          </a>
      
    </li> 
        </ul>
      
      </div>
    </div>
  </nav>
 
</header>

<main>

<div class="pdf-container">
    <div style="position:relative; width:100%; height:100%;">
        <!-- Embed Google Docs Viewer -->
        <iframe src="https://docs.google.com/viewer?url=<?php echo urlencode($pdf_url); ?>&embedded=true" width="100%" height="100%" style="border: none;" id="pdfFrame"></iframe>
        
        <!-- Overlay to block the entire toolbar -->
        <div class="toolbar-overlay"></div>
    </div>
</div>
<br>

<button class="close-button" onclick="window.location.href='../Main.php';">Close</button>
</main>
<script src="admin/inc/inc.js?v=1.0"></script>
<footer >
  

<?php include 'admin/inc/footer.html'; ?>
                    </footer>
                <script>
    // Ensure that the iframe toolbar is blocked after loading the content
    document.getElementById('pdfFrame').addEventListener('load', function() {
        // Adjust iframe size or do anything after the PDF is loaded
    });
</script>
                    <!-- Bootstrap JS Bundle with Popper -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>
                

    <?php
} else {
    echo "<div style='text-align: center; margin-top: 20px;'>
            <h3>Your access to this PDF has expired.</h3>
            <p>To continue viewing this PDF, please renew your subscription.</p>
            <a href='renew_pay.php?pdf_id=$pdf_id' class='btn btn-primary'>Renew Access</a>
          </div>";
}

} else {
echo "No PDF found for the given ID or you do not have access.";
}

$conn->close();
?>
