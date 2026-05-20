<?php
namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class KelasController extends Controller {
    public function index() {
        $semuaKelas = Kelas::all();
        return view('home.index', compact('semuaKelas'));
    }

public function checkPassword(Request $request) {
   $kelas = \App\Models\Kelas::findOrFail($request->kelas_id);

    if (\Illuminate\Support\Facades\Hash::check($request->password, $kelas->password)) {
        return response()->json([
            'success' => true,
            'redirect_url' => route('kelas.show', $kelas->id)
        ]);
    }

    return response()->json(['success' => false, 'message' => 'Password Salah'], 401);
}

public function show($id, Request $request) 
    {
        $kelas = Kelas::findOrFail($id);
        $tab = $request->query('tab', 'siswa');
        $hari = $request->query('hari', 'Senin');
        $siswa = Siswa::where('kelas_id', $id)->get();

        $tanggal = $request->query('tanggal', now()->toDateString());

        $absensi = Absensi::whereDate('tanggal', $tanggal)
        ->whereIn('siswa_id', $siswa->pluck('id'))
        ->get()
        ->keyBy('siswa_id');

        $rekap = Absensi::with('siswa')
    ->whereIn('siswa_id', $siswa->pluck('id'))
    ->get()
    ->groupBy('tanggal')
    ->map(function($rows) {
        $tidakHadir = $rows->where('status', '!=', 'hadir');
        return [
            'hadir'       => $rows->where('status', 'hadir')->count(),
            'tidak_hadir' => $tidakHadir->count(),
            'daftar'      => $tidakHadir->map(fn($r) => $r->siswa->nama . ' (' . $r->status . ')')->join(', ')
        ];
    })
    ->sortKeysDesc();

      $jadwals = Jadwal::with('guru.mapel')
    ->where('kelas_id', $id)
    ->where('hari', $hari)
    ->orderByRaw("STR_TO_DATE(SUBSTRING_INDEX(waktu, '-', 1), '%H.%i')")
    ->get();

        return view('kelas.show', compact('kelas', 'jadwals', 'tab', 'hari', 'siswa', 'absensi', 'tanggal', 'rekap'));
    }
}