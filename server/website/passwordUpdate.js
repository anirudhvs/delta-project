let oldPass = document.getElementById("currentPassword");
let pass = document.getElementById("password");
let confirmPass = document.getElementById("passwordConfirm");
let tooShort = document.getElementById("tooShort");
let newPassSame = document.getElementById("newPassSame");
let matches = document.getElementById("matches");
let save = document.getElementById("save");

function checkPassword() {
  if (pass.value != confirmPass.value && confirmPass.value != '') {
    matches.innerHTML = "Passwords don't match.";
    save.disabled = true;

  } else if (pass.value == "") {

    save.disabled = true;

  } else if (pass.value.length < 8) {
    tooShort.innerHTML = "Password must be 8 characters long.";
    save.disabled = true;

  } else if (pass.value == oldPass.value) {
    newPassSame.innerHTML = "New password cannot be the same as old.";
    save.disabled = true;
  } else {
    tooShort.innerHTML = "";
    newPassSame.innerHTML = "";
    matches.innerHTML = "";
    save.disabled = false;
  }

}


pass.addEventListener("keyup", function (event) {
  checkPassword();
});
confirmPass.addEventListener("keyup", function (event) {
  checkPassword();
});