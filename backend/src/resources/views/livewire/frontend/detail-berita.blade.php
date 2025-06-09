<div>
    <main class="container py-5">
<section class="py-0">
  <div class="container d-flex gap-4 flex-wrap flex-lg-nowrap">
    <!-- Artikel -->
    <article class="flex-grow-1 pe-lg-4 article-content">
    <h1>{{ $berita->judul }}</h1>
  <div class="small">
          Oleh {{ $berita->user->name ?? 'Admin' }} – <span style="color:#c0392b; font-weight:600;">{{ $berita->category->nama_liga ?? '-' }}</span> |
          {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, j F Y H:i') }}
        </div>
  <figure>
    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
    <figcaption>Foto: Manchester United via Getty Imag/Ash Donelon</figcaption>
  </figure>

  <div class="article-body mt-4">
    <!-- Halaman 1 -->
    <div class="page-content" id="page-1">
      {!! nl2br(e($berita->deskripsi)) !!}
    </div>

    <!-- Halaman 2 -->
    {{-- <div class="page-content d-none" id="page-2">
      {!! nl2br(e($berita->deskripsi)) !!}
    </div> --}}

    <!-- Navigasi -->
    <div class="mt-3 d-flex justify-content-end gap-2">
      <button id="prevBtn" class="btn btn-outline-secondary btn-sm" disabled>⬅️ Sebelumnya</button>
      <button id="nextBtn" class="btn btn-outline-primary btn-sm">Selanjutnya ➡️</button>
    </div>
  </div>
</article>

    <!-- Berita Terkait -->
    <aside class="col-lg-4 section-terkait">
      <h3>Berita Terkait</h3>
      <div class="related-wrapper">
        @foreach($beritaTerkait as $item)
        <a href="{{ route('berita.detail', $item->id) }}" class="related-card text-decoration-none text-dark">
        <div class="related-card">
          <img src="{{ asset('storage/' . $item->gambar) }}" alt="">
          <div>
            <small class="text-danger">{{ $item->category->nama_liga ?? '-' }}</small>
            <h6>{{ Str::limit($item->judul, 80) }}</h6>
            <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('l, j F Y') }}</small>
          </div>
        </div>
        </a>
        @endforeach
      </div>
    </aside>
  </div>
</section>

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
