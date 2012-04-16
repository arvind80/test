(function($) {
  $.fn.adjustMenuItems = function(options) {
    return this.each(function() {
      var moveto = $(this).parent().offset().left - 19
      $(this).css({left: -moveto})
    });
  }

  $.fn.glowPoints = function(options) {
    return this.each(function() {
      // console.log();
      last_points_awarded_at = $(this).data('last-points-awarded-at')

      current_time = new Date()
      current_time = parseInt(current_time.getTime()/1000);

      seconds_old = current_time - last_points_awarded_at

      glow_value = Math.exp(-(5*seconds_old/(24*60*60)));

      $(this).parent().css('boxShadow','0 0 ' + Math.floor(glow_value * 10 + 7.5) + 'px rgba(253,206,0,' + glow_value + ')');
      $(this).css('backgroundColor', '#FDCE00');
    });
  }
})(jQuery);
