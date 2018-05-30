
// __________________1 el




var priceList = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price1());
function price1()
{
    var price = "1 890 грн";
    var carryingSelect = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_1").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "1 890 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "2 260 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "2 780 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "3 300 грн";
                        writePrice();
                        break;
                }
                break;
            case "1":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "2 190 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "2 514 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "3 300 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "3 990 грн";
                        writePrice();
                        break;
                }
                break;
            case "2":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "2 690 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "3 600 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "4 295 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "4 990 грн";
                        writePrice();
                        break;
                }
                break;
            case "3":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "3 690 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "4 450 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "5 400 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "6 150 грн";
                        writePrice();
                        break;
                }
                break;
            case "5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "5 990 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "7 950 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "9 990 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "11 990 грн";
                        writePrice();
                        break;
                }
                break;
            case "10":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "9 900 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "12 990 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "20":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "6":
                        price = "19990 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
        }

    }

    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}

// _________2



var priceList = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price2());
function price2()
{
    var price = "9 720 грн";
    var carryingSelect = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_2").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,25":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "9 720 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "1 350 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "17 460 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "0,5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "8 580 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "10 360 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "12 060 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "13 800 грн";
                        writePrice();
                        break;
                }
                break;
            case "1":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "12 790 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "15 240 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "17 700 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "20 160 грн";
                        writePrice();
                        break;
                }
                break;
            case "1,6":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "16 320 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "19 800 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "23 160 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "26 580 грн";
                        writePrice();
                        break;
                }
                break;
            case "3,2":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "23 280 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "27 660 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "31 980 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "36 360 грн";
                        writePrice();
                        break;
                }
                break;
            case "5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "30 000 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "37 950 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "45 840";
                        writePrice();
                        break;
                    case "12":
                        price = "53 760";
                        writePrice();
                        break;
                }
                break;
            case "7":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "58 380 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "65 580 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "10":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "77 460 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "88 800 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "20":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "6":
                        price = "376 300 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
        }

    }

    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;

        getPrice();
    }
    return price;
}

//_________3


var priceList = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price3());
function price3()
{
    var price = "1 090 грн";
    var carryingSelect = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_3").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,5":
                price = "1 090 грн";
                writePrice();
                break;
            case "1":
                price = "1 490 грн";
                writePrice();
                break;
            case "2":
                price = "1 790 грн";
                writePrice();
                break;
            case "3":
                price = "2 990 грн";
                writePrice();
                break;
            case "5":
                price = "4 598 грн";
                writePrice();
                break;
        }
    }

    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;

        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}


//______________________4


var priceList = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price4());
function price4()
{
    var price = "3 600 грн";
    var carryingSelect = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_4").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "3 600 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "3 980 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "4 680 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "5 460 грн";
                        writePrice();
                        break;
                }
                break;
            case "1":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "4 350 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "4 680 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "5 650 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "6 600 грн";
                        writePrice();
                        break;
                }
                break;
            case "2":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "5 790 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "6 900 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "7 750 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "8 740 грн";
                        writePrice();
                        break;
                }
                break;
            case "3":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "7 600 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "8 240 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "9 400 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "10 390 грн";
                        writePrice();
                        break;
                }
                break;
            case "5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "11 390 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "13 350 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "15 540 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "17 990 грн";
                        writePrice();
                        break;
                }
                break;
            case "10":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "21 450 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "21 450 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "20":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "6":
                        price = "46600 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
        }
    }


    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;

        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}


//_____________________5


var priceList = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price5());
function price5()
{
    var price = "2 090 грн";
    var carryingSelect = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_5").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,75":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "2 090 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "2 280 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "2 560 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "2 840 грн";
                        writePrice();
                        break;
                }
                break;
            case "1,5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "2 990 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "3 350 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "3 720 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "4 090 грн";
                        writePrice();
                        break;
                }
                break;
            case "3":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "3 660 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "4 300 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "4 725 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "5 150 грн";
                        writePrice();
                        break;
                }
                break;
            case "6":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "6 690 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "7 570 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "8 480 грн";
                        writePrice();
                        break;
                    case "12":
                        price = "9 360 грн";
                        writePrice();
                        break;
                }
                break;
            case "9":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "9 900 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "10 990 грн";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
        }
    }


    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}

