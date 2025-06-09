<div>
    <div class="container mt-4">
  <!-- Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    @foreach ($categories as $category)
      <li class="nav-item">
        <a 
          wire:click.prevent="switchTab({{ $category->id }})" 
          class="nav-link {{ $activeTab === $category->id ? 'active' : '' }}" 
          href="#">
          {{ $category->nama_liga }}
        </a>
      </li>
    @endforeach
  </ul>

  <!-- Tabel klasemen -->
  <div class="mt-4">
    @if($klasemens->isEmpty())
      <div class="alert alert-warning">Belum ada data</div>
    @else
      <table class="table table-bordered">
        <thead>
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
          @foreach($klasemens as $i => $klub)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $klub->nama_tim }}</td>
              <td>{{ $klub->jumlah_pertandingan }}</td>
              <td>{{ $klub->menang }}</td>
              <td>{{ $klub->seri }}</td>
              <td>{{ $klub->kalah }}</td>
              <td>{{ $klub->selisih_gol }}</td>
              <td>{{ $klub->poin }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <button class="btn btn-primary mt-3" onclick="history.back()">Kembali</button>
</div>

</div>
