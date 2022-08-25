var Scrolling = {
  init: function() {
    Scrolling.build();
  },
  build: function() {
    Scrolling.animate();
    Scrolling.anchor();
    Scrolling.fix();
  },
  animate: function() {
    $('.animated, .animated-reverse').each(function() {
      var $this = $(this);
      var $height = $this.outerHeight();

      var scrollingScene = new ScrollMagic.Scene({
        triggerElement: $this[0],
        duration: $height,
      });

      // scrollingScene.addIndicators();
      scrollingScene.triggerHook(0.6);
      scrollingScene.addTo(controller);

      if($this.data('offset'))
        scrollingScene.offset($this.data('offset'));

      scrollingScene.on('enter', function(e) {
        if($this.hasClass('animated-reverse') && e.scrollDirection == "FORWARD") {
          $this.addClass('active-reverse');
        } else {

          if($this.data('delay')) {
            setTimeout(function(){
              $this.addClass('active');
            }, $this.data('delay'));
          } else {
            $this.addClass('active');
          }
          
        }
      });

      scrollingScene.on('leave',function(e){
        if($this.hasClass('animated-reverse') && e.scrollDirection == "REVERSE")
          $this.removeClass('active-reverse');
      });

    });
  },
  anchor: function() {
    $(".btn-anchor").each(function () {
      $(this).on("click", function (e) {
        e.preventDefault();
        var id = $(this).attr("href");
        $("html, body").animate({ 
          scrollTop: $(id).parents('section').offset().top - header.outerHeight() 
        }, 500);
      });
    });
  },
  lock: function() {
    $('html, body').css('overflow','hidden');
  },
  unlock: function() {
    $('html, body').css('overflow','');
  },
  fix: function() {
    if (!navigator.userAgent.match(/(Android)/)) {
      $("body *").filter(function () {
        if ($(this).css("overflow") == "scroll" || $(this).css("overflow-x") == "scroll" || $(this).css("overflow-y") == "scroll" || $(this).css("overflow") == "overlay" || $(this).css("overflow-x") == "overlay" || $(this).css("overflow-y") == "overlay") {
          $(this).attr("style", "-webkit-overflow-scrolling: touch !important;");
        }
      });
    }
  }
}