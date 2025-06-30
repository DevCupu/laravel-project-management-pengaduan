<?php

namespace Database\Seeders;
use \App\Models\WargaTerdaftar;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WargaTerdaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        WargaTerdaftar::create([
            'nik' => '7371123456789013',
            'nama' => 'Budi Santoso',
            'alamat' => 'Jl. Mawar No.7',
            'kelurahan' => 'Rappocini',
        ]);

        WargaTerdaftar::create([
            'nik' => '7371123456789014',
            'nama' => 'Dewi Lestari',
            'alamat' => 'Jl. Melati No.12',
            'kelurahan' => 'Biringkanaya',
        ]);

        WargaTerdaftar::create([
            'nik' => '7371123456789015',
            'nama' => 'Irwan Saputra',
            'alamat' => 'Jl. Kenanga No.3',
            'kelurahan' => 'Manggala',
        ]);

        WargaTerdaftar::create([
            'nik' => '7371123456789016',
            'nama' => 'Nur Aisyah',
            'alamat' => 'Jl. Anggrek No.8',
            'kelurahan' => 'Ujung Pandang',
        ]);

        WargaTerdaftar::create([
            'nik' => '7371123456789017',
            'nama' => 'Rizky Pratama',
            'alamat' => 'Jl. Flamboyan No.15',
            'kelurahan' => 'Mamajang',
        ]);
    }
}
