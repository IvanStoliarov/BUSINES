var title = document.querySelectorAll(".title__link");
var switchBtns = document.querySelectorAll(".switch__svg");



// Change text
title.forEach(function (i) {
    i.addEventListener("click", function () {
        title.forEach(function (i) {
            i.classList.remove("title-active");
        })
            this.classList.toggle("title-active");
        if(this.classList.contains("title__simple")){
            var simpleDescriptions = document.querySelectorAll(".description-simple");
            var smartDescriptions = document.querySelectorAll(".description-smart");
            simpleDescriptions.forEach(function (i) {
                i.classList.remove("hidden");
            })
            smartDescriptions.forEach(function (i) {
                i.classList.add("hidden");
            })
        }else {
            var simpleDescriptions = document.querySelectorAll(".description-simple");
            var smartDescriptions = document.querySelectorAll(".description-smart");
            simpleDescriptions.forEach(function (i) {
                i.classList.add("hidden");
            })
            smartDescriptions.forEach(function (i) {
                i.classList.remove("hidden");
            })
        }
    })
})

// Change products

switchBtns.forEach(function (i) {
    i.addEventListener("click", function () {
        switchBtns.forEach(function (i) {
            i.classList.remove("switch__svg-active");
        })
        this.classList.toggle("switch__svg-active");
        if(this.classList.contains("switch__svg-phone")){
            document.querySelector(".phone").classList.add("product-active");
            document.querySelector(".laptop").classList.remove("product-active");
        }else {
            document.querySelector(".laptop").classList.add("product-active");
            document.querySelector(".phone").classList.remove("product-active");
        }
    })

})

