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
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class=" col-6">

            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $orders->count() }}</h3>
                <p>New Orders</p>
              </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          <a href="/order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-6 col-6">

        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $therapists->count() }}</h3>
            @if($therapists->count())
            <p>Active Therapist</p>
            @else
            <p>We have no therapist yet right now</p>
            @endif
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/therapist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      
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
                    <canvas id="areaChart" style="min-height: 320px; height: 320px; max-height: 320px; max-width: 100%;"></canvas>
                  </div>  
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                  <div class="chart">
                    <canvas id="salesChart" style="min-height: 320px; height: 320px; max-height: 320px; max-width: 100%;"></canvas>
                  </div> 
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
      
      
      <!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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