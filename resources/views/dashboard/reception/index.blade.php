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
              <a href="#" data-target="#addUser" data-toggle="modal">
                <li class="breadcrumb-item"><i class="fa fa-plus"></i>  Add Receptionist</li>
              </a>
              
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
              <div class="card-body table-responsive p-0" style="height: 638px;">
                <table class="table table-head-fixed text-nowrap">
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
                      @foreach($users as $user)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-6">
                              <button type="button" class="editUser btn btn-block btn-default btn-lg" data-toggle="modal" data-target="#editUser"  data-bs-name="{{ $user->name }}" data-bs-user="{{ $user->id }}" data-bs-username="{{ $user->username }}" data-bs-phone="{{ $user->phone }}"  data-bs-email="{{ $user->email }}"      data-bs-status="{{ $user->status }}" data-bs-password="{{ $user->password }}">
                              <i class="fa fa-edit"></i>
                              </button>
      
                            </div>
                            <div class="col-md-6">
                              <button type="submit" class="delete btn btn-block btn-default btn-lg" data-bs-target="{{ $user->id}}" data-bs-name="{{ $user->name }}">
                              <i class="fa fas-delete"></i>
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
                                          <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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
                                                                                  
                                              <option value="Admin">Admin</option>
                                              <option value="Receptionist">Receptionist</option>
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
                  <h4 class="modal-title">Edit Receptionist</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
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
                                          <input id="editUsername" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

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
                                          <input id="editPhone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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
                                              <option value="Admin">Admin</option>
                                              <option value="Receptionist">Receptionist</option>
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