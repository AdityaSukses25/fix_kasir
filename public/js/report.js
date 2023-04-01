var report = $('#report-table').height()
if (report > 535) {
  $('#report-table').css('height', '67vh')
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

// $('.serviceDetail').click(function () {
//   $('#salaryReport').modal()
//   var id = $(this).attr('data-bs-id')
//   var name = $(this).attr('data-bs-name')
//   var order = $(this).attr('data-bs-order')
//   var reception = $(this).attr('data-bs-reception')
//   var customer = $(this).attr('data-bs-customer')
//   var time = $(this).attr('data-bs-time')
//   var service = $(this).attr('data-bs-service')
//   $('.modal-title-name').text(name)
//   $('#cust-name').text(customer)
//   $('#reception').text(reception)
//   $('#service').text(service)
//   $('#time').text(time)
//   $('#order-amount').text(order)
// })
