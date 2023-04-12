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
              <form action="/user" class="date-sales mr-2">
                    <div class="input-group input-group-sm">
                          <input type="text" name="search" id="search" class="form-control float-right rounded-left py-3" placeholder="Search" value="{{ request('search') }}">
                          <input type="hidden" id="sort_id" name="" data-start="{{ request('start_date') }}" data-end="{{ request('end_date') }}" data-name="{{ request('search') }}"class="form-control float-right rounded-left py-3" placeholder="Search" value="">
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
                                  <a id="owner" class="dropdown-item" href="#" value="1">Sort By Owner </a>
                                  <a id="reception" class="dropdown-item" href="#" value="0">Sort By Receptionist </a>
                                  <a id="inactive"class="dropdown-item" href="#" value="0">Sort By Inactive </a>
                                </div>
      
                                
                              </div>
                    </div>
                </form>
              <button class="btn btn-primary" data-target="#addUser" data-toggle="modal">
                <li class="breadcrumb-item"><i class="fa-solid fa-user-plus"></i>  Add Receptionist</li>

              </button>
              
                            
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
              <div class="card-body table-responsive p-0" id="reception-table">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th >No</th>
                      <th >Name</th>
                      <th >username</th>
                      <th >Phone</th>
                      <th >Email</th>
                      <th >Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if($users->count())
                      @foreach($users as $user)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        @if( $user->status == 1)
                        <td>Owner</td>
                        @elseif($user->status == 2)
                        <td>Receptionist</td>
                        @else
                        <td ><span class="badge badge-danger p-1">Inactive</span></td>
                        @endif
                        <td>
                          <div class="row justify-content-center">
                            @if($users->count() < 2)
                            <div class="col-md">
                              <button type="button" class="editUser btn btn-block btn-warning" data-toggle="modal" data-target="#editUser"  data-bs-name="{{ $user->name }}" data-bs-user="{{ $user->id }}" data-bs-username="{{ $user->username }}" data-bs-phone="{{ $user->phone }}"  data-bs-email="{{ $user->email }}"      data-bs-status="{{ $user->status }}" data-bs-password="{{ $user->password }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            @else
                            <div class="col-md">
                              <button type="button" class="editUser btn btn-block btn-warning" data-toggle="modal" data-target="#editUser"  data-bs-name="{{ $user->name }}" data-bs-user="{{ $user->id }}" data-bs-username="{{ $user->username }}" data-bs-phone="{{ $user->phone }}"  data-bs-email="{{ $user->email }}"      data-bs-status="{{ $user->status }}" data-bs-password="{{ $user->password }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <!-- <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-danger" data-bs-target="{{ $user->id}}" data-bs-name="{{ $user->name }}">
                              <i class="fa-sharp fa-solid fa-delete-left"></i>
                              </button>
                            </div> -->
                            @endif
                          </div>

                          
                        </td>
                      </tr>
                      @endforeach
                      
                      @else
                      <tr>
                        <td colspan="8" class="text-center">No User Found!</td>
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

    <div class="content">
      <div class="container-fluid">
        <!-- modal add --> 
        <div class="modal fade" id="addUser">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Receptionist</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/reception/create" method="post">
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

                                  <!-- username -->
                                  <div class="row mb-3">
                                      <label for="username" class="col-md-4 col-form-label text-md-end">Username</label>

                                      <div class="col-md-8">
                                          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

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
                                          <input id="phone" type="number" min="0"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- email -->
                                  <div class="row mb-3">
                                      <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                      <div class="col-md-8">
                                          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- password -->
                                  <div class="row mb-3">
                                      <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                      <div class="col-md-8">
                                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="gender" class="col-md-4 col-form-label text-md-end">Status</label>
                                      <div class="col-8">
                                        <select id="gender" class="form-control custom-select" name="status">
                                          <option value="" selected disabled>Select Status...</option>
                                                                                  
                                              <option value="1">Owner</option>
                                              <option value="2">Receptionist</option>
                                        </select>
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
      <!-- /.end add reception -->

        <!-- modal edit --> 
        <div class="modal fade" id="editUser">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit User</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    @if($users->count())
                    @foreach($users as $user)
                    @endforeach
                    <form action="/reception/edit/{{ $user->id }}" method="post">
                      @method('put')
                      @csrf
                      <!-- name -->
                      <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden" id="user_id" name="user_name">
                                        <input id="editName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- username -->
                                  <div class="row mb-3">
                                      <label for="editUsername" class="col-md-4 col-form-label text-md-end">Username</label>

                                      <div class="col-md-8">
                                        @if($user->username === 'aditya')
                                        <input id="editUsername" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" readonly>

                                        @else
                                        <input id="editUsername" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                        @endif

                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- phone -->
                                  <div class="row mb-3">
                                      <label for="editPhone" class="col-md-4 col-form-label text-md-end">Phone</label>

                                      <div class="col-md-8">
                                          <input id="editPhone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                          @error('phone')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  
                                  <!-- email -->
                                  <div class="row mb-3">
                                      <label for="editEmail" class="col-md-4 col-form-label text-md-end">Email</label>

                                      <div class="col-md-8">
                                          <input id="editEmail" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- password -->
                                  <div class="row mb-3">
                                      <label for="editPassword" class="col-md-4 col-form-label text-md-end">Password</label>

                                      <div class="col-md-8">
                                          <input id="editPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="editStatus" class="col-md-4 col-form-label text-md-end">Status</label>
                                      <div class="col-8">
                                        <select id="editStatus" class="form-control custom-select" name="status">
                                          <option value="" selected disabled>Select Status...</option>
                                          @if($user->username ==='aditya')
                                          <option value="1" >Owner</option>
                                          @else
                                          <option value="1" >Owner</option>
                                          <option value="2">Receptionist</option>
                                          <option value="3">Inactive</option>
                                          @endif
                                        </select>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
      </div>
    </div>
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/reception.js"></script>
    
@endsection