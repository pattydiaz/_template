var Tabs = {
  init: function() {
    Tabs.build();
  },
  build: function() {
    Tabs.animate();
  },
  animate: function() {
    var tabs = $('.tabs');
    
    tabs.each(function() {
      Tabs.height($(this));

      var tabs_btn = $(this).find('[data-tab]');
      var tabs_panel = $(this).find('[data-tab-panel]');

      tabs_btn.each(function(){
        var $this = $(this);
        var data = $this.data('tab');

        $this.on('click',function(){
          tabs_btn.removeClass('active');
          tabs_panel.removeClass('active');

          $this.addClass('active');
          $('[data-tab-panel="'+data+'"]').addClass('active');
        });

      });
    });
  },
  height: function(el) {
    var th = el.find('[data-tab-panel]').map(function(){ 
      return $(this).outerHeight() == 0 ? $(this)[0].scrollHeight : $(this).outerHeight();
    }).get();

    var thmax = Math.max.apply(null, th);

    el.find('[class*="-content-wrap"]').height(thmax);
  }
}