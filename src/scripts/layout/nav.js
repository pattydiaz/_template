var nav = $('#nav');
var menuBtn = $('#hamburger');
var subMenuBtn = $('.has-sublist');

var Navigation = {
  init: function() {
    Navigation.build();
  },
  build: function() {
    if(menuBtn.is(':visible'))
      menuBtn.on('click',function() {
        $(this).toggleClass('active');
        ($(this).hasClass('active')) ? Navigation.open() : Navigation.close();
      });

    if(nav.is(':visible'))
      Navigation.items();
      Navigation.a11y();

      var nww = w.width();
      w.on('resize',function(){
        var cww = w.width();

        if(nww !== cww)
          Navigation.items();
          nww = cww;
      });
        
      w.on('keyup',function(e){
        if (e.key === 'Escape') Navigation.close();
      });
  },
  open: function() {
    Scrolling.lock();
    header.attr('style','');

    menuBtn.attr('aria-label','Close');
    menuBtn.find('span').text('Close');

    nav.addClass('nav--open');
    body.addClass('nav-active');
  },
  close: function() {
    Scrolling.unlock();

    menuBtn.attr('aria-label','Menu');
    menuBtn.find('span').text('Menu');

    nav.find('.nav--animate').removeClass('active');
    
    setTimeout(function() {
      nav.removeClass('nav--open');
      nav.one('transitionend webkitTransitionEnd oTransitionEnd', function(){
        body.removeClass('nav-active');
      });
    }, 350);
  },
  items: function() {
    subMenuBtn.each(function() {
      var $this = $(this);
      var $anchor = $this.find('.nav-list-anchor');
      var sublist = $this.find('.nav-sublist');
      var sh = sublist.get(0).scrollHeight;

      if(ww >= 992)subMenuBtn.removeClass('active');

      $anchor.on('click',function(e) {
        e.preventDefault();
        if(ww < 992)$this.toggleClass('active');
        ($this.hasClass("active")) ? sublist.addClass("active").css({ height: sh }) : sublist.removeClass("active").attr('style','');
      });

    });
  },
  a11y: function() {
    subMenuBtn.each(function() {
      var $this = $(this);

      $this.on('keyup', function(e) {
        if(e.key === 'Enter') {
          $this.toggleClass('opened');
          subMenuBtn.not($this).removeClass('opened');
        }
      });

    });
  }
}