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
        @foreach($salary as $sal)
        @endforeach
          <div class="title text-end"><p><span class="today">Download in {{ $Now->format('Y-m-d | H:i:s') }}</span></p></div>
          <div class="card-logo text-center">
            <img src="/assets/logo_lotus/logo_lap.png" alt="Lotus Logo" class="img " style="height: 150px; weight: 150px; background-color: white;">
          </div>
          <div class="title text-center pt-4 pb-3"><h3>SPA LOTUS MASSAGE ECHO</h3></div>
          <div class="from text-center"><p>Jalan Batu Mejan Canggu, Desa Canggu, Kecamatan Kuta Utara, Kabupaten Badung, Bali.</p></div>
          <div class="from text-center" style="margin-top: -10px;"><p>Phone: 083112097031</p></div>
          <div class="border border-top border-dark"></div>
          <div class="title text-center text-success pt-3"><h4>SALARY REPORT </h4></div>
          <div class="title text-center text-success "><h4>OF </h4></div>
          <div class="title text-center text-success "><h4>{{ $sal['therapist_name']}}</h4></div>
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
              <th class="text-center">No</th>
              <th class="text-center">Date</th>
              <th class="text-center">Order Id</th>
              <!-- <th class="text-center">Cust Name</th> -->
              <th class="text-center">Service</th>
              <th class="text-center">Time</th>
              <th class="text-center">ET</th>
              <th class="text-center">Service(ET)</th>
              <th class="text-center">Salary</th>
              </tr>
            </thead>
            <tbody>
                    @foreach($salary as $sal)
                    @foreach($sal['order_details'] as $dt)
                    @if($dt['customer_name'] != null)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td class="text-center">{{ $dt['order_date'] }}</td>
                      <td class="text-center">#{{ $dt['order_id'] }}</td>
                      <!-- <td class="">{{ $dt['customer_name'] }}</td> -->
                      <td class="text-center">{{ $dt['service'] }}</td>
                      <td class="text-center">{{ $dt['time_duration'] }}'</td>
                      @if($dt['extra_time'] == null)
                      <td class="text-center">-</td>
                      <td class="text-center">-</td>
                      @else
                      <td class="text-center">{{ $dt['extra_time'] }}'</td>
                      <td class="text-center">{{ $dt['service_extra']}}</td>
                      @endif
                      <td class="text-end">{{Str::rupiah($dt['order_bonus']) }},00</td>
                    </tr>
                    @else
                    <tr>
                      <td colspan="7">Sorry, We don't take service yet right now!</td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                  </tbody>
            <tfoot>
                        <tr>
                          
                          <th colspan='7' class="text-center">Total Salary (Rp)</th>
                          <th class="text-end">{{ Str::rupiah($Summary) }},00</th>
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