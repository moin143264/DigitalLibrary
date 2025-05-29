<?php
if (isset($_GET['pdf'])) {
    $pdf_url = "https://digitallibrarymanagement.kesug.com/admin/dash_pdf/" . $_GET['pdf'];  // URL to the PDF file

    // Sanitize URL
    $pdf_url = htmlspecialchars($pdf_url, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform." />
    <meta name="keywords" content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com" />
    <meta name="author" content="Digital Library Team" />
    <meta name="robots" content="index, follow" />
    <link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
    <title>View PDF</title>
    <style>
        body {
            text-align: center;
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        .pdf-container {
            width: 100%;
            height: 80vh; /* Adjust height as needed */
            border: 1px solid #ccc;
            margin: 0 auto;
        }
        .close-button {
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="pdf-container">
        <iframe src="https://docs.google.com/viewer?url=<?php echo urlencode($pdf_url); ?>&embedded=true" width="100%" height="100%" style="border: none;"></iframe>
    </div>
    <br>
    <button class="close-button" onclick="window.location.href='../Main.php';">Close</button>
</body>
<script src="admin/inc/inc.js?v=1.0"></script>
</html>
<?php
} else {
    echo "No PDF file specified.";
}
?>
