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
              '<option value="' + key + '">' + therapist.nickname + '</option>',
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
