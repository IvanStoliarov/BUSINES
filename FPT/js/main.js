var textTypeIcons = document.getElementsByClassName("text__type");
if(textTypeIcons){
    for (var i =0; i < textTypeIcons.length; i++){
        textTypeIcons[i].addEventListener( "click", function () {
            for (var i =0; i < textTypeIcons.length; i++){
                textTypeIcons[i].classList.remove("text__type-active");
            }
            this.classList.toggle("text__type-active")
        })
    }
}

var btnUp = document.getElementById("number_of_texts__button-up");
var btnDowm = document.getElementById("number_of_texts__button-down");
var numOfText = document.getElementById("number_of_texts");
btnUp.addEventListener("click", function() {
    numOfText.value = +numOfText.value + 1;
})
btnDowm.addEventListener("click", function () {
    if (numOfText.value > 0) {
        numOfText.value = +numOfText.value - 1;
    }
})

// slide works

var prevBtn = document.getElementById("portfolio__btn-prev");
var nextwBtn = document.getElementById("portfolio__btn-next");

nextwBtn.addEventListener("click", function () {
    var workActive = document.querySelector(".work-active");
    var nextElem = workActive.nextElementSibling;
    if(nextElem){
        workActive.classList.remove("work-active");
        nextElem.classList.add("work-active");
    }
})



prevBtn.addEventListener("click", function () {
    var workActive = document.querySelector(".work-active");
    var prevElem = workActive.previousElementSibling;
    if(prevElem){
        workActive.classList.remove("work-active");
        prevElem.classList.add("work-active");
    }
})

// Change menu bytton icon

var collapse = document.getElementById("navbarTogglerDemo01");
var menuBtn = document.querySelector(".navbar-toggler");
var menuIcon = document.querySelector(".navbar-toggler-icon");

menuBtn.addEventListener("click", function () {
        menuIcon.classList.toggle("navbar-toggler-icon_opened");
})


