@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
@php use Illuminate\Support\Str; @endphp

<main class="container py-5">

  <!-- SECTION 1: Banner Utama & Berita Pilihan -->
<section class="section-banner row g-4 mb-5">
  <!-- Carousel Berita Utama -->
  <div class="col-lg-8">
    @if ($beritaCarousel->isNotEmpty())
      <div id="mainBannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4 overflow-hidden">
          @foreach ($beritaCarousel as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} img-hover-item">
              <a href="{{ route('berita.show', $item->slug) }}" class="text-decoration-none">
                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default.jpg') }}"
                     class="d-block w-100 img-hover" alt="{{ $item->judul }}">
                <div class="carousel-caption bg-opacity-75 text-start rounded">
                  <h5 class="fw-bold text-light shadow-lg">{{ $item->judul }}</h5>
                  <small class="text-light d-block mb-1">{{ $item->tanggal_publish->translatedFormat('l, j F Y') }}</small>
                </div>
              </a>
            </div>
          @endforeach
        </div>

        @if ($beritaCarousel->count() > 1)
          <button class="carousel-control-prev" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#mainBannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        @endif
      </div>
    @else
      <p class="text-center text-muted">Tidak ada berita utama yang ditampilkan saat ini.</p>
    @endif
  </div>

  <!-- Box Klasemen -->
  <div class="col-lg-4">
  <div class="bg-white p-4 rounded shadow">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="m-0">Klasemen</h5>
      <select id="ligaSelector" class="form-select form-select-sm w-auto">
  @foreach ($kategoriList as $kategori)
    <option value="klasmen-{{ $kategori->id }}">{{ $kategori->nama_liga }}</option>
  @endforeach
</select>

    </div>

    @foreach ($kategoriList as $kategori)
  <table id="klasmen-{{ $kategori->id }}"
         class="table table-bordered table-striped klasmen-table {{ $loop->first ? '' : 'd-none' }}">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Tim</th>
        <th>D</th>
        <th>M</th>
        <th>Pn</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($kategori->klasmen as $index => $team)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $team->nama_tim }}</td>
          <td>{{ $team->jumlah_pertandingan }}</td>
          <td>{{ $team->menang }}</td>
          <td>{{ $team->poin }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endforeach

    <div class="text-center">
      <a href="{{ route('klasmen.index') }}" class="btn btn-primary fw-bold" style="margin-top: 10px">Selengkapnya</a>
    </div>
  </div>
</div>

</section>

<!-- SECTION 2: Sub-banner (Berita Sorotan) -->
<section class="section-sub-banner row row-cols-1 row-cols-md-4 g-3 mb-5">
  @if ($subBanner->isNotEmpty())
    @foreach ($subBanner as $item)
      <div class="col text-center">
        <a href="{{ route('berita.show', $item->slug) }}" class="sub-banner-card text-decoration-none text-dark">
          <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default.jpg') }}"
               class="img-fluid rounded" alt="{{ $item->judul }}">
          <p class="mt-2">{{ Str::limit($item->judul, 90) }}</p>
        </a>
      </div>
    @endforeach
  @else
    <div class="col-12 text-center text-muted">
      <p>Tidak ada berita sorotan yang ditampilkan saat ini.</p>
    </div>
  @endif
</section>

  <!-- SECTION 3: Rekomendasi dan Terpopuler -->
  <section class="layout-rekomendasi section-rekomendasi-anda row mb-5">
    <div class="col-lg-8 rekomendasi-anda">
      <h3 class="text-center text-lg-start mb-3">Rekomendasi Untuk Anda</h3>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($rekomendasi as $rec)
          <div class="col">
            <a href="{{ route('berita.show', $rec->berita->slug) }}" class="text-decoration-none text-dark">
              <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('storage/'.$rec->berita->gambar) }}" class="card-img-top img-fluid" alt="{{ $rec->berita->judul }}" style="object-fit: cover;">
                <div class="card-body">
                  <small class="text-muted">{{ $rec->category->nama_liga }}</small>
                  <h6 class="card-title fw-bold mb-2 card-title-limit">{{ Str::limit($rec->berita->judul, 90) }}</h6>
                  <small class="text-muted d-block mb-1">Oleh: {{ $rec->berita->user->name ?? 'Admin' }}</small>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">{{ $rec->berita->tanggal_publish->translatedFormat('l, j F Y') }}</small>
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
        @foreach ($terpopuler as $pop)
          <a href="{{ route('berita.show', $pop->slug) }}" class="list-group-item list-group-item-action d-flex gap-3 border-0 px-0 pb-3">
            <img src="{{ asset('storage/'.$pop->gambar) }}" width="100" height="70" class="rounded object-fit-cover" alt="{{ $pop->judul }}">
            <div>
              <small class="text-danger fw-semibold">{{ $pop->category->nama_liga }}</small>
              <h6 class="fw-bold mb-1">{{ Str::limit($pop->judul, 70) }}</h6>
              <small class="text-muted">{{ $pop->tanggal_publish->diffForHumans() }}</small>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
</main>
@endsection
