
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sự kiện Văn Lang') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>



    <!-- Vendor CSS Files -->
    <link href="/vendor/aos/aos.css" rel="stylesheet" />
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon" />
    <link href="img/favicon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    @stack('style')
</head>

<body>
    <header id="header" class="d-flex align-items-center">
        <div class="container-fluid container-xxl d-flex align-items-center">
            <div id="logo" class="me-auto ">
                <a href="#" class="scrollto"><img src="/img/logo.png" alt="" title="" /></a>
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0 me-auto">
                <ul>
                    <li>
                        <a class="nav-link scrollto active" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ URL::route('home') }}#speakers">Sự kiện mới nhất</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ URL::route('home') }}#likes">Sự kiện nổi bật sắp diễn ra</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ URL::route('home') }}#gallery">Khoảnh khắc</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto" href="{{ URL::route('home') }}#faq">Câu hỏi thường gặp</a>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>Hội nghị - Sự kiện</span>
                            <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{route('client.category', ['id' => 1])}}">Học Thuật</a></li>
                            <li><a href="{{route('client.category', ['id' => 2])}}">Văn Hóa</a></li>
                            <li><a href="{{route('client.category', ['id' => 3])}}">Thể Thao</a></li>
                        </ul>
                    </li>
                    <li>@guest
                        @if (Route::has('login'))
                        <a class="buy-tickets scrollto mx-auto text-white buy-tickets-rp py-2 px-3" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                        @endif
                        @if (Route::has('register'))
                    </li>
                    <li>
                        <a class="buy-tickets scrollto mx-auto text-white buy-tickets-rp py-2 px-3" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                    </li>
                        @endif
                        
                        @else
                        <li class="dropdown dropdown-custom">
                        <a>
                            <span>Xin chào, {{ Auth::user()->fullname }}</span>
                        </a>

                        <ul>
                            <li><a href="{{ route('/home/profile') }}">Quản lí sự kiện cá nhân</a></li>
                           
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a></li>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </ul>
                        @endguest
                    </li>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
           

        </div>
        </div>
    </header>
    <main id="main">

        @yield('content')

    </main>



    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-info">
                        <img src="/img/logo.png" alt="TheEvenet" />
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Liên hệ</h4>
                        <ul>
                            <li>
                                <p><a href="tel:+0287199218">028 7109 9212 (Ext: 3110)</a></p>
                            </li>
                            <li>
                                <p><a href="tel:+0287199218">028 7109 9212 (Ext: 3111)</a></p>
                            </li>
                            <li>
                                <p><a href="mailto:sukien.vanlanguni.edu.vn">sukien.vanlanguni.edu.vn</a></p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>THEO DÕI CHÚNG TÔI</h4>
                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bi bi-tiktok"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>ĐỊA CHỈ</h4>
                        <p>Trụ sở: 45 Nguyễn Khắc Nhu, P.Cô Giang, Q.1, Hồ Chí Minh.</p>
                        <p>
                            Cơ sở 2: 233A Phan Văn Trị, P.11, Q.Bình Thạnh, Hồ Chí Minh.
                        </p>
                        <p>
                            Cơ sơ 3: 80/68 Dương Quảng Hàm, P.5, Q.Gò Vấp, Hồ Chí Minh.
                            69/68 Đặng Thùy Trâm, P.13, Q.Bình Thạnh, Hồ Chí Minh.
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="/vendor/aos/aos.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/js/main.js"></script>
    <!-- Fontawesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>


</html>
