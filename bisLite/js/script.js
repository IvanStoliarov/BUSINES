var navBtn = document.getElementById("nav__btn");

function showMenu(){
    var navMenu = document.getElementById("navMenu");

    if(navMenu.classList.contains("visible")){
        navMenu.classList.remove("visible");
    }else {
        navMenu.classList.add("visible");
    }
}

navBtn.addEventListener("click", showMenu);


var toogleBtn = document.querySelectorAll(".toogleBtn");

function showSubMenu() {
    var navList = this.closest(".firstLineMenu__item").querySelector(".secondLineMenu");

    if(navList.classList.contains("collapse")){
        navList.classList.remove("collapse");
    }else {
        navList.classList.add("collapse");
    }
}


toogleBtn.forEach(element => {
    element.addEventListener("click", showSubMenu);
});
