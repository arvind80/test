// This is a manifest file that'll be compiled into including all the files listed below.
// Add new JavaScript/Coffee code in separate files in this directory and they'll automatically
// be included in the compiled file accessible from http://example.com/assets/application.js
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// the compiled file.
//
//= require jquery
//= require jquery_ujs
//= require bootstrap

//= require jquery.timeago
//= require adjust_menu_items

//= require users
//= require recipes
//= require votes


$(document).ready(function(){

  // timeago
  $("abbr.timeago").timeago();

  // adjust menu items position in header
  $(".dropdown.main_actions").adjustMenuItems();

  // adjust menu items position in header
  $("a[data-last-points-awarded-at]").glowPoints();

  // loading states for buttons
  $('.btn.follow-link, #pagination').click(function() {
    $(this).button('loading');
  });

});
