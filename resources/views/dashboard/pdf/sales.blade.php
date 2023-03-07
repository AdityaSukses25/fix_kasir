<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>SALES REPORT</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col p-2">
          <div class="title text-center"><h1>SPA LOTUS MASSAGE ECHO</h1></div>
          <div class="title text-center text-success"><h1>SALES REPORT</h1></div>
          <div class="title text-center"><h3>January, 24 2024</h3></div>
        </div>
      </div>
      <div class="row">
        <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Receptionist</th>
                <th scope="col" class="text-center">Customer</th>
                <th scope="col" class="text-center">Therapist</th>
                <th scope="col" class="text-center">Massage</th>
                <th scope="col" class="text-center">Time</th>
                <th scope="col" class="text-center">Price</th>
                <th scope="col" class="text-center">Discount</th>
                <th scope="col" class="text-center">Summary</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($days as $day)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $day->created_at->format('Y-m-d') }} | {{ $day->start_service }}</td>
                  <td>{{ $day->reception->name }}</td>
                  <td>{{ $day->cust_name }}</td>
                  <td>{{ $day->therapist->name }}</td>
                  <td>{{ $day->service->massage}}</td>
                  <td>{{ $day->time }} mnt</td>
                  <td>{{Str::rupiah($day->price)}},00</td>
                  @if($day->discount->discount == 0)
                  <td>-</td>
                  @else
                  <td>{{ $day->discount->discount }}%</td>
                  @endif
                  <td>{{ Str::rupiah($day->summary) }},00</td>
                  </tr>
              @endforeach
              
              
            </tbody>
            <tfoot>
                        <tr>
                          
                          <th colspan='9' class="text-center">Total</th>
                          <th>{{ Str::rupiah($totalADays) }},00</th>
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