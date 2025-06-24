@extends('layouts.apps')

@section('content')
<main class="container py-5">

  {{-- UTAMA + BERITA LAIN --}}
  <section class="layout-utama content py-4">
    <div class="row">
      <div class="col-lg-7 mb-4">
        @if ($beritaUtama)
          <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="text-decoration-none text-white">
            <div class="card h-100">
              <img src="{{ asset('storage/' . $beritaUtama->gambar) }}" class="card-img-top" alt="{{ $beritaUtama->judul }}">
              <div class="card-body">
                <span class="badge bg-dark me-2">{{ $beritaUtama->category->nama_liga }}</span>
                <h5 class="card-title">{{ $beritaUtama->judul }}</h5>
                <p class="card-text"><small>{{ $beritaUtama->user->name }}</small> - <small>{{ $beritaUtama->tanggal_publish->translatedFormat('F j, Y') }}</small></p>
                <p class="text-white limit-4-lines">{{ Str::limit(strip_tags($beritaUtama->deskripsi), 200) }}</p>
                <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </a>
        @endif
      </div>

      <div class="col-lg-5 mb-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          @foreach ($beritaPendamping as $item)
            <div class="col">
              <a href="{{ route('berita.show', $item->slug) }}" class="text-decoration-none text-white">
                <div class="card h-100">
                  <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                  <div class="card-body">
                    <h6 class="card-title">{{ Str::limit($item->judul, 50) }}</h6>
                    <p><small>{{ $item->user->name }} - {{ $item->tanggal_publish->translatedFormat('F j, Y') }}</small></p>
                    <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-warning btn-sm">Read More</a>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- Sub Banner -->
  <section class="section-sub-banner row row-cols-1 row-cols-md-4 g-3 mb-5">
    @foreach ($subBanners as $sub)
      <div class="col text-center">
        <a href="{{ route('berita.show', $sub->slug) }}" class="sub-banner-card text-decoration-none text-white">
          <img src="{{ asset('storage/' . $sub->gambar) }}" class="img-fluid rounded" alt="{{ $sub->judul }}">
          <p class="mt-2">{{ Str::limit($sub->judul, 80) }}</p>
        </a>
      </div>
    @endforeach
  </section>

  {{-- REKOMENDASI --}}
  <section class="layout-rekomendasi section-rekomendasi-anda row mb-5">
  <div class="col-lg-8 rekomendasi-anda">
  <h3 class="text-center text-lg-start mb-3">Rekomendasi Untuk Anda</h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($rekomendasis as $rekomendasi)
      <div class="col">
        <a href="{{ route('berita.show', $rekomendasi->berita->slug) }}" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0">
            <div class="image-wrapper">
              <img src="{{ asset('storage/' . $rekomendasi->berita->gambar) }}"  alt="{{ $rekomendasi->berita->judul }}">
            </div>
            <div class="card-body">
              <small>{{ $rekomendasi->category->nama }}</small>
              <h6 class="card-title fw-bold mb-2 card-title-limit">{{ $rekomendasi->berita->judul }}</h6>
              <small class="d-block mb-1">Oleh: {{ $rekomendasi->berita->user->name }}</small>
            </div>
            <div class="card-footer">
              <small>{{ $rekomendasi->berita->tanggal_publish->format('l, j F Y') }}</small>
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
      @foreach ($terpopuler as $populer)
      <a href="{{ route('berita.show', $populer->slug) }}" class="list-group-item list-group-item-action d-flex gap-3 border-0 px-0 pb-3">
        <img src="{{ asset('storage/' . $populer->gambar) }}" class="rounded object-fit-cover" alt="...">
        <div>
          <small class="text-danger ">{{ $populer->category->nama }}</small>
          <h6 class="fw-bold mb-1">{{ $populer->judul }}</h6>
          <small class="">{{ $populer->tanggal_publish->format('l, j F Y') }}</small>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>


</main>
@endsection
