
// Show mobile menu
const mobileMenu = document.querySelector(".mobile-menu");
const mobileMenuBtnShow = document.querySelector(".menu__btn");
mobileMenuBtnShow.addEventListener("click", function () {
    mobileMenu.classList.remove("mobile-menu-hidden");
    document.querySelector(".main").style.display = "none";
    document.querySelector("footer").style.display = "none";
});

// Hide mobile menu
const mobileMenuBtnHide = document.querySelector(".mobile-menu__btn");
mobileMenuBtnHide.addEventListener("click", function () {
    mobileMenu.classList.add("mobile-menu-hidden");
    document.querySelector(".main").style.display = "flex";
    document.querySelector("footer").style.display = "flex";

});

// Show city list

const currentCity = document.querySelector(".current__city");
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
const mobileCityListToggler = document.querySelector(".header__city-mobile");
mobileCityListToggler.addEventListener("click", function () {
    document.querySelector(".city__list-mobile").classList.toggle("city__list-hidden");
});


// Show about company text
// const showTextBtn = document.querySelector(".article__text-toggler");
// if (showTextBtn) {
//     showTextBtn.addEventListener("click", function () {
//         document.querySelector(".article__text-wrapper").classList.toggle("article__text-wrapper-full");
//     });
// }

// let allLinks = document.querySelectorAll("a");
// for (let i = 0; i < allLinks.length; i++){
//     allLinks[i].addEventListener("click", function () {
//         let element = this;
//         if(element.getAttribute("target")) {
//             return;
//         }
//         event.preventDefault();
//         let link = element.getAttribute("href");
//         element.classList.add("active-link");
//         setTimeout(function(){
//             location.href = link;
//             element.classList.remove("active-link");
//         },400);
//     });
// }

// const estateItems = document.querySelectorAll(".zim-real-estate__item");
// if(estateItems) {
//     for (let i = 0; i < estateItems.length; i++) {
//         estateItems[i].addEventListener("click", function () {
//             let linkedItem = this.querySelector(".zim-real-estate__name");
//             linkedItem.classList.add("zim-real-estate__name-active");
//             setTimeout(function () {
//                 linkedItem.classList.remove("zim-real-estate__name-active");
//             }, 400);
//         })
//     }
// }

// const complexEstateItems = document.querySelectorAll(".complex-real-estate__item");
// if(complexEstateItems) {
//     for (let i = 0; i < complexEstateItems.length; i++) {
//         complexEstateItems[i].addEventListener("click", function () {
//             let linkedItem = this.querySelector(".complex-real-estate__name");
//             linkedItem.classList.add("complex-real-estate__name-active");
//             setTimeout(function () {
//                 linkedItem.classList.remove("complex-real-estate__name-active");
//             }, 400);
//         })
//     }
// }

// const footerMenu = document.querySelector(".footer__menu");
// const footerLinks = footerMenu.querySelectorAll("a");
// if(footerLinks){
//     for (let i = 0; i < footerLinks.length; i++) {
//         footerLinks[i].addEventListener("click", function () {
//             footerLinks[i].classList.add("pressed-link");
//             setTimeout(function () {
//                 footerLinks[i].classList.remove("pressed-link");
//             }, 400)
//         });
//     }
// }

// DOWNLOAD FILE
// const downloadButton = document.querySelector("#downloadButton");
// if(downloadButton){
//     const downloadForm = document.querySelector("#downloadForm");
//     const downloadLink = downloadButton.querySelector("a");
//     downloadLink.addEventListener("click", function () {
//         downloadForm.click();
//     });
// }

// Form validation
let form = document.querySelector("#form");
if(form) {
    let emailInput = form.email;
    let emptyValue = emailInput.value;
    emailInput.addEventListener("input", function (event) {
        let validMail = event.target.value.match(/^[0-9a-z-\.-\@]+$/i);
        if((emptyValue == event.target.value) || (validMail)) {
            document.querySelector(".form__email").classList.remove("form__email-wrong");
        } else {
            document.querySelector(".form__email").classList.add("form__email-wrong");
        }
    });
}




