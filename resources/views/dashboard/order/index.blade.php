@extends('dashboard.layout.main')

@section('container')

<!-- select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <h2>12 : 30 : 00</h2>
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
                <form action="/order/create" method="post" >
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

                    <!-- phone
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
                    </div> -->

                    <!-- service -->
                    <!-- <div class="row mb-3">
                      <label for="service_id" class="col-md-4 col-form-label text-md-end">Massage</label>
                        <div class="col-md-8">
                          <select id="inputMassage" class="form-control custom-select" name=""  onchange="selectMassage()">
                            <option value="" selected disabled>Select Massage...</option>
                            @foreach( $massages as $massage)                                    
                                              <option value="{{ $massage }}">{{$massage->massage}}</option>
                                              
                                              @endforeach
                                            </select>
                        
                            <input id="massage" type="text" class="form-control @error('phone') is-invalid @enderror" name="service_id" >
                        </div>
                    </div> -->

                    <!-- therapist -->
                    <!-- <div class="row mb-3">
                      <label for="therapist_id" class="col-md-4 col-form-label text-md-end">Therapist</label> -->

                        <!-- gender -->
                        <!-- <div class="col-md-3">
                          <select id="inputGender" class="form-control custom-select" name="gender_id">
                                          <option value="" selected disabled>Select gender...</option>
                                              @foreach( $genders as $gender)                                    
                                              <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                              @endforeach
                                          
                          </select>
                        </div> -->

                        <!-- therapist name -->
                        <!-- <div class="col-md-5">
                        <select id="inputTherapist" class="form-control custom-select" name="therapist_id">
                                        
                                          
                          </select>
                        </div>
                    </div> -->
                    <!-- end therapist -->

                    <!-- place -->
                    <!-- <div class="row mb-3">
                      <label for="place_id" class="col-md-4 col-form-label text-md-end">Room</label>
                      <div class="col-md-8">
                          <select id="place" class="form-control custom-select" name="place_id">
                                          <option value="" selected disabled>Select room...</option>
                                              @foreach( $places as $place )                                    
                                              <option value="{{$place->id}}">{{$place->place}}</option>
                                              @endforeach
                                          
                          </select>
                      </div>
                    </div> -->

                    <!-- time -->
                    <!-- <div class="row mb-3">
                      <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration</label>
                        <div class="col-md-8">
                          <input id="time" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" readonly>

                            @error('time')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- price -->
                    <!-- <div class="row mb-3">
                      <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
                        <div class="col-md-8">
                          <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" readonly>

                            @error('price')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- discount -->
                    <!-- <div class="row mb-3">
                      <label for="discount_id" class="col-md-4 col-form-label text-md-end">Discount</label>
                      <div class="col-md-8">
                          <select id="discount" class="form-control custom-select" name="discount_id">
                                          <option value="" selected disabled>Select discount...</option>
                                              @foreach( $discounts as $discount)                                    
                                              <option value="{{$discount->discount}}">{{$discount->discount}}</option>
                                              @endforeach
                                          
                          </select>
                      </div>
                    </div> -->

                    <!-- payment -->
                    <!-- <div class="row mb-3">
                      <label for="payment" class="col-md-4 col-form-label text-md-end">Payment Method</label>
                      <div class="col-md-8">
                          <select id="payment" class="form-control custom-select" name="payment_method">
                                          <option value="" selected disabled>Select payment...</option>
                                          <option value="Cash">Cash</option>
                                          <option value="Debit">Debit</option>
                                                                                  
                                          
                          </select>
                        </div>
                    </div> -->

                    <!-- description -->
                    <!-- <div class="row mb-3">
                      <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                        <div class="col-md-8">
                          <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                            @error('description')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div> -->

                    <!-- summary -->
                    <!-- <div class="row mb-3">
                      <label for="summary" class="col-md-4 col-form-label text-md-end">Total</label>
                        <div class="col-md-8">
                          <input id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" readonly>

                            @error('summary')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                    </div> -->
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
        </div>
    
        
      
    </section>

    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="/js/order.js"></script>
    
@endsection