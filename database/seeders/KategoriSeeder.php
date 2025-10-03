<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori; // <-- PENTING: Tambahkan baris ini

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Undangan', 'keterangan' => 'Surat yang bersifat mengundang seseorang atau suatu pihak.'],
            ['nama_kategori' => 'Pengumuman', 'keterangan' => 'Surat yang berisi pengumuman resmi.'],
            ['nama_kategori' => 'Nota Dinas', 'keterangan' => 'Surat yang digunakan untuk komunikasi internal antar pejabat.'],
            ['nama_kategori' => 'Pemberitahuan', 'keterangan' => 'Surat yang berfungsi untuk memberikan informasi atau pemberitahuan.'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}