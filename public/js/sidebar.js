$('.edit-personal').on('click', function () {
  $('#edit-personal').modal()
  var id = $('.edit-personal').attr('data-bs-id')
  var name = $('.edit-personal').attr('data-bs-name')
  var username = $('.edit-personal').attr('data-bs-username')
  var phone = $('.edit-personal').attr('data-bs-phone')
  var email = $('.edit-personal').attr('data-bs-email')
  var password = $('.edit-personal').attr('data-bs-password')
  var status = $('.edit-personal').attr('data-bs-status')
  $('#user-id').val(id)
  $('#edit-Name').val(name)
  $('#edit-Username').val(username)
  $('#edit-Phone').val(phone)
  $('#edit-Email').val(email)
  $('#edit-Password').val(password)
  $('#edit-Status').val(status)
})

$(document).ready(function () {
  $('.edit-personal').hover(
    function () {
      $('.user-personal').removeClass('d-none')
    },
    function () {
      $('.user-personal').addClass('d-none')
    },
  )
})

$(document).ready(function () {
  $('#push').click(function () {
    $('#initial').toggleClass('d-none')
    $('.main-sidebar').hover(function () {
      $('#initial').toggleClass('d-none')
    })
  })
})
