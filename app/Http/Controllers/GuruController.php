<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index(Request $request)
{
    // 1. Ambil input filter dari URL
   $jabatanFilter = $request->get('jabatan');

    $gurus = Guru::with('mapel')
        ->when($jabatanFilter, function ($query) use ($jabatanFilter) {
            // Memfilter berdasarkan kolom jabatan di database
            return $query->where('jabatan', $jabatanFilter);
        })
        ->get();

    return view('guru.index', compact('gurus'));
}
}



