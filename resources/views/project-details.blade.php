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
        style="background-image: url({{ url('assets/img/TI1.jpg') }});">
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

                <div class="row justify-content-between gy-4 mt-4">
                    

                    <div class="col-lg-9 row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    @php
                        $youtube = explode('v=', $project->link_youtube);
                    @endphp
                    <iframe width="100%" height="400" src="https://youtube.com/embed/{{ $youtube[1] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <a href="https://youtube.com/watch?v={{ $youtube[1] }}" width="100%" height="400 frameborder="0" ></a>
                
                    <div class="d-flex flex-row">
                        <div class="col-lg-3 portfolio-item filter-remodeling">
                            <div class="portfolio-content h-25">
                                <img src="{{ asset('storage/' . $project->gambar_1) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_1) }}" title="poster"
                                        data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 portfolio-item filter-construction">
                            <div class="portfolio-content h-25">
                                <img src="{{ asset('storage/' . $project->gambar_2) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_2) }}" title="gambar 1"
                                        data-gallery="portfolio-gallery-construction" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 portfolio-item filter-remodeling">
                            <div class="portfolio-content h-25">
                                <img src="{{ asset('storage/' . $project->gambar_3) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_3) }}" title="gambar 2"
                                        data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 portfolio-item filter-construction">
                            <div class="portfolio-content h-25">
                                <img src="{{ asset('storage/' . $project->gambar_4) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ asset('storage/' . $project->gambar_4) }}" title="gambar 3"
                                        data-gallery="portfolio-gallery-construction" class="glightbox preview-link"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        


                        <div style="font-family: Arial, sans-serif;">
                            <h5 style="margin-bottom: 5px;">
                                <strong style="text-transform: capitalize;">{{ $project->nama_aplikasi }}</strong>
                            </h5>
                            <div style="margin-bottom: 10px;">
                                <h5 style="margin: 0;">Dibuat oleh :</h5>
                                <h6 style="margin-top: 5px;">
                                @foreach($project->detail as $detail)
                                    <li>{{ $detail->users->name }}
                                        <ul>   
                                            <li><i class="fa-solid fa-phone"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   phone :  </strong></i><span><tel>{{ $detail->users->phone_number}}</tel></span></li>
                                            <li><i class="fa-solid fa-envelope"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   email :  </strong></i><span><mail>{{ $detail->users->email}}<mail></span></li>
                                            <!-- Jika setiap user memiliki satu tautan Github dan Linkedin -->
                                            <li><i class="fa-brands fa-github"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Github :  </strong></i><a href="{{ $detail->users->akun_github }}">{{ $detail->users->akun_github }}</a></li>
                                            <li><i class="fa-brands fa-linkedin"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Linkedin :  </strong></i><a href="{{ $detail->users->akun_linkedin }}">{{ $detail->users->akun_linkedin }}</a></li>
                                        </ul>
                                    </li>
                                @endforeach


                                </h6>
                            </div>
                            <p style="margin-top: 0;">{{ $project->narasi }}</p>
                        </div>

                    </div>

                    <div class="col-lg-3">
                        <div class="portfolio-info">
                            <h3>Informasi Projek</h3>
                            <ul style="font-family: Roboto;">
                                <li><i class="fa-solid fa-laptop""><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Nama Aplikasi</strong></i><span style="text-transform: capitalize;">{{ $project->nama_aplikasi }}</span></li>
                                <li><i class="fa-solid fa-user"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Nama Ketua </strong></i><span style="text-transform: capitalize;">{{ $project->ketua_kelompok }} {{ $project->user->name}}</span></li>
                                <li><i class="fa-solid fa-graduation-cap"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">Angkatan</strong></i><span>{{ $project->angkatan }}</span></li>
                                <li><i class="fa-solid fa-book"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Semester</strong></i><span>{{ $project->semester}}</span></li>
                                <li><i class="fa-solid fa-book-atlas"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Golongan</strong></i><span>{{ $project->golongan}}</span></li>
                                <li><i class="fa-solid fa-phone"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   phone</strong></i><span>{{ $project->user->phone_number}}</span></li>
                                <li><i class="fa-solid fa-envelope"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   email</strong></i><span>{{ $project->user->email}}</span></li>
                                <li><i class="fa-brands fa-github"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Github Projek</strong></i><a href="{{ $project->link_github }}">{{ $project->nama_aplikasi }}</a></li>
                                <li><i class="fa-solid fa-globe"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   website</strong></i><a href="{{ $project->link_website }}">{{ $project->link_website }}</a></li>
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
                    <h4>Other Link</h4>
                        <ul>
                            <li><a href="https://polije.ac.id/" class="active">Polije</a></li>
                            <li><a href="https://jti.polije.ac.id/">TI POLIJE</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Contact</h4>
                        <span style="font-family: Arial, sans-serif;">
                            <i class="fa-solid fa-phone" style="margin-right: 5px;"></i>
                            <strong>Phone :</strong> +1 5589 55488 55
                        </span>
                        <br>
                        <span style="font-family: Arial, sans-serif;">
                            <i class="fa-solid fa-envelope" style="margin-right: 5px;"></i>
                            <strong>Email :</strong> mifpolije@gmail.com
                        </span>
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

    <--tampilan-->
<div class="modal fade" id="details_user" tabindex="-1" role="dialog" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahMahasiswaLabel">$details->users->name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li><i class="fa-solid fa-phone"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   phone</strong></i><span>{{ $project->user->phone_number}}</span></li>
                    <li><i class="fa-solid fa-envelope"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   email</strong></i><span>{{ $project->user->email}}</span></li>
                    <li><i class="fa-brands fa-github"><strong style="font-family: Arial, sans-serif; font-weight: bold; color: #333;">   Github Projek</strong></i><a href="{{ $project->link_github }}">{{ $project->nama_aplikasi }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
