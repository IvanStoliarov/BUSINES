(function() {
  var collapsedLinkList = document.querySelectorAll(".menu__item_is-collapsed");
  for (var i = 0; i < collapsedLinkList.length; i++) {
    var collapsedLink = collapsedLinkList[i];
    collapsedLink.addEventListener("click", function() {
      this.classList.toggle("menu__item_is-collapsed");
    });
  }
})();
