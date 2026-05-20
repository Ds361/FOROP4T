<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Siswa {{ $kelas->nama_kelas }}</title>
</head>
<body>

   <div class="header-container" style="padding-left: 80px; padding-right: 80px;">
    <h1>Jadwal Pembelajaran Kelas {{ $kelas->nama_kelas }}</h1>
    </div>

    <!-- BUTTON HARI -->
    <div class="nav-filter">
    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari_item)
        {{-- Kita cek jika hari yang dipilih di URL sama dengan hari_item, maka beri class active-day --}}
        <a href="{{ route('kelas.show', [$kelas->id, 'tab' => 'jadwal', 'hari' => $hari_item]) }}" 
           class="{{ request('hari', 'Senin') == $hari_item ? 'active-day' : '' }}">
           {{ $hari_item }}
        </a>
    @endforeach
</div>

    <!-- TABLE -->
    <div class="table-container">
    <table class="jadwal-table">
        <thead>
            <tr>
                <th>Jam Ke</th>
                <th>Waktu</th>
                <th>Mata Pelajaran</th>
                <th>Nama Guru</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $j)
            {{-- Kita buat variabel pembantu untuk mengecek istirahat agar kode lebih bersih --}}
            @php
                $isIstirahat = ($j->jam_ke == '4.5' || $j->jam_ke == '7.5');
            @endphp

            <tr>
                <td class="text-center">
                    @if($isIstirahat)
                        <span class="text-red-600 font-bold">ISTIRAHAT</span>
                    @else
                        {{ $j->jam_ke ?? '-' }}
                    @endif
                </td>

                <td class="text-center">{{ $j->waktu ?? 'ISTIRAHAT' }}</td>

                <td>
                    @if($isIstirahat)
                        <span class="text-red-600 font-bold">ISTIRAHAT</span>
                    @else
                        {{ $j->guru->mapel->nama_mapel ?? 'ISTIRAHAT' }}
                    @endif
                </td>

                <td>
                    @if($isIstirahat)
                        -
                    @else
                        {{ $j->guru->nama ?? '-' }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">
                    Tidak ada jadwal untuk hari {{ $hari }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>