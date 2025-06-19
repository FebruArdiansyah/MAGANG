@extends('layouts.app')

@section('content')
<main class="container py-5">
  <!-- Layout Utama -->
  <section class="layout-utama content py-4">
    <div class="row">
      <div class="col-lg-7 mb-4">
        @if($beritas->first())
        <a href="{{ route('berita.show', $beritas->first()->slug) }}" class="text-decoration-none text-dark">
          <div class="card h-100">
            <img src="{{ asset('storage/' . $beritas->first()->gambar) }}" class="card-img-top" alt="Berita Utama">
            <div class="card-body">
              <span class="badge bg-dark me-2">{{ $beritas->first()->category->nama_liga }}</span>
              <h5 class="card-title">{{ $beritas->first()->judul }}</h5>
              <p class="card-text"><small>{{ $beritas->first()->user->name }}</small> - <small>{{ \Carbon\Carbon::parse($beritas->first()->tanggal_publish)->translatedFormat('d M Y') }}</small></p>
              <p class="text-muted">{{ Str::limit(strip_tags($beritas->first()->deskripsi), 160) }}</p>
              <a href="{{ route('berita.show', $beritas->first()->slug) }}" class="btn btn-primary btn-sm">Read More</a>
            </div>
          </div>
        </a>
        @endif
      </div>

      <div class="col-lg-5 mb-4">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          @foreach($beritas->skip(1)->take(4) as $berita)
          <div class="col">
            <a href="{{ route('berita.show', $berita->slug) }}" class="text-decoration-none text-dark">
              <div class="card h-100">
                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="Berita">
                <div class="card-body">
                  <h6 class="card-title">{{ $berita->judul }}</h6>
                  <p><small>{{ $berita->user->name }} - {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') }}</small></p>
                  <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-link btn-sm">Read More</a>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- Rekomendasi & Terpopuler jika ada -->
  <section class="layout-rekomendasi section-rekomendasi-anda row mb-5">
    <div class="col-12">
      <h3 class="text-center text-lg-start mb-3">Berita Lainnya dari {{ $category->nama_liga }}</h3>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($beritas->skip(5) as $berita)
        <div class="col">
          <a href="{{ route('berita.show', $berita->slug) }}" class="text-decoration-none text-dark">
            <div class="card h-100 shadow-sm border-0">
              <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top img-fluid" alt="...">
              <div class="card-body">
                <small class="">{{ $berita->category->nama_liga }}</small>
                <h6 class="card-title fw-bold mb-2 card-title-limit">{{ $berita->judul }}</h6>
                <small class="d-block mb-1">Oleh: {{ $berita->user->name }}</small>
              </div>
              <div class="card-footer">
                <small>{{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, d F Y') }}</small>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
</main>
@endsection
