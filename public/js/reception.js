$('.editUser').click(function () {
  $('#editUser').modal()
  var name = $(this).attr('data-bs-name')
  var user_id = $(this).attr('data-bs-user')
  var username = $(this).attr('data-bs-username')
  var status = $(this).attr('data-bs-status')
  var phone = $(this).attr('data-bs-phone')
  var email = $(this).attr('data-bs-email')
  var password = $(this).attr('data-bs-password')
  $('#user_id').val(user_id)
  $('#editName').val(name)
  $('#editUsername').val(username)
  $('#editStatus').val(status)
  $('#editPhone').val(phone)
  $('#editEmail').val(email)
  $('#editPassword').val(password)
})

$('.delete').click(function () {
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
        window.location = '/reception/delete/' + id + ' '
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
