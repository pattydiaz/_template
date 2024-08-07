/**
 * 
 * BuddySystem.jquery.js
 * https://github.com/adamjgrant/Buddy-System
 * 
 */

(function() {
  (function($) {
    return $.fn.buddySystem = function() {
      return this.each(function() {
        var $clean;
        $clean = $(this).html().replace(/\s+/g, " ").replace(/^\s|\s$/g, "");
        return $(this).html($clean.replace(new RegExp('((?:[^ ]* ){' + (($clean.match(/\s/g) || []).length - 1) + '}[^ ]*) '), "$1&nbsp;"));
      });
    };
  })(jQuery);

}).call(this);