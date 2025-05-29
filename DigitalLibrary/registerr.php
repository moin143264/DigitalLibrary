<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="fevicon.svg" sizes="64x64" type="image/x-icon" />

    <link rel="stylesheet" href="animate.css?v=1.0" />
    <style>
      .error {
        color: red;
      }
    </style>

    <title>REGISTER YOURSELF</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform."
    />
    <meta
      name="keywords"
      content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com"
    />
    <meta name="author" content="Digital Library Team" />
    <meta name="robots" content="index, follow" />
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/699a5f7240.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="ocean-breeze">
    <header>
      <nav class="navbar navbar-expand-sm">
        <div class="container">
          <span
            class="fa-solid"
            style="
              color: #003366;

              text-shadow: 2px 2px 4px #ddd;
              text-shadow: #ddd;
            "
          >
            <i class="fas fa-university" style="font-size: 1em; color: #003366">
              Digital Library</i
            >
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
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
    <main class="main flex-fill">
  <div
    class="container-fluid my-5 p-5 border border-5 border-light"
    style="max-width: 600px; border-radius: 15px"
  ><h1 class="text-center">Registration Form</h1>
    <div class="row justify-content-center align-items-center g-2">
      <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
        
        <form action="register.php" method="post" id="go" onsubmit="return verify()">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" />
            <small id="namerror" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              placeholder="abc@mail.com"
            />
            <small id="emailerror" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="uname" class="form-label">Username</label>
            <input type="text" class="form-control" name="uname" id="uname" placeholder="" />
            <small id="unameerror" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="passwordInput" class="form-label">Password</label>
            <div class="input-group">
              <input
                type="password"
                class="form-control"
                name="pass"
                id="passwordInput"
                placeholder=""
              />
              <span
                class="input-group-text"
                onclick="togglePasswordVisibility()"
                style="cursor: pointer"
              >
              <i class="fas fa-fingerprint icon-toggle-password text-secondary"
                    ></i>
              </span>
            </div>
            <small id="passerror" class="text-danger"></small>
          </div>
          <button type="submit" class="btn btn-outline-success w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</main>


   

    <footer class="footer">
      <?php include 'admin/inc/footer.html'; ?>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <script src="admin/inc/inc.js?v=1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
