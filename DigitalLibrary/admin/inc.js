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
