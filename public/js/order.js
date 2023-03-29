$(document).ready(function () {
  $('#inputGender').change(function () {
    var genderId = $(this).val()

    $.ajax({
      url: '/getTherapist/' + genderId,
      type: 'GET',
      dataType: 'JSON',
      success: function (data) {
        $('#inputTherapist').empty()
        $('#inputTherapist').append(
          '<option hidden>-- Choosen Therapist --</option>',
        )
        $.each(data, function (key, value) {
          if (value.status == 3) {
            $('#inputTherapist').append(
              '<option value="' +
                value.id +
                '">' +
                value.nickname +
                ' (' +
                value.today_order_count +
                ' order)</option>',
            )
          }
        })
      },
    })
  })
})

// autofill service
function selectMassage() {
  let select = document.getElementById('inputMassage')
  let time = document.getElementById('time')
  let price = document.getElementById('price')
  let massage = document.getElementById('massage')

  if (select.value === 'default') {
    time.value = ''
    price.value = ''
    massage.value = ''
  } else {
    massage.value = JSON.parse(select.value).id
    time.value = JSON.parse(select.value).time
    price.value = JSON.parse(select.value).price
  }
}

// autofill discount
function selectDiscount() {
  let select = document.getElementById('inputDiscount')
  let id = document.getElementById('discount_id')
  let discount = document.getElementById('discount')
  if (select.value === 'default') {
    id.value = ''
    discount.value = ''
  } else {
    id.value = JSON.parse(select.value).id
    discount.value = JSON.parse(select.value).discount
  }
}

// summary
// total summary
$('#inputDiscount').on('change', function () {
  var price = $('#price').val()
  var disc = $('#discount').val()
  var total = price - (price * disc) / 100
  $('#summary').val(total)
})

// jam
setInterval(function () {
  const time = moment().format('HH:mm:ss')
  document.getElementById('jam').innerHTML = time
}, 1000)

$('#inputMassage').on('change', function () {
  setInterval(function () {
    var timeNow = moment()
    var time = $('#time').val()
    $('#time-Start').val(timeNow.format('H:mm:ss'))
    var end_service = timeNow.add(time, 'minute')
    $('#time-End').val(end_service.format('H:mm:ss'))
  }, 1000)
})

// setInterval(function () {
//   $('#table-view').load('/order #table-view > *')
// }, 2000)

var show_service = $('#show-on-going').height()
if (show_service > 535) {
  $('#show-on-going').css('height', '67vh')
} else {
}

// modal confirm
$('.orderid').click(function () {
  $('#confirmOrder').modal()
  var id = $(this).attr('data-bs-id')
  var cust = $(this).attr('data-bs-cust')
  var therapist = $(this).attr('data-bs-therapist')
  var massage = $(this).attr('data-bs-massage')
  var time = $(this).attr('data-bs-time')
  var place = $(this).attr('data-bs-place')
  var orderId = $(this).attr('data-bs-orderID')
  $('#order_id').val(id)
  $('#editOrder').val(cust)
  $('#editTherapist').val(therapist)
  $('#editMassage').val(massage)
  $('#editTime').val(time)
  $('.title-only').text(orderId)
  $('#editPlace').val(place)
  setInterval(function () {
    var timeNow = moment()
    var timeAja = $('#editTime').val()
    $('#time-Start').val(timeNow.format('H:mm:ss'))
    var end_service = timeNow.add(timeAja, 'minute')
    $('#time-End').val(end_service.format('H:mm:ss'))
  }, 1000)
})

// modal extra time
$('.extraTime').click(function () {
  $('#extraTime').modal()
  var id = $(this).attr('data-bs-id')
  var cust = $(this).attr('data-bs-cust')
  var therapist = $(this).attr('data-bs-therapist')
  var therapistId = $(this).attr('data-bs-therapistId')
  var massage = $(this).attr('data-bs-massage')
  var end_service = $(this).attr('data-bs-end')
  var time = $(this).attr('data-bs-time')
  var orderId = $(this).attr('data-bs-orderID')
  var price = $(this).attr('data-bs-price')
  $('#order_extra').val(id)
  $('.editOrder').val(cust)
  $('#therapist_id').val(therapistId)
  $('.editTherapist').val(therapist)
  $('.editMassage').val(massage)
  $('.time-Start').val(end_service)
  $('.title-only').text(orderId)

  setInterval(function () {
    var time_start_extra = $('.time-Start').val()
    var defaultDate = moment().year(2000)
    var timeArr = time_start_extra.split(':')
    defaultDate.set({
      hour: timeArr[0],
      minute: timeArr[1],
      second: timeArr[2],
      millisecond: 0,
    })
    var timeAja = $('.editTime').val()
    var end_service = defaultDate.add(timeAja, 'minute')
    $('.time-End').val(end_service.format('H:mm:ss'))
    // $('.price-extra').val(price_extra)
  }, 1000)
})
function selectMassageExtra() {
  let select = document.getElementById('editMassageAja')
  let price = document.getElementById('price-extra')
  let priceExtra = document.getElementById('summary_extra')
  let id = document.getElementById('service_extra_time_id')
  var timeAja = $('.editTime').val()

  if (select.value === 'default') {
    price.value = ''
    id.value = ''
  } else {
    id.value = JSON.parse(select.value).id
    price_start = JSON.parse(select.value).price
    time = JSON.parse(select.value).time
    price_extra = price_start / time
    price.value = price_extra
    priceEx = JSON.parse(select.value).price
    summEx = priceEx
    priceExtra.value = summEx
  }
}
$('.editTime').keyup(function () {
  var price_extra = $('#price-extra').val()
  var time_custom = $('.editTime').val()
  var price_real = price_extra * time_custom
  price_real = parseInt(price_real)
  var price_order = $('#summary_extra').val()
  price_order = parseInt(price_order)
  var summary = price_real + price_order
  $('#price-real').val(price_real)
  $('#sum_extra').val(summary)
})

