<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Mapel;


class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'mapel_id'
    ];

    public function mapel() {
    return $this->belongsTo(Mapel::class, 'mapel_id'); // Pastikan 'mapel_id' sesuai nama kolom
}


}