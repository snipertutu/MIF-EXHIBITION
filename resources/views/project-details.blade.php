<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MIF EXHIBITION Project Details</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/MIF.png')}}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: UpConstruction
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>MIF EXHIBITION<span>.</span></h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?php echo url('/landingpage') ?>" class="active">Home</a></li>
                    <li><a href="#footer">Contact</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header>

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center"
            style="background-image: url('assets/img/breadcrumbs-bg.jpg');">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Project Details</h2>
                <ol>
                    <li><a href="<?php echo url('/landingpage') ?>">Home</a></li>
                    <li>Project Details</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Projet Details Section ======= -->
        <section id="project-details" class="project-details">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="position-relative d-flex justify-content-center align-items-center h-100">
                    @php
                        $youtube = explode('v=', $project->link_youtube);
                    @endphp
                    <iframe width="560" height="315" src="https://youtube.com/embed/{{ $youtube[1] }}" frameborder="0" allowfullscreen></iframe>
                    <a href="https://youtube.com/watch?v={{ $youtube[1] }}" width="560" height="315 frameborder="0" ></a>
                </div>
            

                <div class="row justify-content-between gy-4 mt-4">
                    

                    <div class="col-lg-9 row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-md-6 portfolio-item filter-remodeling">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('storage/' . $project->gambar_1) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_1) }}" title="Remodeling 1"
                                        data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 portfolio-item filter-construction">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('storage/' . $project->gambar_2) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_2) }}" title="Construction 1"
                                        data-gallery="portfolio-gallery-construction" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 portfolio-item filter-remodeling">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('storage/' . $project->gambar_3) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_3) }}" title="Remodeling 1"
                                        data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 portfolio-item filter-construction">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('storage/' . $project->gambar_4) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_4) }}" title="Construction 1"
                                        data-gallery="portfolio-gallery-construction" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <h5><strong>{{ $project->nama_aplikasi }}</strong></h5>
                        <h5>Oleh :</h5>
                        <h5><span>{{ $project->ketua_kelompok }}{{ $project->ketua_anggota }}</span></h5>
                        <p>{{ $project->narasi }}</p>

                    </div>

                    <div class="col-lg-3">
                        <div class="portfolio-info">
                            <h3>Informasi Projek</h3>
                            <ul>
                                <li><strong>Nama Aplikasi</strong> <span>{{ $project->nama_aplikasi }}</span></li>
                                <li><strong>Nama Ketua </strong> <span>{{ $project->ketua_kelompok }}</span></li>
                                <li><strong>Angkatan</strong> <span>{{ $project->angkatan }}</span></li>
                                <li><strong>Semester</strong> <span>{{ $project->semester}}</span></li>
                                <li><strong>Golongan</strong> <span>{{ $project->golongan}}</span></li>
                                <li><strong>phone</strong> <span>{{ $project->user->phone_number}}</span></li>
                                <li><strong>email</strong> <span>{{ $project->user->email}}</span></li>
                                <li><strong>Github Projek</strong> <a href="{{ $project->link_github }}">{{ $project->nama_aplikasi }}</a></li>
                                <li><strong>website</strong><a href="{{ $project->link_website }}">{{ $project->link_website }}</a></li>
                                <!-- <li><strong>video youtube</strong><a href="{{ $project->link_youtube }}">{{ $project->link_youtube }}</a></li> -->
                                <!-- <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li> -->
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Projet Details Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <h3>MIF EXHIBITION</h3>
                            <p>
                                Jl.Mastrip, Krajan Timur Sumbersari, <br>
                                Kec.Sumbersari, Kabupaten Jember, <br>
                                Jawa Timur 68121, Politeknik Negeri Jemebr<br>

                            </p>
                        </div>
                    </div><!-- End footer info column-->

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Contact</h4>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="footer-info">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1974.712050904118!2d113.72176629338655!3d-8.1599551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b617d8f623%3A0xf6c4437632474338!2sPoliteknik%20Negeri%20Jember!5e0!3m2!1sid!2sid!4v1714060623494!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>MIF EXHIBITION</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by MIF POLIJE
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js_home/main.js')}}"></script>

</body>

</html>
