@extends('dashboard.layout.main')

@section('container')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-9 mt-1">
            <ol class="breadcrumb float-sm-right">
              <!-- <div class="print-sale">
                <form action="/pdf-sales" method="" target="_blank">
                <input type="hidden" name="start_sales" id="start_sales">
                <input type="hidden" name="end_sales" id="end_sales">
                <button class="btn btn-primary" type="submit">
                  <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
                </button>
                </form>
              </div>
              <div class="print-salary d-none">
                <form action="/pdf-salary" method="" target="_blank">
                <input type="hidden" name="bulan" id="bulan" class="ml-5 mr-2 rounded border-0 p-1 px-2 start_month"  >
                <button class="btn btn-success" type="submit">
                  <li class="breadcrumb-item"><i class="fas fa-print"></i> Print to PDF </li>
                </button>
                </form>
              </div> -->
              <form action="/transaction-record" class="date-sales">
                <div class="input-group input-group-sm">
                      <!-- <input type="date" class="ml-5 mr-2 rounded border-0   date-sales" id="start_date" name="start_date" value="{{ old('start_date')}}">
                      to
                      <input type="date" class="ml-2 date-sales rounded border-0 mr-2 " id="end_date" name="end_date" value="{{ old('end_date') }}"> -->
                      <input type="date" id="search" class="form-control float-right rounded mr-2 py-3" name="start_date" value="{{ request('start_date')}}">
                      to
                      <input type="date" id="search" class="form-control float-right rounded mr-2 py-3 ml-2" name="end_date" value="{{ request('end_date') }}">
                      <input type="text" name="search" id="search" class="form-control float-right rounded-left py-3" placeholder="Search" value="{{ request('search') }}">
                      <input type="hidden" name="sort" id="sort_id" data-start="{{ request('start_date') }}" data-end="{{ request('end_date') }}" data-name="{{ request('search') }}"class="form-control float-right rounded-left py-3" placeholder="Search" value="asc">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" >
                              <a href="/order">
  
                                
                                </a>
                            </button> -->
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-end" data-toggle="dropdown">
                            <i class=" fa fa-filter"></i>
                            </button>
                              <div class="dropdown-menu">
                                <a id="all" class="dropdown-item" href="#" value="2">Sort By All</a>
                                <a id="asc" class="dropdown-item" href="#">Sort By Asc</a>
                                <a id="desc" class="dropdown-item" href="#" >Sort By Desc</a>
                              </div>
  
                            
                          </div>
                </div>
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
            <div class="card card-primary card-tabs " id="card-sales">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">    </h3></li>
                  <li class="nav-item" style="Margin-right: 680px;">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fa-solid fa-dollar-sign"></i> Sales</a>
                  </li>
                  
                  
                  <!-- <form action="/report" class="date-sales">
                    <div class="d-flex justify-content-end" >
                      <li><input type="date" class="ml-5 mr-2 py-3 rounded border-0 p-1 px-2 date-sales" id="start_date" name="start_date" value="{{ old('start_date')}}"></li>
                      <li class="mt-1 date-sales">to</li>                  
                      <li><input type="date" class="ml-2 date-sales rounded border-0 p-1 px-2" id="end_date" name="end_date" value="{{ old('end_date') }}"></li>
                      
                      <div class="input-group input-group-sm" style="margin-top: px ;">
                        
                        <button class="btn btn-tool date-sales" style="margin-top: px;" type="submit">
                          <i class="fas fa-search"></i>
                          
                        </button>                      
                        
                        
                        <button type="button" class="btn btn-tool date-sales" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                        
                      </div>
                      
                      
                    </div>
                  </form> -->

                  <form action="/report" class="date-salary  d-none" style="margin-left: 10rem;">
                    <div class="d-flex justify-content-end" >
                      <li><input type="month" name="bulan" id="start_month" class="ml-5 mr-2 rounded border-0 p-1 px-2 "  ></li>
                      
                      
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
                    <table id="table_transaction" class="table table-bordered table-striped table-head-fixed table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Order ID</th>
                          <th class="text-center">Customer</th>
                          <th class="text-center">Receptionist</th>
                          <th class="text-center">Therapist</th>
                          <th class="text-center">Massage</th>
                          <th class="text-center">Time (mnt)</th>
                          <th class="text-center">Price (Rp)</th>
                          <th class="text-center">Discount (%)</th>                    
                          <th class="text-center">Extra Time</th>                    
                          <th class="text-center">Service (Extra Time)</th>                    
                          <th class="text-center">Price (Extra Time)</th>                    
                          <th class="text-center">Summary (Rp)</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                      @if($days->count())
                      @foreach($days as $day)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td class=>{{ date('Y-m-d', strtotime($day->created_at)) }} | {{ $day->start_service}}</td>
                          <td>#{{ $day->order_name}}</td>
                          <td>{{ $day->cust_name}}</td>
                          <td>{{ $day->Rname}}</td>
                          <td>{{ $day->Tname}}</td>
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
                          <td colspan="14" class="text-center">No Service yet Right now!</td>
                        </tr>
                        @endif
                      </tbody>
                      <tfoot>
                        <tr>
                          
                          <th colspan='13' class="text-center">Total Summary (Rp)</th>
                          <th class="text-right">{{ Str::rupiah($totalADays) }},00</th>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="page d-flex justify-content-center">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                  </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      
<script src="/js/customer.js"></script>

@endsection