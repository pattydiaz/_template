var hero = $('.hero-animate');
var hero_wrapper = hero.find('.hero-wrapper');

var Hero = {
  init: function() {
    Hero.build();
  },
  build: function() {
    Hero.animate();
  },
  animate: function() {

    if(hero.is(':visible')) {
      var hero_anim = gsap.timeline();
      
      Scrolling.lock();

    }
  }
}