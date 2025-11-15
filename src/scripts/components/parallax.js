var Parallax = {
  init: function() {
    Parallax.build();
  },
  build: function() {
    Parallax.animate();
  },
  animate: function() {
    var parallax = $('.parallax');

    parallax.each(function(){
      var $this = $(this);
      var item = $this.hasClass('parallax-item') ? $this : $this.find('.parallax-item');

      var {
        percent = 20, 
        scrub = true, 
        offset = 0 
      } = $this.data();

      gsap.set(item, {
        yPercent: $this.hasClass('no-offset') ? offset : percent
      });

      // Create animation
      gsap.to(item, {
        yPercent: percent * -1,
        ease: 'none',
        scrollTrigger: {
          trigger: item,
          start: '-50% 100%',
          end: '100% 0',
          scrub: scrub
        }
      });
    });
  }
};
