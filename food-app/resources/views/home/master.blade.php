<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nhom-I | Food-App</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <style>
    #notifDiv {
        z-index: 10000;
        display: none;
        background: green;
        font-weight: 450;
        width: 350px;
        position: fixed;
        top: 80%;
        left: 7.8%;
        color: white;
        padding: 5px 20px;
    }
    </style>
</head>

<body>
    <div id="notifDiv"></div>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> food-app@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if(Auth::check())
                            @if(Auth::user()->user_type === 'user')
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="header__top__right__social">
                                    <a href="{{url('/home.login-register.login')}}">Welcome {{Auth::user()->name}}</a>
                                    <span><img src="{{asset('images/' .Auth::user()->avata)}}" alt=""
                                            style="width:28px; border-radius:50%;"></span>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"><i
                                            class="fa fa-user"></i>Logout</a>
                                </div>
                            </form>
                            @else
                            <div class="header__top__right__auth">
                                <a href="{{route('login')}}"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</a>
                            </div>
                            @endif
                            @else
                            <div class="header__top__right__social">
                                <a href="{{route('login')}}"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('register')}}"><i class="fa fa-user"></i>Register</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{url('/index')}}"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-5">
                </div>
                <div class="col-lg-4">
                    <div class="header__cart">
                        <ul>
                            @if (Session::has('cart') && Session('cart')->totalQty != 0)
                            <li><a href="{{url('shoping-cart')}}">Cart&nbsp;&nbsp;<i class="fa fa-shopping-bag"></i>
                                    <span>
                                        @if (Session::has('cart'))
                                        {{Session('cart')->totalQty}}
                                        @else
                                        0
                                        @endif
                                    </span></a>
                            </li>
                            @else
                            <li><a href="#">Cart&nbsp;&nbsp;<i class="fa fa-shopping-bag"></i> <span>0</span></a>
                            </li>
                            @endif
                            @if (Auth::check())
                            @if(Auth::user()->user_type === 'user')
                            &nbsp;&nbsp;&nbsp;
                            <li><a href="#">Order History&nbsp;&nbsp;<i class="fa fa-history"></i>
                                    <span>0</span></a>
                            </li>
                            &nbsp;&nbsp;&nbsp;
                            @php $totalCountWishlist = App\Models\Wishlist::totalCountWishlist() @endphp
                            <li>
                                @if($totalCountWishlist == 0)
                                <a class="update_total" href="#">Favourite&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                    <span>0</span></a>
                                @else
                                <a class="update_total" href="{{url('favourite')}}">Favourite&nbsp;&nbsp;<i
                                        class="fa fa-heart"></i>
                                    <span>{{$totalCountWishlist}}</span></a>
                                @endif
                            </li>
                            @else
                            &nbsp;&nbsp;&nbsp;
                            <li><a href="#">Favourite&nbsp;&nbsp;<i class="fa fa-heart"></i> <span>0</span></a></li>
                            @endif
                            @else
                            &nbsp;&nbsp;&nbsp;
                            <li><a href="{{url('login')}}">Favourite&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                    <span>0</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach($allCategory as $row)
                            <li><a href="{{url('home.shop')}}?catalog_id={{$row->id}}">{{$row->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ url('my-seach')}}" method="get" id="formSearch">
                                <input type="text" name="key" id="key" placeholder="Find products and foods you want?"
                                    value="{{ request()->input('key') }}">
                                <button type="submit" class="site-btn search" value="Search">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i onclick="location.href='{{url('/contact')}}';" style="cursor: pointer;"
                                    class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 53 Võ Văn Ngân - Phường Linh Chiểu - Quận Thủ Đức - TPHCM</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/mixitup.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/ajax.js')}}"></script>
    <script src="{{asset('js/food-app.js')}}"></script>
</body>

</html>