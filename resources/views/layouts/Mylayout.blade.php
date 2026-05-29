<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REEN - @yield('title')</title>

     <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- splide -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    @section('header')

    <div id="header" class="header">
        <div class="top-header">
            <div class="container">
                <div class="social">
                    <div class="contect">
                        <span>&#9993; info@reen.com</span>
                        <span><i class="fa fa-mobile-phone" style="font-size:20px"></i>+00 (123) 456 78 90</span>
                    </div>
                    <div class="social-links">
                        <ul>
                            <li><a id="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a id="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a id="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a id="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a id="behance" href="#"><i class="fa fa-behance"></i></a></li>
                            <li><a id="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="navbar">
                    <div class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="">
                    </div>
                    <div class="controlles">
                        <ul>
                            <li class="menu-item"><a href="#">HOME</a></li>

                            <li class="menu-item"><a href="#portfolio">PORTFOLIO</a></li>
                            <li class="menu-item"><a href="#">BLOG</a></li>
                            <li class="menu-item"><a href="#">PAGES</a></li>
                            <li class="menu-item"><a href="#features">FEATURES</a></li>
                            <li class="menu-item" id="mega-menu"><a href="#">MEAG MENU</a></li>
                            <li class="menu-item"><a href="#contact">CONTACT</a></li>

                        </ul>
                    </div>
                    <div class="menu">

                    </div>
                    <div class="searchIcon">
                        <span class="menuBtn">&#9776;</span>
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @show

    @yield('content')

    @section('footer')

    <div class="footer">

        <div class="top-footer">
            <div class="container">
                <div class="about-us">
                    <div class="section">
                        <h4>Who we are</h4>

                        <img src="{{asset('images/whiteLogo.png')}}" id="logo" alt="">

                        <p>Magnis modipsae voloratati andigen daepeditem quiate re porem que aut labor. Laceaque
                            eictemperum
                            quiae sitiorem rest non restibusaes maio es dem tumquam.</p>

                        <span class="info">
                            <p>More about us</p> <span class="icons arrow"><i class="fa fa-arrow-right"></i></span>
                        </span>
                    </div>
                    <div class="section">
                        <h4>Latest works</h4>
                        <div class="thumbs">
                            <div class="thambs-row">
                                <div class="thumb">
                                    <img src="{{asset('images/demo4.png')}}" alt="">
                                    <div class="plus-icon">+</div>
                                </div>
                                <div class="thumb">
                                    <img src="{{asset('images/demo2.png')}}" alt="">
                                    <div class="plus-icon">+</div>
                                </div>
                            </div>
                            <div class="thambs-row">
                                <div class="thumb">
                                    <img src="{{asset('images/demo2.png')}}" alt="">
                                    <div class="plus-icon">+</div>
                                </div>
                                <div class="thumb">
                                    <img src="{{asset('images/demo4.png')}}" alt="">
                                    <div class="plus-icon">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feed-back">
                        <div class="contect">
                            <h4>Get in touch</h4>
                            <p>Doloreiur quia commolu ptatemp dolupta oreprerum tibusam eumenis et consent accullignis
                                dentibea
                                autem inisita.</p>
                            <div>
                                <span class="info"><span class="icons"><i class="fa fa-map-marker"></i></span>
                                    <p>84 Street, City, State 24813</p>
                                </span>
                                <span class="info"><span class="icons"><i class="fa fa-mobile-phone"></i></span>
                                    <p>+00 (123) 456 78 90</p>
                                </span>
                                <span class="info"><span class="icons"><span>&#9993;</span></span>
                                    <p>info@reen.com</p>
                                </span>
                            </div>
                        </div>
                        <div class="contect">
                            <h4>Free updates</h4>
                            <p>Conecus iure posae volor remped modis aut lor volor accabora incim resto explabo.</p>
                            <div class="warp-input">
                                <input type="email" id="email" placeholder="Enter your email address">
                                <button id="subBtn" onclick="subscribe()">SUBSCRIBE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-footer">
            <div class="container">
                <div class="footer-end">
                    <div class="siteRights">
                        © 2014 REEN. All rights reserved.
                    </div>
                    <div class="siteRights">

                        <a href="#">Home</a> <span>·</span> <a href="">Portfolio</a> <span>·</span> <a href="">Blog</a>
                        <span>·</span> <a href="">About</a> <span>·</span>
                        <a href="">Services</a> <span>·</span> <a href="">Contact</a>
                    </div>
                </div>
            </div>

            <div class="scroll-btn"><a href="#header"><i class='fa fa-angle-up'></i></a></div>

        </div>
    </div>
    @show


    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>