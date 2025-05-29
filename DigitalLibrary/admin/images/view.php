<?php
if (isset($_GET['pdf'])) {
    $pdf_path = "dash_pdf/" . $_GET['pdf'];  // Path to the PDF file
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF</title>
    <style>
        body {
            text-align: center;
            margin: 20px;
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
        .ocean-breeze {
  background: linear-gradient(to top, #d0f0f0, #a1c4fd 50%, #d4a5a5);
  height: 100vh;
}



footer{
  background-color:#D8CFFF;
}
    </style>
</head>
<body
    class="ocean-breeze"
  >
    <embed src="<?php echo $pdf_path; ?>" width="800" height="500" type="application/pdf">
    <br>
    <button class="close-button" onclick="window.location.href='../Main.php';">Close</button>
</body>
</html>
<?php
} else {
    echo "No PDF file specified.";
}
?>




