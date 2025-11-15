function cl(e) {
  console.log(e);
}

function rtn(e) {
  return e;
}

var w = $(window)
var ww = w.width();
var wh = w.height();
var doc = $(document);
var html = $('html');
var body = $('body');
var page = $('#page');
var main = $('#main');
var wrapper = $('#wrapper');
var footer = $('footer');
var loaded = false;

gsap.registerPlugin(ScrollTrigger);

var lazyload;
var lazyloadSettings = {
  thresholds: '0px 100px',
  threshold: 0.1,
  rootMargin: '50px 0px',
  elements_selector: '.lazy',
  load_delay: 0,
  callback_loaded: function(el) {
    el.classList.add('loaded');
  },
  callback_error: function(el) {
    el.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMSIgaGVpZ2h0PSIxIiB2aWV3Qm94PSIwIDAgMSAxIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9IiNmNWY1ZjUiLz48L3N2Zz4=';
  }
}

$('.buddy').buddySystem();

$("a, button").on("mouseup", function () {
  $(this).trigger('blur');
});

w.on('resize',function(){
  ww = w.width();
  wh = w.height();
});