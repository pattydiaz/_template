var anchorBtn = $(".anchor");

var Buttons = {
  init: function () {
    Buttons.build();
  },
  build: function () {
    Buttons.anchor();
  },
  anchor: function() {
    anchorBtn.each(function () {
      $(this).on("click", function (e) {
        e.preventDefault();
        var id = $(this).attr("href");
        // $("html, body").animate({ scrollTop: $(id).offset().top - header.outerHeight() }, 500);
        $("html, body").animate({ scrollTop: $(id).offset().top }, 500);
      });
    });
  },
  doubleclick: function (element) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (element.data("isclicked")) return true;

    //mark as clicked for 1 second
    element.data("isclicked", true);
    setTimeout(function () {
      element.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
  }
};
