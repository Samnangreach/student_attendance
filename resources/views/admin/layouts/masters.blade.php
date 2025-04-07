
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Index')</title>

    



    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">


    {{-- homepage --}}

    <link 
      href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"> 
      <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
      integrity="sha512 5A8nwdMOWrSz20fDsjczguidUBR8liPYU+WymTZP1lmY9660c7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .main{
            display:flexbox;
        }
        .main > .side-left{
            background-color: #cff;
            flex:1;
        }
        .main > .content{
            flex: 6;
        }

    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="main">
        @auth
    
            <div class="wrapper">

                <!-- Navbar -->

                @include('admin.layouts.navbar')

                
                <!-- Sidebar -->
                
                        
                @include('admin.layouts.sidebar')    
                
            </div>
        @endauth
            {{-- <div class="content-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div> 
                
                <div class="card-body">
                    <div class="content">
                        @yield('main')
                    </div>
                </div>
                <!-- /.card-body -->
            </div> --}}
            <div class="content-wrapper">
            
                <div class="content">
                    @yield('main')
                </div>
            </div>
        
    </div>
    {{-- <div class="footer">

    </div> --}}


    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
</body>
</html>