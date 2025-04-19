<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #24056b;">
    <!-- Brand Logo -->
    {{-- <a href="../../index3.html" class="brand-link">
        <img src="../pics/Brand_Logo.png" alt=""
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}
    <img src="" >
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h1 style=" text-decoration: none !important; text-align: center; width: 100%; color: white; ">API</h1>
        </div>
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="{{ route('admin.class') }}" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Class
                        </p>
                    </a>
                </li>

                
                





                <li class="nav-item">
                    <a href="{{route('admin.group')}}" class="nav-link">
                        <i class="nav-icon fas fa-group"></i>
                        <p>
                            Group
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.subject') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Subject
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.teacher') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Teacher
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                      <p>
                        Users
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                      <li class="nav-item ps-3">
                        <a href="{{ route('admin.teacher') }}" class="nav-link">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i>
                          <p>Teacher</p>
                        </a>
                      </li>
                      <li class="nav-item ps-3">
                        <a href="pages/charts/flot.html" class="nav-link">
                            <i class="fas fa-user-shield nav-icon"></i>
                          <p>Admin</p>
                        </a>
                      </li>
                      <li class="nav-item ps-3">
                        <a href="pages/charts/inline.html" class="nav-link">
                            <i class="fas fa-user-lock nav-icon"></i>
                          <p>Permission</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                <li class="nav-item">
                    <a href="{{ route('admin.student') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.attendance') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Attendance
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.schedule') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Schedule
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Evaluation
                        </p>
                    </a>
                </li><li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Report
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
