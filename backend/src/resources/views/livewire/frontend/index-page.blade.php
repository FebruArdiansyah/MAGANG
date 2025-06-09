<div>
  <main class="container py-5">
    <!-- SECTION 1: Banner Utama & Berita Pilihan -->
    <section class="section-banner row g-4 mb-5">
      <!-- Carousel Berita -->
      <div class="col-lg-8">
        <div id="mainBannerCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner rounded-4 overflow-hidden">
            @foreach($carousel as $key => $item)
              <div class="carousel-item {{ $key == 0 ? 'active' : '' }} img-hover-item">
                <a href="{{ route('berita.detail', $item->id) }}" class="text-decoration-none">
                  <img src="{{ Storage::url($item->gambar) }}" class="d-block w-100 img-hover" alt="...">
                  <div class="carousel-caption bg-opacity-75 text-start rounded">
                    <h5 class="fw-bold text-light shadow-lg">{{ $item->judul }}</h5>
                    <small class="text-light d-block mb-1">{{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('l, j F Y') }}</small>
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

      <!-- Tabel Klasemen -->
      <div class="col-lg-4">
        <div class="bg-white p-4 rounded shadow">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Klasemen</h5>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $selectedLigaName ?? 'Pilih Liga' }}
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($ligas as $liga)
                <li>
                  <a class="dropdown-item" href="#" wire:click.prevent="selectLiga({{ $liga->id }})">
                  {{ $liga->nama_liga }}
                </a>
                </li>
              @endforeach
              </ul>
            </div>
          </div>
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>Pos.</th>
                <th>Tim</th>
                <th>D</th>
                <th>M</th>
                <th>Pn</th>
              </tr>
            </thead>
            <tbody>
              @foreach($klasemen as $i => $tim)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $tim->nama_tim }}</td>
                <td>{{ $tim->jumlah_pertandingan }}</td>
                <td>{{ $tim->menang }}</td>
                <td>{{ $tim->poin }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="text-center mt-3">
            <a href="{{ url('/klasmen') }}" class="btn btn-primary">Selengkapnya</a>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: Sub Banner Berita -->
    <section class="section-sub-banner row row-cols-1 row-cols-md-4 g-3 mb-5">
      @foreach($subBanners as $berita)
      <div class="col text-center">
        <a href="{{ route('berita.detail', $berita->id) }}" class="sub-banner-card text-decoration-none text-dark">
          <img src="{{ Storage::url($berita->gambar) }}" class="img-fluid rounded" alt="">
          <p class="mt-2">{{ Str::limit($berita->judul, 100) }}</p>
        </a>
      </div>
      @endforeach
    </section>

    <!-- SECTION 3: Rekomendasi dan Terpopuler -->
    <section class="layout-rekomendasi section-rekomendasi-anda row mb-5">
      <div class="col-lg-8 rekomendasi-anda">
        <h3 class="text-center text-lg-start mb-3">Rekomendasi Untuk Anda</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @foreach($rekomendasi as $item)
          <div class="col">
            <a href="{{ route('berita.detail', $item->berita->id) }}" class="text-decoration-none text-dark">
              <div class="card h-100 shadow-sm border-0">
                <img src="{{ Storage::url($item->berita->gambar) }}" class="card-img-top img-fluid" alt="..." style="object-fit: cover;">
                <div class="card-body">
                  <small class="text-muted">{{ $item->berita->category->nama_liga ?? '-' }}</small>
                  <h6 class="card-title fw-bold mb-2 card-title-limit">{{ $item->berita->judul }}</h6>
                  <small class="text-muted d-block mb-1">Oleh: {{ $item->berita->user->name ?? 'Admin' }}</small>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">{{ \Carbon\Carbon::parse($item->berita->tanggal_publish)->translatedFormat('l, j F Y') }}</small>
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
          @foreach($terpopuler as $item)
          <a href="{{ route('berita.detail', $item->id) }}" class="list-group-item list-group-item-action d-flex gap-3 border-0 px-0 pb-3">
            <img src="{{ Storage::url($item->gambar) }}" width="100" height="70" class="rounded object-fit-cover" alt="...">
            <div>
              <small class="text-danger fw-semibold">{{ $item->category->nama_liga ?? '-' }}</small>
              <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
              <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </section>
  </main>
</div>
