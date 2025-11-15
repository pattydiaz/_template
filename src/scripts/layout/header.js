var header = $("#header");
var header_anim;
var header_height;

var Header = {
  init: function () {
    Header.build();
  },
  build: function () {
    if (header.is(":visible")) {
      Header.height();
      Header.scroll();
    }
  },
  height: function () {
    header_height = header.outerHeight();
    body.get(0).style.setProperty("--hh", `${header_height}px`);

    w.on("resize", () => {
      header_height = header.outerHeight();
      body.get(0).style.setProperty("--hh", `${header_height}px`);
    });
  },
  scroll: function () {
    header_anim = gsap.timeline({
      paused: true,
      scrollTrigger: {
        trigger: body,
        start: '0 0',
        end: '100% 0',
        onUpdate: (self) => {
          const scroll_condition = self.scroll() > header_height && self.direction == 1;
          const reverse_condition = self.direction == -1 || body.hasClass('sidecart-active');

          header.toggleClass("header--scroll", self.progress > 0.001);

          if (scroll_condition && !body.hasClass("nav-active") && !body.hasClass('sidecart-active')) 
            header_anim.play();

          if (reverse_condition) header_anim.reverse();
        }
      },
    });

    header_anim.to(header, {
      y: '-200%',
      duration: 0.4,
      ease: 'power2.inOut'
    });
  }
};
