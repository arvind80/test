# Place all the behaviors and hooks related to the matching controller here.
# All this logic will automatically be available in application.js.
# You can use CoffeeScript in this file: http://jashkenas.github.com/coffee-script/

jQuery ->
  $(".remove_field").click ->
    $(this).prev('input[type="hidden"]').val 1
    $(this).closest('.dynamic_field').hide()
    false


jQuery ->
  $(".add_field").click ->
    new_id = new Date().getTime()
    regexp = new RegExp("new_" + $(this).data("association"), "g")
    $(this).before($(this).data("field").replace(regexp, new_id))
    false
