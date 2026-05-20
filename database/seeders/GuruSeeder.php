<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run()
    {
        Guru::insert([
            [
                'nama' => 'Yudi Kartiwa S.Pd, S.St, M.Pd',
                'jabatan' => 'Kepala SMKN 4 Bandung',
                'mapel_id' => 1,
                'foto' => 'guru/Kratz.jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Siti Aminah',
                'jabatan' => 'Guru',
                'mapel_id' => 2,
                'foto' => 'default.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // 🔽 tinggal lanjut sampai 20
        ]);
    }
}