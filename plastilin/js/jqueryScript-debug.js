
var title = $(".title__link");
var switchBtns = $(".switch__svg");

// Change text

title.on("click", function(){
    title.removeClass("title-active");
    $(this).toggleClass("title-active");
    if($(this).hasClass("title__simple")){
        var simpleDescriptions = $(".description-simple");
        var smartDescriptions = $(".description-smart");
        simpleDescriptions.removeClass("hidden");
        smartDescriptions.addClass("hidden");
    }
    else{
        var simpleDescriptions = $(".description-simple");
        var smartDescriptions = $(".description-smart");
        simpleDescriptions.addClass("hidden");
        smartDescriptions.removeClass("hidden");
    }
})

// Change products

switchBtns.on("click", function(){
    switchBtns.removeClass("switch__svg-active");
    $(this).toggleClass("switch__svg-active");
    if($(this).hasClass("switch__svg-phone")){
        $(".phone").addClass("product-active");
        $(".laptop").removeClass("product-active");
    }
    else{
        $(".laptop").addClass("product-active");
        $(".phone").removeClass("product-active");

    }
})