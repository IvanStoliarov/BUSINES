"use strict";

// Show mobile menu
var mobileMenu = document.querySelector(".mobile-menu");
var mobileMenuBtnShow = document.querySelector(".menu__btn");
mobileMenuBtnShow.addEventListener("click", function() {
  mobileMenu.classList.remove("mobile-menu-hidden");
  document.querySelector(".main").style.display = "none";
  document.querySelector("footer").style.display = "none";
});

// Hide mobile menu
var mobileMenuBtnHide = document.querySelector(".mobile-menu__btn");
mobileMenuBtnHide.addEventListener("click", function() {
  mobileMenu.classList.add("mobile-menu-hidden");
  document.querySelector(".main").style.display = "flex";
  document.querySelector("footer").style.display = "flex";
});

// Show city list

var currentCity = document.querySelector(".current__city");
currentCity.addEventListener("click", function() {
  document.querySelector(".city-popup").classList.toggle("city-popup-hidden");
});

document.addEventListener("click", function(element) {
  if (element.target.className == "header__city" || element.target.className == "current__city") {
    return;
  } else {
    if (document.querySelector(".city-popup")) {
      document.querySelector(".city-popup").classList.add("city-popup-hidden");
    }
  }
});

// Show profile popup
(function() {
  var header = document.querySelector("header");
  if (!(header.getAttribute("data-status") == "developer")) {
    var signUpBlock = document.querySelector(".header__sign-up");
    var userPopup = document.querySelector(".user-popup");
    signUpBlock.addEventListener("click", function(event) {
      this.classList.toggle("user-popup_is-hidden");
    });
    userPopup.addEventListener("click", function(event) {
      event.stopPropagation();
    });
  }
})();

// Show city list mobile
var mobileCityListToggler = document.querySelector(".header__city-mobile");
mobileCityListToggler.addEventListener("click", function() {
  document.querySelector(".city__list-mobile").classList.toggle("city__list-hidden");
});

// Show about company text
var showTextBtn = document.querySelector(".article__text-toggler");
if (showTextBtn) {
  showTextBtn.addEventListener("click", function() {
    document.querySelector(".article__text-wrapper").classList.toggle("article__text-wrapper-full");
    showTextBtn.style.display = "none";
  });
}

var allLinks = document.querySelectorAll("a");
for (var i = 0; i < allLinks.length; i++) {
  allLinks[i].addEventListener("click", function() {
    var element = this;
    if (element.getAttribute("target")) {
      return;
    }
    event.preventDefault();
    var link = element.getAttribute("href");
    element.classList.add("active-link");
    setTimeout(function() {
      location.href = link;
      element.classList.remove("active-link");
    }, 400);
  });
}

var estateItems = document.querySelectorAll(".zim-real-estate__item");
if (estateItems) {
  for (var i = 0; i < estateItems.length; i++) {
    estateItems[i].addEventListener("click", function() {
      var linkedItem = this.querySelector(".zim-real-estate__name");
      linkedItem.classList.add("zim-real-estate__name-active");
      setTimeout(function() {
        linkedItem.classList.remove("zim-real-estate__name-active");
      }, 400);
    });
  }
}

var complexEstateItems = document.querySelectorAll(".complex-real-estate__item");
if (complexEstateItems) {
  for (var i = 0; i < complexEstateItems.length; i++) {
    complexEstateItems[i].addEventListener("click", function() {
      var linkedItem = this.querySelector(".complex-real-estate__name");
      linkedItem.classList.add("complex-real-estate__name-active");
      setTimeout(function() {
        linkedItem.classList.remove("complex-real-estate__name-active");
      }, 400);
    });
  }
}

var footerMenu = document.querySelector(".footer__menu");
var footerLinks = footerMenu.querySelectorAll("a");
if (footerLinks) {
  for (var i = 0; i < footerLinks.length; i++) {
    footerLinks[i].addEventListener("click", function() {
      footerLinks[i].classList.add("pressed-link");
      setTimeout(function() {
        footerLinks[i].classList.remove("pressed-link");
      }, 400);
    });
  }
}

