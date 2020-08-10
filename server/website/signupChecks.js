let pass = document.getElementById("password");
let confirmPass = document.getElementById("passwordConfirm");
let tooShort = document.getElementById("tooShort");
let matches = document.getElementById("matches");
let submitButton = document.getElementById("signup");

function checkPassword() {
  if (pass.value != confirmPass.value && confirmPass.value != '') {
    matches.innerHTML = "Passwords don't match.";
    submitButton.disabled = true;

  } else if (pass.value == "") {

    submitButton.disabled = true;

  } else if (pass.value.length < 8) {
    tooShort.innerHTML = "Password must be 8 characters long.";
    submitButton.disabled = true;

  } else {
    tooShort.innerHTML = "";
    matches.innerHTML = "";
    submitButton.disabled = false;
  }

}


pass.addEventListener("keyup", function (event) {
  checkPassword();
});
confirmPass.addEventListener("keyup", function (event) {
  checkPassword();
});