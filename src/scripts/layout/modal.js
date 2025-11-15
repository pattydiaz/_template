var modal = $('#modal');
var modal_wrapper = modal.find('.modal-wrapper');
var modal_container = modal.find('.modal-container');
var modal_content = $('#modal-content');
var modal_close = $('#modal-close');
var modal_btn = $('.modal-btn');

var Modal = {
  init: function() {
    Modal.build();
  },
  build: function() {
    if (!modal.is(':visible')) return;
    Modal.bindEvents();
  },
  bindEvents: function() {
    modal_btn.on('click', function(e) {
      e.preventDefault();
      const $btn = $(this);
      const $content = $btn.next('.modal-content');
      Modal.open($btn, $content);
    });

    modal_btn.on('keyup', function(e) {
      if (e.key === 'Enter') modal.trigger('focus');
    });

    modal_close.on('click', Modal.close);

    w.on('keyup', function(e) {
      if (e.key === 'Escape') Modal.close();
    }).on('resize', Modal.overflow);
  },
  open: function(el, content) {
    Scrolling.lock();
    Modal.overflow();

    modal.addClass('modal--open');
    body.addClass('modal-active');

    if (content && content.length) {

      // Apply all classes except the first (base) one
      const class_list = content.attr('class').split(/\s+/).slice(1);
      modal.addClass(class_list.join(' '));

      // Copy data attributes
      $.each(content.data(), function(key, value) {
        modal_layout.attr('data-' + key, value);
      });

      content.addClass('modal-content--empty').children('div').appendTo(modal_content);
    }

    setTimeout(() => modal.trigger('focus'), 100);
    
  },
  close: function() {
    Scrolling.unlock();

    setTimeout(() => {
      modal.removeClass('modal--open');

      setTimeout(() => {
        body.removeClass('modal-active');

        const empty_content = $('.modal-content--empty');
        modal_content.children('div').appendTo(empty_content);
        empty_content.removeClass('modal-content--empty');
        modal_content.empty();

        // Reset modal class and data
        modal.attr('class', 'modal');
        $.each(modal_layout.data(), function(key) {
          modal_layout.removeAttr('data-' + key);
        });

      }, 600);

    }, 300);
  },
  overflow: function () {
    const mh = modal_container[0].scrollHeight;
    modal.toggleClass('modal--scroll', mh > wh);
  },
}