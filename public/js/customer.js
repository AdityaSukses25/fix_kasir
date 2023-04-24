// $('.editCustomer').on('click', function () {
//   $('#editCustomer').modal()
//   var id = $(this).attr('data-bs-id')
//   var name = $(this).attr('data-bs-name')
//   var phone = $(this).attr('data-bs-phone')
//   var service = $(this).attr('data-bs-service')
//   var therapist = $(this).attr('data-bs-therapist')
//   var place = $(this).attr('data-bs-place')
//   var time = $(this).attr('data-bs-time')
//   var price = $(this).attr('data-bs-price')
//   var discount = $(this).attr('data-bs-discount')
//   var payment = $(this).attr('data-bs-payment')
//   var desc = $(this).attr('data-bs-description')
//   var summary = $(this).attr('data-bs-summary')
//   var reception = $(this).attr('data-bs-reception')
//   var created_at = $(this).attr('data-bs-create_at')
//   var start = $(this).attr('data-bs-start')
//   var end = $(this).attr('data-bs-end')
//   var status = $(this).attr('data-bs-status')
//   $('#editName').val(name)
//   $('#therapist_id').val(id)
//   $('#editphone').val(phone)
//   $('#editservice').val(service)
//   $('#edittherapist').val(therapist)
//   $('#editplace').val(place)
//   $('#edittime').val(time)
//   $('#editprice').val(price)
//   $('#editdiscount').val(discount)
//   $('#editpayment').val(payment)
//   $('#editdescription').val(desc)
//   $('#editsummary').val(summary)
//   $('#editreceptionist').val(reception)
//   $('#editcreate').val(created_at)
//   $('#editstart').val(start)
//   $('#editend').val(end)
//   $('#editstatus').val(status)
// })

// var customer = $('#customer-table').height()
// if (customer > 580) {
//   $('#customer-table').css('height', '74vh')
// } else {
// }

var report = $('#report-table').height()
if (report > 535) {
  $('#report-table').css('height', '68vh')
} else {
}

$(document).ready(function () {
  $('#all').click(function () {
    var start = $('#sort_id').attr('data-start')
    var end = $('#sort_id').attr('data-end')
    var name = $('#sort_id').attr('data-name')
    if (start === '') {
      window.location.href = 'http://127.0.0.1:8000/transaction-record?sort=asc'
    } else {
      window.location.href =
        'http://127.0.0.1:8000/transaction-record?start_date=' +
        start +
        '&end_date=' +
        end +
        '&search=&sort=asc'
    }
  })
})

$(document).ready(function () {
  $('#asc').click(function () {
    var start = $('#sort_id').attr('data-start')
    var end = $('#sort_id').attr('data-end')
    var name = $('#sort_id').attr('data-name')
    if (start === '') {
      window.location.href = 'http://127.0.0.1:8000/transaction-record?sort=asc'
    } else {
      window.location.href =
        'http://127.0.0.1:8000/transaction-record?start_date=' +
        start +
        '&end_date=' +
        end +
        '&search=' +
        name +
        '&sort=asc'
    }
  })
})

$(document).ready(function () {
  $('#desc').click(function () {
    var start = $('#sort_id').attr('data-start')
    var end = $('#sort_id').attr('data-end')
    var name = $('#sort_id').attr('data-name')
    if (start === '') {
      window.location.href =
        'http://127.0.0.1:8000/transaction-record?sort=desc'
    } else {
      window.location.href =
        'http://127.0.0.1:8000/transaction-record?start_date=' +
        start +
        '&end_date=' +
        end +
        '&search=' +
        name +
        '&sort=desc'
    }
  })
})

$('.detail-btn').click(function () {
  $('#detail').modal()
  var id = $(this).attr('data-id')
  var customer = $(this).attr('data-customer')
  var time = $(this).attr('data-time')
  var price = $(this).attr('data-price')
  var date = $(this).attr('data-date')
  var massage = $(this).attr('data-massage')
  var description = $(this).attr('data-description')
  var summary = $(this).attr('data-summary')
  var discount = $(this).attr('data-discount')
  var start = $(this).attr('data-start')
  var end = $(this).attr('data-end')
  var status = $(this).attr('data-status')
  var reception = $(this).attr('data-reception')
  var therapist = $(this).attr('data-therapist')
  $('.modal-title').text('Transaction Detail #' + id)
  $('#transaction_date').val(date)
  $('#customer').val(customer)
  $('#massage').val(massage)
  $('#time_duration').val(time)
  $('#price').val(price)
  $('#discount').val(discount)
  $('#Description').val(description)
  $('#summary').val(summary)
  $('#start').val(start)
  $('#end').val(end)
  $('#reception').val(reception)
  $('#therapist').val(therapist)
  if (status === 'finish') {
    status = 'completed'
  }
  $('#status').val(status)
})

$('.detail-extra').click(function () {
  $('#detail_extra').modal()
  var id = $(this).attr('data-id')
  var customer = $(this).attr('data-customer')
  var time = $(this).attr('data-time')
  var price = $(this).attr('data-price')
  var date = $(this).attr('data-date')
  var massage = $(this).attr('data-massage')
  var description = $(this).attr('data-description')
  var summary = $(this).attr('data-summary')
  var discount = $(this).attr('data-discount')
  var start = $(this).attr('data-start')
  var end = $(this).attr('data-end')
  var extra = $(this).attr('data-extra')
  var start_extra = $(this).attr('data-start-extra')
  var end_extra = $(this).attr('data-end-extra')
  var price_extra = $(this).attr('data-price-extra')
  var massage_extra = $(this).attr('data-massage-extra')
  var summary_extra = $(this).attr('data-summary-extra')
  var status = $(this).attr('data-status')
  var reception = $(this).attr('data-reception')
  var therapist = $(this).attr('data-therapist')
  $('.modal-title').text('Transaction Detail #' + id + '*')
  $('#transaction_date1').val(date)
  $('#customer1').val(customer)
  $('#massage1').val(massage)
  $('#time_duration1').val(time)
  $('#price1').val(price)
  $('#discount1').val(discount)
  $('#Description1').val(description)
  $('#summary1').val(summary)
  $('#start1').val(start)
  $('#end1').val(end)
  $('#massage_et1').val(massage_extra)
  $('#extra_time1').val(extra)
  $('#price_et1').val(price_extra)
  $('#price_et1').val(price_extra)
  $('#total1').val(summary_extra)
  $('#start_et1').val(start_extra)
  $('#end_et1').val(end_extra)
  $('#reception1').val(reception)
  $('#therapist1').val(therapist)
  if (status === 'finish') {
    status = 'completed'
  }
  $('#status1').val(status)
})
