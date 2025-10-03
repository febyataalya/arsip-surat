<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'kategori_id',
        'judul',
        'file_path',
        'filename_original',
        'filename_stored',
        'file_size',
        'mime',
    ];

    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori::class, 'kategori_id');
    }
}
