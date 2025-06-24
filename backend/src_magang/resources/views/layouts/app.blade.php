<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WinniSoccer</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('front/stylecss/newspage.css') }}">
  <link rel="stylesheet" href="{{ asset('front/stylecss/klasmen.css') }}">
  <link rel="stylesheet" href="{{ asset('front/stylecss/detail.css') }}">
  
</head>
<body>
  <!--NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-dark  shadow sticky-top" style="background: linear-gradient(to right, #0A0F2C, #1E3A8A);">
    <div class="container-fluid px-3 d-flex align-items-center justify-content-between">
  
      <!-- Logo (Kiri) -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('front/assets/logo.png') }}" alt="Logo" width="36" class="me-2">
        <span class="text-uppercase fw-bold mb-0" style="color: #EC4899;">Winni<span class="text-primary">Soccer</span></span>
      </a>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasMenu" data-bs-backdrop="false">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
  
      <!-- Navbar content -->
      <div class="offcanvas-body" id="navbarMain">
        <!-- Menu (Tengah) -->
        <ul class="navbar-nav mx-auto nav-menu">
  <li class="nav-item"><a class="nav-link" href="/">News</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('liga.show', 'liga-indonesia') }}">Liga Indonesia</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('liga.show', 'liga-spanyol') }}">Liga Spanyol</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('liga.show', 'liga-inggris') }}">Liga Inggris</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('liga.show', 'liga-jerman') }}">Liga Jerman</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('liga.show', 'liga-italia') }}">Liga Italia</a></li>
</ul>

  
        <!-- Search (Kanan) -->
        <form id="searchForm" class="d-block d-lg-flex" role="search" style="min-width: 200px;">
        <input id="searchInput" class="form-control form-control-sm" type="search" placeholder="Cari berita...">
        <div id="searchResults"></div>
      </form>
      </div>
  
    </div>
  </nav>
  
    @yield('content')


<!-- Footer -->
<footer class="text-white py-5 mt-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3">
        <h5>TAUTAN</h5>
        <p><i class="fa fa-globe me-2"></i>Winnicode</p>
        <p><i class="fa fa-instagram me-2"></i>Instagram</p>
      </div>
      <div class="col-md-3">
        <h5>LINK</h5>
        <p><a href="#" class="text-white text-decoration-none">Beranda</a></p>
        <p><a href="/liganasional.html" class="text-white text-decoration-none">Liga Nasional</a></p>
        <p><a href="/ligaspanyol.html" class="text-white text-decoration-none">Liga Spanyol</a></p>
        <p><a href="/ligainggris.html" class="text-white text-decoration-none">Liga Inggris</a></p>
        <p><a href="/ligajerman.html" class="text-white text-decoration-none">Liga Jerman</a></p>
        <p><a href="/ligaitalia.html" class="text-white text-decoration-none">Liga Italia</a></p>
      </div>
      <div class="col-md-3">
        <h5>KONTAK KAMI</h5>
        <p><strong>Email:</strong> winnicodegarudaofficial@gmail.com</p>
        <p><strong>Call Center:</strong> 0812909823</p>
        <p><strong>Alamat:</strong> Jl. Asia Afrika No.158, Bandung</p>
      </div>
      <div class="col-md-3">
        <div class="d-flex gap-2 mb-2">
          <img src="{{ asset('front/assets/logo.png') }}" height="40">
          <img src="{{ asset('front/assets/bpd.png') }}" height="40">
        </div>
        <p class="small">Jurnalistik Program winnicode adalah program pengembangan SDM untuk karier di dunia report.</p>
      </div>
    </div>
    <hr class="border-secondary mt-4">
    <p class="text-center small mb-0">&copy; 2025 PT.WINNICODE GARUDA TEKNOLOGI</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('front/js/javas.js') }}"></script>
</body>
</html>
