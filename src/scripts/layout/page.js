var Page = {
  init: function() {
    Page.build();
  },
  build: function() {
    Page.setup();
    Page.height();

    w.on('resize',function() {
      Page.height();
    });
  },
  setup: function() {
    if (wrapper.is(":visible")) 
      var className = wrapper.attr("class");
      var classList = wrapper.attr("class").split(/\s+/);

      $.each(classList, function (index, item) {
        if (className) {
          item = item.replace("-page", "");
          body.addClass(item);
        }
      });
  },
  height: function() {
    if(wrapper.is(':visible')) {
      wrapper.css('min-height','')
      wrapper.attr("data-height", wrapper.innerHeight());
  
      var nh = (wh - $('footer').innerHeight());
      if (wh > wrapper.data('height')) wrapper.css('min-height', nh);
    }
  }
}