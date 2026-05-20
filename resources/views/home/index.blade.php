<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>FOROP4T</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body>
  <nav>
    <div class="logo">
      <div class="circle"></div>
      <a href="{{ route('dashboard') }}" class="tombol">FOROP4T</a> </div>

    </div>
    <ul>
      <li><a href="#kelas">Daftar Kelas</a></li>
      <li><a href="#guru">Data Guru</a></li>
    </ul>
  </nav>

  <!-- HERO FULLSCREEN -->
  <section class="hero">

    <div class="text">
      <h2>Selamat Datang di FOROP4T</h2>
      <p>Temukan informasi seputar kelas, guru, dan jadwal pembelajaran dengan mudah melalui website ini.</p>

      <a href="#kelas" class="button">Lihat Kelas</a> 

      </div>

    <div class="image">
      <img src="{{ asset('smkn4bdg.jpeg') }}" alt="">
    </div>
  </section>

   <!-- DAFTAR KELAS -->
  <section id="kelas" class="kelas-section">
    <h2>Daftar Kelas</h2>
    <select id="kelasSelect">
      <option value="X " selected>Kelas 10</option>
      <option value="XI">Kelas 11</option>
      <option value="XII">Kelas 12</option>
    </select>

  <div id="passwordModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <h3>Akses Kelas</h3>
        <p>Masukkan password untuk melanjutkan</p>
        
        <form id="passwordForm">
            @csrf
            <input type="hidden" id="kelas_id" name="kelas_id">
            
            <input type="password" name="password" class="input-pw" placeholder="Masukkan Password" required>

            <div class="button-group">
                <button type="submit" class="btn-login">Masuk Ke Kelas</button>
                <button type="button" onclick="closeModal()" class="btn-cancel">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="kelas-container">
    @foreach($semuaKelas as $kelas)
    <button 
        type="button"
        onclick="openModal('{{ $kelas->id }}')" 
        class="kelas-card"
        data-tingkat="{{ substr($kelas->nama_kelas, 0, 2) }}"
    >
        {{ $kelas->nama_kelas }}
    </button>
    @endforeach
</div>


<script>
    // FUNGSI MODAL
    function openModal(id) {
        document.getElementById('kelas_id').value = id;
        document.getElementById('passwordModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('passwordModal').style.display = 'none';
    }

    // Menangani submit form
    document.getElementById('passwordForm').onsubmit = function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        fetch("{{ route('kelas.check-password') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.href = data.redirect_url;
            } else {
                alert('Password Salah!');
            }
        })
        .catch(error => console.error('Error:', error));
    };

    // FUNGSI FILTER KELAS (Sudah benar)
    const select = document.getElementById('kelasSelect');
    function filterKelas() {
        let selected = select.value;
        document.querySelectorAll('.kelas-card').forEach(card => {
            card.style.display = (selected == card.getAttribute('data-tingkat')) ? 'flex' : 'none';
        });
    }

    // FUNGSI SUBMIT PASSWORD (AJAX)
    document.getElementById('passwordForm').onsubmit = function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        fetch("{{ route('kelas.check-password') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                window.location.href = data.redirect_url;
            } else {
                alert('Password Salah!');
            }
        });
    };

    select.addEventListener('change', filterKelas);
    window.addEventListener('DOMContentLoaded', filterKelas);
</script>
  </section>

  <!-- DATA GURU -->
  <section id="guru" class="guru-section">

  <div class="guru-card">
    <div class="foto">
        <img src="{{ asset('dbguru.png') }}" alt="gurupict">
    </div>

    <div class="text">
      <div class="h2"> <h2>Data Guru</h2> </div>
      
       <p>Berikut ini merupakan 
        data dari guru-guru yang mengajar di SMKN 4 Bandung
         dalam berbagai bidang kejuruan. Terdapat bidang kejuruan Pengembangan Perangkat Lunak dan Game, Desain Komunikasi Visual (DKV), Teknik Jaringan Komputer dan Telekomunikasi (TJKT), Teknik Otomasi Industri, Teknik Ketenagalistrikan, dan Teknik Elektronika
        </p>
      <a href="{{ route('guru.index') }}" class="tombol">Lihat Selengkapnya</a> </div>
      
    </div>
    
  </section>

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

<script>
const select = document.getElementById('kelasSelect');

function filterKelas() {
    let selected = select.value;
    let cards = document.querySelectorAll('.kelas-card');

    cards.forEach(card => {
        let tingkat = card.getAttribute('data-tingkat');

        if (selected == tingkat) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

<div id="passwordModal" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <h3>Akses Kelas</h3>
        <p style="color: var(--text-secondary); margin-bottom: 20px;">Masukkan password untuk melanjutkan</p>
        
        <form id="passwordForm">
            @csrf
            <input type="hidden" id="kelas_id" name="kelas_id">
            <input type="password" id="password" name="password" 
                   class="input-pw" placeholder="••••••••" required>
            
            <button type="submit" class="btn-login">Masuk ke Kelas</button>
            <button type="button" onclick="closeModal()" 
                    style="margin-top: 15px; background: none; border: none; color: #999; cursor: pointer;">
                Batal
            </button>
        </form>
    </div>
</div>

select.addEventListener('change', filterKelas);

window.addEventListener('DOMContentLoaded', filterKelas);
</script>