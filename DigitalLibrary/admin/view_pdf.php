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
        $file_path = 'admin/dash_pdf/' . urlencode($pdf_name); // Use urlencode for safe URL

        // Debug output to check file path
        if (!file_exists($file_path)) {
            echo "PDF file not found: " . $file_path;
            exit();
        }

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
  
  body {
  margin: 0;
  padding: 0;
  height: 100vh; /* Full viewport height */
  display: flex;
  flex-direction: column;
}



main {
  margin-top: 60px; /* Match header height */
  margin-bottom: 60px; /* Match footer height */
  overflow: scroll; /* Enable scrolling for the main content area */
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.pdf-frame {
  width: 90%;
  max-width: 1200px; /* Adjust as needed */
  
  border: 1px solid #ccc;
  background:black;
  /* display:flex;
  align-items:center;
  justify-content:center; */
   /* Enable scrolling within the frame */
}


.pdf-frame::after {
  content: 'Loading...'; /* Text shown while loading */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 1.5em;
  color: #007bff;
  z-index: 10; /* Ensure loading text is on top */
  
}
.page {
        width: 100%;
        max-width: 100%;
        margin: 10px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .page canvas {
        width: 90% !important;
        height: auto !important;
    }

    </style>
</head>
<link rel="stylesheet" href="../animate.css?v=1.0" />
<body class="ocean-breeze">
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-dark">
            <div class="container">
                <small style="font-size: 20px; color: white">Digital<span style="color: white">Library</span></small>
                <button class="navbar-toggler d-lg-none bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0 mx-5">
                        <li class="nav-item me-3">
                            <a class="nav-link" href="index.php" aria-current="page">
                                <div class="dash-icon">
                                    <i style="color: red; font-size: 25px" class="fa-solid fa-house-user"></i> <span class='text-light'>Home</span>
                                </div>
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Main_logout.php">
                                <i style="color: blue; font-size: 25px" class="fa-solid fa-right-from-bracket"></i><span class='text-light'>Logout</span>
                                <?php echo isset($_SESSION["loggin"]) ? $_SESSION["loggin"] : ''; ?>
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" style="position: relative" action="https://www.google.com/search" method="GET">
                        <input class="form-control me-sm-2" type="text" name="q" placeholder="Search" style="box-shadow: none; border-radius: 20px; max-width: 100%">
                        <button class="btn btn-outline-background" type="submit" style="position: absolute; right: 10px; top: 0; bottom: 0; border: none;">
                            <i class="fa-solid fa-magnifying-glass fa-flip fa-md search-icon"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class='pdf-frame ms-auto me-auto my-5 ' style='max-width:750px'>

        <div id="pdf-viewer" style="height: 100vh; overflow-y: scroll;"></div>
    <script type="module">
        import * as pdfjsLib from "./admin/dash_pdf/pdf/PDFJS/build/pdf.js";
        pdfjsLib.GlobalWorkerOptions.workerSrc = "./admin/dash_pdf/pdf/PDFJS/build/pdf.worker.js";

        const url = "<?php echo htmlspecialchars($file_path); ?>";
        console.log("Loading PDF from URL: " + url);

        const loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            const viewer = document.getElementById("pdf-viewer");
            const pageCache = {}; // Cache for rendered pages
            let pageHeight = 1000; // Initial page height estimate, adjust as needed

            const renderPage = (pageNum) => {
                if (pageCache[pageNum]) return; // Skip rendering if already cached

                pdf.getPage(pageNum).then(function(page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({ scale: scale });

                    const canvas = document.createElement("canvas");
                    canvas.className = 'page';
                    canvas.dataset.page = pageNum; // Store page number in dataset
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
                        pageCache[pageNum] = true; // Cache page as rendered
                    });
                });
            };

            const loadVisiblePages = () => {
                const viewportHeight = viewer.clientHeight;
                const scrollTop = viewer.scrollTop;

                // Adjust page height based on actual content
                if (pageHeight === 1000) {
                    // Estimate page height from the first rendered page if not set
                    const firstPage = document.querySelector('.page');
                    if (firstPage) {
                        pageHeight = firstPage.offsetHeight;
                    }
                }

                // Determine visible page range
                const startPage = Math.max(1, Math.floor(scrollTop / pageHeight));
                const endPage = Math.min(pdf.numPages, Math.ceil((scrollTop + viewportHeight) / pageHeight));

                // Render pages in range
                for (let pageNum = startPage; pageNum <= endPage; pageNum++) {
                    if (!document.querySelector(`.page[data-page="${pageNum}"]`)) {
                        renderPage(pageNum);
                    }
                }
            };

            // Initial load
            loadVisiblePages();

            // Attach scroll event listener
            viewer.addEventListener('scroll', () => {
                clearTimeout(viewer.scrollTimeout); // Debounce scroll events
                viewer.scrollTimeout = setTimeout(loadVisiblePages, 100);
            });
        }, function(reason) {
            console.error("Error loading PDF: ", reason);
        });
    </script>
      

</main>
<script src="./inc/inc.js?v=1.0"></script>
    <footer>
    <?php include './inc/footer.html'; ?>
                        </footer>
                    
                        <!-- Bootstrap JS Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    </body>
                    </html>
                    

        <?php
    } else {
        echo "PDF access has expired.";
    }
} else {
    echo "No PDF found for the given ID or you do not have access.";
}

$conn->close();
?>