// DOWNLOAD FILE
var downloadButton = document.querySelector("#downloadButton");
if (downloadButton) {
  var downloadForm = document.querySelector("#downloadForm");
  var downloadLink = downloadButton.querySelector("a");
  downloadLink.addEventListener("click", function() {
    downloadForm.click();
  });
}

// Form validation
var form = document.querySelector("#form");
if (form) {
  var emailInput = form.email;
  var completedValue = emailInput.value;
  emailInput.addEventListener("input", function(event) {
    var validMail = event.target.value.match(/^[0-9a-z-\.-\@]+$/i);
    if (completedValue == event.target.value || validMail) {
      document.querySelector(".form__email").classList.remove("form__email-wrong");
    } else {
      document.querySelector(".form__email").classList.add("form__email-wrong");
    }
  });
}

// CHECKBOX

var checkBoxes = document.querySelectorAll(".input-box");
if (checkBoxes[0]) {
  for (var index = 0; index < checkBoxes.length; index++) {
    var checkbox = checkBoxes[index];
    checkbox.addEventListener("click", function(event) {
      var currentBlock = event.target.parentElement;
      event.target.classList.toggle("input-box_checked");
      var inputElement = currentBlock.querySelector("input");
      if (event.target.className == "input-box") {
        inputElement.checked = false;
      } else {
        inputElement.checked = true;
      }
    });
  }

  var showCheckBoxes = function() {
    var emailInput = document.querySelector("#emailInput");
    if (emailInput) {
      if (emailInput.value == "") {
        document.querySelector(".checkbox").classList.remove("checkbox-active");
      } else {
        document.querySelector(".checkbox").classList.add("checkbox-active");
      }
    }
  };

  showCheckBoxes();
}

// user profile icons color

function changeIconColor() {
  var profileItems = document.querySelectorAll(".profile-item");
  for (var index = 0; index < profileItems.length; index++) {
    var inputField = profileItems[index].querySelector(".profile-item__input");
    if (!inputField.value == "") {
      profileItems[index].classList.add("profile-item_completed");
    } else {
      profileItems[index].classList.remove("profile-item_completed");
    }
  }
}

changeIconColor();

// user profile buttons

var buttons = document.querySelectorAll(".button-edit");
if (buttons) {
  for (var index = 0; index < buttons.length; index++) {
    var editButton = buttons[index];
    editButton.addEventListener("click", function() {
      var buttonsGroup = this.parentElement;
      var saveButton = buttonsGroup.querySelector(".button-save");
      var cancelButton = buttonsGroup.querySelector(".button-cancel");
      var deleteButton = buttonsGroup.querySelector(".button-delete");
      var inputField = buttonsGroup.parentElement.querySelector(".profile-item__input");

      buttonsGroup.classList.add("profile-item__buttons_editing");
      var startValue = inputField.value;
      inputField.readOnly = false;

      saveButton.addEventListener("click", function() {
        inputField.readOnly = true;
        buttonsGroup.classList.remove("profile-item__buttons_editing");
        changeIconColor();
        showCheckBoxes();
      });

      cancelButton.addEventListener("click", function() {
        inputField.value = startValue;
        buttonsGroup.classList.remove("profile-item__buttons_editing");
      });

      deleteButton.addEventListener("click", function() {
        inputField.value = "";
      });
    });
  }
}

// GO TO EMAIL

var conditionsLink = document.querySelector(".checkbox__conditions_link");
if (conditionsLink) {
  conditionsLink.addEventListener("click", function() {
    emailItem.querySelector(".button-edit").click();
  });
}

// useful_info page. toggle category

var categoryItems = document.querySelectorAll(".category-item");
if (categoryItems.length > 0) {
  for (var i = 0; i < categoryItems.length; i++) {
    var element = categoryItems[i];
    element.addEventListener("click", function(event) {
      var activeElement = document.querySelector(".category-item_active");
      activeElement.classList.remove("category-item_active");
      this.classList.add("category-item_active");
    });
  }
}

