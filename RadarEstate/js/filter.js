"use strict";
// PRO MODE TOGGLER
var proModeToggler = document.querySelector(".pro-mode__toggler");
proModeToggler.addEventListener("click", function() {
  proModeToggler.classList.toggle("pro-mode__toggler_yes");
});

// BUDGET SLIDER
$(function() {
  $("#slider-range").slider({
    range: true,
    min: 0,
    max: 40000,
    values: [10000, 25000],
    slide: function(event, ui) {
      $("#budget").val("$" + ui.values[0] + " - $" + ui.values[1]);
      $("#slider-range .value:eq(0)").html("$" + $("#slider-range").slider("values", 0));
      $("#slider-range .value:eq(1)").html("$" + $("#slider-range").slider("values", 1));
    }
  });

  $("#budget").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
  $("#slider-range .ui-state-default").append("<span></span>");
  $("#slider-range .ui-state-default span").addClass("value");
  $("#slider-range .value:eq(0)").html("$" + $("#slider-range").slider("values", 0));
  $("#slider-range .value:eq(1)").html("$" + $("#slider-range").slider("values", 1));
});

// SQUARE SLIDER
$(function() {
  $("#square-range").slider({
    range: true,
    min: 0,
    max: 500,
    values: [20, 300],
    slide: function(event, ui) {
      $("#square").val(ui.values[0] + " - " + ui.values[1]);
      $("#square-range .value:eq(0)").html($("#square-range").slider("values", 0));
      $("#square-range .value:eq(1)").html($("#square-range").slider("values", 1));
    }
  });

  $("#square").val($("#square-range").slider("values", 0) + " - " + $("#square-range").slider("values", 1));
  $("#square-range .ui-state-default").append("<span></span>");
  $("#square-range .ui-state-default span").addClass("value");
  $("#square-range .value:eq(0)").html($("#square-range").slider("values", 0));
  $("#square-range .value:eq(1)").html($("#square-range").slider("values", 1));
});

//   TERMS SLIDER
$(function() {
  $("#slider-terms-min").slider({
    range: "min",
    value: 10,
    min: 0,
    max: 96,
    slide: function(event, ui) {
      $("#terms").val(ui.value);
      $(".terms-scale__choice").html($("#slider-terms-min").slider("value"));
    }
  });
  $("#terms").val($("#slider-terms-min").slider("value"));
  $(".terms-scale__choice").html($("#slider-terms-min").slider("value"));
});

// ROOMS CHECKBOXES
var allRoomsBtn = $(".rooms-quantity__wrapper input").eq(0);
allRoomsBtn.change(function() {
  if (allRoomsBtn.prop("checked")) {
    $(".rooms-quantity__wrapper input").prop("checked", true);
  } else {
    $(".rooms-quantity__wrapper input").prop("checked", false);
  }
});

//   CLASS CHECKBOXES
var allClassBtn = $(".class input").eq(0);
allClassBtn.change(function() {
  if (allClassBtn.prop("checked")) {
    $(".class input").prop("checked", true);
  } else {
    $(".class input").prop("checked", false);
  }
});

// SHOW FILTERS

var showFiltersButon = document.querySelector(".filters-show-button");
var filtersBlock = document.querySelector(".filters");

showFiltersButon.addEventListener("click", function() {
  this.classList.toggle("filters-show-button_opened");
  filtersBlock.classList.toggle("filters_showed");
  document.querySelector("body").classList.toggle("filters-opened");
});

// FIX FILTERS BUTTON FOR DESKTOP
(function() {
  var filters = document.querySelector(".filters");
  if (filters) {
    var fiXFooter = function() {
      var getWindowHeight = function() {
        return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
      };
      var filtersButton = document.querySelector(".filters__button-wrapper");
      var container = document.querySelector(".container");
      var containerPositionBottom = container.getBoundingClientRect().bottom;
      var windowHeight = getWindowHeight();
      if (windowHeight - containerPositionBottom > 0) {
        filtersButton.style.bottom = windowHeight - containerPositionBottom + "px";
      } else {
        filtersButton.style.bottom = 0;
      }
      filters.style.height = "unset";
    };

    var fixAsideTablet = function() {
      if (document.body.offsetWidth >= 577 && document.body.offsetWidth < 993) {
        var header = document.querySelector("header");
        var headerPositionBottom = header.getBoundingClientRect().bottom;
        if (headerPositionBottom >= 0) {
          filters.style.top = headerPositionBottom + "px";
          filters.style.height = "calc( 100% - " + headerPositionBottom + "px)";
        } else {
          filters.style.top = 0;
          filters.style.height = "100%";
        }
      }
    };

    fiXFooter();
    fixAsideTablet();

    window.addEventListener("scroll", function() {
      fiXFooter();
      fixAsideTablet();
    });
    window.addEventListener("resize", function() {
      fiXFooter();
      fixAsideTablet();
    });
  }
})();

// CHECKMARK HOVER
(function() {
  var body = document.querySelector("body");
  body.classList.add("hashover");
  body.addEventListener("touchstart", function() {
    body.classList.remove("hashover");
  });
})();
