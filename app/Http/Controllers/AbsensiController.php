<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function store(Request $request)
    {
         $tanggal = $request->tanggal;

    foreach ($request->input('status', []) as $siswa_id => $status) {
        Absensi::updateOrCreate(
            ['siswa_id' => $siswa_id, 'tanggal' => $tanggal],
            ['status'   => $status]
        );
    }

    return redirect("/kelas/{$request->kelas_id}?tab=absensi")
        ->with('success', 'Absensi berhasil disimpan!');
    }

    public function destroy($id)
    {
        Absensi::findOrFail($id)->delete();
        return back()->with('success', 'Data absensi dihapus.');
    }

    public function updateSingle(Request $request)
{
    Absensi::updateOrCreate(
        [
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal
        ],
        [
            'status' => $request->status
        ]
    );

    return back()->with('success', 'Absensi diupdate');
}

public function hapus(Request $request)
{
     Absensi::whereDate('tanggal', $request->tanggal)
        ->whereIn('siswa_id', Siswa::where('kelas_id', $request->kelas_id)->pluck('id'))
        ->delete();

    return redirect("/kelas/{$request->kelas_id}?tab=absensi")
        ->with('success', 'Data absensi berhasil dihapus.');
}

}