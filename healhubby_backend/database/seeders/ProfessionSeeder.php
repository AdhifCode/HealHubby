<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    public function run()
    {
        $Professions = [
            ['name' => 'Dokter'],
            ['name' => 'Perawat'],
            ['name' => 'Bidan'],
            ['name' => 'Apoteker'],
            ['name' => 'Ahli Gizi'],
            ['name' => 'Mahasiswa'],
            ['name' => 'Dosen'],
            ['name' => 'Peneliti'],
        ];

        Profession::insert($Professions);
    }
}
