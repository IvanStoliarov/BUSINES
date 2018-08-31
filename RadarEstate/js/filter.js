// "use strict";
// PRO MODE TOGGLER

(function() {
  var proModeToggler = document.querySelector(".pro-mode__toggler");
  if (proModeToggler) {
    function toggleFilterBlocks() {
      var filter = document.querySelector(".filters_pro");
      if (filter) {
        function toggleFilterBlock(block) {
          block.classList.toggle("filter-block_is-opened");
        }

        var filterBlockTopList = document.querySelectorAll(".filter-block__top");
        for (var i = 0; i < filterBlockTopList.length; i++) {
          var filterBlockTop = filterBlockTopList[i];
          filterBlockTop.addEventListener("click", function() {
            toggleFilterBlock(this.parentElement);
          });
        }
      }
    }
    var filters = document.querySelector(".filters");
    proModeToggler.addEventListener("click", function() {
      proModeToggler.classList.toggle("pro-mode__toggler_yes");
      filters.classList.toggle("filters_pro");
      toggleFilterBlocks();
    });
  }
})();


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

$(function() {
  $("#slider-range_pro").slider({
    range: true,
    min: 0,
    max: 40000,
    values: [10000, 25000],
    slide: function(event, ui) {
      $("#budget").val("$" + ui.values[0] + " - $" + ui.values[1]);
      $("#slider-range_pro .value:eq(0)").html("$" + $("#slider-range_pro").slider("values", 0));
      $("#slider-range_pro .value:eq(1)").html("$" + $("#slider-range_pro").slider("values", 1));
    }
  });

  $("#budget").val(
    "$" + $("#slider-range_pro").slider("values", 0) + " - $" + $("#slider-range_pro").slider("values", 1)
  );
  $("#slider-range_pro .ui-state-default").append("<span></span>");
  $("#slider-range_pro .ui-state-default span").addClass("value");
  $("#slider-range_pro .value:eq(0)").html("$" + $("#slider-range_pro").slider("values", 0));
  $("#slider-range_pro .value:eq(1)").html("$" + $("#slider-range_pro").slider("values", 1));
});

$(function() {
  $("#slider-distance-pro").slider({
    range: true,
    min: 0,
    max: 10000,
    values: [500, 5000],
    slide: function(event, ui) {
      $("#budget").val("$" + ui.values[0] + " - $" + ui.values[1]);
      $("#slider-distance-pro .value:eq(0)").html($("#slider-distance-pro").slider("values", 0) + " м.");
      $("#slider-distance-pro .value:eq(1)").html($("#slider-distance-pro").slider("values", 1) + " м.");
    }
  });

  $("#budget").val(
    "$" + $("#slider-distance-pro").slider("values", 0) + " - $" + $("#slider-distance-pro").slider("values", 1)
  );
  $("#slider-distance-pro .ui-state-default").append("<span></span>");
  $("#slider-distance-pro .ui-state-default span").addClass("value");
  $("#slider-distance-pro .value:eq(0)").html($("#slider-distance-pro").slider("values", 0) + " м.");
  $("#slider-distance-pro .value:eq(1)").html($("#slider-distance-pro").slider("values", 1) + " м.");
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

// SQUARE PRO SLIDER
$(function() {
  $("#square-range-pro").slider({
    range: true,
    min: 0,
    max: 500,
    values: [20, 300],
    slide: function(event, ui) {
      $("#square-pro").val(ui.values[0] + " - " + ui.values[1]);
      $("#square-range-pro .value:eq(0)").html($("#square-range-pro").slider("values", 0));
      $("#square-range-pro .value:eq(1)").html($("#square-range-pro").slider("values", 1));
    }
  });

  $("#square-pro").val($("#square-range-pro").slider("values", 0) + " - " + $("#square-range-pro").slider("values", 1));
  $("#square-range-pro .ui-state-default").append("<span></span>");
  $("#square-range-pro .ui-state-default span").addClass("value");
  $("#square-range-pro .value:eq(0)").html($("#square-range-pro").slider("values", 0));
  $("#square-range-pro .value:eq(1)").html($("#square-range-pro").slider("values", 1));
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

//   TERMS SLIDER PRO
$(function() {
  $("#slider-terms-pro").slider({
    range: "min",
    value: 10,
    min: 0,
    max: 96,
    slide: function(event, ui) {
      $("#terms-pro").val(ui.value);
      $(".terms-scale__choice").html($("#slider-terms-pro").slider("value"));
    }
  });
  $("#terms-pro").val($("#slider-terms-pro").slider("value"));
  $(".terms-scale__choice").html($("#slider-terms-pro").slider("value"));
});

// CEIL HEIGHT SLIDER

$(function() {
  $("#ceil-height").slider({
    range: "min",
    value: 275,
    min: 200,
    max: 500,
    slide: function(event, ui) {
      $("#ceil-h").val(ui.value);
      $(".ceil-height-scale__choice").html($("#ceil-height").slider("value") / 100);
    }
  });
  $("#ceil-h").val($("#ceil-height").slider("value"));
  $(".ceil-height-scale__choice").html($("#ceil-height").slider("value") / 100);
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

var cataloguePage = document.querySelector(".catalogue-page");

if (cataloguePage) {
  var showFiltersButon = document.querySelector(".filters-show-button");
  if (showFiltersButon) {
    var filtersBlock = document.querySelector(".filters");

    showFiltersButon.addEventListener("click", function() {
      this.classList.toggle("filters-show-button_opened");
      filtersBlock.classList.toggle("filters_showed");
      document.querySelector("body").classList.toggle("filters-opened");
    });
  }

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
        // filters.style.height = "unset";
        filters.style.height = container.getBoundingClientRect().height + "px";
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
}

// CHECKMARK HOVER
(function() {
  var body = document.querySelector("body");
  body.classList.add("hashover");
  body.addEventListener("touchstart", function() {
    body.classList.remove("hashover");
  });
})();

