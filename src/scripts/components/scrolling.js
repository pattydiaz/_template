var Scrolling = {
  init: function() {
    Scrolling.build();
  },
  build: function() {
    Scrolling.animate();
    Scrolling.hash();
    Scrolling.fix();
  },
  animate: function() {
    var $animated = $('.animated');

    $animated.each(function() {
      var $this = $(this);
      var delay = parseInt($this.data('delay')) || 0;
      var offset = $this.data('offset') || 0;
      var isReverse = $this.hasClass('animated-reverse');

      var enterTimeout, leaveTimeout;

      ScrollTrigger.create({
        trigger: $this[0],
        start: `${offset} 60%`,
        end: `+=${$this.outerHeight()}`,
        onEnter: () => {
          enterTimeout = setTimeout(() => {
            $this.addClass(isReverse ? 'active-reverse' : 'active');
          }, delay);
        },
        onLeaveBack: () => {
          if (isReverse) {
            if (enterTimeout) clearTimeout(enterTimeout);
            leaveTimeout = setTimeout(() => {
              $this.removeClass('active-reverse');
            }, delay);
          }
        }
      });
    });
  },
  hash: function () {
    const anchor = window.location.hash;
    if (!anchor) return;

    const target = document.querySelector(anchor);
    if (!target) return;

    const yPosition = target.offsetTop;

    gsap.to(window, {
      scrollTo: { y: yPosition },
      duration: 1,
      ease: 'power1.inOut'
    });
  },
  lock: function(delay) {
    $('html, body').css('overflow', 'hidden');
  },
  unlock: function() {
    $('html, body').css('overflow', '');
  },
  top: function() {
    if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
    
    $(window).on('load', function () {
      window.scrollTo(0, 0);
    });
  },
  fix: function() {
    if (!navigator.userAgent.match(/(Android)/)) {
      $('body *').each(function() {
        const $el = $(this);
        const overflow = $el.css('overflow');
        const overflowX = $el.css('overflow-x');
        const overflowY = $el.css('overflow-y');

        if (/(scroll|overlay)/.test(overflow + overflowX + overflowY)) {
          $el.css("-webkit-overflow-scrolling", "touch !important");
        }
      });

    }
  }
};