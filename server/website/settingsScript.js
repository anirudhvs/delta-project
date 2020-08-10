let enableEdit = document.getElementById("enableEdit");
let save = document.getElementById("edit");
let email = document.getElementById("email");

let originalEmail = email.value;

function changeToCancelButton() {
  enableEdit.innerHTML = "Cancel";
  save.hidden = false;
  enableEdit.className = "btn btn-danger mx-1";
  email.readOnly = false;
}

function changeToEditButton() {
  enableEdit.innerHTML = "Edit";
  save.hidden = true;
  enableEdit.className = "btn btn-success mx-1";
  email.readOnly = true;

  //resetting values
  email.value = originalEmail;
}

enableEdit.addEventListener("click", function (event) {

  if (enableEdit.innerHTML == "Edit") {
    changeToCancelButton();

  } else if (enableEdit.innerHTML == "Cancel") {

    var proceed = confirm("You have unsaved changes. Do you wish to continue?");
    if (proceed == true) {
      changeToEditButton();
    }
  }
});