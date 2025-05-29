<?php 
session_start();
include "conn.php";
if (!isset($_SESSION["logged_in"])) {
  header("location:Admin_loginn_dash.html");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="./inc/inc.js?v=1.0"></script>
  <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform." />
      <meta name="keywords" content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com" />
      <meta name="author" content="Digital Library Team" />
      <meta name="robots" content="index, follow" />
  <link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
  <link rel="stylesheet" href="../animate.css?v=1.0" />
    <style>
     

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

    .aqua-gradient {
        background: linear-gradient(40deg, #2096ff, #05ffa3);
    }

    /* Additional styles as needed */


    </style>
    <title>Dashboard</title>
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
    />
    <link rel="stylesheet" href="first.css">
  </head>

  <body
   class="ocean-breeze"
  >
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
                <a class="nav-link " href="../index.php"><div class="icon"><i style="color:#003366" class="fa-solid fa-house-user"> Home</i> </div></a>
              </li>
              
              <li class="nav-item me-3">
                <a class="nav-link active" href="Admin_logout.php"
                  ><div class="sign-in">
                    <i
                      style="color: #003366"
                      class="fa-solid fa-right-to-bracket "
                    >logout  <?php echo isset($_SESSION["logged_in"]) ? $_SESSION["logged_in"] : ''; ?></i>
                    
                  </div>
                </a>
              </li>

              
            </ul>
        
          </div>
        </div>
      </nav>
    </header>
<main>
    <div class="container-fluid my-5">
        <div class="row justify-content-center align-items-center g-2">
          
            <?php 
             include "conn.php";

             $sql = "SELECT * FROM dash;";
             $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='row justify-content-center align-items-center g-2' id='bookList'>";

            while ($rows = mysqli_fetch_assoc($result)) {
                echo "<div class='col-sm-12 col-md-6 col-lg-4 py-3 book'>
                    <div class='card text-center border border-3 border-dark' style='border-radius:50px;height:450px;'>
                        <img class='card-img-top p-3 img-fluid' src='dash_image/{$rows['image']}' alt='Title' style='height:250px;border-radius:200px;background-image:transparent;' />
                        <div class='card-body'>
                            <h4 class='card-title book-title'>{$rows['name']}</h4>
                            <a class='btn btn-primary larger-btn' href='{$rows['link']}' role='button'>Manage</a>
                        </div>
                    </div>
                </div>";
            }

            echo "</div>";
        } else {
            echo "<p class='text-center'>NO</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
      </div>
</main>
</main>
    <footer>
    <?php include './inc/footer.html'; ?>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
 

<script src="admin/inc/inc.js?v=1.0"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
