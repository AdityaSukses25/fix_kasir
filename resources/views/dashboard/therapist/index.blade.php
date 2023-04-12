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
              <form action="/therapist" class="date-sales mr-2">
                  <div class="input-group input-group-sm">
                        <input type="text" name="search" id="search" class="form-control float-right rounded-left py-3" placeholder="Search" value="{{ request('search') }}">
                        <input type="hidden" id="sort_id" name="status" data-start="{{ request('start_date') }}" data-end="{{ request('end_date') }}" data-name="{{ request('search') }}"class="form-control float-right rounded-left py-3" placeholder="Search" value="">
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
                                <a id="all" class="dropdown-item" href="#" value="1">Sort By All</a>
                                <a id="on" class="dropdown-item" href="#" value="1">Sort By Day On </a>
                                <a id="off" class="dropdown-item" href="#" value="0">Sort By Day Off </a>
                                <a id="inactive"class="dropdown-item" href="#" value="0">Sort By Inactive </a>
                              </div>
    
                              
                            </div>
                  </div>
              </form>
              @can('admin')
              <button class="btn btn-primary" data-target="#addTerapist" data-toggle="modal">
                <li class="breadcrumb-item"><i class="fa-solid fa-user-plus"></i>  Add Therapist</li>
              </button>
              @endcan
              
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
              <div class="card-body table-responsive p-0" id="therapist-table">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Name</th>
                      <th >Nickname</th>
                      <th >Phone</th>
                      <th >Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($terapists->count())
                    @foreach($terapists as $terapist)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ $terapist->name }}</td>
                      <td>{{ $terapist->nickname }}</td>
                      <td>{{ $terapist->phone }}</td>
                      <td>
                        @if ($terapist->status > 2)
                          <span class="badge badge-success">Day On</span>
                        @elseif($terapist->status == 2)
                          <span class="badge badge-warning">Day Off</span>
                        @else
                          <span class="badge badge-danger">Inactive</span>
                        @endif
                      </td>
                      <td>
                        <div class="row justify-content-center">
                          @if($terapists->count() < 2)
                          <div class="col-md">
                            <button type="button" class="editTerapist btn btn-block btn-warning" data-toggle="modal" data-target="#editTerapist"  data-bs-name="{{ $terapist->name }}" data-bs-terapist="{{ $terapist->id }}" data-bs-nickname="{{ $terapist->nickname }}" data-bs-number="{{ $terapist->phone }}" data-bs-gender="{{ $terapist->gender }}" data-bs-kehadiran="{{ $terapist->presence }}" data-bs-komisi="{{ $terapist->commision }}" data-bs-attend="{{ $terapist->status }}">
                            <i class="fa fa-edit"></i>
                            </button>
                          </div>
                          @else
                          <div class="col-md">
                            <button type="button" class="editTerapist btn btn-block btn-warning" data-toggle="modal" data-target="#editTerapist"  data-bs-name="{{ $terapist->name }}" data-bs-terapist="{{ $terapist->id }}" data-bs-nickname="{{ $terapist->nickname }}" data-bs-number="{{ $terapist->phone }}" data-bs-gender="{{ $terapist->gender }}" data-bs-kehadiran="{{ $terapist->presence }}" data-bs-komisi="{{ $terapist->commision }}" data-bs-attend="{{ $terapist->status }}">
                            <i class="fa fa-edit"></i>
                            </button>
                          </div>
                          <!-- <div class="col-md-4"> -->
                            
                            <!-- <button type="submit" class="deleteTherapist btn btn-block btn-danger" data-bs-target="{{ $terapist->id}}" data-bs-name="{{ $terapist->name }}" >
                            <i class="fa-sharp fa-solid fa-delete-left text-dark"></i>
                            </button> -->
                            <!-- <button type="submit" class="deleteTherapist btn btn-block btn-danger" data-bs-target="{{ $terapist->id}}" data-bs-name="{{ $terapist->name }}">
                            <i class="fa-sharp fa-solid fa-delete-left"></i>
                            </button> -->
                          <!-- </div> -->
                          @endif
                        </div>

                        
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td colspan="6" class="text-center">No Therapist Found Right Now.</td>
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
    
        
      
    </section>

    <!-- modal content -->
    <div class="content">
      <div class="container-fluid">
        <!-- modal add --> 
        <div class="modal fade" id="addTerapist">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Therapist</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/therapist/create" method="post">
                      @csrf
                                  <!-- name -->
                                  <div class="row mb-3">
                                      <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- nickname -->
                                  <div class="row mb-3">
                                      <label for="nickname" class="col-md-4 col-form-label text-md-end">Nickname</label>

                                      <div class="col-md-8">
                                          <input id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                                          @error('nickname')
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
                                          <input id="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- gender -->
                                  <div class="row mb-3">
                                      <label for="gender" class="col-md-4 col-form-label text-md-end">Gender</label>
                                      <div class="col-8">
                                        <select id="gender" class="form-control custom-select" name="gender">
                                          <option value="" selected disabled>Select gender...</option>
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>
                                        </select>
                                      </div>
                                  </div>

                                  <!-- kehadiran
                                  <div class="row mb-3">
                                      <label for="presence" class="col-md-4 col-form-label text-md-end">Presence</label>

                                      <div class="col-md-8">
                                          <input id="presence" type="text" class="form-control @error('presence') is-invalid @enderror" name="presence" value="{{ old('presence') }}" required autocomplete="presence" autofocus>

                                          @error('presence')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div> -->

                                  <!-- commision -->
                                  <div class="row mb-3">
                                      <label for="commision" class="col-md-4 col-form-label text-md-end">Commision</label>

                                      <div class="col-md-8">
                                          <input id="commision" type="number" min="0" class="form-control @error('commision') is-invalid @enderror" name="commision" value="{{ old('commision') }}" required autocomplete="commision" autofocus>

                                          @error('commision')
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
      <!-- /.end add therapist -->

        <!-- modal edit --> 
        <div class="modal fade" id="editTerapist">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Therapist</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    @if($terapists->count())
                    
                    @foreach($terapists as $terapist)
                    <form action="/therapist/edit/{{ $terapist->id }}" method="post">
                    @endforeach

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

                                  <!-- nickname -->
                                  <div class="row mb-3">
                                      <label for="nickname" class="col-md-4 col-form-label text-md-end">Nickname</label>

                                      <div class="col-md-8">
                                          <input id="editNickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                                          @error('nickname')
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
                                          <input id="editPhone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- gender -->
                                  <div class="row mb-3">
                                      <label for="gender" class="col-md-4 col-form-label text-md-end">Gender</label>
                                      <div class="col-8">
                                        <select id="editGender" class="form-control custom-select" name="gender">
                                          <option value="" selected disabled>Select gender...</option>
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>
                                        </select>
                                      </div>
                                  </div>

                                  <!-- attend -->
                                  <div class="row mb-3">
                                      <label for="attend" class="col-md-4 col-form-label text-md-end">Attended</label>
                                      <div class="col-8">
                                        <select id="editAttend" class="form-control custom-select" name="status">
                                          <option value="" selected disabled>Select attended...</option>
                                              <option value="2">Day Off</option>
                                              <option value="3">Day On</option>
                                              <option value="1">Inactive</option>
                                        </select>
                                      </div>
                                  </div>

                                  <!-- kehadiran -->
                                  <!-- <div class="row mb-3">
                                      <label for="presence" class="col-md-4 col-form-label text-md-end">Presence</label>

                                      <div class="col-md-8">
                                          <input id="editPresence" type="text" class="form-control @error('presence') is-invalid @enderror" name="presence" value="{{ old('presence') }}" required autocomplete="presence" autofocus>

                                          @error('presence')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div> -->

                                  <!-- commision -->
                                  @can('reception')
                                  <div class="row mb-3">

                                      <div class="col-md-8">
                                        <input id="editCommision" type="hidden" class="form-control @error('commision') is-invalid @enderror" name="commision" value="{{ old('commision') }}" required autocomplete="commision" autofocus>

                                        @error('commision')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                        </div>
                                      </div>
                                      
                                      
                                  </div>
                                  @endcan
                                  @can('admin')
                                  <div class="row mb-3">
                                      <label for="commision" class="col-md-4 col-form-label text-md-end">Commision</label>

                                      <div class="col-md-8">
                                        <input id="editCommision" type="number" min="0" class="form-control @error('commision') is-invalid @enderror" name="commision" value="{{ old('commision') }}" required autocomplete="commision" autofocus>

                                        @error('commision')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                          @enderror
                                        </div>
                                      </div>
                                      
                                      
                                  </div>
                                  @endcan
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
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
          <!-- /.end edit therapist -->

        <!-- modal time_start -->
        <div class="modal fade" id="time_start">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Therapist Presence</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/attendence/create" method="post">
                      @csrf
                                  <!-- name -->
                                  <div class="row mb-3">
                                      <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <div class="col-md-8">
                                        <input id="start_id" type="hidden" class="form-control @error('name') is-invalid @enderror" name="therapist_id" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <input id="start_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- Time_in -->
                                  <div class="row mb-3">
                                      <label for="nickname" class="col-md-4 col-form-label text-md-end">Time Start</label>

                                      <div class="col-md-8">
                                          <input id="time_in" type="text" class="form-control @error('nickname') is-invalid @enderror" name="time_start" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>

                                          @error('nickname')
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
        <!-- end time_start -->
      </div>
    </div>
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" ></script>


<script src="/js/therapist.js"></script>
    
@endsection