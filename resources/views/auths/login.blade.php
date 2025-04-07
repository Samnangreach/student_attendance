{{-- @extends('layouts.masters')
@section('title','Login')
@push('styles')
    <style>
        #register{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 120px;
            /* height: 100vh;
            width: 100%; */
        }
    </style>
@endpush
@section('main')
    <div class="container" id="register">
        <div class="card" style="width: 50%;height:40%;">
            <form class="m-3" action="{{ route('accounts.authenticate') }}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="row mb-2">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input name="remember" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary">Login</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
 --}}

 
{{-- @section('title','Homepage') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Login')</title>
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css"> --}}
    
    <link 
      href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"> 
      <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
      integrity="sha512 5A8nwdMOWrSz20fDsjczguidUBR8liPYU+WymTZP1lmY9660c7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" /> 

      <link rel="stylesheet" href="/dist/css/adminlte.min.css">
      @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

#register{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 120px;
        /* height: 100vh;
        width: 100%; */
    }
/* homepage */
            * {
    margin: 0;
    padding: 0;
    font-family: 'Ubuntu', sans-serif;
}

header {
    min-height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(3, 16, 44, 0.7), rgba(3, 16, 44, 0.7)), url('/images/Homepage_Pic.jpg');
    background-position: center;
    background-size: cover;
    position: relative;
}

nav {
    display: flex;
    padding: 12px 50px;
    justify-content: space-between;
    align-items: center;
}

nav img {
    width: 100px;
}

.navigation-bar {
    flex: 1;
    text-align: right;
    margin-top: 10px;
}

.navigation-bar ul li {
    list-style: none;
    display: inline-block;
    padding: 15px;
    position: relative;
}

.navigation-bar ul li a {
    color: rgb(0, 0, 0);
    text-decoration: none;
    font-size: 15px;
}

.navigation-bar ul li::after {
    content: '';
    width: 100%;
    height: 2px;
    background: rgb(0, 0, 0);
    display: block;
    margin: auto;
    transition: 0.5s;
}

.navigation-bar ul li:hover::after {
    width: 0%;
    /* background-color: #0387bb; */
}

/* .navigation-bar a:hover { */
    /* display: block; */
    /* padding: 10px;
    color: #00AFEF; */
    /* background-color: #111111; */
/* } */

