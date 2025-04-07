
{{-- @section('title','Homepage') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Homepage')</title>
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css"> --}}
    <link 
      href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"> 
      <link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
      integrity="sha512 5A8nwdMOWrSz20fDsjczguidUBR8liPYU+WymTZP1lmY9660c7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <style>
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
}

.navigation-bar ul li {
    list-style: none;
    display: inline-block;
    padding: 15px;
    position: relative;
}

.navigation-bar ul li a {
    color: white;
    text-decoration: none;
    font-size: 15px;
}

.navigation-bar ul li::after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
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
        <nav> 
            {{-- <a href="index.html"> --}}
            <img src="{{ asset('images/Brand_Logo.png')}}" >
            </a>
            <div class="navigation-bar" id="myNav">
                <i class="fa fa-times" onclick="closeMenu()"></i>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('privacy') }}">Hotel</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('login') }}">Log In</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showmMenu()"></i>
        </nav>
        <!-- content -->
        <div class="text-box">
            <h1> World's Best Travel Agency Website </h1>
            <p>
            Jobs fill your pockets, adventures fill your soul
            <br>
            Life is short, and the world is wide
            <br>
            Live life with no excuses, travel with no regret
            </p>
            <!-- Visit Button -->
            <a href="visit.html" class="visit-btn"> Visit to know more </a>
        </div>
    </header>
    <main>
   
    <!-- Contact -->
    <section class="contact">
        <h1>  
        </h1>
        <a href="Contact.html" class="visit-btn"> Contact us </a>
    </section>
    <!-- Footer -->
    <footer>
        <h3> About us </h3>
        <p>
        orem ipsum dolor sit amet consectetur adipisicing elit. 
        Unde ab alias porro beatae.
        <br>
        officiis reiciendis distinctio 
        fugit ex assumenda velit quisquam nihil.
        </p>
        <div class="icon">
        <i class="fa fa-star"></i>
                <i class="fa fa-facebook-official"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-linkedin"></i>
                <i class="fa fa-twitter"></i>
        </div>
        <p>
        <i class="fa-fa-copyright"> copyright </i>
        </p>
    </footer>
    </main>
    <!-- Script -->
    <script>
    var myNav = document.getElementById("myNav");
    function showmMenu(){
        myNav.style.right = "0";
    }

    function closeMenu(){
        myNav.style.right = "-150px";
    }
    </script>
</body>>
</html>