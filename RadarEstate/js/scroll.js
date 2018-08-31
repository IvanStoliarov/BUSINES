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
    if (window.screen.width > 576) {
      $(".map-filter").mCustomScrollbar({
        autoDraggerLength: false,
        scrollInertia: 50,
        mouseWheel: { preventDefault: true },
        contentTouchScroll: 25
      });
    }
  });
})(jQuery);

(function($) {
  $(window).on("resize", function() {
    if (window.screen.width <= 576) {
      $(".map-filter").mCustomScrollbar("destroy");
    } else {
      $(".map-filter").mCustomScrollbar({
        autoDraggerLength: false,
        scrollInertia: 50,
        mouseWheel: { preventDefault: true },
        contentTouchScroll: 25
      });
    }
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

(function($) {
  $(window).on("load", function() {
    $(".videos__list").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".infrastructure__list").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".sections-list").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

(function($) {
  $(window).on("load", function() {
    $(".building-progress__right-side").mCustomScrollbar({
      autoDraggerLength: false,
      scrollInertia: 50,
      mouseWheel: { preventDefault: true },
      contentTouchScroll: 25
    });
  });
})(jQuery);

// Fixing scroll block height bug

(function() {
  window.addEventListener("resize", function() {
    var scrollBox = this.document.querySelector(".mCustomScrollBox");
    if (scrollBox) {
      scrollBox.style.maxHeight = "unset";
    }
  });
})();

(function() {
  window.addEventListener("scroll", function() {
    var aside = document.querySelector(".favorite-lists");
    if (aside) {
      var scrollBlock = aside.querySelector(".mCustomScrollBox");
      if (scrollBlock) {
        var favoriteListButton = document.querySelector(".favorite-lists__bottom");
        var favoriteListButtonPositionTop = favoriteListButton.getBoundingClientRect().top;

        var scrollBlockPositionTop = scrollBlock.getBoundingClientRect().top;

        scrollBlock.style.maxHeight = favoriteListButtonPositionTop - scrollBlockPositionTop + "px";
      }
    }
  });
})();
