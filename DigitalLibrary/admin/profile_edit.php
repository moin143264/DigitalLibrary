<?php
 include "conn.php";
 $id=$_GET["id"];
 $sql="select * from last where id='$id';";
 $result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);
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
    <title>UPDATE_PROFILE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />    <script
      src="https://kit.fontawesome.com/699a5f7240.js"
      crossorigin="anonymous"
    ></script>

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
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="../Main.php"
                  ><div class="icon">
                    <i style="color: #003366" class="fa-solid fa-book">
                    Library</i
                    >
                  </div>
                </a>
              </li>
    
        
            </ul>
          
          </div>
        </div>
      </nav>
    </header>
    
    <main >
      <div class="container-fluid my-3 p-5 border border-5"  style='max-width:600px;border-radius:50px' >
        <div class="row justify-content-center align-items-center g-2">

          
        <div  class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <h1 class="text-center">Update</h1>
            <form action="profile_update.php" method="post">
                <div class="mb-3">
                    
                    <input
                        type="hidden"
                        class="form-control"
                        name="id"
                        id=""
                        aria-describedby="helpId"
                        placeholder=""
                        value="<?php 
                        echo "{$row['id']}";
                        ?>"
                    />
                </div>
                
              <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id=""
                  aria-describedby="helpId"
                  placeholder=""
                  
                  value="<?php 
                        echo "{$row['name']}";
                        ?>"
                />
              
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  id=""
                  aria-describedby="emailHelpId"
                  placeholder="abc@mail.com"
                  
                  value="<?php 
                        echo "{$row['email']}";
                        ?>"
                />
          
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  name="uname"
                  id=""
                  aria-describedby="helpId"
                  placeholder=""
                  
                  value="<?php 
                        echo "{$row['username']}";
                        ?>"
                />
              
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  name="pass"
                  id=""
                  placeholder=""
                  
                  value="<?php 
                        echo "{$row['password']}";
                        ?>"
                />
              </div>
              <button type="submit" class="btn btn-success w-100">
                Submit
              </button>
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
