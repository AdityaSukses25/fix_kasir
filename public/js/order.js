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
            $('select[name="therapist_id"]').append(
              '<option value="' +
                therapist.id +
                '">' +
                therapist.nickname +
                '</option>',
            )
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

// autofill
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

// summary
// total summary
$('#discount').on('change', function () {
  var price = $('#price').val()
  var disc = $('#discount').val()
  var total = price - (price * disc) / 100
  $('#summary').val(total)
})

// jam
window.setTimeout('waktu()', 1000)

function waktu() {
  var waktu = new Date()
  setTimeout('waktu()', 1000)
  h = waktu.getHours()
  m = waktu.getMinutes()
  s = waktu.getSeconds()
  x = h

  var time = x + ' : ' + m + ' : ' + s
  document.getElementById('jam').innerHTML = time
}

$('#inputMassage').on('change', function () {
  var timeNow = moment()
  var time = $('#time').val()
  $('#start_service').val(timeNow.format('H:mm:ss'))
  var end_service = timeNow.add(time, 'minute')
  $('#end_service').val(end_service.format('H:mm:ss'))
})
