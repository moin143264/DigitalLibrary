<?php 
session_start();
include "conn.php";
if (!isset($_SESSION["productma"])) {
  header("location:Admin_loginn_dash.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
    <style>
        body,
        form,
        .container-fluid,
        .navbar,
        footer {
            font-family: fantasy;
            /* background: rgb(214, 205, 205); */
        }
        header {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 1000; /* Ensure the header stays on top */
  background-color:#D8CFFF;
}

body {
  padding-top: 80px; /* Adjust this value to match the header height */
}
.ocean-breeze {
  background: linear-gradient(to top, #d0f0f0, #a1c4fd 50%, #d4a5a5);
  height: 100vh;
}



footer{
  background-color:#D8CFFF;
}
    </style>
    <title>Manage_Book</title>
    <!-- Required meta tags -->
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
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <script
        src="https://kit.fontawesome.com/699a5f7240.js"
        crossorigin="anonymous"
    ></script>
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
                        <a class="nav-link " href="product_add.php"><i  style="color: #003366" class="fa-solid fa-plus">Book_Add</i></a>
                    </li>

                    <li class="nav-item me-3">
                        <a class="nav-link active" href="Admin_logout.php"
                        ><div class="sign-in">
                                <i
                                    style="color: #003366"
                                    class="fa-solid fa-right-to-bracket "
                                >Logout   <?php echo isset($_SESSION["productma"]) ? $_SESSION["productma"] : ''; ?></i>
                               
                            </div>
                        </a>
                    </li>

                </ul>
              
            </div>
        </div>
    </nav>
</header>
<main>
    <h1 class='text-center'>Manage Product  <i class='fa-solid fa-bottom-to-bracket' aria-hidden='true'></i></h1>
    <div class='container-fluid my-3 p-3 border border-5 border-dark' style='max-width:1200px'>
        <div class='table-responsive'>
            <table class='table table-primary'>
                <thead>
                <tr>
                    <th scope='col'>id</th>
                    <th scope='col'>name</th>
                    
                    <th scope='col'  >product</th>
                    
                    <th scope='col' colspan='2'>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include "conn.php";
                $sql="select * from card;";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)>0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo "<tr class=''>
                            <td scope='row'>{$rows['id']}</td>
                            <td>{$rows['name']}</td>
                            
                            <td><img src='images/{$rows['image']}'
                                     class='img-fluid rounded-top ' width='75px'></td>
                            <td scope='row'>
                                <a name='' id='' class='btn btn-danger' href='product_del.php?id={$rows['id']}' role='button'>Delete</a>
                            </td>
                            <td scope='row'>
                                <a name='' id='' class='btn btn-success' href='view.php?pdf=" . urlencode($rows['link']) . "' role='button'>View</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "something Went Wrong".mysqli_error($conn);
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<footer>
    <footer class="text-center text-sm-start text-dark">
        <!-- Section: Social media -->
        <section
            class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        >
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h3
                            class="text-uppercase fw-bold mb-4 d-flex-inline"
                            style="font-family: 'Courier New', Courier, monospace"
                        >
                            Digital<span style="color: red">Library</span>
                        </h3>
                        <p></p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->

                        <p>
                            <a href="#!" class="text-reset">
                                <h6 class="text-uppercase fw-bold mb-4">
                                    <div class="container-box">
                                        <button
                                            type="button"
                                            class="bbtn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hell"
                                            style="background: transparent; border: none"
                                        >
                                            About
                                        </button>
                                    </div>

                                    <!-- Popup Modal-->
                                    <div
                                        class="modal fade"
                                        id="hell"
                                        tabindex="-1"
                                        aria-labelledby="popupModalLabel"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Digital Library is a digital
                                                    platform that allows you to
                                                    manage and view your
                                                    products. It offers various
                                                    features to enhance your
                                                    experience.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </h6>
                            </a>
                            <a href="#!" class="text-reset">
                                <h6 class="text-uppercase fw-bold mb-4">
                                    <div class="container-box">
                                        <button
                                            type="button"
                                            class="bbtn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#help"
                                            style="background: transparent; border: none"
                                        >
                                            Help
                                        </button>
                                    </div>

                                    <!-- Popup Modal-->
                                    <div
                                        class="modal fade"
                                        id="help"
                                        tabindex="-1"
                                        aria-labelledby="popupModalLabel"
                                        aria-hidden="true"
                                    >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        If you need any
                                                        assistance regarding
                                                        using Digital Library,
                                                        please contact our
                                                        support team at
                                                        support@Digitallibrary.com
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal"
                                                    >
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </h6>
                            </a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->
    </footer>
    <!-- Footer -->
    <!-- Footer -->
</footer>
</body>
</html>
