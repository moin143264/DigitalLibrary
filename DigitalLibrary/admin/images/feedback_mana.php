<?php 
session_start();
include "conn.php";
if (!isset($_SESSION["logged"])) {
  header("location:Admin_loginn_dash.html");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      body,
      form,
      .container-fluid,
      .navbar ,
      footer{
        font-family: fantasy;
        /* background: rgb(214, 205, 205); */
      }
      .ocean-breeze {
  background: linear-gradient(to top, #d0f0f0, #a1c4fd 50%, #d4a5a5);
  height: 100vh;
}



footer{
  background-color:#D8CFFF;
}
    </style>
    <link rel="icon" href="../fevicon.svg" sizes="64x64" type="image/x-icon" />
    <title>Manage_User</title>
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
                <a class="nav-link active" href="Admin_logout.php"
                  ><div class="sign-in">
                    <i
                      style="color: #003366"
                      class="fa-solid fa-right-to-bracket "
                    >logout <?php echo isset($_SESSION["logged"]) ? $_SESSION["logged"] : ''; ?></i>
                    
                  </div>
                </a>
              </li>
  
              
            </ul>
          
          </div>
        </div>
      </nav>
    </header>
    <main>
    <?php 
include "conn.php";


$sql="SELECT * FROM feedback;";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {
    echo "
    <h1 class='text-center'>Feedbacks  <i class='fa-solid fa-bottom-to-bracket' aria-hidden='true'></i></h1>
    <div
        class='container-fluid my-3 p-3 border border-5 border-dark'
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
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div
                              class="modal-body"
                              style="
                                font-family: 'Franklin Gothic Medium',
                                  'Arial Narrow', Arial, sans-serif;
                                text-transform: capitalize;
                              "
                            >
                              <h3 class="text-center text-capitalize">
                                About DigitalLibrary
                              </h3>

                              Digital Library is your digital haven for boundless
                              knowledge and entertainment. With an expansive
                              collection of e-books, audiobooks, and multimedia
                              resources, our user-friendly platform offers
                              seamless navigation and personalized
                              recommendations. Whether you're a student,
                              professional, or leisure reader, Digital Library
                              caters to all interests. Our commitment to
                              interactive learning and community engagement sets
                              us apart, creating a dynamic space where members
                              can connect, discuss, and participate in exclusive
                              events. As we envision the future, Digital Library
                              is dedicated to continuous evolution, ensuring an
                              enriching digital experience that transcends
                              traditional boundaries. Ignite your imagination
                              and explore the limitless possibilities with Digital
                              Library.
                            </div>
                          </div>
                        </div>
                      </div>
                    </h6></a
                  >
                </p>
                <p>
                  <a
                    style="
                      margin-left: 5px;
                      text-decoration: none;
                      font-family: fantasy;
                    "
                    name=""
                    id=""
                    class="text-dark"
                    href="FAQ.html"
                    role="button"
                    >FAQ</a
                  >
                </p>

                <p>
                  <a href="#!" class="text-reset">
                    <h6 class="text-uppercase fw-bold mb-4">
                      <div class="container-box">
                        <button
                          type="button"
                          class="bbtn"
                          data-bs-toggle="modal"
                          data-bs-target="#privacy"
                          style="background: transparent; border: none"
                        >
                          Privacy
                        </button>
                      </div>

                      <!-- Popup Modal-->
                      <div
                        class="modal fade"
                        id="privacy"
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
                            <div
                              class="modal-body"
                              style="
                                font-family: 'Franklin Gothic Medium',
                                  'Arial Narrow', Arial, sans-serif;
                                text-transform: capitalize;
                              "
                            >
                              <h3 class="text-center text-capitalize">
                                Privacy Policy
                              </h3>
                              <small
                                ><!-- Privacy Policy for Digital Library -->
                                <!-- Last Updated: [Date] -->

                                <!-- 1. Introduction -->
                                <p>
                                  Digital Library is committed to safeguarding the
                                  privacy of its users. This Privacy Policy
                                  outlines how we collect, use, disclose, and
                                  protect your personal information when you use
                                  our digital library services.
                                </p>

                                <!-- 2. Information We Collect -->
                                <!-- 2.1 Personal Information -->
                                <p>
                                  We may collect personal information, including
                                  but not limited to names, email addresses, and
                                  account credentials when you create an account
                                  or interact with our platform.
                                </p>

                                <!-- 2.2 Usage Data -->
                                <p>
                                  We may collect information about how you use
                                  Digital Library, including your browsing
                                  history, search queries, and interactions with
                                  the content.
                                </p>

                                <!-- 2.3 Device Information -->
                                <p>
                                  We may collect information about the device
                                  you use to access Digital Library, such as
                                  device type, operating system, and browser
                                  information.
                                </p>

                                <!-- 3. How We Use Your Information -->
                                <!-- 3.1 Providing Services -->
                                <p>
                                  We use your personal information to provide
                                  and improve our services, personalize content
                                  recommendations, and enhance your overall
                                  experience with Digital Library.
                                </p>

                                <!-- 3.2 Communication -->
                                <p>
                                  We may use your contact information to send
                                  you updates, newsletters, and promotional
                                  materials. You can opt-out of these
                                  communications at any time.
                                </p>

                                <!-- 3.3 Analytics -->
                                <p>
                                  We use analytics tools to analyze usage
                                  patterns and improve the performance and
                                  functionality of Digital Library.
                                </p>

                                <!-- 4. Information Sharing -->
                                <!-- 4.1 Third-Party Service Providers -->
                                <p>
                                  We may share your information with trusted
                                  third-party service providers who assist us in
                                  delivering and improving our services.
                                </p>

                                <!-- 4.2 Legal Compliance -->
                                <p>
                                  We may disclose your information when required
                                  by law, legal process, or government
                                  authorities.
                                </p>

                                <!-- 5. Your Choices -->
                                <!-- 5.1 Account Settings -->
                                <p>
                                  You can manage your account settings and
                                  privacy preferences through the settings page
                                  on Digital Library.
                                </p>

                                <!-- 5.2 Opting Out -->
                                <p>
                                  You can opt-out of promotional communications
                                  by following the instructions provided in the
                                  communication or contacting us directly.
                                </p>

                                <!-- 6. Security -->
                                <p>
                                  We implement industry-standard security
                                  measures to protect your personal information.
                                  However, no method of transmission over the
                                  internet or electronic storage is entirely
                                  secure, and we cannot guarantee absolute
                                  security.
                                </p>

                                <!-- 7. Children's Privacy -->
                                <p>
                                  Digital Library is not intended for use by
                                  individuals under the age of 13. We do not
                                  knowingly collect personal information from
                                  children. If you believe a child has provided
                                  us with personal information, please contact
                                  us, and we will take appropriate steps to
                                  delete such information.
                                </p>

                                <!-- 8. Changes to this Privacy Policy -->
                                <p>
                                  We reserve the right to update this Privacy
                                  Policy periodically. Any changes will be
                                  posted on this page, and the "Last Updated"
                                  date will be revised accordingly. We encourage
                                  you to review this Privacy Policy regularly.
                                </p>

                                <!-- 9. Contact Us -->
                                <p>
                                  If you have questions or concerns regarding
                                  this Privacy Policy, please contact us at
                                  [Your Contact Information].
                                </p>
                              </small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </h6></a
                  >
                </p>

                <p>
                  <a href="#!" class="text-reset">
                    <h6 class="text-uppercase fw-bold mb-4">
                      <div class="container-box">
                        <button
                          type="button"
                          class="bbtn"
                          data-bs-toggle="modal"
                          data-bs-target="#disclaimer"
                          style="background: transparent; border: none"
                        >
                          Disclaimer
                        </button>
                      </div>

                      <!-- Popup Modal-->
                      <div
                        class="modal fade"
                        id="disclaimer"
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
                            <div
                              class="modal-body"
                              style="
                                font-family: 'Franklin Gothic Medium',
                                  'Arial Narrow', Arial, sans-serif;
                                text-transform: capitalize;
                              "
                            >
                              <h3 class="text-center text-capitalize">
                                Disclaimer
                              </h3>

                              <small>
                                Digital Library strives to provide accurate and
                                up-to-date information and content. However, we
                                make no representations or warranties of any
                                kind, express or implied, about the
                                completeness, accuracy, reliability,
                                suitability, or availability of the information,
                                products, services, or related graphics
                                contained within our digital library for any
                                purpose. Any reliance you place on such
                                information is strictly at your own risk. Digital
                                Library shall not be liable for any loss or
                                damage, including but not limited to indirect or
                                consequential loss or damage, or any loss or
                                damage whatsoever arising from the use of our
                                digital library. Through Digital Library, you can
                                access external websites or content that are not
                                under our control. We have no control over the
                                nature, content, and availability of those sites
                                or content. The inclusion of any links does not
                                necessarily imply a recommendation or endorse
                                the views expressed within them. Every effort is
                                made to keep Digital Library up and running
                                smoothly. However, we take no responsibility
                                for, and will not be liable for, the digital
                                library being temporarily unavailable due to
                                technical issues beyond our control. By using
                                Digital Library, you acknowledge and agree to the
                                terms outlined in this disclaimer. If you have
                                any concerns or questions, please contact us at
                                <span class="text-lowercase"
                                  >ms66454566@gmail.com</span
                                ></small
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </h6></a
                  >
                </p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p>
                  <i class="fas fa-home me-3 text-secondary"></i> Thane 401107
                </p>
                <p>
                  <i class="fas fa-envelope me-3 text-secondary"></i>
                  ms66454566@gmail.com
                </p>
                <p>
                  <i class="fas fa-phone me-3 text-secondary"></i> +91
                  9324777191
                </p>
                <p>
                  <i class="fas fa-print me-3 text-secondary"></i> +918424868079
                </p>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <div
          class="text-center text-dark p-4"
          style="background-color: rgba(0, 0, 0, 0.025)"
        >
          © 2024 Copyright: All Rights Are Reserved To Moin
        </div>
      </footer>
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
