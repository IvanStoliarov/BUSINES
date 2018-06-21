var timerStart = 90;
var timeField = document.querySelector(".timer__text_number");
timeField.innerHTML = timerStart;
var button = document.querySelector(".resend");
var timerBlock = document.querySelector(".timer");

function timer() {
    if (timerStart > 0) {
        timerStart -= 1;
        timeField.innerHTML = timerStart;
    }
    else {
        button.removeAttribute("disabled");
        timerBlock.style.opacity = 0;
    }
}
setInterval(timer, 1000);