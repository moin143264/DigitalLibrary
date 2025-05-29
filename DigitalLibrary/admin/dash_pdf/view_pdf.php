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
        $file_path = 'http://digitallibrarymanagement.kesug.com/htdocs/admin/dash_pdf/' . urlencode($pdf_name); // Use urlencode for safe URL

        ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        *{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, 'ans-serif';
        }
  body {
  margin: 0;
  padding: 0;
  height: 100vh; /* Full viewport height */
  display: flex;
  flex-direction: column;
}

/* header, footer {
  width: 100%;
  background-color: #d6cdcd; /* Match your header/footer background color */
   /* Ensure they stay on top of other content */
} */


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
<link rel="stylesheet" href="style.css">
<body style='background:black'>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-dark">
            <div class="container">
                <small style="font-size: 20px; color: white">Prime<span style="color: white">Library</span></small>
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
        import * as pdfjsLib from "./admin/dash_pdf/pdf/PDFJS/build/pdf.mjs";
        pdfjsLib.GlobalWorkerOptions.workerSrc = "./admin/dash_pdf/pdf/PDFJS/build/pdf.worker.mjs";

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
    <footer class="text-center text-sm-start text-dark mt-auto bg-dark">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Right -->
            <div>
                <a href="https://www.facebook.com/profile.php?id=100024523637556" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="mailto:ms66454566@gmail.com" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a href="https://www.instagram.com/s_moin_a/" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h3 class="text-uppercase fw-bold mb-4 d-flex-inline" style="font-family: 'Courier New', Courier, monospace">
                            Prime<span style="color: red">Library</span>
                        </h3>
                        <p></p>
                    </div>
                    <!-- Grid column -->
                    
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <div class="container-box">
                                <button type="button" class="bbtn text-light" data-bs-toggle="modal" data-bs-target="#popupModal" style="background: transparent; border: none">
                                    Contact Us
                                </button>
                            </div>
                        </h6>
                        <!-- Popup Modal -->
                        <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background: #d6cdcd">
                                    <div class="modal-header" style="background: #d6cdcd">
                                        <h5 class="modal-title" id="popupModalLabel">Contact Us</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row justify-content-center align-items-center g-2">
                                                <h1 class="text-center">Contact Form</h1>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <img src="user_accept.svg" class="img-fluid rounded-top" alt="" />
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                    <form action="contact.php" method="post" id="go">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="abc@mail.com" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="number" class="form-label">Number</label>
                                                            <input type="number" class="form-control" name="number" id="number" placeholder="" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="query" class="form-label">Query</label>
                                                            <textarea class="form-control" name="query" id="query" placeholder=""></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-outline-success">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>
                            <a href="#!" class="text-reset">
                                <h6 class="text-uppercase fw-bold mb-4">
                                    <div class="container-box">
                                        <button type="button" class="bbtn text-light" data-bs-toggle="modal" data-bs-target="#hell" style="background: transparent; border: none">
                                            About
                                        </button>
                                    </div>
                                </h6>
                            </a>
                        </p>
                        <!-- Popup Modal -->
                                                <!-- Popup Modal (About) -->
                                                <div class="modal fade" id="hell" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="background: #d6cdcd">
                                                            <div class="modal-header" style="background: #d6cdcd">
                                                                <h5 class="modal-title" id="popupModalLabel">About</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>PrimeLibrary is a place where you can find a variety of digital resources. Our mission is to provide easy access to high-quality content. Feel free to contact us for any queries or support.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Grid column -->
                                    </div>
                                    <!-- Grid row -->
                                </div>
                            </section>
                            <!-- Section: Links  -->
                    
                            <!-- Copyright -->
                            <div class="text-center p-4" style="background-color: #d6cdcd">
                                © 2024 PrimeLibrary:
                                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">www.primelibrary.com</a>
                            </div>
                            <!-- Copyright -->
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
