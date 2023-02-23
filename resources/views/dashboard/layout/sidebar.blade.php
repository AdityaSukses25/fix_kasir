<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="/assets/logo_lotus/logo_dashboard.png" alt="Lotus Logo" class="brand-image img-circle elevation-3" >
      <span class="brand-text font-weight-light">Lotus Massage Echo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image mt-2">
          <img src="../template/Admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-capitalize">{{ auth()->user()->name }}</a>
          <small class="text-light">you're logged in as {{ auth()->user()->status }}</small>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon  fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/order" class="nav-link">
              <i class="nav-icon fas fa-file "></i>
              <p>
                Orders
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/service" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Services
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/customer" class="nav-link">
            <i class="nav-icon fas fa-solid fa-user"></i>
              <p>
                Customers
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/therapist" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
              <p>
                Therapists
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
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
                <a href="/reception" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Receptionist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/therapist" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Therapist</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/report" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Reports
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
