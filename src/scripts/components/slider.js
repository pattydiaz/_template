var Slider = {
  init: function() {
    Slider.build();
  },
  build: function() {
    Slider.default();
    Slider.mobile();
  },
  default: function() {
    $('.slider').each(function() {
      var $this = $(this);
      var swiper = $this.find('.swiper');
      var speed = 800;

      var slider = new Swiper(swiper[0], {
        init: true,
        loop: false,
        speed: speed,
        longSwipes: true,
        longSwipesRatio: 0,
        autoplay: {
          delay: 8000
        },
        pagination: {
          el: $this.find('.swiper-pagination')[0],
          clickable: true,
        },
        navigation: {
          nextEl: $this.find('.swiper-next')[0],
          prevEl: $this.find('.swiper-prev')[0],
        }
      });

      $this.hasClass('autoplay') ? slider.autoplay.start() : slider.autoplay.stop();

      if(body.hasClass('mobile')) slider.params.noSwiping = false;

    });
  },
  mobile: function () {
    $('.slider-mobile').each(function () {
      var $this = $(this);
      var spacing = $this.data('spacing');
      var foo;

      spacing == null ? spacing = 10 : spacing = $this.data('spacing');

      var mobile = $this[0], mobileOptions = {
        init: false,
        slidesPerView: 1,
        speed: 800,
        watchOverflow: true,
        spaceBetween: spacing,
        pagination: {
          el: $this.find('.swiper-pagination')[0],
          clickable: true,
        },
        navigation: {
          nextEl: $this.find('.swiper-next')[0],
          prevEl: $this.find('.swiper-prev')[0],
        },
        on: {
          init: function () {
            foo = true;
          },
        },
      };

      function updateSlider() {
        if (ww < 768) {
          if (foo != true) {
            mobileSlider = new Swiper(mobile, mobileOptions);
            mobileSlider.init();
          }
        } else {
          if (foo == true) {
            mobileSlider.destroy();
            foo = false;
          }
        }
      }

      updateSlider();

      w.on('resize', function () {
        updateSlider();
      });
    });
  }
}