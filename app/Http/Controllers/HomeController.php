<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller

{

    public function index() {
        // Mengambil semua data dari tabel 'kelas'
    $semuaKelas = \App\Models\Kelas::all(); 
    
    // Mengirim data ke view
    return view('dashboard', compact('semuaKelas'));
    }

}
