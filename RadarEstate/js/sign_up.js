var submitButton = document.querySelector(".button_submit");

if (submitButton) {
  submitButton.addEventListener("click", function(event) {
    var password = document.querySelector("#password").value;
    var passwordRepeat = document.querySelector("#password-repeat").value;
    if (
      (password.length && passwordRepeat.length) < 8 ||
      (password.length && passwordRepeat.length) > 16
    ) {
      event.preventDefault();
      document
        .querySelector("#password")
        .parentElement.classList.add("input-wrapper_error");
    }
  });
}

var checkBoxes = document.querySelectorAll(".input-box");
if (checkBoxes) {
  for (let index = 0; index < checkBoxes.length; index++) {
    var checkbox = checkBoxes[index];
    checkbox.addEventListener("click", function(event) {
      var currentBlock = event.target.parentElement;
      event.target.classList.toggle("input-box_checked");
      var inputElement = currentBlock.querySelector("input");
      if (event.target.className == "input-box") {
        inputElement.checked = false;
      } else {
        inputElement.checked = true;
      }
    });
  }
}

function showCheckBoxes() {
  var emailInput = document.querySelector("#emailInput");
  if (emailInput) {
    if (emailInput.value == "") {
      document.querySelector(".checkbox").classList.remove("checkbox-active");
    } else {
      document.querySelector(".checkbox").classList.add("checkbox-active");
    }
  }
}
