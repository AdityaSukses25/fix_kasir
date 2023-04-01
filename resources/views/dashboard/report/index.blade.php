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
              <div class="print-sale">
                <form action="/pdf-sales" method="" target="_blank">
                <input type="hidden" name="start_sales" id="start_sales" value="{{ request('start_date')}}">
                <input type="hidden" name="end_sales" id="end_sales" value="{{ request('end_date')}}">
                <button class="btn btn-primary" type="submit">
                  <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
                </button>
                </form>
              </div>
              <div class="print-salary d-none">
                <form action="/pdf-salary" method="" target="_blank">
                <input type="hidden" name="bulan" id="bulan" class="ml-5 mr-2 rounded border-0 p-1 px-2 start_month" value="{{ request('bulan')}}"  >
                <button class="btn btn-success" type="submit">
                  <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
                </button>
                </form>
              </div>
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
            <div class="card card-primary card-tabs " id="card-sales">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">    </h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fa-solid fa-dollar-sign"></i> Sales</a>
                  </li>
                  <li class="nav-item" style="Margin-right: 580px;">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fa fa-hand-holding-dollar"></i>  Salarys</a>
                  </li>
                  
                  <form action="/report" class="date-sales">
                    <div class="d-flex justify-content-end" >
                      <li><input type="date" class="ml-5 mr-2 rounded border-0 p-1 px-2 date-sales" id="start_date" name="start_date" value="{{ request('start_date')}}"></li>
                      <li class="mt-1 date-sales">to</li>                  
                      <li><input type="date" class="ml-2 date-sales rounded border-0 p-1 px-2" id="end_date" name="end_date" value="{{ request('end_date') }}"></li>
                      
                      <div class="input-group input-group-sm" style="margin-top: px ;">
                        
                        <button class="btn btn-tool date-sales" style="margin-top: px;" type="submit">
                          <i class="fas fa-search"></i>
                          
                        </button>                      
                        
                        
                        <button type="button" class="btn btn-tool date-sales" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                         
                      </div>
                      
                      
                    </div>
                  </form>

                  <form action="/report" class="date-salary  d-none" style="margin-left: 10rem;">
                    <div class="d-flex justify-content-end" >
                      <li><input type="month" name="bulan" id="start_month" class="ml-5 mr-2 rounded border-0 p-1 px-2 "  value="{{ request('bulan')}}"></li>
                      
                      
                      <div class="input-group input-group-sm" style="margin-top: px ;">
                        
                        <button class="btn btn-tool " style="margin-top: px;" type="submit">
                          <i class="fas fa-search"></i>
                          
                        </button>                      
                        
                        
                        <button type="button" class="btn btn-tool " data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                        
                      </div>
                      
                      
                    </div>
                  </form>
                </ul>
              </div>

              <div class="card-body table-responsive p-0" id="report-table">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
              <!-- sales -->

                  <table id="table1" class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Massage</th>
                          <th class="text-center">Time (mnt)</th>
                          <th class="text-center">Price (Rp)</th>
                          <th class="text-center">Discount (%)</th>                    
                          <th class="text-center">Extra Time (mnt)</th>                    
                          <th class="text-center">Massage (Extra Time)</th>                    
                          <th class="text-center">Price (Rp) (Extra Time)</th>                    
                          <th class="text-center">Summary (Rp)</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                      @if($days->count())
                      @foreach($days as $day)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td class=>{{ date('Y-m-d', strtotime($day->created_at)) }}</td>
                          <td>{{ $day->massage}}</td>
                          <td class="text-center">{{ $day->time }}'</td>
                          <td class="text-right" >{{Str::rupiah($day->price)}},00</td>
                          @if($day->discount == 0)
                          <td class="text-center">-</td>
                          @else
                          <td class="text-center">{{ $day->discount }}%</td>
                          @endif
                          @if($day->start_extra_time == null)
                          <td class="text-center">-</td>
                          <td class="text-center">-</td>
                          <td class="text-center">-</td>
                          <td class="text-right">{{ Str::rupiah($day->summary) }},00</td>
                          @else
                          <td class="text-center">{{ $day->extra_time}}'</td>
                          <td class="text-center">{{ $day->massageExtra}}</td>
                          <td class="text-right">{{ Str::rupiah($day->priceExtra) }},00</td>
                          <td class="text-right">{{ Str::rupiah($day->summary_extra_time) }},00</td>
                          @endif
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
                          
                          <th colspan='9' class="text-center">Total Summary (Rp)</th>
                          <th class="text-right">{{ Str::rupiah($totalADays) }},00</th>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="page d-flex justify-content-center">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                  <!-- salary -->
                    <table class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Month</th>
                          <th class="text-center">Therapist</th>
                          <th class="text-center">Total Service</th>
                          <th class="text-center">Salary (Rp)</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($salarys as $salary)
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td class="text-center">{{ $loop->iteration}}</td>
                          <td>{{ $month_salary->format('F, Y')}}</td>
                          <td>{{ $salary['therapist_name'] }}</td>
                          <td class="text-center"><a href="/report/salary-detail{{ $salary['therapist_id'] }}?bulan={{request('bulan')}}" class="serviceDetail" data-toggle="" data-target="" data-bs-name="{{ $salary['therapist_name'] }}" data-bs-order="{{ $salary['order_amount'] }}" data-bs-id="{{ $salary['therapist_id'] }}">{{ $salary['order_amount'] }}</a></td>
                          <td class="text-right">{{ Str::rupiah($salary['salary']) }},00</td>
                        </tr>
                      @endforeach

                      </tbody>
                      <tfoot>
                        <tr>
                    
                          <th colspan='4' class="text-center">Total Salary (Rp)</th>
                          <th class="text-right">{{ Str::rupiah($Summary) }},00</th>
                          
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
      <div class="modal fade" id="salaryReport">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title-name"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="" method="post">
                      @method('put')
                      @csrf
                      <div class="card-body table-responsive p-0" id="report-table">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                          <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                            <table id="table1" class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th class="text-center">Id Order</th>
                                  <th class="text-center">Date</th>
                                  <th class="text-center">Customer</th>
                                  <th class="text-center">Receptionist</th>
                                  <!-- <th class="text-center">Therapist</th> -->
                                  <th class="text-center">Massage</th>
                                  <th class="text-center">Time (mnt)</th>
                                  <!-- <th class="text-center">Price (Rp)</th> -->
                                  <!-- <th class="text-center">Discount (%)</th>                    
                                  <th class="text-center">Summary (Rp)</th> -->
                                </tr>
                              </thead>
                              <tbody id="table-body-detail">
                              @if($salarys)
                              @foreach($salarys as $salary)
                              @foreach($salary['order_details'] as $d)
                              <td class="">{{ $d['order_id'] }}</td>
                              <td class="" id="orderID">{{ $d['order_date'] }}</td>
                              <td class="" id="orderNAME">{{ $d['customer_name'] }}</td>
                              <td class="" id="orderSERVICE">{{ $d['service'] }}</td>
                              <td class="" id="orderTIME_Duration">{{ $d['time_duration'] }}</td>
                              <td class="" id="orderTIME">{{ $d['time'] }}</td>
                              @endforeach
                              @endforeach
                              
                                @else
                                <tr>
                                  <td colspan="10" class="text-center">No Service yet Right now!</td>
                                </tr>
                                @endif
                              </tbody>
                              <tfoot>
                                <tr>
                                  
                                  <th colspan='5' class="text-center">Total Service</th>
                                  <th class="text-center"><div id="order-amount"></div></th>
                                </tr>
                              </tfoot>
                            </table>
                            <div class="page d-flex justify-content-center">
                            </div>
                          </div>
                          
                        </div>
                                  
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/report.js"></script>
@endsection