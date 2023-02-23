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
              <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
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
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Sales</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Salarys</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Laba</a>
                  </li>
                  
                  <form id="form-filter" method="post">
                    <div class="d-flex justify-content-end" style="Margin-left: 820px; margin-top: -37px;">
                      <li><input type="date" class="ml-5 mr-2" id="" name="start_date"></li>
                      <li>to</li>                  
                      <li><input type="date" class="ml-2" id="dateEnd" name="end_date"></li>
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
              <div class="card-body table-responsive p-0" style="height: 590px;">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <table id="table1" class="table table-bordered table-striped table-head-fixed text-nowrap">
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
                      @foreach($days as $day)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $day->created_at }}</td>
                          <td>{{ $day->reception->name}}</td>
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
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Customer</th>
                          <th>Massage</th>
                          <th>Time</th>
                          <th>Price</th>
                          <th>Discount</th>                    
                          <th>Summary</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                      <tfoot>
                        <tr>
                    
                          <th colspan='7' class="text-center">Total</th>
                          
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                     bersihnya 200jt
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