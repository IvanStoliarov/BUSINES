var rightBtn = document.getElementById('carouselRightButton');


var leftBtn = document.getElementById('carouselLeftButton');


var ul = document.querySelector('.carousel').querySelector('ul');
//
//
// moveRight = function(){
//     ul.style
// }

// rightBtn.onclick = function moveRight;


/* этот код помечает картинки, для удобства разработки */
var lis = document.querySelector('.carousel').getElementsByTagName('li');
// for (var i = 0; i < lis.length; i++) {
//     lis[i].style.position = 'relative';
//     var span = document.createElement('span');
//     // обычно лучше использовать CSS-классы,
//     // но этот код - для удобства разработки, так что не будем трогать стили
//     span.style.cssText = 'position:absolute;left:0;top:0';
//     span.innerHTML = i + 1;
//     lis[i].appendChild(span);
// }

/* конфигурация */
var width = 171; // ширина изображения
var count = 1; // количество изображений

var listElems = ul.querySelectorAll('li');

var position = 0; // текущий сдвиг влево

var displayWidth = document.documentElement.clientWidth;
var quantityCoef;

if(displayWidth < 375){
    var quantityCoef = 2;
}
else if(displayWidth < 540){
    var quantityCoef = 3;
}
else if(displayWidth < 715){
    var quantityCoef = 4;
}
else if(displayWidth < 885){
    var quantityCoef = 5;
}
else if(displayWidth < 1050){
    var quantityCoef = 6;
}
else {
    var quantityCoef = 7;
}


var changeList = setInterval(function () {
    if(position == (-1*(width*(listElems.length - quantityCoef)))){
        position = 0;
        ul.style.marginLeft = position + 'px';
    }
    else {
        position -= width;
        ul.style.marginLeft = position + 'px';
    }
},5000);

leftBtn.onclick = function() {
    // сдвиг влево
    // последнее передвижение влево может быть не на 3, а на 2 или 1 элемент
    if (position == 0) {
        position = (-1 * (width * (listElems.length - quantityCoef)));
        ul.style.marginLeft = position + 'px';
    }else {
        position = Math.min(position + width * count, 0);
        ul.style.marginLeft = position + 'px';
    }
};

rightBtn.onclick = function() {
    // сдвиг вправо
    // последнее передвижение вправо может быть не на 3, а на 2 или 1 элемент
    position = Math.max(position - width * count, -width * (listElems.length - count));
    if (position == (-1*(width*(listElems.length - (quantityCoef - 1))))){
        position = 0;
        ul.style.marginLeft = position + 'px';
    }
    else {
        ul.style.marginLeft = position + 'px';
    }
}


var toggleBtn = document.querySelector('.toggle__menu').getElementsByClassName('ion-android-add-circle');

for(var i = 0; i<toggleBtn.length; i++){
    toggleBtn[i].onclick = function () {
       this.parentNode.nextElementSibling.classList.toggle('active');
    }
}


var menuBtn = document.querySelector('.menu__btn');
var toggleArea = document.querySelector('.header__toggle');


menuBtn.onclick = function () {
    toggleArea.classList.toggle('show');
}

toggleArea.onclick = function (e) {
    e.stopPropagation();
    e.target.classList.remove('show');
}

console.log("hello");