// Mask for phone input
var phoneInput = document.querySelector("#phone");
if (phoneInput) {
  $(function() {
    $("#phone").mask("+38 999 999 99 99");
  });
}

// Expand services

var ourServices = document.querySelector(".our-services");
if (ourServices) {
  var serviceItem = ourServices.querySelectorAll(".our-services__item");
  for (var i = 0; i < serviceItem.length; i++) {
    serviceItem[i].addEventListener("click", function() {
      for (var i = 0; i < serviceItem.length; i++) {
        serviceItem[i].classList.remove("our-services__item_active");
        serviceItem[i].style.marginBottom = 0;
      }
      this.classList.add("our-services__item_active");
      var descriptionHeight = this.querySelector(".our-services__description").offsetHeight;
      this.style.marginBottom = descriptionHeight * 1.09 + "px";
    });
  }
  var closeButtons = ourServices.querySelectorAll(".description__button");
  for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", function(event) {
      event.stopPropagation();
      this.parentElement.parentElement.classList.remove("our-services__item_active");
      this.parentElement.parentElement.style.marginBottom = 0;
    });
  }
}

// Choice services

var servicesList = document.querySelector(".services-list");
if (servicesList) {
  var services = servicesList.querySelectorAll(".service");
  for (var i = 0; i < services.length; i++) {
    services[i].addEventListener("click", function() {
      for (var i = 0; i < services.length; i++) {
        services[i].classList.remove("service_active");
      }
      this.classList.add("service_active");
    });
  }
}

// buildinginfo page show more text

var showMoreButton = document.querySelector(".infrastructure__show-more-btn");
if (showMoreButton) {
  var infrastructureList = document.querySelector(".infrastructure__list");
  showMoreButton.addEventListener("click", function() {
    infrastructureList.style.height = "unset";
    showMoreButton.style.display = "none";
  });
}

// buildinginfo page select section
var sectionsList = document.querySelector(".sections-list");
if (sectionsList) {
  var sections = document.querySelectorAll(".section");

  for (var i = 0; i < sections.length; i++) {
    var section = sections[i];
    section.addEventListener("click", function(event) {
      for (var i = 0; i < sections.length; i++) {
        sections[i].classList.remove("section_active");
      }

      this.classList.add("section_active");

      if (event.target.className == "floor__link") {
        var floorLinks = document.querySelectorAll(".floor__link");
        for (var i = 0; i < floorLinks.length; i++) {
          floorLinks[i].classList.remove("floor__link_active");
        }
        event.target.classList.add("floor__link_active");
      }
    });
  }
}

// buildinginfo page progress show month

var progressCalendar = document.querySelector(".building-progress__calendar");
if (progressCalendar) {
  var month = progressCalendar.querySelectorAll(".calendar-month__top");
  for (var i = 0; i < month.length; i++) {
    month[i].addEventListener("click", function() {
      this.parentElement.classList.toggle("calendar-month_collapsed");
    });
  }
}

// buildinginfo page progress active img

if (progressCalendar) {
  var days = progressCalendar.querySelectorAll(".calendar-month__img");
  for (var i = 0; i < days.length; i++) {
    days[i].addEventListener("click", function() {
      for (var i = 0; i < days.length; i++) {
        days[i].classList.remove("calendar-month__img_active");
      }
      this.classList.add("calendar-month__img_active");
    });
  }
}

// buildinginfo page currency toggler, year choice

var priceDynamicBlock = document.querySelector(".price-dynamic");
if (priceDynamicBlock) {
  var currencyTogglers = document.querySelectorAll(".currency-toggler");
  for (var i = 0; i < currencyTogglers.length; i++) {
    currencyTogglers[i].addEventListener("click", function() {
      for (var i = 0; i < currencyTogglers.length; i++) {
        currencyTogglers[i].classList.remove("currency-toggler_active");
      }
      this.classList.add("currency-toggler_active");
    });
  }

  var yearList = document.querySelectorAll(".price-dynamic__year");
  for (var i = 0; i < yearList.length; i++) {
    yearList[i].addEventListener("click", function() {
      for (var i = 0; i < yearList.length; i++) {
        yearList[i].classList.remove("price-dynamic__year_active");
      }
      this.classList.add("price-dynamic__year_active");
    });
  }
}

