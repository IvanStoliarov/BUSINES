var customerBtn = document.querySelector(".customer__wrapper"),
    perfomerBtn = document.querySelector(".performer__wrapper"),
    forCustomer = document.querySelectorAll(".forCustomer"),
    forPerformer = document.querySelectorAll(".forPerformer"),
    descriptionBtns = document.querySelectorAll(".description__toggle");

if(customerBtn) {
    customerBtn.addEventListener("click", function () {
        customerBtn.parentNode.classList.contains("activeStatus") || (customerBtn.parentNode.classList.add("activeStatus"), perfomerBtn.parentNode.classList.remove("activeStatus"));
        for (var e = 0; e < forPerformer.length; e++) forPerformer[e].style.display = "none";
        for (e = 0; e < forCustomer.length; e++) forCustomer[e].style.display = "flex";
        document.querySelector(".carousel").style.left = "-2000em", document.querySelector(".carousel").style.height = "0"
    });
};


if (perfomerBtn) {
    perfomerBtn.onclick = function () {
        perfomerBtn.parentNode.classList.contains("activeStatus") ? customerBtn.parentNode.classList.remove("activeStatus") : (perfomerBtn.parentNode.classList.add("activeStatus"), customerBtn.parentNode.classList.remove("activeStatus"));
        for (var e = 0; e < forPerformer.length; e++) forPerformer[e].style.display = "flex";
        for (e = 0; e < forCustomer.length; e++) forCustomer[e].style.display = "none";
        document.querySelector(".carousel").style.left = "0", document.querySelector(".carousel").style.height = "unset"
    };
};
for (var i = 0; i < descriptionBtns.length; i++) descriptionBtns[i].onclick = function() {
    this.parentNode.classList.toggle("description__showed")
};

var settingsBtn = document.querySelector(".settings__btn");
var settingsForm = document.querySelector(".settings__form");

if (settingsBtn) {
    settingsBtn.onclick = function () {
        settingsForm.classList.toggle("settings__form-active");
        console.log(settingsForm);
    }
};

if(document.querySelector(".menu__link_active")) {
    document.querySelector(".menu__link_active").onclick = function () {
        // document.querySelector(".menu__mobile").style.display = "block";
        document.querySelector(".menu__mobile").style.display = document.querySelector(".menu__mobile").style.display === "block" ? "none" : "block";
    }
};

if(document.querySelector(".img__cancel")) {
    document.querySelector(".img__cancel").onclick = function () {
        document.querySelector(".menu__mobile").style.display = "none";
    }
};

var menuSwitch = document.querySelector(".menu__switch");


if(menuSwitch){
    var menuSwitchBtns = menuSwitch.getElementsByTagName("a");
    for (var i=0; i<menuSwitchBtns.length; i++){
        menuSwitchBtns[i].addEventListener("click", function (event) {
            for (var i=0; i<menuSwitchBtns.length; i++){
                menuSwitchBtns[i].classList.remove("menu__switch-active");
            }
            var target = event.target;
            target.classList.add("menu__switch-active");
        })
    }
};