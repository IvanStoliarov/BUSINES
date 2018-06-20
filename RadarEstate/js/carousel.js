"use strict";
let currentPosition = getComputedStyle(carousel).left;
let startPosition;
let carouselItems;
let itemqQuantity;
let itemWidth;
let itemMargin;
let step;
let maxLeftMove;
let maxRightMove;
let maxItemqQuantity;

function getSize() {
    currentPosition;
    carouselItems = carousel.querySelectorAll(".carousel__item");
    itemqQuantity = carouselItems.length;
    itemWidth = parseInt(getComputedStyle(carouselItems[0]).width);
    itemMargin = parseInt(getComputedStyle(carouselItems[0]).marginLeft);
    startPosition = - (itemWidth * 0.95) + "px";
    step = itemWidth + itemMargin * 2;
    maxItemqQuantity =parseInt(getComputedStyle(carouselWrapper).width) / itemWidth;
    maxLeftMove = - step * (itemqQuantity - maxItemqQuantity);
    maxRightMove = parseInt(startPosition);
}

getSize();

prevBtn.addEventListener("click", moveRight);
nextBtn.addEventListener("click", moveLeft);

function moveLeft() {
    if ((parseInt(currentPosition) - maxLeftMove) > itemWidth) {
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
        carousel.style.left = maxLeftMove + "px";
        currentPosition = maxLeftMove + "px";
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

window.addEventListener("resize", getSize);

// Swipe
carousel.addEventListener('touchstart', handleTouchStart, false);
carousel.addEventListener('touchmove', handleTouchMove, false);

var xDown = null;
var yDown = null;

function handleTouchStart(evt) {
    xDown = evt.touches[0].clientX;
    yDown = evt.touches[0].clientY;
};

function handleTouchMove(evt) {
    if ( ! xDown || ! yDown ) {
        return;
    }

    var xUp = evt.touches[0].clientX;
    var yUp = evt.touches[0].clientY;

    var xDiff = xDown - xUp;
    var yDiff = yDown - yUp;
    console.log(xDiff);

    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
        if ( xDiff > 5 ) {
            moveLeft();
        } else if(xDiff < -5) {
            moveRight();
        }
    }
    xDown = null;
    yDown = null;
};