<?php
session_start();
include "conn.php";

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: Main_Login.html");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "User ID not found. Please log in again.";
    exit();
}

$user_id = $_SESSION['user_id']; // Use user ID from session

// Check if pdf_name is set in the GET request
if (!isset($_GET['pdf_name'])) {
    echo "PDF name is not specified.";
    exit();
}

$pdf_name = $_GET['pdf_name']; // PDF name from request

// Query to get payment details
$sql = "SELECT expiration_date FROM payments WHERE user_id = ? AND pdf_name = ?";
$stmt = $conn->prepare($sql); // Prepare the SQL query
$stmt->bind_param("ss", $user_id, $pdf_name); // Bind parameters
$stmt->execute();
$payment = $stmt->get_result()->fetch_assoc(); // Fetch the result

if ($payment) {
    $expiration_date = new DateTime($payment['expiration_date']);
    $current_date = new DateTime();

    if ($current_date > $expiration_date) {
        // PDF has expired
        echo "This PDF has expired. Please renew your access.";
        exit();
    } else {
        // Serve the PDF file
        $file_path = 'pdf/' . $pdf_name . '.pdf';

        if (file_exists(__DIR__ . '/' . $file_path)) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
            <link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />

                <title>View PDF</title>
                <style>
                    body {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin: 0;
                        background-color: #f0f0f0;
                    }
                    #pdf-viewer {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        width: 100%;
                        max-width: 800px;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        background-color: #fff;
                        border-radius: 10px;
                    }
                    .page {
                        border: 1px solid #000;
                        margin-bottom: 10px;
                    }
                </style>
            </head>
            <body>
                <div id="pdf-viewer"></div>
                <script type="module">
                    import * as pdfjsLib from "./pdf/pdfjs/build/pdf.mjs";

                    pdfjsLib.GlobalWorkerOptions.workerSrc = "./pdf/pdfjs/build/pdf.worker.mjs";

                    const url = "<?php echo $file_path; ?>";
                    console.log("PDF URL: " + url);

                    const loadingTask = pdfjsLib.getDocument(url);
                    loadingTask.promise.then(function(pdf) {
                        console.log("PDF loaded");

                        const viewer = document.getElementById("pdf-viewer");

                        const renderPage = (pageNum) => {
                            pdf.getPage(pageNum).then(function(page) {
                                const scale = 1.5;
                                const viewport = page.getViewport({ scale: scale });

                                const canvas = document.createElement("canvas");
                                canvas.className = 'page';
                                const context = canvas.getContext("2d");
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                viewer.appendChild(canvas);

                                const renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                const renderTask = page.render(renderContext);
                                renderTask.promise.then(function() {
                                    console.log(`Page ${pageNum} rendered`);
                                });
                            });
                        };

                        for (let i = 1; i <= 3; i++) {
                            renderPage(i);
                        }
                    }, function(reason) {
                        console.error(reason);
                    });
                </script>
            </body>
            </html>
            <?php
        } else {
            echo "File not found.";
        }
    }
} else {
    echo "No payment record found.";
}
?>
