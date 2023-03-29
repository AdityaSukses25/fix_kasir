$(document).ready(function () {
  var start = $('#start_Sales').val()
  var end = $('#end_Sales').val()
  $('#start').text(start)
  $('#end').text('- ' + end)
  setTimeout(function () {
    window.print()
  }, 1000)
})
