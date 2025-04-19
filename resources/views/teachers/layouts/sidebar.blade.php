{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #24056b;"> --}}
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
                    <a href="{{ route('teachers.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('teachers.student') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Classes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        @foreach($teacherClasses as $class)
                            <li class="nav-item ps-3">
                                <a href="{{ route('students.index', ['class_id' => $class->id]) }}" class="nav-link">
                                    <i class="fas fa-chalkboard nav-icon"></i>
                                    <p>{{ $class->class_name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-group"></i>
                        <p>
                            Attendance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        @foreach($teacherClasses as $class)
                            <li class="nav-item ps-3">
                                <a href="{{ route('attendances.index', ['class_id' => $class->id]) }}" class="nav-link">
                                    <i class="fas fa-chalkboard nav-icon"></i>
                                    <p>{{ $class->class_name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Evaluation
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        @foreach($teacherClasses as $class)
                            <li class="nav-item ps-3">
                                <a href="{{ route('evaluations.index', ['class_id' => $class->id]) }}" class="nav-link">
                                    <i class="fas fa-chalkboard nav-icon"></i>
                                    <p>{{ $class->class_name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('teachers.schedule') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Schedule
                        </p>
                    </a>
                </li>
                
                
                


                
                {{-- <li class="nav-item">
                    <a href="{{ route('teachers.attendance') }}" class="nav-link">
                        <i class="nav-icon fas fa-group"></i>
                        <p>
                            Attendance
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('teachers.evaluation') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Evaluation
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('teachers.classReport', $class->id) }}" class="nav-link">
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