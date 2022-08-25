var header = $("#header");

var Header = {
  init: function () {
    Header.build();
  },
  build: function () {
    if (header.is(":visible")) Header.height();
    Header.scroll();
  },
  height: function () {
    var hh = header.outerHeight();
    wrapper.css("padding-top", hh);
    body.get(0).style.setProperty("--hh", hh + "px");

    w.on("resize", function () {
      hh = header.outerHeight();
      wrapper.css("padding-top", hh);
      body.get(0).style.setProperty("--hh", hh + "px");
    });
  },
  scroll: function () {
    var ph = page.outerHeight();

    var headerAnim = gsap
      .to(header, { duration: 0.4, y: "-100%", ease: "circ.inOut" })
      .reverse();

    var headerScene = new ScrollMagic.Scene({
      triggerElement: $("section").first(),
      duration: ph,
      offset: 0,
    });

    // headerScene.addIndicators();
    headerScene.triggerHook(0);
    headerScene.addTo(controller);

    headerScene.on("progress", function (e) {
      e.progress > 0.01 ? header.addClass("header--scroll") : header.removeClass("header--scroll");
      
      if (e.progress > 0.01 && e.scrollDirection == "FORWARD" && !body.hasClass("nav-active"))
        if(header.find('.has-sublist:hover').length == 0)
          headerAnim.play();

      if (e.scrollDirection == "REVERSE" && !body.hasClass("nav-active"))
        headerAnim.reverse();
    });
  },
};
