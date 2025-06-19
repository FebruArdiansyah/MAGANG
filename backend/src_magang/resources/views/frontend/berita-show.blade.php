@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<main class="container py-5">
  <section class="py-0">
    <div class="container d-flex gap-4 flex-wrap flex-lg-nowrap">
      
      <!-- Artikel -->
      <article class="flex-grow-1 pe-lg-4 article-content">
        <h1>{{ $berita->judul }}</h1>
        <div class="small mb-3">
          Oleh {{ $berita->user->name ?? 'Admin' }} – 
          <span class="text-danger fw-semibold">{{ $berita->category->nama_liga }}</span> |
          {{ $berita->tanggal_publish->translatedFormat('l, d F Y H:i') }}
        </div>
        <figure>
          <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid rounded">
          @if ($berita->credit_foto)
            <figcaption class="small mt-1">Foto: {{ $berita->credit_foto }}</figcaption>
          @endif
        </figure>
        <div class="article-body mt-4">
          {!! nl2br(e($berita->deskripsi)) !!}
        </div>
      </article>

      <!-- Berita Terkait -->
      <aside class="col-lg-4 section-terkait">
        <h3 class="mb-3">Berita Terkait</h3>
        <div class="related-wrapper">
          @forelse ($beritaTerkait as $item)
            <div class="related-card mb-3 d-flex gap-3">
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="rounded" width="100" height="70" style="object-fit: cover;">
              <div>
                <small class="text-danger">{{ $item->category->nama_liga }}</small>
                <h6 class="mb-1">
                  <a href="{{ route('berita.show', $item->slug) }}" class="text-dark text-decoration-none">
                    {{ Str::limit($item->judul, 70) }}
                  </a>
                </h6>
                <small class="text-muted">{{ $item->tanggal_publish->translatedFormat('d M Y') }}</small>
              </div>
            </div>
          @empty
            <p class="text-muted">Tidak ada berita terkait.</p>
          @endforelse
        </div>
      </aside>

    </div>
  </section>
</main>
@endsection
