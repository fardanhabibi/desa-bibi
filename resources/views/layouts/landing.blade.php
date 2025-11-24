<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - Aplicación PPDB SMK</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Page specific CSS] start -->
    <link href="{{ asset('assets/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- [Page specific CSS] end -->
    <!-- [Google Font] Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4a6cf7 0%, #6a11cb 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .landing-page {
            font-family: 'Public Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            padding: 1rem 0;
            backdrop-filter: blur(10px);
        }

        .navbar.default {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-light);
        }

        .navbar.top-nav-collapse {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-medium);
            padding: 0.5rem 0;
        }

        .navbar-brand img {
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link {
            position: relative;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:not(.btn):hover {
            background: rgba(74, 108, 247, 0.1);
            color: #4a6cf7;
        }

        .navbar-nav .nav-link.active {
            background: var(--primary-gradient);
            color: white !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: var(--primary-gradient);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after {
            width: 70%;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-50px, -50px) rotate(360deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-gradient);
        }

        .footer-link a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 0.25rem 0;
        }

        .footer-link a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-sos-link a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .footer-sos-link a:hover {
            background: var(--primary-gradient);
            transform: translateY(-3px);
        }

        .top-footer {
            padding: 3rem 0;
        }

        .bottom-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem 0;
        }

        /* Modern Card Styles */
        .modern-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 2rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }
            
            .hero-section {
                min-height: 80vh;
                text-align: center;
            }
            
            .footer .row > div {
                margin-bottom: 2rem;
            }
        }

        /* Loading Animation Enhancement */
        .loader-bg {
            background: var(--primary-gradient);
        }

        .loader-track {
            background: rgba(255, 255, 255, 0.2);
        }

        .loader-fill {
            background: white;
        }
    </style>
</head>

