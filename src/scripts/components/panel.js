var Panel = {
  init: function () {
    Panel.build();
  },
  build: function () {
    Panel.animate();
  },
  animate: function () {
    var panel = $('.panel');

    panel.each(function(){
      var panel_wrapper = $(this).find('.panel-wrapper');

      gsap.to(panel_wrapper, {
        scrollTrigger: {
          // markers: true,
          trigger: panel_wrapper,
          start: '0 0',
          end: '100%% 0',
          scrub: true,
          pin: true,
        }
      });

    });
  },
}