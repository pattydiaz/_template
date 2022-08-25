function cl(e) {
  console.log(e);
}

function rtn(e) {
  return e;
}

var w = $(window)
var ww = w.width();
var wh = w.height();
var html = $('html');
var body = $('body');
var page = $('#page');
var main = $('#main');
var wrapper = $('#wrapper');

var controller = new ScrollMagic.Controller();

$("a, button").on("mouseup", function () {
  $(this).trigger('blur');
});

w.on('resize',function(){
  ww = w.width();
  wh = w.height();
});