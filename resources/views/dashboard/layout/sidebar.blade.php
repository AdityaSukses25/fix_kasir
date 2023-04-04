<aside class="main-sidebar sidebar-dark-primary elevation-4 " style="height: 100vh">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="/assets/logo_lotus/logo_dashboard.png" alt="Lotus Logo" class="brand-image img-circle elevation-3" >
      <span class="brand-text font-weight-light">Lotus Massage Echo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
        <div class="image mt-2 d-none">
          <img src="../template/Admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="edit-personal d-block text-capitalize" data-toggle="modal" data-target="#edit-personal" data-bs-id="{{ auth()->user()->id }}" data-bs-name="{{ auth()->user()->name }}" data-bs-username="{{ auth()->user()->username }}" data-bs-phone="{{ auth()->user()->phone }}" data-bs-email="{{ auth()->user()->email }}" data-bs-password="{{ auth()->user()->password }}" data-bs-status="{{ auth()->user()->status }}">{{ auth()->user()->name }} <i class="d-none fa fa-user-pen user-personal"></i></a>
          @if(auth()->user()->status == 1)
          <small class="text-light">you're logged in as Owner</small>
          @else
          <small class="text-light">you're logged in as Receptionist</small>
          @endif
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }} nav-link">
              <i class="nav-icon  fas fa-tachometer-alt"></i> 
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @can('reception')
          <li class="nav-item">
            <a href="/order" class="nav-link {{ Request::is('order') ? 'active' : '' }}">
            <i class="fa fa-file-pen nav-icon"></i>
            <p>
              Orders
              </p>
            </a>
          </li>
          @endcan

          
          <li class="nav-item">
            <a href="/service" class="nav-link {{ Request::is('service') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Service
              </p>
            </a>
          </li>
          
          @can('reception')
          <li class="nav-item">
            <a href="/therapist" class="nav-link {{ Request::is('therapist') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Therapists
            </p>
          </a>
        </li>
        @endcan
 
        @can('admin')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Employee
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/reception" class="nav-link {{ Request::is('reception') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/therapist" class="nav-link {{ Request::is('therapist') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Therapist</p>
            </a>
          </li>
        </ul>
      </li>
      @endcan
      
      <li class="nav-item">
        <a href="/transaction-record" class="nav-link {{ Request::is('transaction-record') ? 'active' : '' }}">
        <i class="nav-icon fa fa-sack-dollar"></i>
          <p>
            Transaction Record
          </p>
        </a>
      </li>
      <li class="nav-item">
            <a href="/report" id="DetailService1" class="nav-link {{ Request::is('report') || Request::is('report/*') ? 'active' : '' }}">
            <i class="fa-solid fa-file-contract nav-icon"></i>
              <p>
                Reports
              </p>
            </a>
      </li>
      
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- modal edit --> 
  <div class="modal fade z-5" id="edit-personal">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Personal</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                    <form action="/user-personal/edit/{auth()->user()->id}" method="post">
                      @method('put')
                      @csrf
                      <!-- name -->
                      <div class="row mb-3">
                                      <label for="editName" class="col-md-4 col-form-label text-md-end">Name</label>
                                      <div class="col-md-8">
                                        <input type="hidden" id="user-id" name="user_name">
                                        <input id="edit-Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                          @error('name')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- username -->
                                  <div class="row mb-3">
                                      <label for="edit-Username" class="col-md-4 col-form-label text-md-end">Username</label>

                                      <div class="col-md-8">
                                        

                                        
                                        <input id="edit-Username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                          @error('username')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <!-- phone -->
                                  <div class="row mb-3">
                                      <label for="edit-Phone" class="col-md-4 col-form-label text-md-end">Phone</label>

                                      <div class="col-md-8">
                                          <input id="edit-Phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

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
                                        <input id="edit-Email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        <!-- password -->
                                          <input id="edit-Password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  

                                  <!-- status -->
                                  <div class="row mb-3">
                                      <label for="edit-Status" class="col-md-4 col-form-label text-md-end">Status</label>
                                      <div class="col-8">
                                        <select id="edit-Status" class="form-control custom-select" name="status">
                                          <option value="" selected disabled>Select Status...</option>
                                          @if(auth()->user()->status == 1)
                                          <option value="1" >Owner</option>
                                          @else
                                          <option value="2">Receptionist</option>
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
                </div>
              <!-- /.modal-content -->
              </div>
            <!-- /.modal-dialog -->
            </div>
    </div>
  </div>
          <!-- /.end edit therapist -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/js/sidebar.js"></script>
