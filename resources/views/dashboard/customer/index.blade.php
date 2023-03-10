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
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0" id="customer-table">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Name</th>
                      <th >Phone</th>
                      <th >Service</th>
                      <th class="">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                      @if($customers->count())
                      @foreach($customers as $customer)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $customer->cust_name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->service->massage }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editCustomer btn btn-block btn-warning" data-toggle="modal" data-target="#editCustomer" data-bs-id="{{$customer->id}}"  data-bs-name="{{$customer->cust_name}}" data-bs-phone="{{$customer->phone}}" data-bs-service="{{$customer->service->massage}}" data-bs-therapist="{{$customer->therapist->name}}" data-bs-place="{{$customer->place->place}}" data-bs-time="{{$customer->service->time}}" data-bs-price="{{$customer->service->price}}" data-bs-discount="{{$customer->discount->discount}}" data-bs-payment="{{$customer->payment_method}}" data-bs-description="{{$customer->description}}" data-bs-summary="{{$customer->summary}}" data-bs-reception="{{$customer->reception->name}}" data-bs-create_at="{{$customer->created_at->format('Y-m-d')}}" data-bs-start="{{$customer->start_service}}" data-bs-end="{{$customer->end_service}}" data-bs-status="{{$customer->status}}">
                              <i class="fa fa-circle-info"></i>
                              </button>
      
                            </div>
                            
                          </div>

                          
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                          <td colspan="7" class="text-center">Have no customer right now!</td>
                      </tr>

                      @endif
                    </tbody>
                </table>
                <div class="page d-flex justify-content-center">
                    {{ $customers->links() }}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    
        
      
    </section>

    <div class="content">
      <div class="container-fluid">
    
        <!-- modal edit --> 
        <div class="modal fade" id="editCustomer">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Customer</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="" method="post">
                      @method('put')
                      @csrf
                                  <!-- name -->
                                  <div class="row mb-3">
                                      <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <input type="hidden" id="terapist_id" name="terapist_name">
                                      <div class="col-md-8">
                                        <input id="editName" type="text" class="form-control @error('name') is-invalid @enderror" id="editName" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('username')
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
                                          <input id="editphone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- service -->
                                  <div class="row mb-3">
                                      <label for="service" class="col-md-4 col-form-label text-md-end">Service</label>

                                      <div class="col-md-8">
                                          <input id="editservice" type="text" class="form-control @error('service') is-invalid @enderror" name="service" value="{{ old('service') }}" required autocomplete="service" autofocus>

                                          @error('service')
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
                                          <input id="edittherapist" type="text" class="form-control @error('therapist') is-invalid @enderror" name="therapist" value="{{ old('therapist') }}" required autocomplete="therapist" autofocus>

                                          @error('therapist')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="place" class="col-md-4 col-form-label text-md-end">Room</label>

                                      <div class="col-md-8">
                                          <input id="editplace" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                          @error('place')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="time" class="col-md-4 col-form-label text-md-end">Time duration</label>

                                      <div class="col-md-8">
                                          <input id="edittime" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" autofocus>

                                          @error('time')
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
                                          <input id="editprice" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- discount -->
                                  <div class="row mb-3">
                                      <label for="discount" class="col-md-4 col-form-label text-md-end">Discount</label>

                                      <div class="col-md-8">
                                          <input id="editdiscount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount" autofocus>

                                          @error('discount')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- payment method -->
                                  <div class="row mb-3">
                                      <label for="payment" class="col-md-4 col-form-label text-md-end">Payment method</label>

                                      <div class="col-md-8">
                                          <input id="editpayment" type="text" class="form-control @error('payment') is-invalid @enderror" name="payment" value="{{ old('payment') }}" required autocomplete="payment" autofocus>

                                          @error('payment')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- description -->
                                  <div class="row mb-3">
                                      <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                                      <div class="col-md-8">
                                          <input id="editdescription" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                          @error('description')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- summary -->
                                  <div class="row mb-3">
                                      <label for="summary" class="col-md-4 col-form-label text-md-end">Summary</label>

                                      <div class="col-md-8">
                                          <input id="editsummary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" autofocus>

                                          @error('summary')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- reception -->
                                  <div class="row mb-3">
                                      <label for="receptionist" class="col-md-4 col-form-label text-md-end">Receptionist</label>

                                      <div class="col-md-8">
                                          <input id="editreceptionist" type="text" class="form-control @error('receptionist') is-invalid @enderror" name="receptionist" value="{{ old('receptionist') }}" required autocomplete="receptionist" autofocus>

                                          @error('receptionist')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- create at -->
                                  <div class="row mb-3">
                                      <label for="create" class="col-md-4 col-form-label text-md-end">Create at</label>

                                      <div class="col-md-8">
                                          <input id="editcreate" type="text" class="form-control @error('create') is-invalid @enderror" name="create" value="{{ old('create') }}" required autocomplete="create" autofocus>

                                          @error('create')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- start -->
                                  <div class="row mb-3">
                                      <label for="start" class="col-md-4 col-form-label text-md-end">Start at</label>

                                      <div class="col-md-8">
                                          <input id="editstart" type="text" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start" autofocus>

                                          @error('start')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- end -->
                                  <div class="row mb-3">
                                      <label for="end" class="col-md-4 col-form-label text-md-end">End</label>

                                      <div class="col-md-8">
                                          <input id="editend" type="text" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required autocomplete="end" autofocus>

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
                                          <input id="editstatus" type="text" class="form-control @error('status') is-invalid @enderror text-capitalize" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>

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
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
          <!-- /.end edit therapist -->
      </div>
    </div>
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/customer.js"></script>
    
@endsection