$('#finish').click(function () {
  window.location.href = 'http://127.0.0.1:8000/order?search=finish'
})
$('#all').click(function () {
  window.location.href = 'http://127.0.0.1:8000/order'
})
$('#onGoing').click(function () {
  // var finish = 'on going'
  // $('#search').val(finish)
  window.location.href = 'http://127.0.0.1:8000/order?search=on+going'
})
$('#pending').click(function () {
  // var finish = 'pending'
  // $('#search').val(finish)
  window.location.href = 'http://127.0.0.1:8000/order?search=pending'
})

// cancel extra time
$('.cancel').click(function () {
  var name = $(this).attr('data-bs-name')
  var id = $(this).attr('data-bs-target')
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success mx-1',
      cancelButton: 'btn btn-danger mx-3',
    },
    buttonsStyling: false,
  })
  swalWithBootstrapButtons
    .fire({
      title: 'Are you sure to complete the service on behalf of ' + name + '?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Finish!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        // $('#updateDelete').submit()
        window.location = '/order/finish/' + id + ' '
        swalWithBootstrapButtons.fire(
          'Done!',
          '' + name + ' service is done!',
          'success',
        )
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          '' + name + ' service is still running!',
          'error',
        )
      }
    })
})

// finish extra time
$('.cancelExtra').click(function () {
  var name = $(this).attr('data-bs-name')
  var id = $(this).attr('data-bs-target')
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success mx-1',
      cancelButton: 'btn btn-danger mx-3',
    },
    buttonsStyling: false,
  })
  swalWithBootstrapButtons
    .fire({
      title:
        'Are you sure to complete the service extra time on behalf of ' +
        name +
        '?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Finish!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        // $('#updateDelete').submit()
        window.location = '/extraTime/finish/' + id + ' '
        swalWithBootstrapButtons.fire(
          'Done!',
          '' + name + ' service is done!',
          'success',
        )
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          '' + name + ' service is still running!',
          'error',
        )
      }
    })
})

// modal show service extra time == null
$('.show_service').click(function () {
  $('#show-service').modal()
  var cust = $(this).attr('data-bs-cust')
  var therapist = $(this).attr('data-bs-therapist')
  var massage = $(this).attr('data-bs-massage')
  var duration = $(this).attr('data-bs-duration')
  var price = $(this).attr('data-bs-price')
  price = parseInt(price)
  var start = $(this).attr('data-bs-start')
  var end = $(this).attr('data-bs-end')
  var extra = $(this).attr('data-bs-extra')
  var massageExtra = $(this).attr('data-bs-massageExtra')
  var priceExtra = $(this).attr('data-bs-priceExtra')
  priceExtra = parseInt(priceExtra)
  var place = $(this).attr('data-bs-place')
  var orderId = $(this).attr('data-bs-orderID')
  var endExtra = $(this).attr('data-bs-endExtra')
  var sum = price + priceExtra
  $('#cust_name').val(cust)
  $('#therapist_name').val(therapist)
  $('#service').val(massage)
  $('#duration').val(duration)
  $('#price_real').val(price)
  $('#start_service').val(start)
  $('#end_service').val(end)
  $('#extra').val(extra)
  $('#place1').val(place)
  $('#massageExtra').val(massageExtra)
  $('#priceExtra').val(priceExtra)
  $('#startExtra').val(end)
  $('#endExtra').val(endExtra)
  $('#Sum').val(sum)
  $('.title-only').text(orderId)
})

// modal show service extra time != null
$('.show_service2').click(function () {
  $('#showservice2').modal()
  var cust = $(this).attr('data-bs-cust')
  var therapist = $(this).attr('data-bs-therapist')
  var massage = $(this).attr('data-bs-massage')
  var duration = $(this).attr('data-bs-duration')
  var price = $(this).attr('data-bs-price')
  price = parseInt(price)
  var place = $(this).attr('data-bs-place')
  var start = $(this).attr('data-bs-start')
  var end = $(this).attr('data-bs-end')
  var extra = $(this).attr('data-bs-extra')
  var orderId = $(this).attr('data-bs-orderID')
  var massageExtra = $(this).attr('data-bs-massageExtra')
  var priceExtra = $(this).attr('data-bs-priceExtra')
  priceExtra = parseInt(priceExtra)
  var endExtra = $(this).attr('data-bs-endExtra')
  var sum = price + priceExtra
  $('#cust_name2').val(cust)
  $('#therapist_name2').val(therapist)
  $('#service2').val(massage)
  $('#duration2').val(duration)
  $('#price_real2').val(price)
  $('#start_service2').val(start)
  $('#end_service2').val(end)
  $('#extra').val(extra)
  $('#massageExtra').val(massageExtra)
  $('#place2').val(place)
  $('#priceExtra').val(priceExtra)
  $('#startExtra').val(end)
  $('#endExtra').val(endExtra)
  $('.title-only').text(orderId)
  $('#Sum').val(sum)
})
