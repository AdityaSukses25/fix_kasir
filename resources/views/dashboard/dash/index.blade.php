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
              <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
          <div class="col md-auto">
          <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Bar Chart</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
          </div>
          </div>
        </div>  
      </div>
      
      
    </section>

    
    <!-- <div class="row">

      <section class="col-lg-7 connectedSortable">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
              Sales
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content p-0">

              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div>
        </div>
      </section> -->

    <!-- /.content -->
@endsection