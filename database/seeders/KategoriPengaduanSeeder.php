<?php

namespace Database\Seeders;
use \App\Models\KategoriPengaduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Infrastruktur', 'Lingkungan', 'Layanan Publik', 'Sosial'];

        foreach ($data as $kategori) {
            KategoriPengaduan::create(['name_kategori' => $kategori]);
        }
    }
}
