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
              <div class="fil">
                <button type="button" class="py-2 btn btn-default dropdown-toggle dropdown-toggle-end mr-1" data-toggle="dropdown">
                    <i class=" fa fa-filter mr-1"></i>Filter By
                </button>
                  <div class="dropdown-menu">
                    <a id="all" class="dropdown-item" href="#" value="1">All</a>
                    <a id="active" class="dropdown-item" href="#" value="1">Active </a>
                    <a id="inactive"class="dropdown-item" href="#" value="0">Inactive </a>
                  </div>
              </div>
              
              <div class="a">
                <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown">
                  <i class="fa-solid fa-plus"></i> Add Data
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#" data-target="#addService" data-toggle="modal">Add Massage</a>
                  <a class="dropdown-item" href="#" data-target="#addPlace" data-toggle="modal">Add Room</a>
                  <!-- <a class="dropdown-item" href="#" data-target="#addDiscount" data-toggle="modal">Add Discount</a> -->
                </div>
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
              <div class="card-body table-responsive p-0 " id="service-table">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Massage</th>
                      <th >Time Duration (mint)</th>
                      <th >Price (Rp)</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($massages as $massage)
                      <tr>

                        <td>{{$loop->iteration}}</td>
                        @if($massage->status > 1)
                        <td>{{ $massage->massage }}</td>
                        <td>{{ $massage->time }}'</td>
                        <td class="text-end">{{ Str::rupiah($massage->price) }}</td>
                        <td>
                          <div class="row">
                            @if($massages->count() == 2)
                            <div class="col">
                              <button type="button" class="editMassage btn btn-block btn-warning " data-toggle="modal" data-target="#editMassage" data-bs-massage="{{ $massage->massage }}" data-bs-id="{{ $massage->id }}" data-bs-time="{{ $massage->time}} " data-bs-price="{{ $massage->price }}" data-bs-status="{{ $massage->status }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            @else
                            <div class="col-md">
                              <button type="button" class="editMassage btn btn-block btn-warning " data-toggle="modal" data-target="#editMassage" data-bs-massage="{{ $massage->massage }}" data-bs-id="{{ $massage->id }}" data-bs-time="{{ $massage->time}} " data-bs-price="{{ $massage->price }}" data-bs-status="{{ $massage->status }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            <!-- </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-danger" data-bs-target="{{ $massage->id}}" data-bs-name="{{ $massage->massage }}">
                              <i class="fa-sharp fa-solid fa-delete-left text-dark"></i>
                              </button>
                            </div> -->
                            @endif
                          </div>

                          
                        </td>
                        @else
                        <td class="text-danger">{{ $massage->massage }}</td>
                        <td class="text-danger">{{ $massage->time }}'</td>
                        <td class="text-end text-danger">{{ Str::rupiah($massage->price) }}</td>
                        <td>
                          <div class="row">
                            @if($massages->count() < 2)
                            <div class="col">
                              <button type="button" class="editMassage btn btn-block btn-warning " data-toggle="modal" data-target="#editMassage" data-bs-massage="{{ $massage->massage }}" data-bs-id="{{ $massage->id }}" data-bs-time="{{ $massage->time}} " data-bs-price="{{ $massage->price }}" data-bs-status="{{ $massage->status }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            @else
                            <div class="col-md">
                              <button type="button" class="editMassage btn btn-block btn-warning " data-toggle="modal" data-target="#editMassage" data-bs-massage="{{ $massage->massage }}" data-bs-id="{{ $massage->id }}" data-bs-time="{{ $massage->time}} " data-bs-price="{{ $massage->price }}" data-bs-status="{{ $massage->status }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            <!-- </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-danger" data-bs-target="{{ $massage->id}}" data-bs-name="{{ $massage->massage }}">
                              <i class="fa-sharp fa-solid fa-delete-left text-dark"></i>
                              </button>
                            </div> -->
                            @endif
                          </div>

                          
                        </td>
                        @endif
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
          <div class="col-6">
            <div class="card shadow">
              <div class="card-body table-responsive p-0" id="place-table">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Room</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($places as $place)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        @if($place->status > 1)
                        <td>{{ $place->place }}</td>
                        <td>
                          <div class="row justify-content-center">
                            @if($places->count() < 2)
                            <div class="col-5 ">
                              <button type="button" class="editplace btn btn-block btn-warning " data-toggle="modal" data-target="#editplace" data-bs-id="{{ $place->id }}" data-bs-place="{{ $place->place }}" data-bs-status="{{ $place->status}}" data-bs-facility="{{ $place->facility }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            @else
                            <div class="col-5 ">
                              <button type="button" class="editplace btn btn-block btn-warning " data-toggle="modal" data-target="#editplace" data-bs-id="{{ $place->id }}" data-bs-place="{{ $place->place }}" data-bs-status="{{ $place->status}}" data-bs-facility="{{ $place->facility }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <!-- <div class="col-md-6">
                              <button type="submit" class="deleteplace btn btn-block btn-danger " data-bs-target="{{ $place->id}}" data-bs-name="{{ $place->place }}">
                              <i class="fa-sharp fa-solid fa-delete-left text-dark"></i>
                              </button>
                            </div> -->
                            @endif
                          </div>

                          
                        </td>
                        @else
                        <td class="text-red">{{ $place->place }}</td>
                        <td>
                          <div class="row justify-content-center">
                            @if($places->count() < 2)
                            <div class="col-5 ">
                              <button type="button" class="editplace btn btn-block btn-warning " data-toggle="modal" data-target="#editplace" data-bs-id="{{ $place->id }}" data-bs-place="{{ $place->place }}" data-bs-status="{{ $place->status}}" data-bs-facility="{{ $place->facility }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            @else
                            <div class="col-5 ">
                              <button type="button" class="editplace btn btn-block btn-warning " data-toggle="modal" data-target="#editplace" data-bs-id="{{ $place->id }}" data-bs-place="{{ $place->place }}" data-bs-status="{{ $place->status}}" data-bs-facility="{{ $place->facility }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <!-- <div class="col-md-6">
                              <button type="submit" class="deleteplace btn btn-block btn-danger " data-bs-target="{{ $place->id}}" data-bs-name="{{ $place->place }}">
                              <i class="fa-sharp fa-solid fa-delete-left text-dark"></i>
                              </button>
                            </div> -->
                            @endif
                          </div>

                          
                        </td>
                        @endif
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
                                        <input id="massage" type="text" class="form-control @error('massage') is-invalid @enderror " name="massage" value="{{ old('massage') }}" required autocomplete="massage" autofocus>

                                          @error('massage')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- time -->
                                  <div class="row mb-3">
                                      <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>

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
                                      <label for="price" class="col-md-4 col-form-label text-md-end">Price (Rp)</label>

                                      <div class="col-md-8">
                                          <input id="price" type="number" class="form-control @error('price') is-invalid @enderror rupiah" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

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
                                  @if($massage)
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
                                      <label for="time" class="col-md-4 col-form-label text-md-end">Time Duration (mint)</label>

                                      <div class="col-md-8">
                                          <input id="edit_Time" type="text" min="0" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="" autofocus>

                                          @error('time')
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
                                          <input id="editPrice" type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                          @error('price')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="price" class="col-md-4 col-form-label text-md-end">Status</label>

                                      <div class="col-md-8">
                                          <select id="editstatus" type="text" class="form-control @error('price') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                            <option value="2">Active</option>
                                            <option value="1">Inactive</option>
                                          </select>

                                          @error('status')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  @else
                                  <div class="row mb-3">
                                      <label for="massage" class="col-md-4 col-form-label text-md-end">Massage</label>
                                      <input id="massage_id" type="hidden"  name="massage_name">

                                      <div class="col-md-8">
                                        <input id="edit_Massage" type="text" class="form-control @error('massage') is-invalid @enderror" name="massage" value="{{ old('massage') }}" required autocomplete="massage" readonly>

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
                                          <input id="editTime" type="text" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time" readonly>

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
                                          <input id="editPrice" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" readonly>

                                          @error('price')
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
                                          <select id="editstatus" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                          </select>

                                          @error('status')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>
                                  @endif
                                 
                              


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
                                  <!-- room -->
                                  <div class="row mb-3">
                                      <label for="place" class="col-md-4 col-form-label text-md-end">Room</label>
                                      <div class="col-md-8">
                                        <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}" required autocomplete="place" autofocus>

                                          @error('place')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- facility -->
                                  <div class="row mb-3">
                                      <label for="facility" class="col-md-4 col-form-label text-md-end">Facility</label>
                                      <div class="col-md-8">
                                        <input id="facility" type="text" class="form-control @error('facility') is-invalid @enderror" name="facility" value="{{ old('facility') }}" required autocomplete="facility" autofocus>

                                          @error('facility')
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
                                      <label for="place" class="col-md-4 col-form-label text-md-end">Room</label>
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


                                  <!-- facility -->
                                  <div class="row mb-3">
                                      <label for="edit_facility" class="col-md-4 col-form-label text-md-end">Facility</label>

                                      <div class="col-md-8">
                                        <input id="edit_facility" type="text" class="form-control @error('facility') is-invalid @enderror" name="facility" value="{{ old('facility') }}"  autocomplete="facility" autofocus>

                                          @error('facility')
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
                                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                                          <option value="2">Active</option>
                                          <option value="1">Inactive</option>
                                        </select>

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

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/service.js"></script>
@endsection