// buildinginfo page show more text

var seoText = document.querySelector(".seo-text");
if (seoText) {
  var showSeoTextBtn = document.querySelector(".seo-text__more-btn");
  showSeoTextBtn.addEventListener("click", function() {
    showSeoTextBtn.style.display = "none";
    var hiddenText = document.querySelectorAll(".seo-text_hidden");
    for (var i = 0; i < hiddenText.length; i++) {
      hiddenText[i].classList.remove("seo-text_hidden");
    }
  });
}

(function() {
  var videoDescription = document.querySelector(".videos__description-block");
  if (videoDescription) {
    var videoDescriptionButton = document.querySelector(".videos__description-show-more");
    videoDescriptionButton.addEventListener("click", function() {
      this.style.display = "none";
      this.parentElement
        .querySelector(".videos__description-block_is-collapsed")
        .classList.remove("videos__description-block_is-collapsed");
    });
  }
})();

// buildinginfo page show page navigation

var pageNavButton = document.querySelector(".action-bar__button-navigation");
if (pageNavButton) {
  var navHideButton = document.querySelector(".back-icon");
  var showNavMenu = function() {
    if (pageNavButton.getAttribute("data-status") == "disable") {
      document.querySelector(".aside").classList.add("aside_showed");
      pageNavButton.classList.add("action-bar__button-navigation_active");
      pageNavButton.setAttribute("data-status", "active");
    } else {
      document.querySelector(".aside").classList.remove("aside_showed");
      pageNavButton.classList.remove("action-bar__button-navigation_active");
      pageNavButton.setAttribute("data-status", "disable");
    }
  };

  document.addEventListener("click", function(event) {
    if (event.target == pageNavButton) {
      showNavMenu();
    }
    if (event.target == navHideButton) {
      showNavMenu();
    }
  });
}

// buildinginfo page show page video playlist
(function() {
  var videos = document.querySelector(".videos");
  if (videos) {
    var playlistItems = videos.querySelectorAll(".videos-list-item");
    for (var i = 0; i < playlistItems.length; i++) {
      var playlistItem = playlistItems[i];
      playlistItem.addEventListener("click", function() {
        for (var i = 0; i < playlistItems.length; i++) {
          playlistItems[i].classList.remove("videos-list-item_active");
        }
        this.classList.add("videos-list-item_active");
      });
    }
  }
})();

(function() {
  var videos = document.querySelector(".videos-webcam");
  if (videos) {
    var playlistItems = videos.querySelectorAll(".videos-list-item");
    for (var i = 0; i < playlistItems.length; i++) {
      var playlistItem = playlistItems[i];
      playlistItem.addEventListener("click", function() {
        for (var i = 0; i < playlistItems.length; i++) {
          playlistItems[i].classList.remove("videos-list-item_active");
        }
        this.classList.add("videos-list-item_active");
      });
    }
  }
})();

// catalogue page sort buttons

(function() {
  var sortBlock = document.querySelector(".sort");
  if (sortBlock) {
    var buttons = sortBlock.querySelectorAll(".sort__link");
    for (var i = 0; i < buttons.length; i++) {
      var button = buttons[i];

      button.addEventListener("click", function() {
        for (var i = 0; i < buttons.length; i++) {
          buttons[i].classList.remove("sort__link_active");
        }
        this.classList.add("sort__link_active");
      });
    }
  }
})();

// catalogue coming_soon popup

(function() {
  var popup = document.querySelector(".modal");
  if (popup) {
    var demoButton = popup.querySelector(".modal__link");
    demoButton.addEventListener("click", function() {
      popup.classList.add("modal_hidden");
      document.querySelector(".modal-opened").classList.remove("modal-opened");
    });
  }
})();

// buildinginfo page building buttons bar

