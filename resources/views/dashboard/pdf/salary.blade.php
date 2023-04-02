<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SALARY REPORT</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col p-2">
          <div class="title text-end"><p><span class="today">Download in {{ $Now->format('Y-m-d | H:i:s') }}</span></p></div>
          <div class="title text-center pt-4 pb-3"><h3>SPA LOTUS MASSAGE ECHO</h3></div>
          <div class="from text-center pb-1"><p>Jalan Batu Mejan Canggu, Desa Canggu, Kecamatan Kuta Utara, Kabupaten Badung, Bali.</p></div>
          <div class="border border-top border-dark"></div>
          <div class="title text-center text-success pt-3"><h4>SALARY REPORT</h4></div>
          <div class="row justify-content-center">
            <div class="col-1 border-top border-success pb-3"></div>
          </div>
          <div class="title text-center float-left pb-2" id="start_date" >
            <div class="text-center">Period of</div>
            <div class="title text-center"><p>{{ $month_salary->format('F, Y') }}</p></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
        <table class="table border-dark table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">No</th>
                <!-- <th scope="col" class="text-center">Date</th> -->
                <th scope="col" class="text-center">Therapist</th>
                <th scope="col" class="text-center">Total Service</th>
                <th scope="col" class="text-center">Salary (Rp)</th>
              </tr>
            </thead>
            <tbody>
           
              
                        @foreach($salarys as $salary)
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td class="text-center">{{ $loop->iteration}}</td>
                          <!-- <td>{{ $month_salary->format('F, Y')}}</td> -->
                          <td>{{ $salary['therapist_name'] }}</td>
                          <td class="text-center">{{ $salary['order_amount'] }}</td>
                          
                          @php
                            $total_order_bonus = 0;
                            foreach ($salary['order_details'] as $dt) {
                              $total_order_bonus += $dt['order_bonus'];
                            }
                          @endphp
                          <td class="text-end">{{ Str::rupiah($total_order_bonus) }},00</td>
                        </tr>
                      @endforeach            
            </tbody>
            <tfoot>
                        <tr>
                          
                        <th colspan='3' class="text-center">Total Salary (Rp)</th>
                          @php
                          $total_order_bonus_sum = 0;
                          foreach ($salarys as $salary) {
                              $total_order_bonus_sum += array_reduce($salary['order_details'], function($carry, $item) {
                                  return $carry + $item['order_bonus'];
                              }, 0);
                          }
                          @endphp

                          <th class="text-end">{{ Str::rupiah($total_order_bonus_sum)}},00</th>
                        </tr>
                      </tfoot>
          </table>
        </div>
      </div>
    </div>

    <script>
      window.print()
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>