//________6


var priceList = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price6());
function price6()
{
    var price = "9 300 грн";
    var carryingSelect = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_6").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,8":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "9 300 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "1,6":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "13 440 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "3,2":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "19 560 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "5":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "25 680 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
            case "6,3":
                switch (LiftingHeightValue) {
                    case "3":
                        price = "32 580 грн";
                        writePrice();
                        break;
                    case "6":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "9":
                        price = "По запросу";
                        writePrice();
                        break;
                    case "12":
                        price = "По запросу";
                        writePrice();
                        break;
                }
                break;
        }
    }


    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}

//________7

var priceList = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price7());
function price7()
{
    var price = "3 900 грн";
    var carryingSelect = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_7").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,8":
                price = "3 900 грн";
                writePrice();
                break;
            case "1,6":
                price = "5 640 грн";
                writePrice();
                break;
            case "3,2":
                price = "8 990 грн";
                writePrice();
                break;
            case "5,4":
                price = "19 990 грн";
                writePrice();
                break;
        }
    }


    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}

//______________8

var priceList = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-item__price");
priceList.innerHTML = (price8());

function price8()
{
    var price = "11 500 грн";
    var carryingSelect = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-carrying__select");
    var carryingValue = carryingSelect.value ;
    var LiftingHeighSelect = document.getElementById("mexanizm-item_8").querySelector(".mexanizm__LiftingHeight__select");
    var LiftingHeightValue = LiftingHeighSelect.value;
    var priceList = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-item__price");

    function writePrice() {
        priceList.innerHTML = (price);
    }

    // writePrice();

    function getPrice() {
        switch (carryingValue) {
            case "0,8":
                price = "11 500 грн";
                writePrice();
                break;
            case "1,6":
                price = "15 300 грн";
                writePrice();
                break;
            case "3,2":
                price = "31 900 грн";
                writePrice();
                break;
        }
    }


    carryingSelect.onchange = function () {
        carryingValue = carryingSelect.value;
        // var selectedCarrying = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-carrying__select").value;
        // carryingInput.value = selectedCarrying;
        getPrice();
    }

    LiftingHeighSelect.onchange = function () {
        LiftingHeightValue = LiftingHeighSelect.value;
        getPrice();
    }
    return price;
}

var buttons = document.getElementsByClassName("mexanizm-item__button-order");


    buttons[0].onclick = function () {
        var carryingInput = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-order__input-carrying");
        var carryingSelect = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-carrying__select");
        var selectedCarrying = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-carrying__select").value ;
        carryingInput.value = selectedCarrying;

        var LiftingHeightInput = document.getElementById("mexanizm-item_1").querySelector(".mexanizm-order__input-LiftingHeight");
        var LiftingHeightSelect = document.getElementById("mexanizm-item_1").querySelector(".mexanizm__LiftingHeight__select");
        var selectedLiftingHeight = document.getElementById("mexanizm-item_1").querySelector(".mexanizm__LiftingHeight__select").value;
        LiftingHeightInput.value = selectedLiftingHeight;
    }

buttons[1].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_2").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_2").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_2").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[2].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_3").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_3").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_3").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[3].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_4").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_4").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_4").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[4].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_5").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_5").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_5").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[5].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_6").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_6").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_6").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[6].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_7").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_7").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_7").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}

buttons[7].onclick = function () {
    var carryingInput = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-order__input-carrying");
    var carryingSelect = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-carrying__select");
    var selectedCarrying = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-carrying__select").value;
    carryingInput.value = selectedCarrying;

    var LiftingHeightInput = document.getElementById("mexanizm-item_8").querySelector(".mexanizm-order__input-LiftingHeight");
    var LiftingHeightSelect = document.getElementById("mexanizm-item_8").querySelector(".mexanizm__LiftingHeight__select");
    var selectedLiftingHeight = document.getElementById("mexanizm-item_8").querySelector(".mexanizm__LiftingHeight__select").value;
    LiftingHeightInput.value = selectedLiftingHeight;
}



