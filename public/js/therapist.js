$('.editTerapist').click(function () {
  $('#editTerapist').modal()
  var name = $(this).attr('data-bs-name')
  var terapist_id = $(this).attr('data-bs-terapist')
  var nickname = $(this).attr('data-bs-nickname')
  var number = $(this).attr('data-bs-number')
  var gender = $(this).attr('data-bs-gender')
  var kehadiran = $(this).attr('data-bs-kehadiran')
  var komisi = $(this).attr('data-bs-komisi')
  var attend = $(this).attr('data-bs-attend')
  $('#terapist_id').val(terapist_id)
  $('#editName').val(name)
  $('#editNickname').val(nickname)
  $('#editPhone').val(number)
  $('#editPresence').val(kehadiran)
  $('#editCommision').val(komisi)
  $('#editGender').val(gender)
  $('#editAttend').val(attend)
})

// presence
// time_start
$('.time_start').click(function () {
  $('#time_start').modal()
  var id = $(this).attr('data-bs-terapist')
  var name = $(this).attr('data-bs-name')
  $('#start_id').val(id)
  $('#start_name').val(name)
  setInterval(function () {
    var timeNow = moment()
    $('#time_in').val(timeNow.format('H:mm:ss'))
  }, 1000)
})
// time_end

$('.deleteTherapist').click(function () {
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
      title: 'Are you sure to delete ' + name + '?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        window.location = '/terapist/delete/' + id + ' '
        swalWithBootstrapButtons.fire(
          'Deleted!',
          '' + name + ' has been deleted.',
          'success',
        )
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          '' + name + ' is safe',
          'error',
        )
      }
    })
})

var therapist = $('#therapist-table').height()
if (therapist > 580) {
  $('#therapist-table').css('height', '580px')
} else {
}
