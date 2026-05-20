<!DOCTYPE html>
<html>
<head>
    <title>Siswa {{ $kelas->nama_kelas }}</title>
</head>
<body>

   <div class="header-container" style="padding-left: 80px; padding-right: 80px;">
    <h1>Data Siswa Kelas {{ $kelas->nama_kelas }}</h1>
</div>

    <table cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>NISN</th>
        </tr>

        @foreach ($kelas->siswa as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->nis }}</td>
            <td>{{ $s->nisn }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>