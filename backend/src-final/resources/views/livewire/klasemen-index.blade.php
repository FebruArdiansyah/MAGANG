<div>
    <ul class="nav nav-tabs mb-3">
        @foreach($kategoriList as $name)
            <li class="nav-item">
                <button wire:click="$set('kategori', '{{ $name }}')" class="nav-link @if($name === $kategori) active @endif">
                    {{ $name }}
                </button>
            </li>
        @endforeach
    </ul>

    <h3 class="text-center">{{ $kategori }}</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Posisi</th>
                <th>Nama Klub</th>
                <th>Jumlah Pertandingan</th>
                <th>Menang</th>
                <th>Seri</th>
                <th>Kalah</th>
                <th>Selisih Gol</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($klasemen as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->team->nama ?? '-' }}</td>
                    <td>{{ $data->jumlah_pertandingan }}</td>
                    <td>{{ $data->menang }}</td>
                    <td>{{ $data->seri }}</td>
                    <td>{{ $data->kalah }}</td>
                    <td>{{ $data->selisih_gol }}</td>
                    <td>{{ $data->poin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
