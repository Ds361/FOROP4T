<div class="absensi-wrap">
  <div class="header-container" style="padding-left: 80px; padding-right: 80px;">
    <h1>Absensi Kelas {{ $kelas->nama_kelas }}</h1>
  </div>

  {{-- CARD FORM --}}
  <div class="card-form">
    <h3>Input Absensi</h3>

    <form method="POST" action="/absensi">
      @csrf
      <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

      <input type="date" name="tanggal" id="tanggal-input" value="{{ $tanggal }}">

      {{-- Toggle daftar siswa --}}
      <div style="margin-top: 12px;">
        <button type="button" onclick="toggleSiswa()">
          Pilih Status Siswa ▼
        </button>

        @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

      </div>

      <div id="daftar-siswa" style="display:none; margin-top: 12px;">
        <table>
          @foreach ($siswa as $i => $s)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->nama }}</td>
            <td>
              <input type="hidden" name="status[{{ $s->id }}]" id="hidden-{{ $s->id }}" value="{{ $absensi[$s->id]->status ?? 'hadir' }}">
              <div class="btn-group">
                <button type="button" class="btn-status {{ ($absensi[$s->id]->status ?? '') == 'izin' ? 'active' : '' }}"
                  data-id="{{ $s->id }}" data-status="izin"
                  onclick="setStatus({{ $s->id }}, 'izin')">Izin</button>
                <button type="button" class="btn-status {{ ($absensi[$s->id]->status ?? '') == 'sakit' ? 'active' : '' }}"
                  data-id="{{ $s->id }}" data-status="sakit"
                  onclick="setStatus({{ $s->id }}, 'sakit')">Sakit</button>
                <button type="button" class="btn-status {{ ($absensi[$s->id]->status ?? '') == 'alpha' ? 'active' : '' }}"
                  data-id="{{ $s->id }}" data-status="alpha"
                  onclick="setStatus({{ $s->id }}, 'alpha')">Alpha</button>
              </div>
            </td>
          </tr>
          @endforeach
        </table>

        <button type="submit" style="margin-top: 12px;">Simpan Absensi</button>
      </div>

    </form>
  </div>
  <br>

  <div class="divider"></div>

  {{-- RIWAYAT --}}
  
  <br>
  <h3>Riwayat Absensi</h3>
  <table border="1" cellpadding="10">
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Hadir</th>
      <th>Tidak Hadir</th>
      <th>Daftar Tidak Hadir</th>
      <th>Aksi</th>
    </tr>
    @forelse($rekap as $tgl => $data)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $tgl }}</td>
      <td>{{ $data['hadir'] }} siswa</td>
      <td>{{ $data['tidak_hadir'] }} siswa</td>
      <td>{{ $data['daftar'] ?: '-' }}</td>
      <td>
  <form method="POST" action="/absensi/hapus">
    @csrf
    @method('DELETE')
    <input type="hidden" name="tanggal" value="{{ $tgl }}">
    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
    <button type="submit" class="btn-status" onclick="return confirm('Hapus absensi {{ $tgl }}?')">Hapus</button>
  </form>
</td>
    </tr>
    @empty
    <tr><td colspan="5">Belum ada data.</td></tr>
    @endforelse
  </table>
</div>

<script>
function toggleSiswa() {
  const div = document.getElementById('daftar-siswa');
  const btn = event.target;
  if (div.style.display === 'none') {
    div.style.display = 'block';
    btn.textContent = 'Tutup ▲';
  } else {
    div.style.display = 'none';
    btn.textContent = 'Pilih Status Siswa ▼';
  }
}

function setStatus(id, status) {
  const hidden = document.getElementById('hidden-' + id);
  const btns = document.querySelectorAll(`[data-id="${id}"]`);

  if (hidden.value === status) {
    hidden.value = 'hadir';
    btns.forEach(b => b.classList.remove('active'));
  } else {
    hidden.value = status;
    btns.forEach(b => b.classList.remove('active'));
    document.querySelector(`[data-id="${id}"][data-status="${status}"]`).classList.add('active');
  }
}
</script>