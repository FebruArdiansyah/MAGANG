@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
@php use Illuminate\Support\Str; @endphp

<main class="container py-5">
  <section class="py-0">
    <div class="container d-flex gap-4 flex-wrap flex-lg-nowrap align-items-start">
      <!-- Artikel -->
      <article class="flex-grow-1 pe-lg-4 article-content">
        <h1>{{ $berita->judul }}</h1>
        <div class="small">
          Oleh {{ $berita->user->name ?? 'Admin' }} –
          <span class="text-danger fw-bold">{{ $berita->category->nama_liga }}</span> |
          {{ $berita->tanggal_publish->translatedFormat('l, j F Y H:i') }}
        </div>

        <figure class="my-3">
          <img src="{{ asset('storage/'.$berita->gambar) }}" class="img-fluid rounded" alt="{{ $berita->judul }}">
          <figcaption class="mt-1 small">Foto: {{ $berita->credit_foto }}</figcaption>
        </figure>

        <div class="article-body mt-4">
          {!! $berita->deskripsi !!}
        </div>
      </article>

      <!-- Berita Terkait -->
      <aside class="col-lg-4 section-terkait">
        <h3>Berita Terkait</h3>
        <div class="related-wrapper">
          @forelse($beritaTerkait as $item)
            <div class="related-card mb-3 d-flex gap-2">
              <img src="{{ asset('storage/'.$item->gambar) }}" width="80" class="rounded object-fit-cover" alt="{{ $item->judul }}">
              <div>
                <small class="text-danger">{{ $item->category->nama_liga }}</small>
                <h6 class="mb-1"><a href="{{ route('berita.show', $item->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($item->judul, 60) }}</a></h6>
                <small class="text-muted">{{ $item->tanggal_publish->translatedFormat('l, j F Y') }}</small>
              </div>
            </div>
          @empty
            <p class="text-muted">Tidak ada berita terkait lainnya.</p>
          @endforelse
        </div>
      </aside>
    </div>
  </section>

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
