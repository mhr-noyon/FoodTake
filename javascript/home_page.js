const loginButton = document.getElementById("loginButton");
const loginModal = document.getElementById("loginModal");
const closeModal = document.getElementById("closeModal");
if (loginButton != null) {
  loginButton.addEventListener("click", function () {
    loginModal.style.display = "block";
  });
  window.addEventListener("click", function (event) {
    if (event.target == loginModal) {
      loginModal.style.display = "none";
    }
  });
  closeModal.addEventListener("click", function () {
    loginModal.style.display = "none";
  });
}

function goToAdminLoginPage(page) {
  // Redirect to admin-login.php
  window.location.href = `${page}`;
}

function changeActive(btn) {
  var elements = document.querySelectorAll(".active");
  elements.forEach((element) => {
    element.classList.remove("active");
  });
  btn.classList.add("active");
}
function logoutActive() {
  var elements = document.querySelectorAll(".active");
  elements.forEach((element) => {
    element.classList.remove("active");
  });
  let btn = document.getElementById("home");
  btn.classList.add("active");
}
function changeloginActive() {
  var elements = document.querySelectorAll(".active");
  elements.forEach((element) => {
    element.classList.remove("active");
  });
  let btn = document.getElementById("login");
  btn.classList.add("active");
}