var buildingButtonsBar = document.querySelector(".building__buttons-bar");
if (buildingButtonsBar) {
  var buttons = document.querySelectorAll(".buttons-bar__item");

  for (var i = 0; i < buttons.length; i++) {
    var button = buttons[i];

    button.addEventListener("click", function() {
      this.classList.toggle("buttons-bar__item_active");
      var elem = this;
      var buttonClasses = this.className.split(" ");
      for (var i = 0; i < buttonClasses.length; i++) {
        var buttonClass = buttonClasses[i];
        if (buttonClass == "buttons-bar__item_hide") {
          elem.parentElement.parentElement.parentElement.classList.toggle("building_hide");
        }
      }
    });
  }
}

// dashBoard timeline switcher

var dashBoardTimeline = document.querySelector("#dashBoard");
if (dashBoardTimeline) {
  var timelineItems = document.querySelectorAll(".timeline__item");
  for (var i = 0; i < timelineItems.length; i++) {
    var timelineItem = timelineItems[i];
    timelineItem.addEventListener("click", function() {
      for (var i = 0; i < timelineItems.length; i++) {
        timelineItems[i].classList.remove("timeline__item_active");
      }
      this.classList.add("timeline__item_active");
    });
  }
}

// dashBoard timeline houses show

var devObject = document.querySelector(".developer-objects");

if (devObject) {
  var complexHeaders = document.querySelectorAll(".complex__header");
  for (var i = 0; i < complexHeaders.length; i++) {
    var complexHeader = complexHeaders[i];
    complexHeader.addEventListener("click", function() {
      this.parentElement.querySelector(".complex-houses__list").classList.toggle("complex-houses__list_hidden");
      this.parentElement.classList.toggle("complex_active");
      var satusIcons = this.querySelectorAll(".show-status-icon");
      for (var i = 0; i < satusIcons.length; i++) {
        var satusIcon = satusIcons[i];
        satusIcon.classList.toggle("show-status-icon_collapsed");
      }
    });
  }
}

// dashBoard timeline aside show
(function() {
  var messages = document.querySelector(".messages");
  if (messages) {
    var messageBtn = document.querySelector(".header__notification");
    messageBtn.addEventListener("click", function() {
      messages.classList.toggle("messages_is-showed");
    });
    var messagesCloseBtn = document.querySelector(".messages__close-btn");
    messagesCloseBtn.addEventListener("click", function() {
      messages.classList.remove("messages_is-showed");
    });
  }
})();

// FAVORITE CARD ACCESS TOGGLER
var favoriteList = document.querySelector(".favorite-lists");
if (favoriteList) {
  var togglersList = document.querySelectorAll(".access__toggler");
  for (var i = 0; i < togglersList.length; i++) {
    var currentToggler = togglersList[i];

    currentToggler.addEventListener("click", function() {
      this.classList.toggle("access__toggler_yes");
    });
  }
}

// FAVORITE CARD COLLAPSE LISTS
if (favoriteList) {
  var allLists = document.querySelectorAll(".favorite-lists-item__top");
  for (var i = 0; i < allLists.length; i++) {
    var list = allLists[i];
    list.addEventListener("click", function(event) {
      var currentListInner = this.parentElement.querySelector(".favorite-lists-item__inner");
      currentListInner.classList.toggle("favorite-lists-item__inner_collapsed");
      currentListInner.parentElement.classList.toggle("favorite-lists-item_is-open");
    });
  }

  var removeButtons = document.querySelectorAll(".favorite-lists-item__remove");
  for (var i = 0; i < removeButtons.length; i++) {
    var removeButton = removeButtons[i];
    removeButton.addEventListener("click", function(event) {
      event.stopPropagation();
      this.parentElement.parentElement.remove();
    });
  }
}

