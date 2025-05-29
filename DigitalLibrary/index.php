<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="animate.css?v=1.0" />
     <link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />

    <title>Home</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merienda&display=swap">
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform." />
      <meta name="keywords" content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com" />
      <meta name="author" content="Digital Library Team" />
      <meta name="robots" content="index, follow" />
    <!-- Bootstrap CSS v5.2.1 -->
    <script
      src="https://kit.fontawesome.com/699a5f7240.js"
      crossorigin="anonymous"
    ></script>
    <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Honk:wght@400;700&display=swap"
    />
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
                <a class="nav-link" href="Main.php"
                  ><i style="color: #003366" class="fa-solid fa-book"
                    >Library</i
                  ></a
                >
              </li>
              <li class="nav-item me-3">
                <a class="nav-link" href="registerr.php"
                  ><i style="color: #003366" class="fa-solid fa-user-plus"
                    >SignUp</i
                  ></a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Main.php"
                  ><i style="color: #003366" class="fa-solid fa-key"
                    >Login</i
                  ></a
                >
              </li>
              <li class="nav-item">
              
              <a class="nav-link" href="./admin/feedbac.php" >
                  <i class="fas fa-comment-dots"  style="color: #003366">Feedback</i> 
              </a>
          
        </li>
            </ul>
          
          </div>
        </div>
      </nav>
     
    </header>
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
        echo "<div class='col-sm-12 col-md-6 col-lg-4 py-3 book'>
            <div class='card text-center border border-3 border-dark mx-3' style='border-radius:50px;background-image:url(./uploads/main.webp)'>
                <img class='card-img-top p-3 img-fluid' src='admin/images/{$row['image']}' alt='Title' style='max-height: 300px;' />
                <div class='card-body aqua-gredient'>
                    <h4 class='card-title book-title'>{$row['name']}</h4>
                    <a class='button btn btn-warning btn-outline-white border border-5 w-50 text-dark btnfn' href='Main.php' role='button'>Buy</a>
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
<h3 class=" sidewise text-center text-light " style='background-color: #003366;'><span class="slide-text">General Knowledge Books Free Of Cost</span></h3>
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
      echo " <div class='col-sm-12 col-md-6 col-lg-4 py-3'>
        <div class='card text-center border border-3 border-dark mx-3 ' style='border-radius:50px;background:transparent'>
        	
       
        
            <img class='card-img-top p-3  img-fluid ' src='admin/images/{$row['image']}'
             alt='Title' style='max-height: 300px;' />
            <div class='card-body aqua-gredient'>
                <h4 class='card-title'>{$row['name']}</h4>
                
   <tr> <td>            
   <a class='button btn btn-warning btn-outline-white border border-5 w-50 text-dark btnfn' href='Main.php' role='button'>Buy</a>
  
   </td></tr>
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
<div class="container text-center btnfn">
        
          <a
          class=' button btn  btn-secondary btn-outline-white border border-5  w-25 text-light btnfn'
          href="admin/index.php"
            style="
              color:#003366;
              text-decoration: none;
              font-family: fantasy;
              border-radius:20px;"
            class="text-success"
            >Admin</a
          >
        
      </div>
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
