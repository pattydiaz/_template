var Slider = {
  init: function() {
    Slider.build();
  },
  build: function() {
    Slider.default();
    // Slider.mobile();
  },
  default: function() {

    $('.slider-default').each(function() {
      var $this = $(this);
      var swiper = $this.find('.swiper');

      var loop = swiper.data('loop') != undefined ? swiper.data('loop') : true;
      var effect = swiper.hasClass('fade') ? 'fade' : 'slide';
      var speed = swiper.data('speed') != undefined ? swiper.data('speed') : 1000;

      var slides_mobile = swiper.data('slides-mobile') != undefined ? swiper.data('slides-mobile') : 1;
      var slides_tablet = swiper.data('slides-tablet') != undefined ? swiper.data('slides-tablet') : 1;
      var slides_desktop = swiper.data('slides-desktop') != undefined ? swiper.data('slides-desktop') : 1;

      var spacing_mobile = swiper.data('spacing-mobile') != undefined ? swiper.data('spacing-mobile') : 0;
      var spacing_tablet = swiper.data('spacing-tablet') != undefined ? swiper.data('spacing-tablet') : 0;
      var spacing_desktop = swiper.data('spacing-desktop') != undefined ? swiper.data('spacing-desktop') : 0;

      var slider = new Swiper(swiper[0],{
        loop: loop,
        effect: effect,
        speed: speed,
        pagination: {
          el: $this.find('.swiper-pagination')[0],
          clickable: true,
        },
        navigation: {
          nextEl: $this.find('.slider-next')[0],
          prevEl: $this.find('.slider-prev')[0],
        },
        breakpoints: {
          0: {
            slidesPerView: slides_mobile,
            slidesPerGroup: slides_mobile,
            spaceBetween: spacing_mobile,
          },
          768: {
            slidesPerView: slides_tablet,
            slidesPerGroup: slides_tablet,
            spaceBetween: spacing_tablet,
          },
          992: {
            slidesPerView: slides_desktop,
            slidesPerGroup: slides_desktop,
            spaceBetween: spacing_desktop,
          },
        }
      });

    });
    
  },
  // mobile: function () {
  //   $('.slider-mobile').each(function () {
  //     var $this = $(this);
  //     var spacing = $this.data('spacing');
  //     var effect = $this.data('effect');
  //     var foo;

  //     spacing == null ? spacing = 0 : spacing = $this.data('spacing');
  //     effect == null ? effect = 'slide' : effect = $this.data('effect');

  //     var mobile = $this[0], mobileOptions = {
  //       init: false,
  //       slidesPerView: 1,
  //       speed: 600,
  //       effect: effect,
  //       watchOverflow: true,
  //       spaceBetween: spacing,
  //       pagination: {
  //         el: $this.find('.swiper-pagination')[0],
  //         clickable: true,
  //       },
  //       navigation: {
  //         nextEl: $this.find('.swiper-next')[0],
  //         prevEl: $this.find('.swiper-prev')[0],
  //       },
  //       on: {
  //         init: function () {
  //           foo = true;
  //           Slider.lazyload(this, $this);
  //         },
  //         slideChange: function() {
  //           Slider.lazyload(this, $this);
  //         }
  //       },
  //     };

  //     function updateSlider() {
  //       if (ww < 768) {
  //         if (foo != true) {
  //           mobileSlider = new Swiper(mobile, mobileOptions);
  //           mobileSlider.init();
  //         }
  //       } else {
  //         if (foo == true) {
  //           mobileSlider.destroy();
  //           foo = false;
  //         }
  //       }
  //     }

  //     updateSlider();

  //     w.on('resize', function () {
  //       updateSlider();
  //     });
  //   });
  // },
}