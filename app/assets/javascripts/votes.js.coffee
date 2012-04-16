# Place all the behaviors and hooks related to the matching controller here.
# All this logic will automatically be available in application.js.
# You can use CoffeeScript in this file: http://jashkenas.github.com/coffee-script/

$('.vote').click ->
  $.ajax({
    type: 'POST',
    url: '/' + $(this).data('voteable') + '/' + $(this).data('voteable-id') + '/votes',
    data: 'mark=' + $(this).data('mark')
  })
    .done ->
      console.log "VOTE DONE!"
      false
    .fail ->
      console.log "VOTE FAILED!"
      false
  false
