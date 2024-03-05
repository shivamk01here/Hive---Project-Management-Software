  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#
    " class="brand-link">
      <img src="{{ asset('dist/img/ixambee-logo-for-dark-bg.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
           <span style="font-weight: light; font-style: italic; font-size: 24px; color: white; text-decoration: underline;">Ixambee</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar04.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-white">
          {{ session()->get('name') }}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <!-- <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> -->
            <li class="nav-item">
              <a href="{{route('dashboard')}}" class="nav-link">
              <i class="fas fa-home nav-icon"></i>  
                  <p>Home</p>
                </a>
              </li>
            <li class="nav-item">
              <a href="{{route('my-task')}}" class="nav-link">
              <i class="far fa-check-circle nav-icon"></i> 
                  <p>My Tasks</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('new-task')}}" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add Task</p>
                </a>
              </li>
              @if(session('user_id'))
              @if (in_array(session('user_id'), session('superuser_ids'))) 
              <li class="nav-item">
              <a href="{{route('tasklist')}}" class="nav-link">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Report Listing</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('admin-home')}}" class="nav-link">
                  <i class="fas fa-shield nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{route('sprintlisting')}}" class="nav-link">
                  <i class="fas fa-chart-bar"></i>
                  <p> Sprint listing</p>
              </a>
              </li>
              @endif
              @endif
              <li class="nav-item">
                <a href="{{route('signout')}}" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
              <!-- <li class="nav-item">
              <a href="{{route('sprint-view')}}" class="nav-link active">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>Create Sprint</p>
                </a>
              </li> --
            
          <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> -->
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('new-task')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Task</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('tasklist')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Report Listing</p>
                </a>
              </li>
            </ul> -->
          </li>
          <li class="nav-item has-treeview">
            <!-- <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Task Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a> -->
            <ul class="nav nav-treeview">
             
             
             
              <li class="nav-item">
                <!-- <a href="pages/examples/recover-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a> -->
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <!-- <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/login.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login</p>
                </a>
              </li> -->
              <li class="nav-item">
                <!-- <a href="pages/examples/register.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a> -->
              </li>
              
              <li class="nav-item">
                <!-- <a href="pages/examples/recover-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a> -->
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<script>
 
  const currentRoute = window.location.href; 
  const navLinks = document.querySelectorAll('.nav-item a');

  navLinks.forEach((link) => {
    const href = link.getAttribute('href');

    
    if (currentRoute.includes(href)) {
      link.classList.add('active');
    }
  });
</script>






