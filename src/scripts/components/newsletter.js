var form_footer = $('#mc-form-footer');

var Newsletter = {
  init: function () {
    Newsletter.build();
  },
  build: function() {
    Newsletter.form(form_footer);
  },
  form: function (el) {
    if (el.is(":visible")) {

      el.ajaxChimp({
        callback: callbackFunction,
      });

      function callbackFunction(resp) {
        if (resp.result === "success") {
          var parent = el.parents('.form-wrap');
          el.remove();
          parent.append(
            "<div class='valid my-1 text-center'>Thank you for subscribing!</div>"
          );
        }
      }

    }
  }
};
