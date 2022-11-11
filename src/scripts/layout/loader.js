var loader = $('#loader');

var Loader = {
  init: function() {
    Loader.build();
  },
  build: function() {
    loader.is(':visible') ? Loader.animate() : Loader.default();
  },
  default: function() {
    body.addClass('loaded');
    Scrolling.init();
    Scrolling.unlock();
  },
  animate: function() {
    // Scrolling.lock();
    // var loaderAnimation = gsap.timeline();
  }
}