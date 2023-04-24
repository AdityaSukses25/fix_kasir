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
                          <th class="text-center">Order ID</th>
                          <th class="text-center">Customer</th>
                          <!-- <th class="text-center">Receptionist</th> -->
                          <!-- <th class="text-center">Therapist</th> -->
                          <th class="text-center">Massage</th>
                          <th class="text-center">Date</th>
                          <!-- <th class="text-center">Time (mnt)</th> -->
                          <!-- <th class="text-center">Price (Rp)</th> -->
                          <!-- <th class="text-center">Discount (%)</th>                     -->
                          <!-- <th class="text-center">Extra Time</th>                     -->
                          <!-- <th class="text-center">Service (Extra Time)</th>                     -->
                          <!-- <th class="text-center">Price (Extra Time)</th>                     -->
                          <th class="text-center">Summary (Rp)</th>
                          <!-- <th class="text-center">Action</th> -->
                        </tr>
                      </thead>
                      <tbody id="table-body">
                      @if($days->count())
                      @foreach($days as $day)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          @if($day->start_extra_time == null)
                          <td class="text-center"><span class="mr-3">#{{ $day->orderID}}</span> | <button class="btn-sm btn-warning ml-3 detail-btn" data-target="#detail" data-toggle="modal" data-customer="{{ $day->cust_name }}" data-date="{{ date('Y-m-d', strtotime($day->created_at)) }} | {{ date('H:i:s', strtotime($day->created_at)) }}" data-id="{{ $day->orderID }}" data-massage="{{ $day->massage }}" data-time="{{ $day->time }}" data-price="{{ $day->price }}" data-description="{{ $day->description }}" data-summary="{{ $day->summary }}" data-discount="{{ $day->discount }}" data-start="{{ $day->start_service }}" data-end="{{ $day->end_service }}" data-status="{{ $day->status }}" data-reception="{{ $day->Rname }}" data-therapist="{{ $day->Tname }}"><i class="fa fa-circle-info"></i></button></td>
                          @else
                          <td class="text-center"><span class="mr-3">#{{ $day->orderID}}</span> | <button class="btn-sm ml-3 btn-warning detail-extra" style="position: relative; margin-top: -20px;" data-target="#detail_extra" data-toggle="modal" data-customer="{{ $day->cust_name }}" data-date="{{ date('Y-m-d', strtotime($day->created_at)) }} | {{ date('H:i:s', strtotime($day->created_at)) }}" data-id="{{ $day->orderID }}" data-massage="{{ $day->massage }}" data-time="{{ $day->time }}" data-price="{{ $day->price }}" data-description="{{ $day->description }}" data-summary="{{ $day->summary }}" data-discount="{{ $day->discount }}" data-start="{{ $day->start_service }}" data-end="{{ $day->end_service }}" data-massage-extra="{{ $day->massageExtra }}" data-extra="{{ $day->extra_time }}" data-start-extra="{{ $day->start_extra_time }}" data-end-extra="{{ $day->end_extra_time }}" data-price-extra="{{ $day->priceExtra }}" data-summary-extra="{{ $day->summary_extra_time }}" data-status="{{ $day->status}}" data-reception="{{ $day->Rname }}" data-therapist="{{ $day->Tname }}"><i class="fa fa-circle-info"></i><span class="mr-0" style="position: absolute;">*</span></button></td>
                          @endif
                          <td>{{ $day->cust_name}}</td>
                          <!-- <td>{{ $day->Rname}}</td> -->
                          <!-- <td>{{ $day->Tname}}</td> -->
                          <td>{{ $day->massage}}</td>
                          <td class="text-center">{{ date('Y-m-d', strtotime($day->created_at)) }} | {{ date('H:i:s', strtotime($day->created_at))}}</td>
                          <!-- <td class="text-center">{{ $day->time }}'</td> -->
                          <!-- <td class="text-right" >{{Str::rupiah($day->price)}},00</td> -->
                          <!-- @if($day->discount == 0) -->
                          <!-- <td class="text-center">-</td> -->
                          <!-- @else -->
                          <!-- <td class="text-center">{{ $day->discount }}</td> -->
                          <!-- @endif -->
                          @if($day->start_extra_time == null)
                          <!-- <td class="text-center">-</td> -->
                          <!-- <td class="text-center">-</td> -->
                          <!-- <td class="text-center">-</td> -->
                          <td class="text-right">{{ Str::rupiah($day->summary) }},00</td>
                          <!-- <td class="text-center"></td> -->
                          @else
                          <!-- <td class="text-center">{{ $day->extra_time}}'</td> -->
                          <!-- <td class="text-center">{{ $day->massageExtra}}</td> -->
                          <!-- <td class="text-right">{{ Str::rupiah($day->priceExtra) }},00</td> -->
                          <td class="text-right">{{ Str::rupiah($day->summary_extra_time) }},00</td>
                          <!-- <td class="text-center"><button class="btn btn-warning">detail*</button></td> -->
                          @endif
                        </tr>
                      @endforeach

                        @else
                        <tr>
                          <td colspan="6" class="text-center">No Service yet Right now!</td>
                        </tr>
                        @endif
                      </tbody>
                      <tfoot>
                        <tr>
                          
                          <th colspan='5' class="text-center">Total Summary (Rp)</th>
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

      <!-- modal detail extra time == null -->
      <div class="modal fade" id="detail">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Transaction Detail</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="" method="post">
                      @csrf
                                  <!-- transaction_date -->
                                  <div class="row mb-3">
                                      <label for="transaction_date" class="col-md-4 col-form-label text-md-end">Transaction Date</label>
                                      <div class="col-md-8">
                                        <input id="transaction_date" type="text" class="form-control @error('transaction_date') is-invalid @enderror" name="transaction_date" value="{{ old('transaction_date') }}" required autocomplete="transaction_date" autofocus>

                                          @error('transaction_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- customer -->
                                  <div class="row mb-3">
                                      <label for="customer" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input id="customer" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer" value="{{ old('customer') }}" required autocomplete="customer" autofocus>

                                          @error('customer')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- reception -->
                                  <div class="row mb-3">
                                      <label for="reception" class="col-md-4 col-form-label text-md-end">Receptionist</label>
                                      <div class="col-md-8">
                                        <input id="reception" type="text" class="form-control @error('reception') is-invalid @enderror" name="reception" value="{{ old('reception') }}" required autocomplete="reception" autofocus>

                                          @error('reception')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="therapist" class="col-md-4 col-form-label text-md-end">Therapist</label>
                                      <div class="col-md-8">
                                        <input id="therapist" type="text" class="form-control @error('therapist') is-invalid @enderror" name="therapist" value="{{ old('therapist') }}" required autocomplete="therapist" autofocus>

                                          @error('therapist')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="massage" class="col-md-4 col-form-label text-md-end">Massage</label>
                                      <div class="col-md-8">
                                        <input id="massage" type="text" class="form-control @error('massage') is-invalid @enderror" name="massage" value="{{ old('massage') }}" required autocomplete="massage" autofocus>

                                          @error('massage')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                  <!-- time_duration -->
                                  <div class="row mb-3">
                                      <label for="time_duration" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>
                                      <div class="col-md-8">
                                        <input id="time_duration" type="text" class="form-control @error('time_duration') is-invalid @enderror" name="time_duration" value="{{ old('time_duration') }}" required autocomplete="time_duration" autofocus>

                                          @error('time_duration')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>


                                  <!-- price -->
                                  <div class="row mb-3">
                                      <label for="price" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>
                                      <div class="col-md-8">
                                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- discount -->
                                  <div class="row mb-3">
                                      <label for="discount" class="col-md-4 col-form-label text-md-end">Discount (%)</label>
                                      <div class="col-md-8">
                                        <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount" autofocus>

                                          @error('discount')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- Description -->
                                  <div class="row mb-3">
                                      <label for="Description" class="col-md-4 col-form-label text-md-end">Description</label>
                                      <div class="col-md-8">
                                        <input id="Description" type="text" class="form-control @error('Description') is-invalid @enderror" name="Description" value="{{ old('Description') }}" required autocomplete="Description" autofocus>

                                          @error('Description')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- summary -->
                                  <div class="row mb-3">
                                      <label for="summary" class="col-md-4 col-form-label text-md-end">Summary (Rp)</label>
                                      <div class="col-md-8">
                                        <input id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" autofocus>

                                          @error('summary')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- start -->
                                  <div class="row mb-3">
                                      <label for="start" class="col-md-4 col-form-label text-md-end"> Start Service </label>
                                      <div class="col-md-8">
                                        <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start" autofocus>

                                          @error('start')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- end -->
                                  <div class="row mb-3">
                                      <label for="end" class="col-md-4 col-form-label text-md-end">End Service</label>
                                      <div class="col-md-8">
                                        <input id="end" type="text" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end" autofocus>

                                          @error('end')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>
                                      <div class="col-md-8">
                                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>

                                          @error('status')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
      </div>

      <!-- modal detail extra time != null -->
      <div class="modal fade" id="detail_extra">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Transaction Detail</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="" method="post">
                      @csrf
                                  <!-- transaction_date -->
                                  <div class="row mb-3">
                                      <label for="transaction_date" class="col-md-4 col-form-label text-md-end">Transaction Date</label>
                                      <div class="col-md-8">
                                        <input id="transaction_date1" type="text" class="form-control @error('transaction_date') is-invalid @enderror" name="transaction_date" value="{{ old('transaction_date') }}" required autocomplete="transaction_date" autofocus>

                                          @error('transaction_date')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- customer -->
                                  <div class="row mb-3">
                                      <label for="customer" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input id="customer1" type="text" class="form-control @error('customer') is-invalid @enderror" name="customer" value="{{ old('customer') }}" required autocomplete="customer" autofocus>

                                          @error('customer')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- reception -->
                                  <div class="row mb-3">
                                      <label for="reception" class="col-md-4 col-form-label text-md-end">Receptionist</label>
                                      <div class="col-md-8">
                                        <input id="reception1" type="text" class="form-control @error('reception') is-invalid @enderror" name="reception" value="{{ old('reception') }}" required autocomplete="reception" autofocus>

                                          @error('reception')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="therapist" class="col-md-4 col-form-label text-md-end">Therapist</label>
                                      <div class="col-md-8">
                                        <input id="therapist1" type="text" class="form-control @error('therapist') is-invalid @enderror" name="therapist" value="{{ old('therapist') }}" required autocomplete="therapist" autofocus>

                                          @error('therapist')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="massage" class="col-md-4 col-form-label text-md-end">Massage</label>
                                      <div class="col-md-8">
                                        <input id="massage1" type="text" class="form-control @error('massage') is-invalid @enderror" name="massage" value="{{ old('massage') }}" required autocomplete="massage" autofocus>

                                          @error('massage')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                  <!-- time_duration -->
                                  <div class="row mb-3">
                                      <label for="time_duration" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>
                                      <div class="col-md-8">
                                        <input id="time_duration1" type="text" class="form-control @error('time_duration') is-invalid @enderror" name="time_duration" value="{{ old('time_duration') }}" required autocomplete="time_duration" autofocus>

                                          @error('time_duration')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>


                                  <!-- price -->
                                  <div class="row mb-3">
                                      <label for="price" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>
                                      <div class="col-md-8">
                                        <input id="price1" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- discount -->
                                  <div class="row mb-3">
                                      <label for="discount" class="col-md-4 col-form-label text-md-end">Discount (%)</label>
                                      <div class="col-md-8">
                                        <input id="discount1" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount" autofocus>

                                          @error('discount')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- Description -->
                                  <div class="row mb-3">
                                      <label for="Description" class="col-md-4 col-form-label text-md-end">Description</label>
                                      <div class="col-md-8">
                                        <input id="Description1" type="text" class="form-control @error('Description') is-invalid @enderror" name="Description" value="{{ old('Description') }}" required autocomplete="Description" autofocus>

                                          @error('Description')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- summary -->
                                  <div class="row mb-3">
                                      <label for="summary" class="col-md-4 col-form-label text-md-end">Summary (Rp)</label>
                                      <div class="col-md-8">
                                        <input id="summary1" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" autofocus>

                                          @error('summary')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- start -->
                                  <div class="row mb-3">
                                      <label for="start" class="col-md-4 col-form-label text-md-end"> Start Service </label>
                                      <div class="col-md-8">
                                        <input id="start1" type="text" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start" autofocus>

                                          @error('start')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- end -->
                                  <div class="row mb-3">
                                      <label for="end" class="col-md-4 col-form-label text-md-end">End Service</label>
                                      <div class="col-md-8">
                                        <input id="end1" type="text" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end" autofocus>

                                          @error('end')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- massage (ET)-->
                                  <div class="row mb-3">
                                      <label for="massage" class="col-md-4 col-form-label text-md-end">Massage (ET)</label>
                                      <div class="col-md-8">
                                        <input id="massage_et1" type="text" class="form-control @error('massage') is-invalid @enderror" name="massage" value="{{ old('massage') }}" required autocomplete="massage" autofocus>

                                          @error('massage')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  
                                  <!-- extra_time -->
                                  <div class="row mb-3">
                                      <label for="extra_time" class="col-md-4 col-form-label text-md-end">Extra Time (mint)</label>
                                      <div class="col-md-8">
                                        <input id="extra_time1" type="text" class="form-control @error('extra_time') is-invalid @enderror" name="extra_time" value="{{ old('extra_time') }}" required autocomplete="extra_time" autofocus>

                                          @error('extra_time')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- price_et -->
                                  <div class="row mb-3">
                                      <label for="price_et" class="col-md-4 col-form-label text-md-end">Price (ET)</label>
                                      <div class="col-md-8">
                                        <input id="price_et1" type="text" class="form-control @error('price_et') is-invalid @enderror" name="price_et" value="{{ old('price_et') }}" required autocomplete="price_et" autofocus>

                                          @error('price_et')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- total summary -->
                                  <div class="row mb-3">
                                      <label for="extra_time" class="col-md-4 col-form-label text-md-end">Total Summary (Rp)</label>
                                      <div class="col-md-8">
                                        <input id="total1" type="text" class="form-control @error('extra_time') is-invalid @enderror" name="extra_time" value="{{ old('extra_time') }}" required autocomplete="extra_time" autofocus>

                                          @error('extra_time')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- start_et -->
                                  <div class="row mb-3">
                                      <label for="start_et" class="col-md-4 col-form-label text-md-end">Start (ET)</label>
                                      <div class="col-md-8">
                                        <input id="start_et1" type="text" class="form-control @error('start_et') is-invalid @enderror" name="start_et" value="{{ old('start_et') }}" required autocomplete="start_et" autofocus>

                                          @error('start_et')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- end_et -->
                                  <div class="row mb-3">
                                      <label for="end_et" class="col-md-4 col-form-label text-md-end">End (ET)</label>
                                      <div class="col-md-8">
                                        <input id="end_et1" type="text" class="form-control @error('end_et') is-invalid @enderror" name="end_et" value="{{ old('end_et') }}" required autocomplete="end_et" autofocus>

                                          @error('end_et')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>
                                      <div class="col-md-8">
                                        <input id="status1" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>

                                          @error('status')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      
<script src="/js/customer.js"></script>

@endsection