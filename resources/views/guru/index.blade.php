<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>FOROP4T</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- CDN Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    </head>

<body class="bg-gray-100">
  <nav>
    <div class="logo">
      <div class="circle"></div>
      <a href="{{ route('dashboard') }}" class="tombol">FOROP4T</a> </div>

  </nav>

  <div class="container mx-auto p-6">

    <h2 class="text-2xl font-bold mb-6">Daftar Guru SMKN 4 Bandung</h2>

<div class="flex justify-center mb-8">
            <select onchange="window.location.href=this.value" 
                    class="px-8 py-3 rounded-full border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                <option value="{{ route('guru.index') }}" @selected(!request('jabatan'))>
                    Semua Guru
                </option>
                <option value="{{ route('guru.index', ['jabatan' => 'Guru Umum']) }}" 
                        @selected(request('jabatan') == 'Guru Umum')>
                    Guru Umum
                </option>
                <option value="{{ route('guru.index', ['jabatan' => 'Guru Kejuruan']) }}" 
                        @selected(request('jabatan') == 'Guru Kejuruan')>
                    Guru Kejuruan
                </option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($gurus as $guru)
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition flex flex-col items-center">
                    
                    <div class="flex justify-center mb-4">
                        @if($guru->foto && file_exists(public_path('guruassets/' . $guru->foto)))
                            <img src="{{ asset('guruassets/' . $guru->foto) }}"
                                class="w-24 h-24 rounded-full object-cover border flex-shrink-0" 
                                alt="{{ $guru->nama }}">

                        @elseif($guru->id == 65)
                            <img src="{{ asset('guruassets/Guru_Arief.png') }}"
                                class="w-24 h-24 rounded-full object-cover border flex-shrink-0" 
                                alt="Pak Arief">

                        @else
                            <div class="w-24 h-24 rounded-full bg-blue-100 border flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 font-bold text-2xl">
                                    {{ substr($guru->nama, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-semibold text-center mt-auto">
                        {{ $guru->nama }}
                    </h3>

                    <p class="text-sm text-gray-500 text-center">
                        {{ $guru->jabatan }}
                    </p>

                    <p class="mt-2 text-center text-blue-600 font-medium">
                        {{ optional($guru->mapel)->nama_mapel ?? '-' }}
                    </p>
                </div>
            @empty
                <p class="text-center col-span-full text-gray-500">Tidak ada guru dengan kategori tersebut.</p>
            @endforelse
        </div>
    </div>

</div>

<br>

<!-- FOOTER -->
  <footer>
    <p>Ikuti kami di Instagram:</p>
    <p>
      <a href="https://www.instagram.com/nsyd.a/" target="_blank">akun1</a> |
      <a href="https://www.instagram.com/rhhdes/" target="_blank">akun2</a> |
      <a href="https://www.instagram.com/naurahsbl_/" target="_blank">akun3</a>
    </p>

    <br>

    <p style="font-weight: bold;">©2026</p>
  </footer>

</body>
</html>