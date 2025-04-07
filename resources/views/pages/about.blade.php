<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Contact </title>
        <link rel="stylesheet" href="../CSS/contactus.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link 
        href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font awesome.css" 
        integrity="sha512-5A8nwdMOWrSz20fDsjczguidUBR8liPYU + WymTZP1lmY9660c7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <style>
            * {
    margin: 0;
    padding: 0;
    font-family: 'Ubuntu', sans-serif;
}
    /* Header */
    header {
    min-height: 50vh;
    width: 100%;
    background-image: linear-gradient(rgba(3, 16, 44, 0.7), rgba(3, 16, 44, 0.7)),
    url('../../images/Pictures/Contact.jpg');
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
    width: 100%;
}
    .navigation-bar a:hover {
    color: #00AFEF;
}
    .navigation-bar ul li:hover::after {
    width: 0%;
    /* background-color: #0387bb; */
}
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
    font-size: 60px;
}
    nav .fa {
    display: none;
}
    /* Responsive */
    @media (max-width: 700px) {
        .text-box h1 {
        font-size: 40px;
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
        .navigation-bar {
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
/* Contact Page */
#address-section {
    /* margin-top: 80px; */
    background-color: #faf3f3;
}
#address-wrapper {
    width: 100%;
    max-width: 1140px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    padding: 100px 0;
}
#address-wrapper > div {
    width: 50%;
}
#address-wrapper > div:last-of-type{
    width: 40%;
}
.green-heading {
    color: #00AFEF;
    font-size: 24px;
    margin: 0;
    margin-top: 35px;
    margin-bottom: 20px;
}
.section-heading {
    font-size: 600;
    font-size: 35px;
    margin: 0;
}
.section-description {
    font-size: 16px;
    font-weight: 400;
    color: #8b8b99;
    letter-spacing: 0.5px;
}
.address-heading {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
    margin-top: 32px;
}
.address-lines {
    font-size: 16px;
    font-weight: 400;
    color: #8b8b99;
    letter-spacing: 0.5px;
    line-height: 2;
    margin: 0;
}
.input-box {
    width: 100%;
    padding: 16px;
    font-size: 16px;
    color: #8b8b99;
    border-radius: 6px;
    border: 1px solid #e5e6ec;
    margin-bottom: 16px;
    box-sizing: border-box;
    box-shadow: rgba(0, 0, 0, 0.95) 0px 5px 15px;
    transition: transform 1s, filter .5s ease-out;
}
.input-box:hover {
    transform: scale(1.1);
}
#btn-submit {
    border-radius: 5px;
    font-size: 18px;
    /* background: #00AFEF; */
    height: 40px;
    width: 150px;
    color: rgb(88, 88, 88);
    /* transition: 0.5s; */
}
#btn-submit:hover {
    border: 1px solid #0387bb;
    background: #0387bb;
    transition: 1s;
    color: white;
}
/* Responsive */
@media (max-width: 700px) {
#address-wrapper {
    flex-direction: column;
    justify-content: start;
    align-items: center;
    padding: 16px;
    padding-top: 0;
    box-sizing: border-box;
}
#address-wrapper > div {
    width: 100%;
}
#address-wrapper > div:last-of-type {
    width: 100%;
}
}
/* Footer */
footer {
    width: 80%;
    padding: 30px 0;
    text-align: center;
    margin: auto;
}
footer h3 {
    margin: 20px;
}
footer p {
    font-size: 15px;
    color: #525252;
    line-height: 22px;
}
.icons .fa {
    color: #06b8ff;
    padding: 25px 0;
    margin: 0 20px;
    cursor: pointer;
}
        </style>
    </head>
    <body>
        <!-- Header -->
        <header>
            <nav>
                <a href="index.html">
                    <img src="../../images/Pictures/logo.png" >
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
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
            <div class="text-box">
                <h1> Contact Us </h1>
            </div>
        </header>
        <!-- Contact -->
        <section id="address-section">
            <div id="address-wrapper">
                <div>
                    <p class="green-heading">Contact Us</p>
                    <h3 class="section-heading">Address Information</h3>
                    <p class="section-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing 
                    elit. Natus perspiciatis veniam autem modi
                    suscipit odit ipsa dolorum tempora qui necessitatibus.
                    </p>
                    <h4 class="address-heading"> Phnom Penh Branch </h4>
                    <p class="address-lines">
                    Lorem ipsum dolor sit amet.
                    <br>
                    Lorem, ipsum dolor.
                    <br>
                    Monday to Friday : 7am to 9pm
                    <br>
                    demoemail@mail.com
                    </p>
                    <h4 class="address-heading"> Siem Reap Branch </h4>
                    <p class="address-lines">
                    Lorem ipsum dolor sit amet.
                    <br>
                    Lorem, ipsum dolor.
                    <br>
                    Monday to Friday : 7am to 9pm
                    <br>
                    demoemail@mail.com
                    </p>
                </div>
                <div>
                    <p class="green-heading">Meet Our Team</p>
                    <h3 class="section-heading">Get In Touch</h3>
                    <p class="section-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing 
                    elit. Corporis cupiditate labore nostrum
                    explicabo aut eveniet!
                    </p>
                    <form>
                        <input class="input-box" type="text" name="name"
                        placeholder="First Name" />
                        <input class="input-box" type="text" name="name"
                        placeholder="Last Name" />
                        <input class="input-box" type="text" name="phone"
                        placeholder="Phone" />
                        <input class="input-box" type="email" name="email"
                        placeholder="E-mail" />
                        <textarea class="input-box">Message</textarea>
                        <input id="btn-submit" class="primary-button"
                        type="submit" value="Submit Now">
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <Footer>
            <h3> About Us </h3>
            <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Voluptatibus consectetur odio eveniet
            <br>
            dolores error hic quasi labore esse amet, quaerat tempore 
            mollitia libero molestias reiciendis.
            </p>
            <div class="icons">
                <i class="fa fa-facebook-official"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-linkedin"></i>
                <i class="fa fa-twitter"></i>
            </div>
            <p>
                <i class="fa fa-copyright"> Copyright </i>
            </p>
        </Footer>
        <!-- Script -->
        <script>
            var myNav = document.getElementById("myNav");
            function showMenu() {
            myNav.style.right = "0";
            }
            function closeMenu() {
            myNav.style.right = "-150px";
            }
        </script>
    </body>
</html>
    