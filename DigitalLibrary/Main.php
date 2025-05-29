<?php
session_start();
include "conn.php"; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: Main_Login.html");
    exit();
}

// Ensure user ID is available
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session.";
    exit();
}

$user_id = $_SESSION['user_id']; // Use user ID from session

// Your page content here
// echo "Welcome, user with ID: " . htmlspecialchars($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />
<link rel="stylesheet" href="animate.css?v=1.0" />
<script src="admin/inc/inc.js?v=1.0"></script>
    <style>
       


.sidewise {
    background-color: #003366;
    padding: 10px; /* Optional: Adds space around the text inside the element */
    border-radius: 5px; /* Optional: Rounds the corners of the background */
    text-align: center;
    overflow: hidden; /* Ensures the text doesn't overflow outside the h3 element */
}



        .aqua-gradient {
            background: linear-gradient(40deg, #2096ff, #05ffa3);
        }

        .button:hover {
            transform: translateY(10px);
            border-radius: 50px;
        }

        .btnfn:after {
            border-radius: 15px;
            color: 'red';
            text-decoration:none; /* Correct spelling */
        }
        .btnfn:hover {

          text-decoration: underline; 
    text-decoration-color: black;
    text-decoration-thickness: 5px;  
}

  

@keyframes slideDown {
    from {
        top: -100px;
        opacity: 0;
    }
    to {
        top: 0;
        opacity: 1;
    }
}
#bookList .book {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 5px 0;
        border-radius: 5px;
      }

      .highlight {
        background-color: yellow;
        font-weight: bold;
      }

      .hidden {
        display: none;
      }



    </style>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Welcome To DigitalLibrary</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://kit.fontawesome.com/699a5f7240.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body class='ocean-breeze'
   
  >
  <h5 class="text-center my-2  welcome-text">Welcome To Digital Library</h5>

    <header>
        <nav class="navbar navbar-expand-sm">
            <div class="container">
            <form
            class="d-flex w-50"
            style="position: relative"
         
            id="searchForm" onsubmit="return false;"
          >
            <input
              class="form-control me-sm-2 border border-dark border-3"
            type="text"
            id="searchQuery"
            placeholder="Search..."
            onkeyup="searchBooks()"
            style="box-shadow: none; max-width: 100%"
            />
            
          </form>
   
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0 mx-5">
                    <li class="nav-item me-3">
                            <a class="nav-link" href="./admin/profileup.php" aria-current="page">
                                <div class="dash-icon">
                                    <i  class="fa-solid fa-user text-center" style='color:#003366  '>  Profile</i>
                                    <p></p>
                                </div>
                               
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Main_logout.php"><i  class="fa-solid fa-right-from-bracket" style='color:#003366  ' >  logout</i><p></p>
                                
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="purch.php?user_id=<?php echo $user_id; ?>" aria-current="page">
                                <div class="dash-icon">
                                    <i class="fa-solid fa-book" style='color:#003366  '>  PDF</i>
                                    <p></p>
                                </div>
                               
                            </a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link" href="./admin/feedbac.php?id=<?php echo urlencode($user_id); ?>">
        <i class="fas fa-comment-dots" style="color: #003366"> Feedback</i>
    </a>
</li>
                    </ul>
            
          </div>
        </div>
      </nav>
    </header>
    <div >
      <hr style="color:white;border-width:5px">

    </div>
    <main>
<section class='paid-books'>
<?php
include "conn.php";

$sql = "SELECT * FROM card;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='container-fluid my-5'>
    <div class='row justify-content-center align-items-center g-2' id='bookList'>";

    while ($row = mysqli_fetch_assoc($result)) {
        $id = urlencode($row['id']);
        $buy_url = "download.php?id=$id"; 
        echo "<div class='col-sm-12 col-md-6 col-lg-4 py-3 book animate-from-top'>
            <div class='card text-center border border-3 border-dark mx-3' style='border-radius:50px;background:transparent'>
                <img class='card-img-top p-3 img-fluid' src='admin/images/{$row['image']}' alt='Title' style='max-height: 300px;' />
                <div class='card-body aqua-gredient'>
                    <h4 class='card-title book-title'>{$row['name']}</h4>
                    <a class='button btn btn-warning btn-outline-white border border-5 w-50 text-dark btnfn' href='Ordered.php?id=" . urlencode($row['id']) . "' role='button'>Buy</a>
                </div>
            </div>
        </div>";
    }

    echo "</div></div>";
} else {
    echo "No records found.";
}

mysqli_close($conn);
?>
</section>
<h3 class="sidewise text-center text-light animate-mix" style='background-color: #003366;'><span class="slide-text">General Knowledge Books Free Of Cost</span></h3>
<section class='free book'>
<?php
include "conn.php";

$sql = "SELECT * FROM card;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='container-fluid my-5'>
    <div class='row justify-content-center align-items-center g-2'>";

    while ($row = mysqli_fetch_assoc($result)) {
        $id = urlencode($row['id']);
        $buy_url = "download.php?id=$id"; 
        echo " <div class='col-sm-12 col-md-6 col-lg-4 py-3 animate-from-bottom'>
          <div class='card text-center border border-3 border-dark mx-3 ' style='border-radius:50px;background:transparent'>
              
            <img class='card-img-top p-3 img-fluid' src='admin/images/{$row['image']}' alt='Title' style='max-height: 300px;' />
            <div class='card-body aqua-gredient'>
                <h4 class='card-title'>{$row['name']}</h4>
                <a class='button btn btn-warning btn-outline-white border border-5 w-50 text-dark btnfn' href='Ordered.php?id=" . urlencode($row['id']) . "' role='button'>Buy</a>
            </div>
        </div>
        </div>";
    }

    echo "</div></div>";
} else {
    echo "No records found.";
}

mysqli_close($conn);
?> 
</section>
</main>

<footer>
<?php include 'admin/inc/footer.html'; ?>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
