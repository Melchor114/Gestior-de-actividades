<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:400,500,600%7CTeko:300,400,500%7CMaven+Pro:500">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }


        /* Estilo para el enlace de bienvenida */
        .rd-nav-link-welcome {
            color: #007bff;
            /* Color del texto */
            font-weight: bold;
            /* Negrita para el nombre del usuario */
            text-transform: capitalize;
            /* Capitalizar la primera letra de cada palabra */
        }

        /* Estilo para el botón de logout */
        .rd-nav-link-logout {
            background: none;
            /* Sin fondo */
            border: none;
            /* Sin borde */
            color: #dc3545;
            /* Color de texto (rojo) */
            cursor: pointer;
            /* Cursor de puntero para indicar que es clickeable */
            font-size: 16px;
            /* Tamaño del texto */
        }

        .rd-nav-link-logout:hover {
            color: #c82333;
            /* Color de texto más oscuro al pasar el mouse */
        }
    </style>
</head>

<body>
    <div class="ie-panel">
        <a href="http://windows.microsoft.com/en-US/internet-explorer/">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
        </a>
    </div>
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-container"><span></span><span></span><span></span><span></span></div>
        </div>
    </div>
    <div class="page">
        <div id="home">
            <!-- Page Header-->
            <header class="section page-header">
                <!-- RD Navbar-->
                <div class="rd-navbar-wrap">
                    <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                        <div class="rd-navbar-main-outer">
                            <div class="rd-navbar-main">
                                <!-- RD Navbar Panel-->
                                <div class="rd-navbar-panel">
                                    <!-- RD Navbar Toggle-->
                                    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                    <!-- RD Navbar Brand-->
                                    <div class="rd-navbar-brand"><a class="brand" href="index.html"><img src="images/logo-default-223x50.png" alt="" width="223" height="50" /></a></div>
                                </div>
                                <div class="rd-navbar-main-element">
                                    <div class="rd-navbar-nav-wrap">

                                        <ul class="rd-navbar-nav">
                                            <li class="rd-nav-item active"><a class="rd-nav-link" href="#home">Home</a></li>
                                            <li class="rd-nav-item"><a class="rd-nav-link" href="#services">Services</a></li>
                                            <!-- Login/Register Links -->
                                            @guest
                                            <li class="rd-nav-item">
                                                <a class="rd-nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                                            </li>
                                            <li class="rd-nav-item">
                                                <a class="rd-nav-link" href="{{ route('register') }}">Registrarme</a>
                                            </li>
                                            @else
                                            <li class="rd-nav-item">
                                                <!-- Welcome message styled as a button -->
                                                <a class="rd-nav-link rd-nav-link-welcome" href="{{ route('dashboard') }}">
                                                    Bienvenido, {{ Auth::user()->name }}
                                                </a>
                                            </li>
                                            <li class="rd-nav-item">
                                                <!-- Simple logout button -->
                                                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="rd-nav-link rd-nav-link-logout">Cerrar sesión</button>
                                                </form>
                                            </li>
                                            @endguest
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- Swiper-->
            <section class="section swiper-container swiper-slider swiper-slider-classic" data-loop="true" data-autoplay="4859" data-simulate-touch="true" data-direction="vertical" data-nav="false">
                <div class="swiper-wrapper text-center">
                    <div class="swiper-slide" data-slide-bg="images/slider-1-slide-2-1770x742.jpg">
                        <div class="swiper-slide-caption section-md">
                            <div class="container">
                                <h1 data-caption-animate="fadeInLeft" data-caption-delay="0">Mobile App Development</h1>
                                <p class="text-width-large" data-caption-animate="fadeInRight" data-caption-delay="100">Since our establishment, we have been delivering high-quality and sustainable software solutions for corporate purposes of worldwide businesses.</p>
                                <a class="button button-primary button-ujarak" href="#modalCta" data-toggle="modal" data-caption-animate="fadeInUp" data-caption-delay="200">Get in touch</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" data-slide-bg="images/slider-1-slide-4-1770x742.jpg">
                        <div class="swiper-slide-caption section-md">
                            <div class="container">
                                <h1 data-caption-animate="fadeInLeft" data-caption-delay="0">Experienced Team</h1>
                                <p class="text-width-large" data-caption-animate="fadeInRight" data-caption-delay="100">We are a team of qualified software developers, aimed at creating unique and powerful tools for your business & everyday life.</p>
                                <a class="button button-primary button-ujarak" href="#modalCta" data-toggle="modal" data-caption-animate="fadeInUp" data-caption-delay="200">Get in touch</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" data-slide-bg="images/slider-1-slide-6-1770x742.jpg">
                        <div class="swiper-slide-caption section-md">
                            <div class="container">
                                <h1 data-caption-animate="fadeInLeft" data-caption-delay="0">Award-Winning Software</h1>
                                <p class="text-width-large" data-caption-animate="fadeInRight" data-caption-delay="100">The software solutions developed by our company have been numerously awarded for usability and innovative features.</p>
                                <a class="button button-primary button-ujarak" href="#modalCta" data-toggle="modal" data-caption-animate="fadeInUp" data-caption-delay="200">Get in touch</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Swiper Pagination-->
                <div class="swiper-pagination__module">
                    <div class="swiper-pagination__fraction"><span class="swiper-pagination__fraction-index">00</span><span class="swiper-pagination__fraction-divider">/</span><span class="swiper-pagination__fraction-count">00</span></div>
                    <div class="swiper-pagination__divider"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </section>
        </div>
        <!-- See all services -->
        <section class="section section-sm section-first bg-default text-center" id="services">
            <div class="container">
                <div class="row row-30 justify-content-center">
                    <div class="col-md-7 col-lg-5 col-xl-6 text-lg-left wow fadeInUp">
                        <img src="{{ asset('images/index-1-415x592.png') }}" alt="" width="415" height="592" />
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="row row-30">
                            <div class="col-sm-6 wow fadeInRight">
                                <article class="box-icon-modern box-icon-modern-custom">
                                    <div>
                                        <h3 class="box-icon-modern-big-title">What We Offer</h3>
                                        <div class="box-icon-modern-decor"></div>
                                        <a class="button button-primary button-ujarak" href="#">View All Services</a>
                                    </div>
                                </article>
                            </div>
                            <div class="col-sm-6 wow fadeInRight" data-wow-delay=".1s">
                                <article class="box-icon-modern box-icon-modern-2">
                                    <div class="box-icon-modern-icon linearicons-phone-in-out"></div>
                                    <h5 class="box-icon-modern-title"><a href="#">CORPORATE<br>SOLUTIONS</a></h5>
                                    <div class="box-icon-modern-decor"></div>
                                    <p class="box-icon-modern-text">Need specific software for your company? We are ready to develop it!</p>
                                </article>
                            </div>
                            <div class="col-sm-6 wow fadeInRight" data-wow-delay=".2s">
                                <article class="box-icon-modern box-icon-modern-2">
                                    <div class="box-icon-modern-icon linearicons-headset"></div>
                                    <h5 class="box-icon-modern-title"><a href="#">CALL CENTER<br>SOLUTIONS</a></h5>
                                    <div class="box-icon-modern-decor"></div>
                                    <p class="box-icon-modern-text">Our experts provide custom products of any complexity for call centers.</p>
                                </article>
                            </div>
                            <div class="col-sm-6 wow fadeInRight" data-wow-delay=".3s">
                                <article class="box-icon-modern box-icon-modern-2">
                                    <div class="box-icon-modern-icon linearicons-outbox"></div>
                                    <h5 class="box-icon-modern-title"><a href="#">CLOUD<br>DEVELOPMENT</a></h5>
                                    <div class="box-icon-modern-decor"></div>
                                    <p class="box-icon-modern-text">We can also offer you reliable cloud development solutions.</p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Meet The Team -->
        <section class="section section-sm section-fluid bg-default" id="team">
            <div class="container-fluid">
                <h2>Meet The Team</h2>
                <div class="row row-sm row-30 justify-content-center">
                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInRight">
                        <!-- Team Classic-->
                        <article class="team-classic team-classic-lg">
                            <a class="team-classic-figure" href="#"><img src="{{ asset('images/team-11-420x424.jpg') }}" alt="" width="420" height="424" /></a>
                            <div class="team-classic-caption">
                                <h4 class="team-classic-name"><a href="#">Ryan Wilson</a></h4>
                                <p class="team-classic-status">Director of Production</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay=".1s">
                        <!-- Team Classic-->
                        <article class="team-classic team-classic-lg">
                            <a class="team-classic-figure" href="#"><img src="{{ asset('images/team-12-420x424.jpg') }}" alt="" width="420" height="424" /></a>
                            <div class="team-classic-caption">
                                <h4 class="team-classic-name"><a href="#">Jill Peterson</a></h4>
                                <p class="team-classic-status">UI Designer</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay=".2s">
                        <!-- Team Classic-->
                        <article class="team-classic team-classic-lg">
                            <a class="team-classic-figure" href="#"><img src="{{ asset('images/team-13-420x424.jpg') }}" alt="" width="420" height="424" /></a>
                            <div class="team-classic-caption">
                                <h4 class="team-classic-name"><a href="#">Sam Robinson</a></h4>
                                <p class="team-classic-status">Senior Developer</p>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay=".3s">
                        <!-- Team Classic-->
                        <article class="team-classic team-classic-lg">
                            <a class="team-classic-figure" href="#"><img src="{{ asset('images/team-14-420x424.jpg') }}" alt="" width="420" height="424" /></a>
                            <div class="team-classic-caption">
                                <h4 class="team-classic-name"><a href="#">Mary Lee</a></h4>
                                <p class="team-classic-status">Software Developer</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="section section-md bg-primary text-center" id="cta">
            <div class="container">
                <h3 style="color: black;">¿Estás listo para mejorar tu productividad académica?</h3>
                <a class="button button-light button-ujarak" href="#modalCta" data-toggle="modal">Contáctanos</a>
            </div>
        </section>

        <!-- Contact Modal -->
        <div class="modal fade" id="modalCta" tabindex="-1" role="dialog" aria-labelledby="modalCtaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCtaLabel">Contáctanos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row text-center text-md-left">
                    <!-- About Us Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">About Us</h5>
                        <p class="footer-text">We are dedicated to providing high-quality software solutions and services to meet the needs of businesses and individuals alike. Our team is committed to innovation and excellence.</p>
                    </div>
                    <!-- Contact Us Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Contact Us</h5>
                        <ul class="footer-contact-list list-unstyled">
                            <li><i class="material-icons">phone</i><a href="tel:+1234567890">+1 (234) 567-890</a></li>
                            <li><i class="material-icons">email</i><a href="mailto:info@example.com">info@example.com</a></li>
                            <li><i class="material-icons">location_on</i><a href="#">123 Main Street, Anytown, USA</a></li>
                        </ul>
                    </div>
                    <!-- Follow Us Section -->
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Follow Us</h5>
                        <ul class="footer-social-list list-inline">
                            <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="footer-social-link" href="#"><i class="fab fa-x"></i></a></li>
                        </ul>
                    </div>

                </div>
                <!-- Footer Bottom -->
                <div class="footer-bottom text-center mt-4">
                    <p class="footer-bottom-text">&copy; 2024 Your Company Name. All rights reserved.</p>
                </div>
            </div>
        </footer>
        <!-- Include Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <!-- Include Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles for the footer -->
        <style>
            .footer {
                padding: 40px 0;
                background-color: #f5f5f5;
            }

            .footer-title {
                font-size: 1.25rem;
                font-weight: 500;
                margin-bottom: 15px;
                color: #333;
            }

            .footer-text {
                font-size: 0.875rem;
                color: #666;
            }

            .footer-contact-list li {
                margin-bottom: 10px;
                font-size: 0.875rem;
                color: #666;
            }

            .footer-contact-list i {
                font-size: 1.25rem;
                margin-right: 8px;
                vertical-align: middle;
                color: #6d1641;
            }

            .footer-social-list {
                padding-left: 0;
            }

            .footer-social-link {
                font-size: 1.5rem;
                color: #6d1641;
                margin: 0 8px;
                transition: color 0.3s;
            }

            .footer-social-link:hover {
                color: #0056b3;
            }

            .footer-bottom {
                padding-top: 20px;
                border-top: 1px solid #ddd;
            }

            .footer-bottom-text {
                font-size: 0.75rem;
                color: #888;
            }
        </style>

        <!-- Scripts -->
        <script src="js/core.min.js"></script>
        <script src="js/script.js"></script>
</body>

</html>