// FAVORITE CARD POPUP SELECT IERMS
if (favoriteList) {
  var currentListItems = document.querySelectorAll(".favorite-card__list");
  for (var i = 0; i < currentListItems.length; i++) {
    var currentListItem = currentListItems[i];
    currentListItem.addEventListener("click", function() {
      this.querySelector(".favorite-card-popup").classList.toggle("favorite-card-popup_active");
    });
  }

  var favoritePagePopupList = document.querySelectorAll(".favorite-card-popup");
  for (var i = 0; i < favoritePagePopupList.length; i++) {
    var favoritePagePopup = favoritePagePopupList[i];
    favoritePagePopup.addEventListener("click", function(event) {
      event.stopPropagation();
    });
  }

  var popupItems = document.querySelectorAll(".favorite-card-popup__item");
  for (var i = 0; i < popupItems.length; i++) {
    var popupItem = popupItems[i];
    popupItem.addEventListener("click", function() {
      this.classList.toggle("favorite-card-popup__item_checked");
    });
  }
}

// FAVORITE CARD SHOW ASIDE

(function() {
  var aside = document.querySelector(".favorite-lists");
  if (aside) {
    var asideBtn = document.querySelector(".filters-show-button");
    asideBtn.addEventListener("click", function() {
      var menuStatus = "hidden";
      this.classList.toggle("filters-show-button_opened");
      this.parentElement.classList.toggle("favorite-lists_is-show");
      document.querySelector(".main-block").classList.toggle("min_collapsed-menu");
    });
  }
})();

// My_ADV TOGGLER

(function() {
  var promotion = document.querySelector(".promotion");
  if (promotion) {
    var togglers = document.querySelectorAll(".promotion__toggler");
    for (var i = 0; i < togglers.length; i++) {
      var toggler = togglers[i];
      toggler.addEventListener("click", function() {
        this.classList.toggle("promotion__toggler_yes");
      });
    }
  }
})();

// My_ADV CONFIG

(function() {
  var promotion = document.querySelector(".promotion");
  if (promotion) {
    var changeEditorWidth = function() {
      var activePromotion = document.querySelector(".promotion_is-active");
      if (activePromotion) {
        var editor = activePromotion.querySelector(".editor");
        var body = document.querySelector("body");
        editor.style.width = body.offsetWidth + "px";
      }
    };

    var setPromotionMarginBottom = function() {
      var activePromotion = document.querySelector(".promotion_is-active");
      if (activePromotion) {
        var editor = activePromotion.querySelector(".editor");
        var editorHeight = editor.offsetHeight;
        activePromotion.style.marginBottom = editorHeight + 30 + "px";
      }
    };

    var openEditor = function(eventTarget, currentElement) {
      if (eventTarget.getAttribute("data-button") == "edit-button") {
        var allPromotions = currentElement.parentElement.querySelectorAll(".promotion");
        for (var i = 0; i < allPromotions.length; i++) {
          allPromotions[i].classList.remove("promotion_is-active");
          allPromotions[i].style.marginBottom = "15px";
        }
        currentElement.classList.toggle("promotion_is-active");
        currentElement.parentElement.querySelector(".promotion__editor").classList.add("promotion__editor_is-showed");
        setPromotionMarginBottom();
        changeEditorWidth();
        setEditorPosition();
      }
    };

    var setEditorPosition = function() {
      var activePromotion = document.querySelector(".promotion_is-active");
      if (activePromotion) {
        var editor = activePromotion.querySelector(".editor");
        editor.style.left = 0 + "px";
        var currentPosition = editor.getBoundingClientRect();
        if (!(currentPosition.left == 0)) {
          editor.style.left = -currentPosition.left + "px";
        }
      }
    };

    var closeEditor = function() {
      var allEditors = document.querySelectorAll(".editor");
      if (allEditors.length > 0) {
        for (var i = 0; i < allEditors.length; i++) {
          var editor = allEditors[i];
          editor.addEventListener("click", function(event) {
            if (
              event.target.getAttribute("data-button") == "editor-button" ||
              event.target.getAttribute("data-button") == "close-btn"
            ) {
              this.parentElement.classList.remove("promotion_is-active");
              this.parentElement.style.marginBottom = "15px";
            }
          });
        }
      }
    };

    closeEditor();

    var promotionsList = document.querySelectorAll(".promotion");
    for (var i = 0; i < promotionsList.length; i++) {
      var promotion = promotionsList[i];
      promotion.addEventListener("click", function(event) {
        var eventTarget = event.target;
        var currentElement = this;
        openEditor(eventTarget, currentElement);
      });
    }

    window.addEventListener("resize", function() {
      changeEditorWidth();
      setEditorPosition();
      setPromotionMarginBottom();
    });
  }
})();

