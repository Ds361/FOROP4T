<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $hari = $request->hari ?? 'Senin';

        $jadwals = Jadwal::with(['guru.mapel'])
            ->where('hari', $hari)
            ->orderBy('jam_ke', 'asc')
            ->get();

        return view('jadwal.index', compact('jadwals', 'hari'));
    }
}