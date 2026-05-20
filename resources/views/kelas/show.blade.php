<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kelas {{ $kelas->nama_kelas }}</title>
    @vite(['resources/css/kelas.css', 'resources/js/kelas.js', 'resources/css/absensi.css'])
    
</head>
<body>
    <nav>
        <div class="logo">
            <div class="circle"></div>
            <ul>
            <li><a href="{{ route('dashboard') }}"><span>FOROP4T</span></a></li>
        </ul>
        </div>
    </nav>

   <section class="hero-section">
    <div class="text-content">
        <h1 style="color:#2d7b84;">{{ $kelas->nama_kelas }}</h1>
        <p style="color:#2d7b84;">Informasi mengenai kelas {{ $kelas->nama_kelas }} untuk mempermudah pengelolaan informasi</p>

        <div class="card-container">
            <a href="{{ route('kelas.show', [$kelas->id, 'tab' => 'siswa']) }}" 
               class="main-card {{ $tab == 'siswa' ? 'active' : '' }}" 
               data-target="illustration-siswa">
                <span class="card-icon">👥</span> <h3>Data Siswa</h3>
            </a>
            <a href="{{ route('kelas.show', [$kelas->id, 'tab' => 'jadwal']) }}" 
               class="main-card {{ $tab == 'jadwal' ? 'active' : '' }}" 
               data-target="illustration-jadwal">
                <span class="card-icon">📅</span> <h3>Jadwal</h3>
            </a>
            <a href="{{ route('kelas.show', [$kelas->id, 'tab' => 'absensi']) }}" 
               class="main-card {{ $tab == 'absensi' ? 'active' : '' }}" 
               data-target="illustration-absensi">
                <span class="card-icon">📋</span> <h3>Absensi</h3>
            </a>
        </div>
    </div>

<div class="illustration-container">
    <div id="illustration-siswa" class="illustration-item {{ $tab == 'siswa' ? 'active' : '' }}">
        <img src="{{ asset('IconDataSiswa.png') }}" class="img-content" alt="Data Siswa">
    </div>

    <div id="illustration-jadwal" class="illustration-item {{ $tab == 'jadwal' ? 'active' : '' }}">
        <img src="{{ asset('IconJadwal.png') }}" class="img-content" alt="Jadwal">
    </div>

    <div id="illustration-absensi" class="illustration-item {{ $tab == 'absensi' ? 'active' : '' }}">
        <img src="{{ asset('IconAbsensi.png') }}" class="img-content" alt="Absensi">
    </div>
</div>

</section>

<br><br>

    <div class="data-section">
        @if($tab == 'jadwal')
            @include('kelas.datakelas.tabel_jadwal')
        @elseif($tab == 'absensi')
            @include('kelas.datakelas.Absensi')
        @else
            @include('kelas.datakelas.DataSiswa')
        @endif
    </div>

     <footer>
    <p>Ikuti kami di Instagram:</p>
    <p>
      <a href="https://www.instagram.com/nsyd.a/" target="_blank">@nsyd.a</a> |
      <a href="https://www.instagram.com/rhhdes/" target="_blank">@rhhdes</a> |
      <a href="https://www.instagram.com/naurahsbl_/" target="_blank">@naurahsbl</a>
    </p>

    <br>

    <p style="font-weight: bold;">©2026</p>
  </footer>
</body>
</html>