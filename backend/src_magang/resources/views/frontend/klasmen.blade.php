@extends('layouts.app')

@section('title', 'Klasemen Liga')

@section('content')
<main class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Klasemen Liga</h2>

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-3" id="klasmenTabs" role="tablist">
        @foreach ($kategoriList as $kategori)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $kategori->id }}" data-bs-toggle="tab"
                    data-bs-target="#liga-{{ $kategori->id }}" type="button" role="tab">
                    {{ $kategori->nama_liga }}
                </button>
            </li>
        @endforeach
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content" id="klasmenTabsContent">
        @foreach ($kategoriList as $kategori)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="liga-{{ $kategori->id }}" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Pos</th>
                                <th>Klub</th>
                                <th>Main</th>
                                <th>Menang</th>
                                <th>Seri</th>
                                <th>Kalah</th>
                                <th>Selisih Gol</th>
                                <th>Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori->klasmen as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_tim }}</td>
                                    <td>{{ $item->jumlah_pertandingan }}</td>
                                    <td>{{ $item->menang }}</td>
                                    <td>{{ $item->seri }}</td>
                                    <td>{{ $item->kalah }}</td>
                                    <td>{{ $item->selisih_gol }}</td>
                                    <td class="fw-bold">{{ $item->poin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection
