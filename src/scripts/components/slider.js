var Slider = {
  init: function(){
    Slider.build();
  },
  build: function(){
    Slider.default();
    Slider.mobile();
  },
  default: function () {
    function getData($el, key, fallback) {
      return $el.data(key) !== undefined ? $el.data(key) : fallback;
    }

    $('.slider-default').each(function () {
      var $this = $(this);
      var $swiper = $this.find('.swiper');

      // Prevent re-initialization
      if ($swiper.hasClass('swiper-initialized')) return;

      var loop = getData($swiper, 'loop', false);
      var effect = $swiper.hasClass('fade') ? 'fade' : 'slide';
      var rate = getData($swiper, 'rate', 500);
      var center = getData($swiper, 'center', false);

      var slides_sm = getData($swiper, 'slides-sm', 1);
      var slides_md = getData($swiper, 'slides-md', slides_sm);
      var slides_lg = getData($swiper, 'slides-lg', slides_md);
      var slides_xl = getData($swiper, 'slides-xl', slides_lg);

      var group_sm = getData($swiper, 'group-sm', 1);
      var group_md = getData($swiper, 'group-md', group_sm);
      var group_lg = getData($swiper, 'group-lg', group_md);
      var group_xl = getData($swiper, 'group-xl', group_lg);

      var spacing_sm = getData($swiper, 'spacing-sm', 0);
      var spacing_md = getData($swiper, 'spacing-md', spacing_sm);
      var spacing_lg = getData($swiper, 'spacing-lg', spacing_md);
      var spacing_xl = getData($swiper, 'spacing-xl', spacing_lg);

      var $pagination = $this.find('.swiper-fraction, .swiper-pagination').first();
      var isFraction = $pagination.hasClass('swiper-fraction');

      var slider = new Swiper($swiper[0], {
        loop: loop,
        effect: effect,
        speed: rate,
        watchOverflow: true,
        grabCursor: true,
        centerInsufficientSlides: center,
        autoplay: $swiper.hasClass('autoplay') ? { delay: 8000 } : false,
        pagination: {
          el: $pagination[0],
          clickable: !isFraction,
          type: isFraction ? 'fraction' : 'bullets'
        },
        navigation: {
          nextEl: $this.find('.slider-btn-next')[0],
          prevEl: $this.find('.slider-btn-prev')[0],
        },
        breakpoints: {
          0: {
            slidesPerView: slides_sm,
            slidesPerGroup: group_sm,
            spaceBetween: spacing_sm,
          },
          768: {
            slidesPerView: slides_md,
            slidesPerGroup: group_md,
            spaceBetween: spacing_md,
          },
          992: {
            slidesPerView: slides_lg,
            slidesPerGroup: group_lg,
            spaceBetween: spacing_lg,
          },
          1800: {
            slidesPerView: slides_xl,
            slidesPerGroup: group_xl,
            spaceBetween: spacing_xl,
          },
        },
        on: {
          init: function () {
            var $thumbs = $this.find('.slider-thumbs .thumb');

            if ($thumbs.length) {
              $thumbs.removeClass('active');
              $thumbs.filter('[data-slide="' + this.activeIndex + '"]').addClass('active');

              $thumbs.on('click', function () {
                slider.slideTo($(this).data('slide'), rate);
              });
            }

            activeSlides(this);
          },
          slideChange: function () {
            if ($(this.el).find('img').length > 0 && typeof lazyload !== 'undefined') {
              lazyload.update();
            }

            this.el.classList.toggle('swiper--active', this.activeIndex > 0);

            var $thumbs = $this.find('.slider-thumbs .thumb');
            if ($thumbs.length) {
              $thumbs.removeClass('active');
              $thumbs.filter('[data-slide="' + this.activeIndex + '"]').addClass('active');
            }
          },
          update: function () {
            activeSlides(this);
          },
        }
      });

      function activeSlides(swiper) {
        var $swiperEl = $(swiper.el);
        var $wrapper = $(swiper.wrapperEl);

        var slidesWidth = $wrapper[0].scrollWidth;
        var swiperWidth = $swiperEl.outerWidth();
        var areActive = slidesWidth <= swiperWidth;

        $swiperEl.parent().toggleClass('slider--active', areActive);
      }
    });
  },
  mobile: function () {

    function getData($el, key, fallback) {
      return $el.data(key) !== undefined ? $el.data(key) : fallback;
    }

    $('.slider-mobile').each(function () {
      var isActive = false;
      var slider;
      var $this = $(this);
      var $swiper = $this.find('.swiper');
      var sliderEl = $swiper[0];

      var loop = getData($swiper, 'loop', false);
      var effect = $swiper.hasClass('fade') ? 'fade' : 'slide';
      var rate = getData($swiper, 'rate', 500);
      var center = getData($swiper, 'center', false);

      var slides = getData($swiper, 'slides', 1);
      var group = getData($swiper, 'group', 1);
      var spacing = getData($swiper, 'spacing', 0);

      var $pagination = $this.find('.swiper-pagination');
      var $nextBtn = $this.find('.slider-btn-next');
      var $prevBtn = $this.find('.slider-btn-prev');

      var sliderOptions = {
        init: false,
        loop: loop,
        effect: effect,
        speed: rate,
        watchOverflow: true,
        centerInsufficientSlides: center,
        slidesPerView: slides,
        slidesPerGroup: group,
        spaceBetween: spacing,
        pagination: {
          el: $pagination[0],
          clickable: true,
        },
        navigation: {
          nextEl: $nextBtn[0],
          prevEl: $prevBtn[0],
        },
        autoplay: $swiper.hasClass('autoplay') ? { delay: 8000 } : false,
        on: {
          init: function () {
            isActive = true;
            activeSlides(this);
          },
          slideChange: function () {
            if ($(this.el).find('img').length > 0 && typeof lazyload !== 'undefined') {
              lazyload.update();
            }
          },
          resize: function () {
            activeSlides(this);
          },
          update: function () {
            activeSlides(this);
          }
        }
      };

      function activeSlides(swiper) {
        var $swiperEl = $(swiper.el);
        var $wrapper = $(swiper.wrapperEl);
        var areActive = $wrapper[0].scrollWidth <= $swiperEl.outerWidth();
        $swiperEl.parent().toggleClass('slider--active', areActive);
      }

      function updateSlider() {
        var ww = window.innerWidth;
        if (ww < 768) {
          if (!isActive) {
            slider = new Swiper(sliderEl, sliderOptions);
            slider.init();
          }
        } else {
          if (isActive) {
            slider.destroy();
            isActive = false;
            $this.removeClass('slider--active');
          }
        }
      }

      updateSlider();
      $(window).on('resize', updateSlider);
    });
  }
}