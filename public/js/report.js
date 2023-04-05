var report = $('#report-table').height()
var salary_report = $('#custom-tabs-two-profile').height()
if (report > 535) {
  $('#report-table').css('height', '67vh')
} else if (salary_report > 535) {
  $('#custom-tabs-two-profile').css('height', '67vh')
} else {
}

// sales
$('#custom-tabs-two-home-tab').click(function () {
  $('.print-sale').removeClass('d-none')
  $('.print-salary').addClass('d-none')
  $('#card-sales').removeClass('card-success')
  $('#card-sales').addClass('card-primary')
  $('.date-sales').removeClass('d-none')
  $('.date-salary').addClass('d-none')
})
// salary
$('#custom-tabs-two-profile-tab').click(function () {
  $('.print-sale').addClass('d-none')
  $('.print-salary').removeClass('d-none')
  $('#card-sales').removeClass('card-primary')
  $('#card-sales').addClass('card-success')
  $('.date-sales').addClass('d-none')
  $('.date-salary').removeClass('d-none')
})

$(document).ready(function () {
  $('#start_date').change(function () {
    var inputDate = $(this).val()
    $('#start_sales').val(inputDate)
  })
})

$(document).ready(function () {
  $('#end_date').change(function () {
    var inputDate = $(this).val()
    $('#end_sales').val(inputDate)
  })
})

$(document).ready(function () {
  $('#start_month').change(function () {
    var inputMonth = $(this).val()
    $('.start_month').val(inputMonth)
  })
})
