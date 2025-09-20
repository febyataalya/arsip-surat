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
            ['nama_kategori' => 'Undangan', 'judul' => 'Surat yang bersifat mengundang seseorang atau suatu pihak.'],
            ['nama_kategori' => 'Pengumuman', 'judul' => 'Surat yang berisi pengumuman resmi.'],
            ['nama_kategori' => 'Nota Dinas', 'judul' => 'Surat yang digunakan untuk komunikasi internal antar pejabat.'],
            ['nama_kategori' => 'Pemberitahuan', 'judul' => 'Surat yang berfungsi untuk memberikan informasi atau pemberitahuan.'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}