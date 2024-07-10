var Background = {
  init: function () {
    Background.build();
  },
  build: function () {
    Background.animate();
  },
  animate: function() {
    var section = $("section[data-color]");

    section.each(function() {
      var $this = $(this);
      var color = $this.data('color');

      ScrollTrigger.create({
        // markers: true,
        trigger: $this,
        start:'0 '+wh/1.35,
        onEnter: () => {
          if(color != undefined) page.addClass('bg-'+color);
        },
        onLeaveBack: () => {
          if(color != undefined) {
            page.removeClass (function (index, className) {
              return (className.match (/(^|\s)bg-\S+/g) || []).join(' ');
            });
          }
        }
      });
    });
  }
};
