require('jquery-maskmoney')
$('.rupiah').maskMoney({
  thousands: '.',
  decimal: ',',
  allowZero: true,
  prefix: 'Rp ',
})
