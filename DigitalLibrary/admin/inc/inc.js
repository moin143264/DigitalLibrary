//HEADER COLOR CHANGE
window.addEventListener("scroll", function () {
  var header = document.querySelector("header");
  if (window.scrollY > 50) {
    // Change 50 to the scroll distance at which the color should change
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});
//SEARCH

function searchBooks() {
  var query = document.getElementById("searchQuery").value.toLowerCase();
  var books = document.querySelectorAll("#bookList .book");

  books.forEach(function (book) {
    var titleElement = book.querySelector(".book-title");
    var title = titleElement.textContent.toLowerCase();

    if (title.includes(query)) {
      book.classList.remove("hidden"); // Show the book
      highlightText(titleElement, query); // Highlight matching text
    } else {
      book.classList.add("hidden"); // Hide the book
    }
  });
}

function highlightText(element, query) {
  var text = element.textContent;
  var regex = new RegExp("(" + query + ")", "gi");
  var highlighted = text.replace(regex, '<span class="highlight">$1</span>');
  element.innerHTML = highlighted;
}
//validation
//password hide & show
function togglePasswordVisibility() {
  var passwordInput = document.getElementById("passwordInput");
  var toggleIcon = document.querySelector(".icon-toggle-password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleIcon.classList.remove("fa-fingerprint");
    toggleIcon.classList.add("fa-key");
  } else {
    passwordInput.type = "password";
    toggleIcon.classList.remove("fa-key");
    toggleIcon.classList.add("fa-fingerprint");
  }
}

//VALIDATION
function logi() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("passwordInput").value;

  if (username === "") {
    Swal.fire({
      icon: "error",
      text: "Please fill in the username field.",
      title: "Oops",
      confirmButtonText: "Okay",
    });
    return false; // Prevent form submission
  } else if (password === "") {
    Swal.fire({
      icon: "error",
      text: "Please fill in the password field.",
      title: "Oops",
      confirmButtonText: "Okay",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "Main_Login.php"; // Optional redirection
      }
    });
    return false; // Prevent form submission
  } else {
    // All fields are valid
    Swal.fire({
      icon: "success",
      title: "Login ",
      text: "Verifying Click On Ok...",
      confirmButtonText: "OK",
    }).then((result) => {
      if (result.isConfirmed) {
        // Submit the form programmatically after clicking "OK"
        document.getElementById("form").submit();
      }
    });
    return false; // Prevent default form submission
  }
}
//register validation

function verify() {
  let name = document.getElementById("name").value.trim();
  let email = document.getElementById("email").value.trim();
  let uname = document.getElementById("uname").value.trim();
  let pass = document.getElementById("passwordInput").value.trim();

  let nameError = document.getElementById("namerror");
  let emailError = document.getElementById("emailerror");
  let unameError = document.getElementById("unameerror");
  let passError = document.getElementById("passerror");

  let isValid = true;

  // Reset errors
  nameError.textContent = "";
  emailError.textContent = "";
  unameError.textContent = "";
  passError.textContent = "";

  // Name validation
  if (name === "") {
    nameError.textContent = "Name is required.";
    isValid = false;
  }

  // Email validation
  if (email === "") {
    emailError.textContent = "Email is required.";
    isValid = false;
  } else if (!validateEmail(email)) {
    emailError.textContent = "Please enter a valid email.";
    isValid = false;
  }

  // Username validation
  if (uname === "") {
    unameError.textContent = "Username is required.";
    isValid = false;
  }

  // Password validation
  if (pass === "") {
    passError.textContent = "Password is required.";
    isValid = false;
  } else if (pass.length < 8 || !/\d/.test(pass) || !/[A-Z]/.test(pass)) {
    passError.textContent =
      "Password must be at least 8 characters long, contain at least one number, and one uppercase letter.";
    isValid = false;
  }

  // If form is valid
  if (isValid) {
    Swal.fire({
      title: "Registration ",
      text: "Registering Click On Ok.",
      icon: "success",
      confirmButtonText: "OK",
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("go").submit(); // Submit the form after clicking OK
      }
    });
  }

  // Prevent form submission if not valid
  return false;
}

// Email validation function
function validateEmail(email) {
  const re = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
  return re.test(String(email).toLowerCase());
}
//libraries
