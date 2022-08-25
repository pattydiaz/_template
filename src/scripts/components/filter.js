var filter_nav = $('.filter-nav');
var filter_nav_btn = filter_nav.find('button');
var filter_results = $('.filter-results');

var Filter = {
  init: function() {
    Filter.build();
  },
  build: function() {
    if(filter_nav.is(':visible'))
      Filter.validate();

      filter_nav_btn.on('click',function(){
        Filter.nav($(this));
      });
  },
  trigger: function(el) {
    setTimeout(function(){
      el.trigger('click');
    }, 0);
  },
  nav: function(el) {
    var data = el.data('filter');

    filter_nav_btn.removeClass('active');
    el.addClass('active');

    Filter.results(data);
    history.replaceState( "", document.title, window.location.pathname + "?filter=" + data);
  },
  results: function(el) {
    filter_results.find('*[data-filters]').removeClass('active');

    setTimeout(function(){
      filter_results.find('*[data-filters]').addClass('hidden');
      
      setTimeout(function() {
        filter_results.find('*[data-filters*="'+el+'"]').removeClass('hidden');
      }, 50);
      
      setTimeout(function() {
        filter_results.find('*[data-filters*="'+el+'"]').addClass('active');
        filter_results.find('*[data-filters*="'+el+'"]').each(function(index){
          var delay = index * 0.06;
          $(this).css('transition-delay', delay+'s');
        });
      }, 100);

    }, 400);
  },
  validate: function() {
    var filter_nav_active = filter_nav.find('.active');
    var filter_nav_first = filter_nav_btn.first();
    var filter_query = location.search.replace("?filter=", "");
    var valid_query = filter_nav.find('button[data-filter="'+filter_query+'"]');

    if(valid_query.length > 0 && filter_query != '') {
      Filter.trigger(valid_query);
      valid_query.addClass('active');
    } else {
      (filter_nav_active.length > 0) ? Filter.trigger(filter_nav_active) : Filter.trigger(filter_nav_first);
    }

  }
}