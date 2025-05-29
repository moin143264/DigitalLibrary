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
echo "Welcome, user with ID: " . htmlspecialchars($user_id);
?>

<!--  -->
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />
  <link rel="stylesheet" href="animate.css?v=1.0" />
    <style>

   
      .button:hover {
            transform: translateY(10px);
            border-radius:50px;
            
            
          
      }
      .btnfn:after{
        border-radius:15px;
        color:'red';
      }
         
    </style>
    <title>PURCHED BOOK</title>
    
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <script
      src="https://kit.fontawesome.com/699a5f7240.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />  <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform." />
      <meta name="keywords" content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com" />
      <meta name="author" content="Digital Library Team" />
      <meta name="robots" content="index, follow" />
  </head>

  <body
  class="ocean-breeze"
  >
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
            <li class="nav-item me-3">
                <a class="nav-link" href="index.php" aria-current="page"
                  ><div class="dash-icon">
                    <i
                    style='color:#003366  '
                      class="fa-solid fa-house-user"
                    >Home</i>
                    
                  </div>

                  <span class="visually-hidden">(current)</span></a
                >
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="Main_logout.php"><i style='color:#003366  ' class="fa-solid fa-right-from-bracket">logout</i>
                <?php echo isset($_SESSION["loggin"]) ? $_SESSION["loggin"] : ''; ?>
        
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
<?php

include "conn.php";
$sql = "SELECT * FROM purchase_pdf WHERE user_id = '$user_id';"; 

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo "
    <h1 class='text-center'>Manage Books <i class='fa-solid fa-bottom-to-bracket' aria-hidden='true'></i></h1>
    <div class='container-fluid my-3 p-3 border border-5 border-WARNING' style='max-width:500px;border-radius:15px'>
        <div class='table-responsive'>
            <table class='table table-primary'>
                <thead>
                    <tr>
                        <th scope='col'>ID</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>
                <tbody>";
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
            <td scope='row'>{$rows['id']}</td>
            <td>
                <a class='btn btn-warning w-75 btnfn'   href='{$rows['pdf_url']}' role='button'>{$rows['name']}</a>
            </td>
        </tr>";
    }
    echo "
    </tbody>
</table>
</div>
</div>";
} else {
    echo "No records found.";
}

mysqli_close($conn);
?>


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
  <script src="admin/inc/inc.js?v=1.0"></script>
  </body>
</html>