// FIX CREATE BUTTON FAVORITE_CARDS PAGE

(function() {
  var favoriteList = document.querySelector(".favorite-lists__group");
  if (favoriteList) {
    var asidePosition = function() {
      var getWindowHeight = function() {
        return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
      };
      if (favoriteList && document.body.offsetWidth >= 993) {
        var asideDesktop = function() {
          var windowHeight = getWindowHeight();
          var aside = document.querySelector(".favorite-lists");
          var asidePositionBottom = aside.getBoundingClientRect().bottom;
          var addButton = document.querySelector(".favorite-lists__bottom");
          if (windowHeight - asidePositionBottom > 0) {
            addButton.style.bottom = windowHeight - asidePositionBottom + "px";
          } else {
            addButton.style.bottom = 0 + "px";
          }
          var mainBlock = document.querySelector(".main-block");
          aside.style.height = mainBlock.clientHeight + "px";
        };
        asideDesktop();
        window.addEventListener("scroll", function() {
          if (document.body.offsetWidth >= 993) {
            setTimeout(asideDesktop, 200);
          }
        });
      }

      if (favoriteList && (document.body.offsetWidth < 993 && document.body.offsetWidth >= 577)) {
        var tabletDesktop = function() {
          var pageContentPositionTop = document.querySelector(".page-content").getBoundingClientRect().top;
          var aside = document.querySelector(".favorite-lists");
          if (pageContentPositionTop > 0) {
            aside.style.top = pageContentPositionTop + "px";
            aside.style.height = "calc(100% - " + pageContentPositionTop + "px)";
          } else {
            aside.style.top = 0 + "px";
            aside.style.height = "100%";
          }
          var pageContentPositionBottom = document.querySelector(".page-content").getBoundingClientRect().bottom;
          var windowHeight = getWindowHeight();
          var footerHeight = pageContentPositionBottom - windowHeight;
          var aside = document.querySelector(".favorite-lists");
          if (footerHeight < 0) {
            aside.style.height = "calc(100% - " + -footerHeight + "px)";
          }
        };
        tabletDesktop();
        window.addEventListener("scroll", function() {
          if (document.body.offsetWidth < 993 && document.body.offsetWidth >= 577) {
            setTimeout(tabletDesktop, 200);
          }
        });
      }
    };
    asidePosition();
    window.addEventListener("resize", function() {
      setTimeout(asidePosition, 200);
      var aside = document.querySelector(".favorite-lists");
      aside.style.top = 0;
      aside.style.height = "auto";
      asidePosition();
    });
  }
})();

// my_stat filters
(function() {
  var sortFilterBlock = document.querySelector(".sort-filter__row");
  if (sortFilterBlock) {
    var sortFilterOptions = sortFilterBlock.querySelectorAll(".sort-filter__option");
    for (var i = 0; i < sortFilterOptions.length; i++) {
      var sortFilterOption = sortFilterOptions[i];
      sortFilterOption.addEventListener("click", function() {
        for (var i = 0; i < sortFilterOptions.length; i++) {
          sortFilterOptions[i].classList.remove("sort-filter__option_active");
        }
        this.classList.add("sort-filter__option_active");
      });
    }
  }
})();

// my_stat close popup

(function() {
  var statisticBlock = document.querySelector(".main-statistic");
  if (statisticBlock) {
    var popupList = document.querySelectorAll(".complex-popup");
    for (var i = 0; i < popupList.length; i++) {
      var popup = popupList[i];
      popup.addEventListener("click", function(event) {
        if (event.target.className == "complex-popup__close-btn") {
          this.classList.add("complex-popup_is-hidden");
        }
      });
    }
  }
})();
