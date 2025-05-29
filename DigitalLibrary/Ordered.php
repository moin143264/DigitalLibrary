<?php
include "conn.php";
session_start();

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo "User is not logged in.";
    exit;
}

$id = $_GET['id'] ?? '';

if (!$id) {
    echo "No product ID provided";
    exit;
}

// Prepare SQL statement to prevent SQL injection
$sql="SELECT * FROM card WHERE id = '$id';";


$result =mysqli_query($conn,$sql);

if (mysqli_num_rows($result)===0) {
    echo "No product found";
    exit;
}

$row = mysqli_fetch_assoc($result);
$name = htmlspecialchars($row['name']);
$cost=50;
$image = 'admin/images/' . htmlspecialchars($row['image']);
$stock = htmlspecialchars($row['link']);
$pdfPath = 'admin/dash_pdf/' . $stock;

if (!file_exists($pdfPath)) {
    echo "<script>alert('The E-Book you are trying to buy is currently out of stock 🙂.'); window.location.href='Main.php';</script>";
    exit;
}

// Check if the item has already been purchased
$sqll="SELECT * FROM payments WHERE user_id = '$userId' AND pdf_id = '$id';";


$purchaseResult = mysqli_query($conn,$sqll);

if (mysqli_num_rows($purchaseResult)>0) {
    echo "<script>alert('You have already purchased this E-book 🙂 if expired renew  from there .'); window.location.href='purch.php';</script>";
    exit;
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="animate.css?v=1.0" />
    <title>FILL THE DETAILS</title>
    <link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />

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
            class="navbar-toggler d-lg-none ms-auto"
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
                      style="color: #003366;"
                      class="fa-solid fa-house-user"
                    >Home</i>
                    
                  </div>

                  <span class="visually-hidden">(current)</span></a
                >
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="Main_logout.php"><i style="color:#003366;" class="fa-solid fa-right-from-bracket">logout</i>
                <?php echo isset($_SESSION["loggin"]) ? $_SESSION["loggin"] : ''; ?>
        
                </a>
              </li>
            </ul>
        
          </div>
        </div>
      </nav>
    </header>
    <hr class='text-light '>
 
<main>

        <h1><span><b>Fill The Details To Make Payment:</b></span></h1>
   
    <div class="container my-5 p-3" style=''>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6" >
                <div class="table-responsive" >
                 <div
                  class="table-responsive"
                 >
                 <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <td><?= $name; ?></td>
                                <td rowspan="2">
                                    <img src="<?= $image; ?>" class="img-fluid rounded-top p-5" width='CALC(100%-20%)'/>
                                </td>
                            </tr>
                        
                            <tr>
                                <th scope="col">Cost</th>
                                <td><?= number_format($cost); ?></td>
                            </tr>
                        </thead>
                    </table>
                 </div>
                 
                </div>

                <form action="pay.php" method="post" class='' style="max-width:500px;">
                <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="name" value="<?= $name; ?>"/>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="cost" value="<?= $cost; ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="cname" placeholder="Enter your name.." required/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="abc@mail.com"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Contact No</label>
                        <input type="number" class="form-control" name="contact" placeholder=""/>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Click to pay: Rs. <?= number_format($cost) ?>/-
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
    <footer>
      <!-- place footer here -->
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