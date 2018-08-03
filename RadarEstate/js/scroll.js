(function($) {
  $(window).on("load", function() {
    $(".filters__form").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".editor__buildings-wrapper").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".favorite-card-popup__list").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".favorite-lists__group").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

// Fixing scroll blcok height bug

(function() {
  window.addEventListener("resize", function() {
    var scrollBox = this.document.querySelector(".mCustomScrollBox");
    scrollBox.style.maxHeight = "unset";
  });
})();

(function() {
  window.addEventListener("scroll", function() {
    var aside = document.querySelector(".favorite-lists");
    var scrollBlock = aside.querySelector(".mCustomScrollBox");
    var favoriteListButton = document.querySelector(".favorite-lists__bottom");
    var favoriteListButtonPositionTop = favoriteListButton.getBoundingClientRect().top;

    var scrollBlockPositionTop = scrollBlock.getBoundingClientRect().top;

    scrollBlock.style.maxHeight = favoriteListButtonPositionTop - scrollBlockPositionTop + "px";
  });
})();
