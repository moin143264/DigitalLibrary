<?php
session_start(); // Start the session
include "conn.php";


if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: ../Main_Login.html");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session.";
    exit();
}

$user_id = $_SESSION['user_id']; 


$sql = "SELECT * FROM last WHERE id = '$user_id';";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    

    
    $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
    $user_id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    
} else {
    echo "No records found for the logged-in user.";
    exit();
}
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
  <script src="./inc/inc.js?v=1.0"></script>
  <link rel="stylesheet" href="../animate.css?v=1.0" />
  <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="description" content="Digital Library: Explore a wide collection of books, articles, and educational resources at https://digitallibrarymanagement.kesug.com. Your online learning platform." />
      <meta name="keywords" content="Digital Library, online books, e-books, research papers, educational resources, digitallibrarymanagement.kesug.com" />
      <meta name="author" content="Digital Library Team" />
      <meta name="robots" content="index, follow" />
    <style>
       .table-header th {
            color: #ffffff; /* Header text color */
        }
        .table-data td {
            color: #000000; /* Data text color */
        }
   
      label{
        color:#003366;
      }
      </style>

    <title>Feedback</title>
    <!-- Required meta tags -->

    <link
      rel='stylesheet'
      href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'
    />
    <link rel='icon' href='fevicon.svg' sizes='64x64' type='image/x-icon' />

    <script
      src='https://kit.fontawesome.com/699a5f7240.js'
      crossorigin='anonymous'
    ></script>
    <meta charset='utf-8' />
    <meta
      name='viewport'
      content='width=device-width, initial-scale=1, shrink-to-fit=no'
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'
      rel='stylesheet'
      integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN'
      crossorigin='anonymous'
    />
  </head>

  <body
    class="ocean-breeze"
  >
    <header>
      <nav class='navbar navbar-expand-sm'>
        <div class='container'>
          <span
            class='fa-solid'
            style='
              color: #003366;

              text-shadow: 2px 2px 4px #ddd;
              text-shadow: #ddd;
            '
          >
            <i class='fas fa-university' style='font-size: 1em; color: #003366'>
              Digital Library</i
            >
          </span>

          <button
            class='navbar-toggler d-lg-none'
            type='button'
            data-bs-toggle='collapse'
            data-bs-target='#collapsibleNavId'
            aria-controls='collapsibleNavId'
            aria-expanded='false'
            aria-label='Toggle navigation'
          >
            <span class='navbar-toggler-icon'></span>
          </button>

          <div class='collapse navbar-collapse' id='collapsibleNavId'>
            <ul class='navbar-nav ms-auto mt-2 mt-lg-0 mx-3'>
              <li class='nav-item me-3'>
                <a class='nav-link' href='../index.php' aria-current='page'
                  ><div class='dash-icon'>
                    <i style='color: #003366' class='fa-solid fa-house-user'
                      >Home</i
                    >
                  </div>

                  <span class='visually-hidden'>(current)</span></a
                >
              </li>
              <li class='nav-item me-3'>
                <a class='nav-link' href='../Main.php'
                  ><i style='color: #003366' class='fa-solid fa-book'
                    >Library</i
                  ></a
                >
              </li>
        
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div
        class='container-fluid my-2 p-5 border border-5 border-light'
        style='max-width: 700px; border-radius: 25px'
      >
        <div class='row justify-content-center align-items-center g-2'>

          <div class='col-sm-9 col-md-9 col-lg-9 col-xl-9'>
            <h3 class='text-center fas' style='color: #003366'>
              Feedback
              <i class='fas fa-comment-dots' style='color: white;font-size:50px'> </i>
            </h3>
            <form action='feedback.php' id='go' method='post'>
            <div class='mb-3'>
                
                <input
                  type='hidden'
                  class='form-control'
                  name='id'
                  id=''
                  value="<?= $user_id; ?>"
                                    
                />
              </div>
              <div class='mb-3'>
                <label for='' class='form-label' style='color: #003366'
                  >Name</label
                >
                <input      type='text'
                  class='form-control'
                  name='name'
                  id=''
                  aria-describedby='helpId'
                  placeholder=''
                  value="<?php 
                                echo "{$row['name']}";?>"
                                
                                name="name"   
                                readonly>
                
              
                    </div>
              <div class='mb-3'>
                <label for='' class='form-label'>Email</label>
                <input
                  type='email'
                  class='form-control'
                  name='email'
                  id=''
                  aria-describedby='emailHelpId'
                  placeholder='abc@mail.com'
                  value="<?php 
                                echo "{$row['email']}";?>"
                                
                                name="email"   
                                readonly>
              </div>
              <div class='mb-3'>
                <label for='rating' class='form-label'>Overall Rating</label>
                <select class='form-select' id='rating' name='rating' required>
                  <option value='1-Poor'>1 - Poor</option>
                  <option value='2-Fair'>2 - Fair</option>
                  <option value='3-Good'>3 - Good</option>
                  <option value='4-Very Good'>4 - Very Good</option>
                  <option value='5-Excellent'>5 - Excellent</option>
                </select>
              </div>
              <div class='mb-3'>
                <label for='ui_rating' class='form-label'>UI & UX Rating</label>
                <select
                  class='form-select'
                  id='ui_rating'
                  name='ui_rating'
                  required
                >
             <option value='1-Poor'>1 - Poor</option>
                  <option value='2-Fair'>2 - Fair</option>
                  <option value='3-Good'>3 - Good</option>
                  <option value='4-Very Good'>4 - Very Good</option>
                  <option value='5-Excellent'>5 - Excellent</option>
                </select>
              </div>
              <div class='mb-3'>
                <label for='functionality_rating' class='form-label'
                  >Functionality Rating</label
                >
                <select
                  class='form-select'
                  id='functionality_rating'
                  name='functionality_rating'
                  required
                >
             <option value='1-Poor'>1 - Poor</option>
                  <option value='2-Fair'>2 - Fair</option>
                  <option value='3-Good'>3 - Good</option>
                  <option value='4-Very Good'>4 - Very Good</option>
                  <option value='5-Excellent'>5 - Excellent</option>
                </select>
              </div>
              <div class='mb-3'>
                <label for='performance_rating' class='form-label'
                  >Performance Rating</label
                >
                <select
                  class='form-select'
                  id='performance_rating'
                  name='performance_rating'
                  required
                >
          <option value='1-Poor'>1 - Poor</option>
                  <option value='2-Fair'>2 - Fair</option>
                  <option value='3-Good'>3 - Good</option>
                  <option value='4-Very Good'>4 - Very Good</option>
                  <option value='5-Excellent'>5 - Excellent</option>
                </select>
              </div>
              <div class='mb-3'>
                <label for='comments' class='form-label'
                  >Additional Comments</label
                >
                <textarea
                  class='form-control'
                  id='comments'
                  name='comments'
                  rows='5'
                ></textarea>
              </div>
              <button
                type='submit'
                style='color: #003366'
                ;
                name='feedback'
                class='btn btn-primary w-100'
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
      <div
        class="container border border-3 border-light " style='max-width:1200px;border-radius:25px;'
      >
      <?php 
