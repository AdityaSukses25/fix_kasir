function fetch(start_date, end_date) {
  $.ajax({
    url: '/reportSearch',
    type: 'GEt',
    data: {
      start_date: start_date,
      end_date: end_date,
    },
    dataType: 'json',
    success: function (data) {
      // Datatables
      var i = 1
      $('#table1').DataTable({
        data: data.query,
        // responsive
        responsive: true,
        columns: [
          {
            data: 'id',
            render: function (data, type, row, meta) {
              return i++
            },
          },
          {
            data: 'cust_name',
          },
          {
            data: 'therapist',
            render: function (data, type, row, meta) {
              return `${row.standard}th Standard`
            },
          },
          {
            data: 'percentage',
            render: function (data, type, row, meta) {
              return `${row.percentage}%`
            },
          },
          {
            data: 'result',
          },
          {
            data: 'created_at',
            render: function (data, type, row, meta) {
              return moment(row.created_at).format('DD-MM-YYYY')
            },
          },
        ],
      })
    },
  })
}