<body class="landing-page">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top default py-2">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img width="70" src="{{ asset('assets/images/my/logo-black-cp.png') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                            href="/dashboard">Dashboard</a>
                    </li>
                   

                    @if (auth()->check())
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a class="btn btn-primary px-4 rounded-pill" href="/myprofile">
                                <i class="ti ti-user me-1"></i> {{ auth()->user()->name }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a class="btn btn-primary px-4 rounded-pill" href="/login">
                                <i class="ti ti-login me-1"></i> Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Modern Footer -->
    <footer class="footer bg-dark text-white">
        <div class="top-footer">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <img src="{{ asset('assets/images/my/logo-black-cp.png') }}"
                            alt="Logo Sekolah Harapan Bangsa" class="img-fluid mb-3" style="max-width: 200px;">
                        <p class="opacity-75 mb-4">desa Wonoayu adalah sebuah kecamatan di Kabupaten Sidoarjo, Provinsi Jawa Timur, Indonesia. Wonoayu dilewati Jalan Provinsi yaitu Jalan Raya Wonoayu. Secara harfiah Wonoayu berasal dari bahasa jawa yang berarti Wono artinya Hutan dan Ayu artinya indah yang berarti Hutan yang Indah</p>
                        <div class="footer-sos-link">
                            <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h5 class="text-white mb-4">Navigasi</h5>
                                <ul class="list-unstyled footer-link">
                                    <li class="mb-2"><a href="/">Beranda</a></li>
                                    <li class="mb-2"><a href="/#alur">Alur Pendaftaran</a></li>
                                    <li class="mb-2"><a href="#">Pengumuman</a></li>
                                    <li class="mb-2"><a href="/contact">Kontak</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <h5 class="text-white mb-4">Hubungi Kami</h5>
                                <ul class="list-unstyled footer-link">
                                    <li class="d-flex mb-3">
                                        <i class="ti ti-map-pin me-3 mt-1 text-primary"></i>
                                        <span>Jl. Balai Desa No.1 61261 Wonoayu Jawa Timur Indonesia</span>
                                    </li>
                                    <li class="d-flex mb-3">
                                        <i class="ti ti-mail me-3 mt-1 text-primary"></i>
                                        <span>info wonoayu @sidoarjokab.go.id</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="ti ti-phone me-3 mt-1 text-primary"></i>
                                        <span>(031) 897-1234</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-white mb-4">Tautan Lainnya</h5>
                                <ul class="list-unstyled footer-link">
                                    <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
                                    <li class="mb-2"><a href="#">Syarat & Ketentuan</a></li>
                                    <li class="mb-2"><a href="#">FAQ</a></li>
                                    <li class="mb-2"><a href="#">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 my-1">
                        <p class="text-white mb-0">© {{ date('Y') }} Sekolah Harapan Bangsa. Hak Cipta
                            Dilindungi.</p>
                    </div>
                    <div class="col-md-6 my-1 text-md-end">
                        <p class="text-white-50 mb-0">Designed with <i class="ti ti-heart text-danger"></i> for better education</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Required Js -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/plugins/simplebar.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>
    
    <script>
        // Enhanced Navbar Scroll Effect
        let ost = 0;
        document.addEventListener('scroll', function() {
            let cOst = document.documentElement.scrollTop;
            let navbar = document.querySelector(".navbar");
            
            if (cOst == 0) {
                navbar.classList.add("top-nav-collapse");
            } else if (cOst > ost) {
                navbar.classList.add("top-nav-collapse");
                navbar.classList.remove("default");
            } else {
                navbar.classList.add("default");
                navbar.classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });

        // Initialize WOW.js for animations
        var wow = new WOW({
            animateClass: 'animated',
            offset: 100,
            mobile: true
        });
        wow.init();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Other existing functions (kept as is)
        // light dark image start
        function initComparisons() {
            var x, i;
            x = document.getElementsByClassName("img-comp-overlay");
            for (i = 0; i < x.length; i++) {
                compareImages(x[i]);
            }

            function compareImages(img) {
                var slider, img, clicked = 0,
                    w, h;
                w = img.offsetWidth;
                h = img.offsetHeight;
                img.style.width = (w / 2) + "px";
                slider = document.createElement("DIV");
                slider.setAttribute("class", "img-comp-slider ti ti-separator-vertical bg-primary");
                img.parentElement.insertBefore(slider, img);
                slider.style.top = (h / 2) - (slider.offsetHeight / 2) + "px";
                slider.style.left = (w / 2) - (slider.offsetWidth / 2) + "px";
                slider.addEventListener("mousedown", slideReady);
                window.addEventListener("mouseup", slideFinish);
                slider.addEventListener("touchstart", slideReady);
                window.addEventListener("touchend", slideFinish);

                function slideReady(e) {
                    e.preventDefault();
                    clicked = 1;
                    window.addEventListener("mousemove", slideMove);
                    window.addEventListener("touchmove", slideMove);
                }

                function slideFinish() {
                    clicked = 0;
                }

                function slideMove(e) {
                    var pos;
                    if (clicked == 0) return false;
                    pos = getCursorPos(e)
                    if (pos < 0) pos = 0;
                    if (pos > w) pos = w;
                    slide(pos);
                }

                function getCursorPos(e) {
                    var a, x = 0;
                    e = (e.changedTouches) ? e.changedTouches[0] : e;
                    a = img.getBoundingClientRect();
                    x = e.pageX - a.left;
                    x = x - window.pageXOffset;
                    return x;
                }

                function slide(x) {
                    img.style.width = x + "px";
                    slider.style.left = img.offsetWidth - (slider.offsetWidth / 2) + "px";
                }
            }
        }
        initComparisons();
        // light dark image end
        
        // marquee start
        $('.marquee').marquee({
            duration: 500000,
            pauseOnHover: true,
            startVisible: true,
            duplicated: true
        });
        $('.marquee-1').marquee({
            duration: 500000,
            pauseOnHover: true,
            startVisible: true,
            duplicated: true,
            direction: 'right'
        });
        // marquee end
        
        // configurations start
        var elem = document.querySelectorAll('.color-checkbox');
        for (var j = 0; j < elem.length; j++) {
            elem[j].addEventListener('click', function(event) {
                var targetElement = event.target;
                if (targetElement.tagName == 'INPUT') {
                    targetElement = targetElement.parentNode;
                }
                if (targetElement.tagName == 'I') {
                    targetElement = targetElement.parentNode;
                }
                var temp = targetElement.children[0].getAttribute('data-pc-value');
                document.getElementsByTagName('body')[0].setAttribute('data-pc-preset', 'preset-' + temp);
                var img_elem = document.querySelectorAll('.img-landing');
                for (var i = 0; i < img_elem.length; i++) {
                    var img_name = img_elem[i].getAttribute('data-img');
                    var img_type = img_elem[i].getAttribute('data-img-type');
                    img_elem[i].setAttribute('src', img_name + temp + img_type);
                }
            });
        }
        // configurations end
    </script>
    <!-- [Page Specific JS] end -->
    
    <!-- Customizer (kept as is) -->
    <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <!-- ... existing customizer code ... -->
    </div>
</body>

</html>