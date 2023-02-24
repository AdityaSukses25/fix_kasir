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
              <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-end" data-toggle="dropdown">
              <i class="fa-solid fa-plus"></i> Add Data
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-target="#addService" data-toggle="modal">Add Massage</a>
                <a class="dropdown-item" href="#" data-target="#addPlace" data-toggle="modal">Add Place</a>
                <a class="dropdown-item" href="#" data-target="#addDiscount" data-toggle="modal">Add Discount</a>
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
          <!-- massage -->
          <div class="col-6">
            <div class="card shadow">
              <div class="card-body table-responsive p-0" style="height: 638px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Massage</th>
                      <th >Time Duration</th>
                      <th >Price</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($massages as $massage)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $massage->massage }}</td>
                        <td>{{ $massage->time }}</td>
                        <td>{{ Str::rupiah($massage->price) }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editMassage btn btn-block btn-default " data-toggle="modal" data-target="#editMassage" data-bs-massage="{{ $massage->massage }}" data-bs-id="{{ $massage->id }}" data-bs-time="{{ $massage->time}} " data-bs-price="{{ $massage->price }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-default " data-bs-target="{{ $massage->id}}" data-bs-name="{{ $massage->massage }}">
                              <i class="fa-sharp fa-solid fa-delete-left"></i>
                              </button>
                            </div>
                          </div>

                          
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- place -->
          <div class="col-3">
            <div class="card shadow">
              <div class="card-body table-responsive p-0" style="height: 638px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Place</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($places as $place)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $place->place }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editplace btn btn-block btn-default " data-toggle="modal" data-target="#editplace" data-bs-id="{{ $place->id }}" data-bs-place="{{ $place->place }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-default " data-bs-target="{{ $place->id}}" data-bs-name="{{ $place->place }}">
                              <i class="fa-sharp fa-solid fa-delete-left"></i>
                              </button>
                            </div>
                          </div>

                          
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- discount -->
          <div class="col-3">
            <div class="card shadow">
              <div class="card-body table-responsive p-0" style="height: 638px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Discount</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($discounts as $discount)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $discount->discount }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editdiscount btn btn-block btn-default" data-toggle="modal" data-target="#editdiscount" data-bs-id="{{$discount->id}}" data-bs-discount="{{$discount->discount}}">
                              <i class="fa fa-edit"></i>
                              </button>
                            </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-default " data-bs-target="{{ $discount->id}}" data-bs-name="{{ $discount->discount }}">
                              <i class="fa-sharp fa-solid fa-delete-left"></i>
                              </button>
                            </div>
                          </div>

                          
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    
        
      
    </section>

    <!-- service -->
    <div class="content">
      <div class="container-fluid">
        <!-- modal add service--> 
        <div class="modal fade" id="addService">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Service</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/service/create" method="post">
                      @csrf
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

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration</label>

                                      <div class="col-md-8">
                                          <input id="time" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" autofocus>

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
                                          <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end add service -->

      <!-- modal edit service--> 
      <div class="modal fade" id="editMassage">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Service</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/service/edit/{{ $massage->id }}" method="post">
                      @method('put')
                      @csrf
                                  <!-- massage -->
                                  <div class="row mb-3">
                                      <label for="massage" class="col-md-4 col-form-label text-md-end">Massage</label>
                                      <input id="massage_id" type="hidden"  name="massage_name">

                                      <div class="col-md-8">
                                        <input id="edit_Massage" type="text" class="form-control @error('massage') is-invalid @enderror" name="massage" value="{{ old('massage') }}" required autocomplete="massage" autofocus>

                                          @error('massage')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration</label>

                                      <div class="col-md-8">
                                          <input id="editTime" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" autofocus>

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
                                          <input id="editPrice" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end edit service -->
      </div>
    </div>
    <!-- end service -->

    <!-- place -->
    <div class="content">
      <div class="container-fluid">
        <!-- modal add Place--> 
        <div class="modal fade" id="addPlace">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Place</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/place/create" method="post">
                      @csrf
                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="place" class="col-md-4 col-form-label text-md-end">Place</label>
                                      <div class="col-md-8">
                                        <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                          @error('place')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end add Place -->

      <!-- modal edit Place--> 
      <div class="modal fade" id="editplace">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Place</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/place/edit/{{ $place->id }}" method="post">
                      @method('put')
                      @csrf
                                  <!-- place -->
                                  <div class="row mb-3">
                                      <label for="place" class="col-md-4 col-form-label text-md-end">Place</label>
                                      <input id="place_id" type="hidden"  name="place_name">

                                      <div class="col-md-8">
                                        <input id="edit_place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                          @error('place')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end edit place -->
      </div>
    </div>
    <!-- end place -->

    <!-- discount -->
    <div class="content">
      <div class="container-fluid">
        <!-- modal add discount--> 
        <div class="modal fade" id="addDiscount">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add discount</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/discount/create" method="post">
                      @csrf
                                  <!-- discount -->
                                  <div class="row mb-3">
                                      <label for="discount" class="col-md-4 col-form-label text-md-end">Discount</label>
                                      <div class="col-md-8">
                                        <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount" autofocus>

                                          @error('discount')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end add discount -->

      <!-- modal edit discount--> 
      <div class="modal fade" id="editdiscount">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Discount</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/discount/edit/{{ $discount->id }}" method="post">
                      @method('put')
                      @csrf
                                  <!-- discount -->
                                  <div class="row mb-3">
                                      <label for="discount" class="col-md-4 col-form-label text-md-end">Discount</label>
                                      <input id="discount_id" type="hidden"  name="discount_name">

                                      <div class="col-md-8">
                                        <input id="edit_discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required autocomplete="discount" autofocus>

                                          @error('discount')
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
                                <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                  </form>
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
          </div>
        </div>
      <!-- /.end edit place -->
      </div>
    </div>
    <!-- end discount -->
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/service.js"></script>
    
@endsection