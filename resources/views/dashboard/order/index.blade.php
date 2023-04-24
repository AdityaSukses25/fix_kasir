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
                @if(session()->has('loginError'))
                  <div class="row justify-content-end" style="position:relative;">
                    <div class="col-3" style="position:absolute;margin-top:-90px; margin-bottom: 20px">
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('orderError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    </div>
                  </div>
                @endif
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
          <div class="col-6">
            <div class="card">
                <div class="card-body table-responsive" style="height: 73vh;">
                  <table class="table table-head-fixed text-nowrap">
                  <div class="card ">
                <!-- /.card-header --> 
                  <!-- form start -->
                  <form action="/order/create" method="post">
                    @csrf
                      <div class="card-body table-responsive border-0">
                      
                      <!-- name -->
                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-8">
                              <input id="name" type="text" class="form-control @error('cust_name') is-invalid @enderror" name="cust_name" value="{{ old('name') }}" required autocomplete="name" placeholder="type customer name..." autofocus>

                                @error('cust_name')
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
                              <input id="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="type customer phone..." autofocus>

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
                              <select id="inputMassage" class="form-control custom-select @error('serve') is-invalid @enderror" name="serve"  onchange="selectMassage()" required>
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
                                                  <option value="male">Male</option>
                                                  <option value="female">Female</option>
                                              
                              </select>
                            </div>
                            @foreach($orders as $order)
                            <div id="orderSukses" class="orderSukses"  data-bs-orderSukses="{{$order->therapist_id}}" data-bs-id="{{$order->id}}"></div>
                            @endforeach

                            <!-- therapist name -->
                            <div class="col-md-5">
                            <select id="inputTherapist" class="form-control custom-select @error('cust_name') is-invalid @enderror" name="therapist_id" required>
                                            
                                              
                              </select>
                            </div>

                            
                        </div>
                        <!-- end therapist -->

                        <!-- place -->
                        <div class="row mb-3">
                          <label for="place_id" class="col-md-4 col-form-label text-md-end">Room</label>
                          <div class="col-md-8">
                              <select id="place" class="form-control custom-select" name="place_id" required>
                                              <option value="" selected disabled>Select room...</option>
                                                  @foreach( $places as $place )                                    
                                                  <option value="{{$place->id}}">{{$place->place}}</option>
                                                  @endforeach
                                              
                              </select>
                          </div>
                        </div>

                        <!-- time -->
                        <div class="row mb-3">
                          <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>
                            <div class="col-md-8">
                              <input id="time" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" placeholder="minute" readonly>

                                @error('time')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <!-- start -->
                            <!-- <div class="col-md-3">
                              <input id="start_service" type="text" class="form-control @error('start_service') is-invalid @enderror" name="start_service" value="{{ old('start_service') }}" required autocomplete="start_service" placeholder="start" readonly>

                                  @error('start_service')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror

                            </div> -->
                            <!-- end -->
                            <!-- <div class="col-md-3">
                              <input id="end_service" type="text" class="form-control @error('end_service') is-invalid @enderror" name="end_service" value="{{ old('end_service') }}" required autocomplete="end_service" placeholder="end" readonly>

                                @error('end_service')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div> -->

                        </div>

                        <!-- price -->
                        <div class="row mb-3">
                          <label for="price" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>
                            <div class="col-md-8">
                              <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" placeholder="Rp." readonly>

                                @error('price')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- discount -->
                        <div class="row mb-3">
                          <label for="discount_id" class="col-md-4 col-form-label text-md-end">Discount (%)</label>
                          <div class="col-md-8">
                              <!-- <select id="inputDiscount" class="form-control custom-select" onchange="selectDiscount()" required>
                                              <option value="" selected disabled>Select discount...</option>
                                                  @foreach( $discounts as $discount)                                    
                                                  <option value="{{$discount}}">{{$discount->discount}}</option>
                                                  @endforeach
                                              
                              </select> -->
                              <input type="number" min="0" id="inputDiscount" name="discount" class="form-control" onchange="selectDiscount()"  placeholder="type discount.. (%)" required>
                              <input type="hidden" id="discount">
                          </div>
                        </div>

                        <!-- payment -->
                        <div class="row mb-3">
                          <label for="payment" class="col-md-4 col-form-label text-md-end">Payment Method</label>
                          <div class="col-md-8">
                              <select id="payment" class="form-control custom-select" name="payment_method" required>
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
                              <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" placeholder="type here..."></textarea>
                                @error('description')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <!-- summary -->
                        <div class="row mb-3">
                          <label for="summary" class="col-md-4 col-form-label text-md-end">Total (Rp)</label>
                            <div class="col-md-8">
                              <input id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}" required autocomplete="summary" placeholder="Rp." readonly>

                                @error('summary')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="btn d-flex justify-content-center" style="margin-top: 20px;">
                          <button type="reset" class="btn btn-danger mr-2 ">Cancel</button>
                          <button type="submit" class="btn btn-primary ml-2 ">Submit</button>
  
                        </div>
                      </div>
                      <!-- /.card-body -->

                      
                  </form>
                  </div>
                    
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
          <div class="col-6">
            <div class="card">
                <div class="card-header">
                  @if($orders->count())
                  <h3 class="card-title">Services on going <i class="ml-1 fa-solid fa-spinner"></i></h3>
                  @else
                  <h3 class="card-title">Services on going</h3>
                  @endif

                  <div class="card-tools">
                    <form action="/order">
                      <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" id="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
  
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
                              <a id="all"class="dropdown-item" href="#" value="2">Sort By All</a>
                              <a id="finish"class="dropdown-item" href="#" value="2">Sort By Finish ({{$finish}})</a>
                              <a id="onGoing" class="dropdown-item" href="#" value="1">Sort By On Going ({{$onGoing}})</a>
                              <a id="pending" class="dropdown-item" href="#" value="0">Sort By Pending ({{$pending}})</a>
                            </div>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" id="show-on-going" style="height: px;">
                  <table id="table-view" class="table table-head-fixed table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Therapist</th>
                        <th class="text-center">Duration</th>
                        <!-- <th>End</th> -->
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($extra_time->count())
                            @foreach($extra_time as $extm)
                            <tr>
                              @if($extm->start_extra_time == Null)
                              <td>#{{ $extm->orderID }}</td>
                              <td><a href="#" data-toggle="modal" class="show_service" data-target="#showservice" data-bs-cust="{{$extm->cust_name}}" data-bs-therapist="{{ $extm->name }}" data-bs-massage="{{$extm->massage}}" data-bs-duration="{{ $extm->time }}" data-bs-price="{{ $extm->summary }}" data-bs-start="{{ $extm->start_service }}" data-bs-end="{{ $extm->end_service }}" data-bs-place="{{ $extm->place }}" data-bs-orderId="#{{ $extm->orderID }}">{{ $extm->cust_name }}</a> </td>
                              <td>{{ $extm->nickname }}</td>
                              <td class="text-center">{{ $extm->start_service}} -{{ $extm->end_service}}</td>
                              <!-- <td>{{ $extm->end_service}}</td> -->
                              @if($extm->start_service == null)
                              <td><button class="btn btn-danger orderid" data-toggle="modal" data-target="#confirmOrder" data-bs-id="{{ $extm->id }}" data-bs-cust="{{ $extm->cust_name }}" data-bs-therapist="{{ $extm->name }}" data-bs-massage="{{ $extm->massage }}"  data-bs-time="{{ $extm->time }}" data-bs-place="{{ $extm->place }}" data-bs-orderId="#{{ $extm->orderID }}">Pending</button></td>
                              @elseif($extm->status == 'on going')
                              <td><a href="#" data-toggl="modal" data-target="extraTime" class="extraTime" data-bs-id="{{ $extm->id }}" data-bs-cust="{{ $extm->cust_name }}" data-bs-therapist="{{ $extm->name }}" data-bs-massage="{{ $extm->massage }}"  data-bs-time="{{ $extm->time }}" data-bs-therapistId="{{ $extm->therapistId }}" data-bs-massage="{{ $extm->massage }}" data-bs-end="{{ $extm->end_service }}" data-bs-orderId="#{{ $extm->orderID }}" data-summary="{{ $extm->summary }}"><span class="badge badge-warning">On Going <span class="badge badge-danger">!</span></span></a> <a href="#" class="cancel" data-bs-target="{{$extm->id}}" data-bs-name="{{$extm->cust_name}}" ><span class="badge badge-danger">x</span></a></td>
                              @else
                              <td><span class="badge badge-success">Completed!</span></td>
                              @endif
                              @else
                              <td>#{{ $extm->orderID }}</td>
                              <td><a href="#" data-toggle="modal" class="show_service2" data-target="#showservice2" data-bs-cust="{{$extm->cust_name}}" data-bs-therapist="{{ $extm->name }}" data-bs-massage="{{$extm->massage}}" data-bs-duration="{{ $extm->time }}" data-bs-price="{{ $extm->summary }}" data-bs-start="{{ $extm->start_service }}" data-bs-end="{{ $extm->end_service }}" data-bs-extra="{{ $extm->extra_time }}" data-bs-massageExtra="{{ $extm->massageExtra }}" data-bs-priceExtra="{{ $extm->priceExtra }}" data-bs-endExtra="{{ $extm->end_extra_time }}" data-bs-place="{{ $extm->place }}" data-bs-orderId="#{{ $extm->orderID }}" data-summary="{{ $extm->summary_extra_time }}">{{ $extm->cust_name }}*</a> </td>
                              <td>{{ $extm->nickname }}</td>
                              <td class="text-center">{{ $extm->start_extra_time}} - {{ $extm->end_extra_time}}</td>
                              <!-- <td>{{ $extm->end_extra_time}}</td> -->
                              @if($extm->status === 'finish')
                              <td><span class="badge bg-olive">Completed!</span></td>
                              @else
                              <td><span class="badge badge-primary" >Extra Time</span> <a href="#"><span class="badge badge-danger cancelExtra" data-bs-name="{{ $extm->cust_name }}" data-bs-target="{{ $extm->extraId }}">x</span></a></td>
                              @endif
                              
                              @endif
                            
                            </tr>
                            @endforeach

                          <!--  -->
                          </tr>
                        

                      @else
                      <tr>
                        <td colspan="7"><div class="session text-center">No service found right now!</div></td>
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

