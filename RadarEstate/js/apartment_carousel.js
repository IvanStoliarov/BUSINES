var elem = document.querySelector(".apartment-carousel");
var flkty = new Flickity(elem, {
  // options
  cellAlign: "left",
  contain: true
});

// element argument can be a selector string
//   for an individual element
var flkty = new Flickity(".apartment-carousel", {
  // options
});
