@extends('dashboard.layout.main')

@section('container')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 mt-1">
            <ol class="breadcrumb float-sm-right">
              <form action="/pdf-print">
              <button class="btn btn-primary" type="submit">
                <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
              </button>
              </form>
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
        <div class="col-12 ">
            <div class="card card-primary card-tabs ">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">    </h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fa-solid fa-dollar-sign"></i> Sales</a>
                  </li>
                  <li class="nav-item" style="Margin-right: 37em;">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fa fa-hand-holding-dollar"></i>  Salarys</a>
                  </li>
                  
                  <form action="/report">
                    <div class="d-flex justify-content-end" >
                      <li><input type="date" class="ml-5 mr-2 rounded border-0 p-1 px-2" id="" name="start_date" value="{{ old('start_date')}}"></li>
                      <li class="mt-1">to</li>                  
                      <li><input type="date" class="ml-2  rounded border-0 p-1 px-2" id="dateEnd" name="end_date" value="{{ old('end_date') }}"></li>
                      <div class="input-group input-group-sm" style="margin-top: px ;">
                        
                        <button class="btn btn-tool" style="margin-top: px;" type="submit">
                          <i class="fas fa-search"></i>
                          
                        </button>                      
                        
                        
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                        
                      </div>
                      
                      </form>
                    
                  </div>
                </ul>
              </div>
              <div class="card-body table-responsive p-0" id="report-table">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <table id="table1" class="table table-bordered table-striped table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Receptionist</th>
                          <th class="text-center">Customer</th>
                          <th class="text-center">Therapist</th>
                          <th class="text-center">Massage</th>
                          <th class="text-center">Time</th>
                          <th class="text-center">Price</th>
                          <th class="text-center">Discount</th>                    
                          <th class="text-center">Summary</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                      @if($days->count())
                      @foreach($days as $day)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $day->created_at->format('Y-m-d') }} | {{ $day->start_service }}</td>
                          <td>{{ $day->reception->name }}</td>
                          <td>{{ $day->cust_name }}</td>
                          <td>{{ $day->therapist->name }}</td>
                          <td>{{ $day->service->massage}}</td>
                          <td>{{ $day->time }}</td>
                          <td>{{Str::rupiah($day->price)}},00</td>
                          @if($day->discount->discount == 0)
                          <td>-</td>
                          @else
                          <td>{{ $day->discount->discount }}%</td>
                          @endif
                          <td>{{ Str::rupiah($day->summary) }},00</td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="10" class="text-center">No Service yet Right now!</td>
                        </tr>
                      @endif
                      </tbody>
                      <tfoot>
                        <tr>
                          
                          <th colspan='9' class="text-center">Total</th>
                          <th>{{ Str::rupiah($totalADays) }},00</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Therapist</th>
                          <th>Total Service</th>
                          <th>Salary</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                      @if($salarys->count())
                      
                      @foreach($salarys as $salary)
                        <tr>
                          <td>{{ $loop->iteration}}</td>
                          <td> </td>
                          <td>{{ $salary['therapist_name'] }}</td>
                          <td>{{ $salary['order_amount'] }}</td>
                          <td>{{ Str::rupiah($salary['salary']) }},00</td>
                        </tr>
                        @endforeach
                        
                        
                      @else
                        <tr>
                          <td colspan="10" class="text-center">No Service yet Right now!</td>
                        </tr>
                      @endif
                      </tbody>
                      <tfoot>
                        <tr>
                    
                          <th colspan='4' class="text-center">Total</th>
                          <th class="">{{ Str::rupiah($Summary) }},00</th>
                          
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/report.js"></script>
@endsection