<!-- modal edit -->
        <div class="modal fade" id="confirmOrder">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Confirmation <span class="title-only"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    @if($orders->count())
                    <form action="/order/edit/{{ $order->id }}" method="post">
                      @method('put')
                      @csrf
                      <!--cust name -->
                      <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden" id="order_id" name="orderID">
                                        <input id="editOrder" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus readonly>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Therapist</label>

                                      <div class="col-md-8">
                                          <input id="editTherapist" type="text" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="editEmail" class="col-md-4 col-form-label text-md-end">Massage</label>

                                      <div class="col-md-8">
                                          <input id="editMassage" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus readonly>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Time Duration</label>

                                      <div class="col-md-8">
                                          <input id="editTime" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Room</label>

                                      <div class="col-md-8">
                                          <input id="editPlace" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time start -->
                                  <div class="row mb-3">
                                      <label for="" class="col-md-4 col-form-label text-md-end"></label>

                                      <div class="col-md-8">
                                          <input id="time-Start" type="hidden" class="form-control @error('') is-invalid @enderror" name="start_service" value="{{ old('') }}" required autocomplete="" autofocus>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time end -->
                                  <div class="row mb-3">
                                      <label for="" class="col-md-4 col-form-label text-md-end"></label>

                                      <div class="col-md-8">
                                          <input id="time-End" type="hidden" class="form-control @error('') is-invalid @enderror" name="end_service" value="{{ old('') }}" required autocomplete="" autofocus>

                                          @error('')
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
                                <button type="submit" class="btn btn-primary">Start Service</button>
                              </div>
                  </form>
                    @else
                    @endif
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>

        <!-- extratime -->
        <div class="modal fade" id="extraTime">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Extra Time <span class="title-only"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    
                    @if($extra_time->count())
                    <form action="/extratime/edit/{{ $extm->extraId }}" method="post">
                      @method('put')
                      @csrf
                      <!--cust name -->
                      <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden" id="order_extra" name="order_extra">
                                        <input  type="text" class="form-control @error('name') is-invalid @enderror editOrder" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus readonly>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Therapist</label>

                                      <div class="col-md-8">
                                        <input type="hidden" id="therapist_id" name="therapist_id">
                                          <input  type="text" min="0" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="editEmail" class="col-md-4 col-form-label text-md-end">Massage</label>

                                      <div class="col-md-8">
                                      <select id="editMassageAja" class=" form-control custom-select" onchange="selectMassageExtra()" required>
                                          <option value="" selected disabled>Select Massage...</option>
                                          @foreach($massages as $massage)
                                          <option value="{{ $massage }}" >{{ $massage->massage }}</option>
                                          @endforeach
                                        </select>
                                        
                                        <input type="hidden" id="service_extra_time_id" name="service_extra_time_id">
                                          <!-- <input  class="editMassage form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                                          
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>

                                      <div class="col-md-8">
                                          <input  type="number" min="0" class="editTime form-control @error('password') is-invalid @enderror" name="extra_time" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time start -->
                                  
                                      <div class="col-md-8">
                                          <input  type="hidden" class="time-Start form-control @error('') is-invalid @enderror" name="start_extra_time" value="{{ old('') }}" required autocomplete="" autofocus>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>

                                  <!-- time end -->
                                      <div class="col-md-8">
                                          <input  type="hidden" class="time-End form-control @error('') is-invalid @enderror" name="end_extra_time" value="{{ old('') }}" required autocomplete="" autofocus>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>

                                  <!-- price extra time-->
                                  <div class="row mb-3">
                                      <label for="" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>

                                      <div class="col-md-8">
                                        <input type="hidden"  id="price-extra">
                                          <input  type="text" id="price-real"  class="price-extra form-control @error('') is-invalid @enderror" name="price_extra_time" value="{{ old('') }}" required autocomplete="" autofocus>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <input type="hidden" id="summary_extra">
                                  <input type="hidden" id="summary_order">
                                  <input type="hidden" id="sum_extra" name="summary_extra_time">

                                  
                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Start Service</button>
                              </div>
                  </form>
                    @else
                    @endif
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>

        <!-- show service extra time = null -->
        <div class="modal fade" id="show-service">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title orderID">Service Detail <span class="title-only"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    @if($orders->count())
                    <form action="/order/editExtra/{{ $order->id }}" method="post">
                      @method('put')
                      @csrf
                      <!--cust name -->
                      <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden"  name="order_name">
                                        <input  type="text" id="cust_name" class="form-control @error('name') is-invalid @enderror editOrder" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus readonly>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Therapist</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="therapist_name" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="editEmail" class="col-md-4 col-form-label text-md-end">Massage</label>

                                      <div class="col-md-8">
                                        <input type="text" id="service" name="service_extra_time_id" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="duration" class="editTime form-control @error('password') is-invalid @enderror" name="extra_time" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Room</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="place1" class="editTime place form-control @error('password') is-invalid @enderror" name="extra_time" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- price -->
                                  <div class="row mb-3">
                                      <label for="" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="price_real"  class="price-extra form-control @error('') is-invalid @enderror" name="price_extra_time" value="{{ old('') }}" required autocomplete="" autofocus readonly>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Start Service</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="start_service" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">End Service</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="end_service" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
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
                    @else
                    @endif
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>

        <!-- show service extra time != null -->
        <div class="modal fade" id="showservice2">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Service Details <span class="title-only"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    @if($orders->count())
                    <form action="/order/editExtra/{{ $order->id }}" method="post">
                      @method('put')
                      @csrf
                                  <!--cust name -->
                                  <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Customer Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden"  name="order_name">
                                        <input  type="text" id="cust_name2" class="form-control @error('name') is-invalid @enderror editOrder" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus readonly>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  

                                  <!-- therapist -->
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Therapist</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="therapist_name2" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="editEmail" class="col-md-4 col-form-label text-md-end">Massage</label>

                                      <div class="col-md-8">
                                        <input type="text" id="service2" name="service_extra_time_id" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="duration2" class="editTime form-control @error('password') is-invalid @enderror" name="extra_time" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="editTime" class="col-md-4 col-form-label text-md-end">Room</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="place2" class="editTime place form-control @error('password') is-invalid @enderror" name="extra_time" value="{{ old('password') }}" required autocomplete="password" autofocus readonly>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- price -->
                                  <div class="row mb-3">
                                      <label for="" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="price_real2"  class="price-extra form-control @error('') is-invalid @enderror" name="price_extra_time" value="{{ old('') }}" required autocomplete="" autofocus readonly>

                                          @error('')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Start Service</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="start_service2" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">End Service</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="end_service2" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  @if($order->extra_time == Null)
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Extra Time</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="extra" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Massage (extra time)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="massageExtra" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Price (extra time)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="priceExtra" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Start (extra time)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="startExtra" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">End (extra time)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="endExtra" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Summary (Rp)</label>

                                      <div class="col-md-8">
                                          <input  type="text" id="Sum" class=" editTherapist form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus readonly>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  @else
                                  @endif


                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                  </form>
                    @else
                    @endif
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>


    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" ></script>
  <script src="/js/order.js"></script>
    
@endsection