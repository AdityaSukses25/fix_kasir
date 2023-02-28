@extends('dashboard.layout.main')

@section('container')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right ">
              <!-- jam -->
              <div class="jam-digital-malasngoding relative">
              	<div class="kotak border px-3 py-1 absolute">
                  <h1 id="jam"></h1>
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
          <div class="col-7">
            <div class="card shadow">
                <div class="card-body table-responsive p-0" style="height: 638px;">
                  <table class="table table-head-fixed text-nowrap">
                  <div class="card ">
                <!-- /.card-header --> 
                  <!-- form start -->
                  <form action="/order/create" method="post">
                    @csrf
                      <div class="card-body table-responsive">
                        <!-- name -->
                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-8">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="cust_name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>


                        <!-- phone -->
                        <div class="row mb-3">
                          <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                            <div class="col-md-8">
                              <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>  

                        <!-- service -->
                        <div class="row mb-3">
                          <label for="service_id" class="col-md-4 col-form-label text-md-end">Massage</label>
                            <div class="col-md-8">
                              <select id="inputMassage" class="form-control custom-select" name=""  onchange="selectMassage()">
                                <option value="" selected disabled>Select Massage...</option>
                                @foreach( $massages as $massage)                                    
                                                  <option value="{{ $massage }}">{{$massage->massage}}</option>
                                                  
                                                  @endforeach
                                                </select>
                            
                                <input id="massage" type="hidden" class="form-control @error('phone') is-invalid @enderror" name="service_id" >
                            </div>
                        </div>

                        <!-- therapist -->
                        <div class="row mb-3">
                          <label for="therapist_id" class="col-md-4 col-form-label text-md-end">Therapist</label>

                            <!-- gender -->
                            <div class="col-md-3">
                              <select id="inputGender" class="form-control custom-select" name="gender_id" text-capitalize>
                                              <option value="" selected disabled>Select gender...</option>
                                                  @foreach( $genders as $gender)                                    
                                                  <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                                  @endforeach
                                              
                              </select>
                            </div>
                            @foreach($orders as $order)
                            <div id="orderSukses" class="orderSukses"  data-bs-orderSukses="{{$order->therapist_id}}" data-bs-id="{{$order->id}}"></div>
                            @endforeach

                            <!-- therapist name -->
                            <div class="col-md-5">
                            <select id="inputTherapist" class="form-control custom-select" name="therapist_id">
                                            
                                              
                              </select>
                            </div>

                            
                        </div>
                        <!-- end therapist -->

                        <!-- place -->
                        <div class="row mb-3">
                          <label for="place_id" class="col-md-4 col-form-label text-md-end">Room</label>
                          <div class="col-md-8">
                              <select id="place" class="form-control custom-select" name="place_id">
                                              <option value="" selected disabled>Select room...</option>
                                                  @foreach( $places as $place )                                    
                                                  <option value="{{$place->id}}">{{$place->place}}</option>
                                                  @endforeach
                                              
                              </select>
                          </div>
                        </div>

                        <!-- time -->
                        <div class="row mb-3">
                          <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration</label>
                            <div class="col-md-2">
                              <input id="time" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" readonly>

                                @error('time')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <!-- start -->
                            <div class="col-md-3">
                              <input id="start_service" type="text" class="form-control @error('start_service') is-invalid @enderror" name="start_service" value="{{ old('start_service') }}" required autocomplete="start_service" placeholder="start" readonly>

                                  @error('start_service')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror

                            </div>
                            <!-- end -->
                            <div class="col-md-3">
                              <input id="end_service" type="text" class="form-control @error('end_service') is-invalid @enderror" name="end_service" value="{{ old('end_service') }}" required autocomplete="end_service" placeholder="end" readonly>

                                @error('end_service')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>

                        </div>

                        <!-- price -->
                        <div class="row mb-3">
                          <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
                            <div class="col-md-8">
                              <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" readonly>

                                @error('price')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- discount -->
                        <div class="row mb-3">
                          <label for="discount_id" class="col-md-4 col-form-label text-md-end">Discount</label>
                          <div class="col-md-8">
                              <select id="inputDiscount" class="form-control custom-select" onchange="selectDiscount()">
                                              <option value="" selected disabled>Select discount...</option>
                                                  @foreach( $discounts as $discount)                                    
                                                  <option value="{{$discount}}">{{$discount->discount}}</option>
                                                  @endforeach
                                              
                              </select>
                              <input type="hidden" id="discount_id" name="discount_id">
                              <input type="hidden" id="discount">
                          </div>
                        </div>

                        <!-- payment -->
                        <div class="row mb-3">
                          <label for="payment" class="col-md-4 col-form-label text-md-end">Payment Method</label>
                          <div class="col-md-8">
                              <select id="payment" class="form-control custom-select" name="payment_method">
                                              <option value="" selected disabled>Select payment...</option>
                                              <option value="Cash">Cash</option>
                                              <option value="Debit">Debit</option>
                                                                                      
                                              
                              </select>
                            </div>
                        </div>

                        <!-- description -->
                        <div class="row mb-3">
                          <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                            <div class="col-md-8">
                              <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                                @error('description')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <!-- summary -->
                        <div class="row mb-3">
                          <label for="summary" class="col-md-4 col-form-label text-md-end">Total</label>
                            <div class="col-md-8">
                              <input id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" readonly>

                                @error('summary')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="btn d-flex justify-content-center" style="margin-top: -10px;">
                        <button type="reset" class="btn btn-primary mr-2 ">Cancel</button>
                        <button type="submit" class="btn btn-primary ml-2 ">Submit</button>

                      </div>
                      
                  </form>
                  </div>
                    
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
          <div class="col-5">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Services on going</h3>

                  <div class="card-tools">
                    
                    <div class="input-group input-group-sm mt-2" style="width: ;">
                      
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                
                  
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 590px;">
                  <table id='table-view' class="table  table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Therapist</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @if($orders->count())
                          @foreach( $orders as $order)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="/customer">{{ $order->cust_name }}</a> </td>
                            <td class="text-capitalize">{{ $order->therapist->nickname }}</td>
                            <td>{{ $order->start_service }}</td>
                            <td><div class="endTime" id="end_time" data-bs-now="{{$order->created_at}}" data-bs-id="{{$order->id}}" data-bs-val="{{$order->end_service}}">{{ $order->end_service }}</div></td>
                            @if($order->status === 'on going')
                            <td><span  id="{{$order->id}}" data-bs-id="{{$order->id}}" class="status badge badge-warning">On going...</span></td>
                            @else
                            <td><span  id="{{$order->id}}" data-bs-id="{{$order->id}}" class="status badge badge-success">Finish</span></td>
                            @endif
                                              
                          </tr>

                          @endforeach
                      @else
                      <tr>
                        <td colspan="7"><div class="session text-center">No service yet right now!</div></td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            
              
      </div>
        </div>
    
        
      
    </section>

    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" ></script>
  <script src="/js/order.js"></script>
    
@endsection