include "conn.php";




$sql="SELECT * FROM feedback WHERE user_id = '$user_id';";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>0) {
    echo "
    <h1 class='text-center'>Given Feedbacks<i class='fa-solid fa-bottom-to-bracket' aria-hidden='true'></i></h1>
    <div
        class='container-fluid my-3 p-3'
    >
        
        <div
            class='table-responsive'
        >
            <table
                class='table table-primary'
            >
                <thead>
                    <tr>
                        <th scope='col'>id</th>
                        <th scope='col'>name</th>
                        <th scope='col'>email</th>
                        <th scope='col'>Overall Rating</th>
                        <th scope='col'>UI & UX Rating</th>
                        <th scope='col'>Functionality Rating</th>
                        <th scope='col'>Performance Rating</th>
                        <th scope='col'>Additional Comments</th>
                        
                    </tr>
                </thead>
                <tbody>";
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "
        <tr class=''>
            <td scope='row'>{$rows['id']}</td>
            <td>{$rows['name']}</td>
            <td>{$rows['email']}</td>
            <td>{$rows['rating']}</td>
            <td>{$rows['ui_rating']}</td>
            <td>{$rows['functionality_rating']}</td>
            <td>{$rows['performance_rating']}</td>
            <td>{$rows['comments']}</td>
            
        </tr>";
    }
    echo "
        
    </tbody>
</table>
</div>

</div>
";
} else {
    echo "something Went Wrong".mysqli_error($conn);
}



?>
      </div>
      
    </main>
    <footer>
    <?php include './inc/footer.html'; ?>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'
      integrity='sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r'
      crossorigin='anonymous'
    ></script>

    <script
      src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js'
      integrity='sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+'
      crossorigin='anonymous'
    ></script>
  </body>
</html>
