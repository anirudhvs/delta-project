let enableEdit = document.getElementById("enableEdit");
let save = document.getElementById("edit");
let title = document.getElementById("title");
let url = document.getElementById("url");
let linkShow = document.getElementById("linkShow");
let linkHide = document.getElementById("linkHide");

let originalTitle = title.value;
let originalURL = url.value;
let originalLinkShow = linkShow.checked;
let originalLinkHide = linkHide.checked;

function changeToCancelButton() {
  enableEdit.innerHTML = "Cancel";
  save.hidden = false;
  enableEdit.className = "btn btn-danger mx-1";
  title.readOnly = false;
  url.readOnly = false;
  linkShow.disabled = false;
  linkHide.disabled = false;
}

function changeToEditButton() {
  enableEdit.innerHTML = "Edit";
  save.hidden = true;
  enableEdit.className = "btn btn-success mx-1";
  title.readOnly = true;
  url.readOnly = true;
  linkShow.disabled = true;
  linkHide.disabled = true;

  //resetting values
  title.value = originalTitle;
  url.value = originalURL;
  linkShow.checked = originalLinkShow;
  linkHide.checked = originalLinkHide;
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