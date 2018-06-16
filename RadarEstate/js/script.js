
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
    var emptyValue = emailInput.value;
    emailInput.addEventListener("input", function (event) {
        var validMail = event.target.value.match(/^[0-9a-z-\.-\@]+$/i);
        if((emptyValue == event.target.value) || (validMail)) {
            document.querySelector(".form__email").classList.remove("form__email-wrong");
        } else {
            document.querySelector(".form__email").classList.add("form__email-wrong");
        }
    });
}

// var form = document.getElementById('form'); // form has to have ID: <form id="formID">
// form.noValidate = true;
// form.addEventListener('submit', function(event) { // listen for form submitting
//         if (!event.target.checkValidity()) {
//             event.preventDefault(); // dismiss the default functionality
//             document.querySelector(".form__email").classList.add("form__email-wrong"); // error message
//         }
//     }, false);


 