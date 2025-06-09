<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WinniSoccer</title>

  <!-- CSS & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('frontend/stylecss/newspage.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/stylecss/detail.css') }}" />
  <link rel="stylesheet" href="{{ asset('frontend/stylecss/klasmen.css') }}" />

  @livewireStyles
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background: linear-gradient(to right, #0A0F2C, #1E3A8A);">
    <div class="container-fluid px-3 d-flex align-items-center justify-content-between">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('frontend/assets/logo.png') }}" alt="Logo" width="36" class="me-2">
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
        <div class="offcanvas-body" id="navbarMain">
          <ul class="navbar-nav mx-auto nav-menu">
            <li class="nav-item"><a class="nav-link" href="/">News</a></li>
            <li class="nav-item"><a class="nav-link" href="/liganasional">Liga Nasional</a></li>
            <li class="nav-item"><a class="nav-link" href="/ligaspanyol">Liga Spanyol</a></li>
            <li class="nav-item"><a class="nav-link" href="/ligainggris">Liga Inggris</a></li>
            <li class="nav-item"><a class="nav-link" href="/ligajerman">Liga Jerman</a></li>
            <li class="nav-item"><a class="nav-link" href="/ligaitalia">Liga Italia</a></li>
          </ul>
          <form class="d-block d-lg-flex" role="search" style="min-width: 200px;">
            <input class="form-control form-control-sm" type="search" placeholder="Cari berita..." aria-label="Search">
          </form>
        </div>
      </div>
    </div>
  </nav>

    <main class="container py-5">
    {{ $slot }}
  </main>

  <!-- Footer -->
   <!-- Footer -->
  <footer class="text-white py-5 mt-5" style="background-color: #111827;">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <h5>TAUTAN</h5>
          <p><i class="fa fa-globe me-2"></i>Winnicode</p>
          <p><i class="fa fa-instagram me-2"></i>Instagram</p>
        </div>
        <div class="col-md-3">
          <h5>LINK</h5>
          <p><a href="/" class="text-white text-decoration-none">Beranda</a></p>
          <p><a href="/liganasional" class="text-white text-decoration-none">Liga Nasional</a></p>
          <p><a href="/ligaspanyol" class="text-white text-decoration-none">Liga Spanyol</a></p>
          <p><a href="/ligainggris" class="text-white text-decoration-none">Liga Inggris</a></p>
          <p><a href="/ligajerman" class="text-white text-decoration-none">Liga Jerman</a></p>
          <p><a href="/ligaitalia" class="text-white text-decoration-none">Liga Italia</a></p>
        </div>
        <div class="col-md-3">
          <h5>KONTAK KAMI</h5>
          <p><strong>Email:</strong> winnicodegarudaofficial@gmail.com</p>
          <p><strong>Call Center:</strong> 0812909823</p>
          <p><strong>Alamat:</strong> Jl. Asia Afrika No.158, Bandung</p>
        </div>
        <div class="col-md-3">
          <div class="d-flex gap-2 mb-2">
            <img src="{{ asset('frontend/assets/logo.png') }}" height="40">
            <img src="{{ asset('frontend/assets/bpd.png') }}" height="40">
          </div>
          <p class="small">Jurnalistik Program Winnicode adalah program pengembangan SDM untuk karier di dunia report.</p>
        </div>
      </div>
      <hr class="border-secondary mt-4">
      <p class="text-center small mb-0">&copy; 2025 PT. WINNICODE GARUDA TEKNOLOGI</p>
    </div>
  </footer>


  <!-- JS -->
  <script src="{{ asset('frontend/javascript/javascript.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @livewireScripts
</body>
</html>
