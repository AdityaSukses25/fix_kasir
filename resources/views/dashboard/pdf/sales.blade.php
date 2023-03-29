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
        @foreach($days as $day)
        @endforeach
          <div class="title text-end"><p><span class="today">Download in {{ $Now->format('Y-m-d | H:i:s') }}</span></p></div>
          <div class="title text-center pt-4 pb-3"><h3>SPA LOTUS MASSAGE ECHO</h3></div>
          <div class="from text-center pb-1"><p>Jalan Batu Mejan Canggu, Desa Canggu, Kecamatan Kuta Utara, Kabupaten Badung, Bali.</p></div>
          <div class="border border-top border-dark"></div>
          <div class="title text-center text-success pt-3"><h4>SALES REPORT</h4></div>
          <div class="row justify-content-center">
            <div class="col-1 border-top border-success pb-3"></div>
          </div>
          <div class="title text-center float-left pb-2" id="start_date" >
            <div class="text-center">Period of</div>
            <p>
              @if(request('start_sales'))
              <span id="start"></span>  <span id="end"></span> 
              @else
                
                <span class="today">{{ $Now->format('Y-m-d') }}</span>
                
              @endif
            </p>
            <input type="hidden" class="border-0" id="start_Sales" value="{{ request('start_sales') }}" readonly>
            <input type="hidden" id="end_Sales" value="{{ request('end_sales')}}">
          </div>
        </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
          <table class="table table-bordered border-dark">
              <thead>
                <tr>
                  <th scope="col" class="text-center">No</th>
                  <th scope="col" class="text-center">Date</th>
                  <!-- <th scope="col" class="text-center">Receptionist</th>
                  <th scope="col" class="text-center">Customer</th>
                  <th scope="col" class="text-center">Therapist</th> -->
                  <th scope="col" class="text-center">Massage</th>
                  <th scope="col" class="text-center">Time (mnt)</th>
                  <th scope="col" class="text-center">Price (Rp)</th>
                  <th scope="col" class="text-center">Discount (%)</th>
                  <th scope="col" class="text-center">Summary (Rp)</th>
                </tr>
              </thead>
              <tbody>
              
                @if($days->count())
                @foreach($days as $day)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td id="today">{{ $day->created_at->format('Y-m-d') }}</td>
                      <!-- <td>{{ $day->reception->name }}</td>
                      <td>{{ $day->cust_name }}</td>
                      <td>{{ $day->therapist->name }}</td> -->
                      <td>{{ $day->service->massage}}</td>
                      <td class="text-center">{{ $day->time }}'</td>
                      <td class="text-end">{{Str::rupiah($day->price)}},00</td>
                      @if($day->discount->discount == 0)
                      <td class="text-center">-</td>
                      @else
                      <td class="text-center">{{ $day->discount->discount }}</td>
                      @endif
                      <td class="text-end">{{ Str::rupiah($day->summary) }},00</td>
                    </tr>
                    @endforeach
                @else
                    <td class="text-center" colspan="7">No Sales Found!</td>
                @endif
                
                
              </tbody>
              <tfoot>
                          <tr>
                            
                            <th colspan='6' class="text-center">Total Summary (Rp)</th>
                            <th class="text-end">{{ Str::rupiah($totalADays) }},00</th>
                          </tr>
                        </tfoot>
            </table>
          </div>
        </div>

      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <script src="/js/sales_report.js"></script>

  </body>
</html>