"use strict";

let currentPosition = getComputedStyle(carousel).left;
let startPosition = currentPosition;
const carouselItems = carousel.querySelectorAll(".carousel__item");
const itemqQuantity = carouselItems.length;
const itemWidth = parseInt(getComputedStyle(carouselItems[0]).width);
const itemMargin = parseInt(getComputedStyle(carouselItems[0]).marginLeft);
const step = itemWidth + itemMargin * 2;
const maxLeftMove = - step * (itemqQuantity -3);
const maxRightMove = parseInt(startPosition);

prevBtn.addEventListener("click", moveLeft);
nextBtn.addEventListener("click", moveRight);

function moveLeft() {
    if(parseInt(currentPosition) > maxLeftMove) {
        currentPosition = parseInt(currentPosition) - step + "px";
        carousel.style.left = currentPosition;
    }
    else {
        carousel.style.left = startPosition;
        currentPosition = startPosition;
    }
}

function moveRight() {
    if (parseInt(currentPosition) <= maxRightMove) {
        currentPosition = (parseInt(currentPosition) + step) + "px";
        carousel.style.left = currentPosition;
    }
    else {
        carousel.style.left = maxLeftMove +"px";
        currentPosition = maxLeftMove +"px";
    }
}

let autoSlide = setInterval(moveLeft, 5000);


carouselWrapper.addEventListener("mouseover", function () {
    if (autoSlide) {
        clearInterval(autoSlide);
        autoSlide = null;
    }
});

carouselWrapper.addEventListener("mouseout", function () {
    if (autoSlide === null) {
        autoSlide = setInterval(moveLeft, 5000);
    }
});