.text-box {
    width: 100%;
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

.text-box h1 {
    font-size: 40px;
}

.text-box p {
    margin: 20px;
    font-size: 15px;
    color: white;
    line-height: 20px;
}

.visit-btn {
    display: inline-block;
    text-decoration: none;
    color: white;
    border: 1px solid white;
    padding: 15px 30px;
    font-size: 13px;
    background-color: transparent;
    position: relative;
    cursor: pointer;
}

.visit-btn:hover {
    border: 1px solid #0387bb;
    background: #0387bb;
    transition: 1s;
}

nav .fa {
    display: none;
}

/* Responsive */
@media (max-width: 700px) {
    .text-box h1 {
        font-size: 16px;
    }

    .text-box p {
        margin: 10px;
        font-size: 10px;
        color: white;
        line-height: 15px;
    }

    .navigation-bar ul li {
        display: block;
    }

    .navigation-bar{
        position: fixed;
        background: #0387bb;
        height: 100vh;
        width: 150px;
        top: 0;
        right: -150px;
        text-align: left;
        z-index: 2;

        transition: 1s;
    }

    nav .fa {
        display: block;
        color: white;
        margin: 10px;
        font-size: 20px;
        cursor: pointer;
    }
    .navigation-bar ul {
        padding: 30px;
    }
}
    /* course */
    .course {
        width: 80%;
        margin: auto;
        text-align: center;
        padding-top: 100px;
    }
    h1 {
        font-size: 36px;
        font-weight: 600;
    }
    p{
        color: gray;
        font-size: 14px;
        font-weight: 300;
        line-height: 22px;
        padding: 10px;
    }

    .sec-1 {
        margin-top: 5%;
        display: flex;
        justify-content: space-between;
    }

    .col-1 {
        flex-basis: 30%;
        background: #faf3f3;
        border-radius: 20px;
        margin-bottom: 20px;
        padding: 15px;
        box-sizing: border-box;
    }

    h3 {
        text-align: center;
        margin: 10px;
    }

    .col-1:hover {
        box-shadow: 0 0 20px 0 rgba(0, 0, 0.4);
        transition: 0.5s;
    }

    @media (max-width: 700px) {
        .sec-1
        .sec-2
        .sec-3
        .sec-4 {
            flex-direction: column;
        }
    }

    .sec-2 {
        margin-top: 5%;
        display: flex;
        justify-content: space-between;
    }

    .col-2 {
        flex-basis: 30%;
        border-radius: 20px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .col-2 img {
        width: 100%;
        display: block;
    }

    .layer {
        color: red;
        background: transparent;
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        transition: 0.5s;
    }

    .layer:hover {
        background: rgba(0, 110, 255, 0.4);
    }

    .layer h3 {
        width: 100%;
        font-weight: 500;
        color: white;
        font-size: 26px;
        bottom: 0;
        left: 30%;
        transform: translate(-50%);
        position: absolute;
        background-color: #06b8ff;
        transition: 0.5s;
    }

    .layer:hover h3 {
        bottom: 49%;
        margin-left: 10px;
        opacity: 1;
    }

    /* Services */
    .services {
        width: 80%;
        margin: auto;
        padding-top: 100px;
        text-align: center;
    }

    .sec-3 {
        margin: 5%;
        justify-content: space-between;
        display: flex;
    }

    .col-3 {
        flex-basis: 23%;
        position: relative;
        margin-bottom: 50px;
    }

    .col-3 img {
        width: 100%;
        border-radius: 10px;
    }

    .col-3 p {
        text-align: justify;
        line-height: 15px;
        padding: 0;
    }

    .col-3 h3 {
        margin-top: 15px;
        margin-bottom: 15px;
        text-align: center;
    }
    .sec-4 {
        margin: 5%;
        justify-content: space-between;
        display: flex;
    }

    .col-4 {
        flex-basis: 44%;
        display: flex;
        padding: 25px;
        background: #faf3f3;
        text-align: justify;
        border-radius: 10px;
        margin-bottom: 5%;
        cursor: pointer;
    }

    .col-4 img {
        height: 60px;
        margin: 5px;
        border-radius: 50%;
    }

    .col-4 p {
        padding: 0;
        margin: 10px;
    }

    .col-4 h3 {
        margin-top: 15px;
        text-align: left;
    }

    .col-4 .fa {
        color: tomato;
    }

    @media (max-width: 700px) {
        .col-4 img {
            margin-left: 0;
            margin-right: 5px;
        }
    }

    /* Contact */
    .contact {
        width: 80%;
        margin: auto;
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(../../images/Pictures/Contact.jpg);
        background-position: center;
        background-size: cover;
        border-radius: 10px;
        padding: 100px 0;
        text-align: center;
    }

    .contact h1 {
        color: white;
        margin-bottom: 40px;
        padding: 0;
    }

    @media (max-width: 700px) {
        .contact h1 {
            font-size: 20px;
        }
    }

    /* Footer */
    footer {
        width: 100%;
        padding: 30px 0;
        text-align: center;
    }

    footer h3 {
        margin: 20px;
    }

    .icon .fa {
        color: #06b8ff;
        padding: 25px 0;
        margin: 0 20px;
        cursor: pointer;
    }

        </style>
</head>
<body>
    <!-- Header  -->
    <header> 
    <!-- Navigation -->
        <nav style="background-color: white; height: 40px; display: flex; align-items: center; padding: 0 20px;"> 
            {{-- <a href="index.html"> --}}
            <img src="{{ asset('images/API_logo.png')}}" style="height: 60px; width: 60px; margin-top: 10px;">
            </a>
            <div class="navigation-bar" id="myNav">
                <i class="fa fa-times" onclick="closeMenu()"></i>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('Login') }}">Log In</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showmMenu()"></i>
        </nav>
        <!-- content -->
        {{-- <div class="text-box"> --}}
            
            {{-- <div class="container" id="register">
                <div class="card" style="width: 50%;height:40%;">
                    <form class="m-3" action="{{ route('accounts.authenticate') }}" method="POST">
                        @csrf
                            <div class="card-body">
                                <div class="row mb-2">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mb-2">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input name="remember" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember me
                                    </label>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm btn-primary">Login</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        --}}

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg" style="width: 400px;">
                <div class="card-header text-center bg-primary text-white" sty>
                    <h4 class="mb-1">Welcome Back!</h4>
                    <p class="small" style="color: white;">Sign in as Admin to API</p>
                    <div class="d-flex justify-content-center">
                        <div class="rounded-circle bg-white text-dark d-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px; font-size: 24px; border: 3px solid #4CAF50;">
                            API
                        </div>
                    </div>
                </div>
                <div class="card-body">
                     <!-- Display Error Messages -->
            

                    @if ($errors->has('role'))
                        <div class="alert alert-danger">{{ $errors->first('role') }}</div>
                    @endif
                    
                    @if ($errors->has('login'))
                        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                    @endif

                    @if ($errors->has('password'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="d-flex align-items-center">
                            <label class="form-label fw-bold me-2" for="role">Role:</label>
                            <select class="form-select w-auto" name="role" required style="margin-top: -5px;">
                                <option value="" disabled selected>Select a role</option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>
                        {{-- <label class="form-label">Role:</label>
                        <select   name="role" required>
                            <option value="" disabled selected>Select a role</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                        </select> --}}
                        {{-- <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="login" class="form-label">Email or Teacher Name</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" required autofocus>
                            {{-- @error('login')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror --}}
                        </div>
        
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required >
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
                                    <i id="toggleIcon" class="fa fa-eye"></i>
                                </span>
                            </div>
                            {{-- @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror --}}
                        </div>
        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
        
                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                        
                    </form>
                </div>
            </div>
        </div>
    
    
        </div>
        {{-- </div> --}}
    </header>
    
    <!-- Script -->
    <script>
        // function togglePassword() {
        //     let passwordInput = document.getElementById("password");
        //     let toggleIcon = document.getElementById("toggleIcon");
    
        //     if (passwordInput.type === "password") {
        //         passwordInput.type = "text";
        //         toggleIcon.classList.remove("fa-eye");
        //         toggleIcon.classList.add("fa-eye-slash");
        //     } else {
        //         passwordInput.type = "password";
        //         toggleIcon.classList.remove("fa-eye-slash");
        //         toggleIcon.classList.add("fa-eye");
        //     }
        // }
        document.getElementById("toggleIcon").addEventListener("click", function () {
        let passwordInput = document.getElementById("password");
        this.classList.toggle("fa-eye-slash");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    });
    </script>

    <script>
    // var myNav = document.getElementById("myNav");
    // function showmMenu(){
    //     myNav.style.right = "0";
    // }

    // function closeMenu(){
    //     myNav.style.right = "-150px";
    // }
    let myNav = document.getElementById("myNav");
    document.querySelector(".fa-bars").addEventListener("click", () => myNav.style.right = "0");
    document.querySelector(".fa-times").addEventListener("click", () => myNav.style.right = "-150px");

    </script>

</body>
</html>

