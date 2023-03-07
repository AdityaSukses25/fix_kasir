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
          <div class="title text-center"><h1>SPA LOTUS MASSAGE ECHO</h1></div>
          <div class="title text-center text-success"><h1>SALARY REPORT</h1></div>
          <div class="title text-center"><h3>{{ $month_salary->format('F, Y') }}</h3></div>
        </div>
      </div>
      <div class="row">
        <div class="col">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Therapist</th>
                <th scope="col" class="text-center">Total Service</th>
                <th scope="col" class="text-center">Salary</th>
              </tr>
            </thead>
            <tbody>
            @foreach($salarys as $salary)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td>{{ $month_salary->format('F Y')}}</td>
                          <td>{{ $salary['therapist_name'] }}</td>
                          <td>{{ $salary['order_amount'] }}</td>
                          <td>{{ Str::rupiah($salary['salary']) }},00</td>
                        </tr>
                        @endforeach  
              
            </tbody>
            <tfoot>
                        <tr>
                          
                          <th colspan='4' class="text-center">Total</th>
                          <th>{{ Str::rupiah($Summary) }},00</th>
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