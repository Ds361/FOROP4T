<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas; 
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.index');
        
    }


    public function xirpl3()
    {
        $kelas = Kelas::with('siswa')->findOrFail(6);

        return view('kelas.kelas_xirpl3.DataSiswa', compact('kelas'));
    }
}