// terapist and gender
$('#inputGender').on('change', function () {
  var genderID = $(this).val()
  if (genderID) {
    $.ajax({
      url: '/getTherapist/' + genderID,
      type: 'GET',
      data: { _token: '{{ csrf_token() }}' },
      dataType: 'json',
      success: function (data) {
        if (data) {
          $('#inputTherapist').empty()
          $('#inputTherapist').append(
            '<option hidden>-- Choose therapist --</option>',
          )
          $.each(data, function (key, therapist) {
            if (therapist.status == '2') {
              $('select[name="therapist_id"]').append(
                '<option value="' +
                  therapist.id +
                  '">' +
                  therapist.nickname +
                  '</option>',
              )
            }
          })
        } else {
          $('#inputTherapist').empty()
        }
      },
    })
  } else {
    $('#inputTherapist').empty()
  }
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
    $('#start_service').val(timeNow.format('H:mm:ss'))
    var end_service = timeNow.add(time, 'minute')
    $('#end_service').val(end_service.format('H:mm:ss'))
  }, 1000)
})

setInterval(function () {
  $('#table-view').load('/order #table-view > *')
}, 500)

var show_service = $('#show-on-going').height()
if (show_service > 535) {
  $('#show-on-going').css('height', '535px')
} else {
}

// function refreshTable() {
//   $.ajax({
//     url: '/order/showService',
//     success: function (orders) {
//       $('#show-on-going').html(orders)
//     },
//   })
// }

// setInterval(refreshTable, 1000) // Refresh table every 5 seconds
