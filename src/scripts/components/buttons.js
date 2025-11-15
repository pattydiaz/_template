var Buttons = {
  init: function () {
    Buttons.build();
  },
  build: function () {
    Buttons.anchor();
  },
  anchor: function () {
    const scrollToTarget = (target) => {
      gsap.to(window, {
        scrollTo: { y: target },
        duration: 1,
        ease: 'power1.inOut',
      });
    };

    // Handle links with href="#" or .anchor
    const handleAnchorClick = function (e) {
      const $this = $(this);
      const id = $this.attr('href');

      // Skip certain links
      if ($this.hasClass('skip-to-content') || !id || id === '#') return;

      e.preventDefault();
      const $target = $(id);
      if ($target.length) scrollToTarget($target[0]);
    };

    // Handle .anchor-next buttons
    const handleNextClick = function (e) {
      e.preventDefault();
      const nextSection = $(this).closest('section').next()[0];
      if (nextSection) scrollToTarget(nextSection);
    };

    doc.on('click', 'a[href^="#"]:not(.skip-to-content), .anchor', handleAnchorClick);
    doc.on('click', '.anchor-next', handleNextClick);
  },
  doubleclick: function (el) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (el.data("isclicked")) return true;

    //mark as clicked for 1 second
    el.data("isclicked", true);
    setTimeout(function () {
      el.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
  },
  trigger: function(el) {
    setTimeout(function(){ el.trigger('click'); }, 0);
  }
};
