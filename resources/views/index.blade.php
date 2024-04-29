<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MIF EXHIBITION</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css" rel="stylesheet')}}">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet">

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
          <li><a href="#home" class="active">Home</a></li>
          <li><a href="#projects">Projects</a></li>
          <li><a href="supported.html">Supported</a></li>
          <li><a href="#footer">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="home" class="hero">
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        @foreach($banners as $banner)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image: url({{ asset('storage/' . $banner->image_url) }})">
                <div class="info d-flex align-items-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 text-center">
                                <h2 data-aos="fade-down">{{ $banner->title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>
    </div>
</section><!-- End Hero Section -->


  <main id="main">

  <!-- ======= Our Projects Section ======= -->
<section id="projects" class="projects">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Projek MIF Semua Angkatan</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('landingpage') }}" method="get" class="form-inline" id="searchForm">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input type="text" name="tahun" class="form-control" placeholder="Masukkan Tahun">
                        </div>
                        <div class="col-md-4 mb-2">
                            <select name="kategori" class="form-control">
                                <option value="">Semua Kategori</option>
                                <option value="Tugas Akhir">Tugas Akhir</option>
                                <option value="Workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button type="submit" class="btn btn-primary form-control">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">
            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                @foreach($projects as $project)
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $project->golongan }}" data-hidden="{{ $project->hidden ? 'true' : 'false' }}">
                    <div class="portfolio-content h-100" style="aspect-ratio: 1/1;">
                        <img src="{{ asset('storage/' . $project->gambar_1) }}" class="img-fluid" alt="{{ $project->nama_aplikasi }}" style="object-fit: cover;">
                        <div class="portfolio-info">
                            <h4>{{ $project->angkatan }}</h4>
                            <p>{{ $project->nama_aplikasi }} <br> Semester {{ $project->semester }}</p>
                            <a href="{{ asset('storage/' . $project->video_aplikasi) }}" title="{{ $project->nama_aplikasi }}" data-gallery="portfolio-gallery-{{ $project->golongan }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="{{ route('project.details', ['id' => $project->id]) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div><!-- End Projects Item -->
                @endforeach
            </div><!-- End Projects Container -->
        </div>
    </div>
</section><!-- End Our Projects Section -->
    

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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31595.345473182497!2d113.69928700358207!3d-8.160553797868172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b5fde95a51%3A0xa6fbfa55a4d83c8c!2sPoliklinik%20POLIJE!5e0!3m2!1sid!2sid!4v1714356798356!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1974.712050904118!2d113.72176629338655!3d-8.1599551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b617d8f623%3A0xf6c4437632474338!2sPoliteknik%20Negeri%20Jember!5e0!3m2!1sid!2sid!4v1714060623494!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div> -->
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

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

  <script>
      document.addEventListener("DOMContentLoaded", function() {
      // Ambil semua elemen portofolio
      var portfolioItems = document.querySelectorAll('.portfolio-item');

      // Periksa setiap item portofolio
      portfolioItems.forEach(function(item) {
          // Periksa apakah item di-disable
          if (item.getAttribute('data-hidden') === 'true') {
              // Tambahkan kelas CSS untuk menyembunyikan item
              item.style.display = 'none';
          }
      });
  });
  </script>

<script>
$(document).ready(function() {
    $('form#search-form').submit(function(event) {
        event.preventDefault(); // Hindari aksi bawaan dari form

        var formData = $(this).serialize(); // Dapatkan data form

        // Lakukan permintaan AJAX
        $.ajax({
            type: 'GET',
            url: '/landingpage', // Ganti dengan URL ke endpoint pencarian
            data: formData,
            success: function(response) {
                // Perbarui tampilan dengan hasil pencarian
                $('.portfolio-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Tangani kesalahan jika terjadi
            }
        });
    });
});

</script>

</body>

</html>