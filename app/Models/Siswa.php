<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
     protected $table = 'siswas';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
