
// Show mobile menu
var mobileMenu = document.querySelector(".mobile-menu");
var mobileMenuBtnShow = document.querySelector(".menu__btn");
mobileMenuBtnShow.addEventListener("click", function () {
    mobileMenu.classList.remove("mobile-menu-hidden");
    document.querySelector(".main").style.display = "none";
    document.querySelector("footer").style.display = "none";
});

// Hide mobile menu
var mobileMenuBtnHide = document.querySelector(".mobile-menu__btn");
mobileMenuBtnHide.addEventListener("click", function () {
    mobileMenu.classList.add("mobile-menu-hidden");
    document.querySelector(".main").style.display = "flex";
    document.querySelector("footer").style.display = "flex";

});

// Show city list

var currentCity = document.querySelector(".current__city");
currentCity.addEventListener("click", function () {
    document.querySelector(".city-popup").classList.toggle("city-popup-hidden");
});

document.addEventListener("click", function (element) {
    if((element.target.className == "header__city")||(element.target.className == "current__city") ) {
        return;
    }else {
        document.querySelector(".city-popup").classList.add("city-popup-hidden");
    }
});

// Show city list mobile
var mobileCityListToggler = document.querySelector(".header__city-mobile");
mobileCityListToggler.addEventListener("click", function () {
    document.querySelector(".city__list-mobile").classList.toggle("city__list-hidden");
});


// Show about company text
var showTextBtn = document.querySelector(".article__text-toggler");
if (showTextBtn) {
    showTextBtn.addEventListener("click", function () {
        document.querySelector(".article__text-wrapper").classList.toggle("article__text-wrapper-full");
        showTextBtn.style.display = "none";
    });
}

var allLinks = document.querySelectorAll("a");
for (var i = 0; i < allLinks.length; i++){
    allLinks[i].addEventListener("click", function () {
        var element = this;
        if(element.getAttribute("target")) {
            return;
        }
        event.preventDefault();
        var link = element.getAttribute("href");
        element.classList.add("active-link");
        setTimeout(function(){
            location.href = link;
            element.classList.remove("active-link");
        },400);
    });
}

var estateItems = document.querySelectorAll(".zim-real-estate__item");
if(estateItems) {
    for (var i = 0; i < estateItems.length; i++) {
        estateItems[i].addEventListener("click", function () {
            var linkedItem = this.querySelector(".zim-real-estate__name");
            linkedItem.classList.add("zim-real-estate__name-active");
            setTimeout(function () {
                linkedItem.classList.remove("zim-real-estate__name-active");
            }, 400);
        })
    }
}

var complexEstateItems = document.querySelectorAll(".complex-real-estate__item");
if(complexEstateItems) {
    for (var i = 0; i < complexEstateItems.length; i++) {
        complexEstateItems[i].addEventListener("click", function () {
            var linkedItem = this.querySelector(".complex-real-estate__name");
            linkedItem.classList.add("complex-real-estate__name-active");
            setTimeout(function () {
                linkedItem.classList.remove("complex-real-estate__name-active");
            }, 400);
        })
    }
}

var footerMenu = document.querySelector(".footer__menu");
var footerLinks = footerMenu.querySelectorAll("a");
if(footerLinks){
    for (var i = 0; i < footerLinks.length; i++) {
        footerLinks[i].addEventListener("click", function () {
            footerLinks[i].classList.add("pressed-link");
            setTimeout(function () {
                footerLinks[i].classList.remove("pressed-link");
            }, 400)
        });
    }
}

// DOWNLOAD FILE
var downloadButton = document.querySelector("#downloadButton");
if(downloadButton){
    var downloadForm = document.querySelector("#downloadForm");
    var downloadLink = downloadButton.querySelector("a");
    downloadLink.addEventListener("click", function () {
        downloadForm.click();
    });
}

// Form validation
var form = document.querySelector("#form");
if (form) {
    var emailInput = form.email;
    var completedValue = emailInput.value;
    emailInput.addEventListener("input", function (event) {
        var validMail = event.target.value.match(/^[0-9a-z-\.-\@]+$/i);
        if((completedValue == event.target.value) || (validMail)) {
            document.querySelector(".form__email").classList.remove("form__email-wrong");
        } else {
            document.querySelector(".form__email").classList.add("form__email-wrong");
        }
    });
}

// CHECKBOX

var checkboxes = document.querySelectorAll(".input-box");
if(checkboxes) {
    for (let index = 0; index < checkboxes.length; index++) {
        var checkbox = checkboxes[index];
        checkbox.addEventListener("click", function (event) {
            var currentBlock = event.target.parentElement;
            event.target.classList.toggle("input-box_checked");
            var inputElement = currentBlock.querySelector("input");
            if (event.target.className == "input-box" ) {
                inputElement.checked = false;
            } else {
                inputElement.checked = true;
            }
        });
    }
}


function showCheckboxes() {
    var emailInput = document.querySelector("#emailInput");
    if (emailInput) {
        if (emailInput.value == "") {
            document.querySelector(".checkbox").classList.remove("checkbox-active");

        } else {
            document.querySelector(".checkbox").classList.add("checkbox-active");
        }
    }
}

showCheckboxes();



// user profile icons color

function changeIconColor() {
    var profileItems = document.querySelectorAll(".profile-item");
    for (var index = 0; index < profileItems.length; index++) {
        var inputField = profileItems[index].querySelector(".profile-item__input");
        if (!inputField.value == ""){
            profileItems[index].classList.add("profile-item_completed");
        } else {
            profileItems[index].classList.remove("profile-item_completed");
        }
    }
}

changeIconColor();

// user profile buttons

var buttons = document.querySelectorAll(".button-edit");
if (buttons) {
    for (var index = 0; index < buttons.length; index++) {
        var editButton = buttons[index];
        editButton.addEventListener("click", function() {
            var buttonsGroup = this.parentElement;
            var saveButton = buttonsGroup.querySelector(".button-save");
            var cancelButton = buttonsGroup.querySelector(".button-cancel");
            var deleteButton = buttonsGroup.querySelector(".button-delete");
            var inputField = buttonsGroup.parentElement.querySelector(".profile-item__input");

            buttonsGroup.classList.add("profile-item__buttons_editing");
            var startValue = inputField.value;
            inputField.readOnly = false;

            saveButton.addEventListener("click", function() {
                inputField.readOnly = true;
                buttonsGroup.classList.remove("profile-item__buttons_editing");
                changeIconColor();
                showCheckboxes();
            });

            cancelButton.addEventListener("click", function() {
                inputField.value = startValue;
                buttonsGroup.classList.remove("profile-item__buttons_editing");
            })

            deleteButton.addEventListener("click", function() {
                inputField.value = "";
            })
        })
    }
}

// GO TO EMAIL 

var conditionsLink = document.querySelector(".checkbox__conditions_link");
if (conditionsLink) {
    conditionsLink.addEventListener("click", function () {
        emailItem.querySelector(".button-edit").click();
    })
}

// useful_info page. toggle category

var categoryItems = document.querySelectorAll(".category-item");
if (categoryItems.length > 0) {
    for (var i = 0; i < categoryItems.length; i++) {
        var element = categoryItems[i];
        element.addEventListener("click", function (event) {
            var activeElement = document.querySelector(".category-item_active");
            activeElement.classList.remove("category-item_active");
            this.classList.add("category-item_active");
        });
    }
}




 