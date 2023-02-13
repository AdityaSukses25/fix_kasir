// masssage
$('.editMassage').click(function () {
  $('#editMassage').modal()
  var massage = $(this).attr('data-bs-massage')
  var massage_id = $(this).attr('data-bs-id')
  var time = $(this).attr('data-bs-time')
  var price = $(this).attr('data-bs-price')
  $('#massage_id').val(massage_id)
  $('#edit_Massage').val(massage)
  $('#editTime').val(time)
  $('#editPrice').val(price)
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
        window.location = '/service/delete/' + id + ' '
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
// end massage

// place
$('.editplace').click(function () {
  $('#editplace').modal()
  var id = $(this).attr('data-bs-id')
  var place = $(this).attr('data-bs-place')
  $('#place_id').val(id)
  $('#edit_place').val(place)
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
        window.location = '/place/delete/' + id + ' '
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
// end place

// discount
$('.editdiscount').click(function () {
  $('#editdiscount').modal()
  var discount = $(this).attr('data-bs-discount')
  var discount_id = $(this).attr('data-bs-id')
  $('#discount_id').val(discount_id)
  $('#edit_discount').val(discount)
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
        window.location = '/discount/delete/' + id + ' '
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
// end discount
