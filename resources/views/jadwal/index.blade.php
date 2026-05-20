<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Pelajaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="p-6">

    <h2 class="text-2xl font-bold mb-3">
        Jadwal Hari {{ $hari }}
    </h2>

    <!-- BUTTON HARI -->
    <div class="flex gap-2 mb-6">
        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
            <a href="{{ route('jadwal.index', ['hari'=>$h]) }}"
               class="px-4 py-2 rounded 
               {{ $hari == $h ? 'bg-blue-500 text-white' : 'bg-white shadow' }}">
                {{ $h }}
            </a>
        @endforeach
    </div>

    <!-- TABEL -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">

            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="p-3">Jam</th>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Mata Pelajaran</th>
                    <th class="p-3">Guru</th>
                </tr>
            </thead>

            <tbody>
                @forelse($jadwals as $jadwal)
                <tr class="border-b hover:bg-gray-100">

                    <!-- JAM (ISTIRAHAT jadi "-") -->
                    <td class="p-3">
                        {{ is_null($jadwal->jam_ke) ? '-' : $jadwal->jam_ke }}
                    </td>

                    <td class="p-3">
                        {{ $jadwal->waktu ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $jadwal->guru->mapel->nama_mapel ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $jadwal->guru->nama ?? '-' }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Belum ada jadwal
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

</body>
</html>