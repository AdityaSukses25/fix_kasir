@extends('dashboard.layout.main')

@section('container')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @if(auth()->user()->status == 1)
    <section class="content">
        <div class="container-fluid">
        <!-- order info -->
        <div class="row">
          <div class=" col-4">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $orders->count() }}</h3>
                @if($orders->count() == 0)
                <p>No Order yet right now!</p>
                @elseif($orders->count() == 1)
                <p>New Order</p>
                @else
                <p>New Orders</p>
                @endif
              </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          <a href="/transaction-record" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      
      <!-- service favorite info -->
      <div class="col-lg-4 col-4">
        @if($favorites->count())
        <div class="small-box bg-teal">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $favorites->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $services->count() }}</h5>
            </div>
            @if($favorites->count() == 1)
            <p>Top service of the week</p>
            @else
            <p>Top services of the week</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer" data-target="#showFavorite" data-toggle="modal">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @else
        <div class="small-box bg-danger">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $therapists->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $therapists_total->count() }}</h5>
            </div>
            <p>We have no therapist ready right now!</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @endif
      </div>

      <!-- therapist info -->
      <div class="col-lg-4 col-4">
        @if($therapists->count())
        <div class="small-box bg-success">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $therapists->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $therapists_total->count() }}</h5>
            </div>
            @if($therapists->count() == 1)
            <p>Therapist Available</p>
            @else
            <p>Therapists Available</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @else
        <div class="small-box bg-danger">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $therapists->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $therapists_total->count() }}</h5>
            </div>
            <p>We have no therapist ready right now!</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @endif
      </div>
    @else
      <section class="content">
        <div class="container-fluid">
        <!-- order info -->
        <div class="row">
          <div class=" col-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $orders->count() }}</h3>
                @if($orders->count() == 0)
                <p>No Order yet right now!</p>
                @elseif($orders->count() == 1)
                <p>New Order</p>
                @else
                <p>New Orders</p>
                @endif
              </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          <a href="/transaction-record" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- action needed -->
      <div class="col-lg-3 col-3">
        @if($order_on->count())
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $order_on->count() }}</h3>
            <p>Need to be processed!</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/order?search=pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @elseif($order_on_going->count())
      <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $order_on_going->count() }}</h3>
            @if($order_on_going->count() > 1)
            <p>Services is running!</p>
            @else
            <p>Service is running!</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/order?search=on going" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @else
      <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $order_on->count() }}</h3>
            <p>No action is required at this time</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/order?search=finish" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif
      
      <!-- service favorite info -->
      <div class="col-lg-3 col-3">
        @if($favorites->count())
        <div class="small-box bg-teal">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $favorites->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $services->count() }}</h5>
            </div>
            @if($favorites->count() == 1)
            <p>Top service of the week</p>
            @else
            <p>Top services of the week</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer" data-target="#showFavorite" data-toggle="modal">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @else
        <div class="small-box bg-teal">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $favorites->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $services->count() }}</h5>
            </div>
            <p>Have no top service </p>
          </div>
          <div class="icon">
            <i class="ion ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer" data-target="#showFavorite" data-toggle="modal">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @endif
      </div>

      <!-- therapist info -->
      <div class="col-lg-3 col-3">
        @if($therapists->count())
        <div class="small-box bg-success">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $therapists->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $therapists_total->count() }}</h5>
            </div>
            @if($therapists->count() == 1)
            <p>Therapist Available</p>
            @else
            <p>Therapists Available</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @else
        <div class="small-box bg-danger">
          <div class="inner">
            <div class="" style="position: relative;">
              <h3>{{ $therapists->count() }} </h3>
              <h5 class="absolute ml-4" style="margin-top: -40px; position: absolute;">of {{ $therapists_total->count() }}</h5>
            </div>
            <p>We have no therapist ready right now!</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        @endif
      </div>
      
    @endif
      <!-- BAR CHART -->
      <div class="container-fluid"> 
        <div class="row">
          <div class="col-12">
            <div id="sales" class="card card-primary card-outline card-tabs" >
              <div class="card-header border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active text-primary" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><i class="fas fa-solid fa-user"></i> Visitation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link sales text-dark" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fas fa-dollar-sign"></i> Sales</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <div class="chart">
                    <canvas id="areaChart" style="min-height: 40vh; height: 40vh; max-height: 40vh; max-width: 100%;"></canvas>
                  </div>  
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                  <div class="chart">
                    <canvas id="salesChart" style="min-height: 40vh; height: 40vh; max-height: 40vh; max-width: 100%;"></canvas>
                  </div> 
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>

      <!-- modal show favorite service -->
      <div class="modal fade" id="showFavorite">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                      @if($favorites->count() == 1)
                      <h4 class="modal-title">Top {{$favorites->count()}} service on the week</h4>
                      @else
                      <h4 class="modal-title">Top {{$favorites->count()}} services on the week</h4>
                      @endif
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="card-body">
                        <table class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">Massage</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($favorites as $fv)
                            <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td>{{ $fv->massage }}</td>
                              <td class="text-center">{{ $fv->total }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="modal-footer justify-content-end">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
                </div>
        </div>
      </div>
      
     
      
      <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // sales
    $('#custom-tabs-four-profile-tab').click(function(){
      $('#sales').removeClass('card-primary')
      $('#sales').addClass('card-success')
      $('#custom-tabs-four-profile-tab').removeClass('text-dark')
      $('#custom-tabs-four-profile-tab').addClass('text-success')
      $('#custom-tabs-four-home-tab').addClass('text-dark')
      // $('#custom-tabs-four-home-tab').removeClass('text-primary')
    } )
// visitation
    $('#custom-tabs-four-home-tab').click(function(){
      $('#sales').removeClass('card-success')
      $('#sales').addClass('card-primary')
      $('#custom-tabs-four-profile-tab').addClass('text-dark')
      // $('#custom-tabs-four-profile-tab').removeClass('text-dark')
      $('#custom-tabs-four-home-tab').removeClass('text-dark')
      $('#custom-tabs-four-home-tab').addClass('text-primary')

      // $('#custom-tabs-four-profile-tab').removeClass('text-success')
      // $('#custom-tabs-four-home-tab').removeClass('text-success')
    } )
</script>
    <!-- ChartJS -->
<script src="../template/Admin/plugins/chart.js/Chart.min.js"></script>
<script>
  // visitation
  var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

  
  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      {
        label               : 'Sales',
        backgroundColor     : 'rgba(255,255,255,1)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : {!! json_encode($counts) !!}
      },
      
    ]
  }
  
  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }
  
  // This will get the first returned node in the jQuery collection.
  new Chart(areaChartCanvas, {
    type: 'line',
    data: areaChartData,
    options: areaChartOptions
  })
  // end of visitation

  // sales per month
  var areaChartCanvas = $('#salesChart').get(0).getContext('2d')

  
  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [
      {
        label               : 'Sales',
        backgroundColor     : 'rgba(255,255,255,1)',
        borderColor         : 'rgba(92, 184, 92, 1)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : {!! json_encode($summarys) !!}
      },
      
    ]
  }
  
  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }
  
  // This will get the first returned node in the jQuery collection.
  new Chart(areaChartCanvas, {
    type: 'line',
    data: areaChartData,
    options: areaChartOptions
  })
  
</script>


</section>
  
@endsection