<?php 
session_start();
include "conn.php";
if (!isset($_SESSION["addproduct"])) {
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
      <link rel="stylesheet" href="../animate.css?v=1.0" />
    <link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
    <title>Add_Product</title>
    <!-- Required meta tags -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />

    <script
      src="https://kit.fontawesome.com/699a5f7240.js"
      crossorigin="anonymous"
    ></script>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
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
            <li class="nav-item">
                <a class="nav-link" href="index.php"
                  ><div class="icon">
                    <i style="color: #003366" class="fa-solid fa-chart-line">
                      Dashboard</i
                    >
                  </div>
                </a>
              </li>

              <li class="nav-item me-3">
                <a class="nav-link" href="productm.php"
                  ><div class="icon">
                    <i
                      style="color: #003366"
                      class="fa-solid fa-minus"
                    >Book_Manage</i>
                    
                  </div></a
                >
              </li>

              <li class="nav-item">
                <a class="nav-link" href="Admin_logout.php"><i style="color:#003366" class="fa-solid fa-right-from-bracket">logout  <?php echo isset($_SESSION["logged"]) ? $_SESSION["logged"] : ''; ?></i>
               
        
                </a>
              </li>
            </ul>
            
          </div>
        </div>
      </nav>
    </header>

    <main>
      <div
        class="container-fluid my-5 p-5 border border-5 border-light"
        style="max-width: 450px; border-radius: 15px"
      >
        <div class="row justify-content-center align-items-center g-2">

          
        <div  class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <h1 class="text-center">Add Book</h1>
            <form
              action="product.php"
              method="post"
              enctype="multipart/form-data"
            >
              <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id=""
                  aria-describedby="helpId"
                  placeholder=""
                />
              </div>
            

              <div class="mb-3">
                <label for="" class="form-label">Choose file</label>
                <input
                  type="file"
                  class="form-control"
                  name="image"
                  id=""
                  placeholder=""
                  aria-describedby="fileHelpId"
                />
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Choose file</label>
                <input
                  type="file"
                  class="form-control"
                  name="link"
                  id=""
                  placeholder=""
                  aria-describedby="fileHelpId"
                />
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
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

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
