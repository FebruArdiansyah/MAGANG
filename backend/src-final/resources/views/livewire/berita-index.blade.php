
<div>
<section class="section-banner row g-4 mb-5">
    <!-- Banner Gambar -->
    <div class="col-lg-8">
      <div id="mainBannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4 overflow-hidden">
          @foreach($beritas as $key => $berita)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }} img-hover-item">
            <a href="/detailpage/{{ $berita->slug }}" class="text-decoration-none">
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="d-block w-100 img-hover" alt="{{ $berita->judul }}">
              <div class="carousel-caption bg-opacity-75 text-start rounded">
                <h5 class="fw-bold text-light shadow-lg">{{ $berita->judul }}</h5>
                <small class="text-light d-block mb-1">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</small>
              </div>
            </a>
          </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

    <!-- Klasemen -->
    <div class="col-lg-4">
  <div class="bg-white p-4 rounded shadow">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="m-0">Klasemen</h5>
      <!-- Dropdown Pilihan Liga -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownLigaButton" data-bs-toggle="dropdown" aria-expanded="false">
          {{ $selectedLiga ?? 'Liga Indonesia' }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownLigaButton">
          <li><a class="dropdown-item" href="{{ route('klasmen', ['kategori' => 'inggris']) }}">Liga Inggris</a></li>
          <li><a class="dropdown-item" href="{{ route('klasmen', ['kategori' => 'italia']) }}">Liga Italia</a></li>
          <li><a class="dropdown-item" href="{{ route('klasmen', ['kategori' => 'spanyol']) }}">Liga Spanyol</a></li>
          <li><a class="dropdown-item" href="{{ route('klasmen', ['kategori' => 'jerman']) }}">Liga Jerman</a></li>
          <li><a class="dropdown-item" href="{{ route('klasmen', ['kategori' => 'nasional']) }}">Liga Indonesia</a></li>
        </ul>
      </div>
    </div>

    <!-- Tabel Klasemen -->
    <table class="table table-bordered table-striped">
      <thead class="text-center">
        <tr>
          <th>Pos.</th>
          <th>Tim</th>
          <th>D</th>
          <th>M</th>
          <th>Pn</th>
        </tr>
      </thead>
      <tbody>
        @forelse($klasemens as $index => $klasmen)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $klasmen->team->nama ?? '-' }}</td>
            <td>{{ $klasmen->jumlah_pertandingan }}</td>
            <td>{{ $klasmen->menang }}</td>
            <td>{{ $klasmen->poin }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada data klasemen.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Tombol Selengkapnya -->
    <div class="text-center mt-3">
      <a href="{{ route('klasmen') }}" class="btn btn-primary">Selengkapnya</a>
    </div>
  </div>
</div>

  </section>

<!-- SUB BANNER -->
<section class="section-sub-banner row row-cols-1 row-cols-md-4 g-3 mb-5">
    @foreach($subBanners as $sub)
    <div class="col text-center">
        <a href="/detailpage/{{ $sub->slug }}" class="sub-banner-card text-decoration-none text-dark">
            <img src="{{ asset('storage/' . $sub->gambar) }}" class="img-fluid rounded" alt="{{ $sub->judul }}">
            <p class="mt-2">{{ Str::limit($sub->judul, 100) }}</p>
        </a>
    </div>
    @endforeach
</section>

<section class="layout-rekomendasi section-rekomendasi-anda row mb-5">
    <div class="col-lg-8 rekomendasi-anda">
        <h3 class="text-center text-lg-start mb-3">Rekomendasi Untuk Anda</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($rekomendasis as $berita)
            <div class="col">
                <a href="/detailpage/{{ $berita->slug }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top img-fluid" style="object-fit: cover;">
                        <div class="card-body">
                            <small class="text-muted">{{ $berita->category->nama ?? '' }}</small>
                            <h6 class="card-title fw-bold mb-2 card-title-limit">{{ Str::limit($berita->judul, 100) }}</h6>
                            <small class="text-muted d-block mb-1">Oleh: {{ $berita->penulis }}</small>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-4 section-terpopuler">
    <h3 class="mb-3 fw-bold">Terpopuler</h3>
    <div class="list-group list-group-flush">
        @foreach($populers as $berita)
        <a href="/detailpage/{{ $berita->slug }}" class="list-group-item list-group-item-action d-flex gap-3 border-0 px-0 pb-3">
            <img src="{{ asset('storage/' . $berita->gambar) }}" width="100" height="70" class="rounded object-fit-cover">
            <div>
                <small class="text-danger fw-semibold">{{ $berita->category->nama ?? '' }}</small>
                <h6 class="fw-bold mb-1">{{ Str::limit($berita->judul, 60) }}</h6>
                <small class="text-muted">{{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}</small>
            </div>
        </a>
        @endforeach
    </div>
</div>
</section>

</div>