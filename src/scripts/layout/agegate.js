var agegate = $("#agegate");

var Agegate = {
  init: function () {
    Agegate.build();
  },
  build: function () {
    if (agegate.is(":visible"))
      Cookies.get("AGEGATE") == undefined ? Agegate.animate() : Agegate.remove();
    else
      Agegate.default();
  },
  default: function () {
    body.addClass("loaded");
    Scrolling.init();
    Scrolling.unlock();
  },
  animate: function () {
    setTimeout(function(){
      Agegate.overflow()
    }, 0);

    Scrolling.lock();
    
    agegate.removeClass("agegate--hidden");
    Agegate.focus();

    agegate.find("button").on("click", function () {
      Cookies.set("AGEGATE", "TRUE", { expires: 1 });

      agegate.addClass("agegate--hidden");
      agegate.one( "transitionend webkitTransitionEnd oTransitionEnd", function () {
          Agegate.remove();
        }
      );
    });

    w.on('resize',function(){
      Agegate.overflow();
    });
  },
  remove: function () {
    agegate.remove();
    Agegate.default();
  },
  focus: function () {
    var focusEl = 'button, [tabindex]:not([tabindex="-1"])';

    var firstFocusEl = agegate.find(focusEl)[0];
    var focusContent = agegate.find(focusEl);
    var lastFocusEl = focusContent[focusContent.length - 1];

    document.addEventListener("keydown", function (e) {
      var isTabPressed = e.key === "Tab";

      if (!isTabPressed) {return};

      if (e.shiftKey) {
        if (document.activeElement === firstFocusEl) {
          e.preventDefault();
          lastFocusEl.focus();
        }
      } else {
        if (document.activeElement === lastFocusEl) {
          e.preventDefault();
          firstFocusEl.focus();
        }
      }
    });
  },
  overflow: function () {
    var ah;
    agegate.is(":visible") ? ah = $(".agegate-container")[0].scrollHeight : ah = ah;

    ah > wh ? agegate.addClass("agegate--scroll") : agegate.removeClass("agegate--scroll");
  },
};
