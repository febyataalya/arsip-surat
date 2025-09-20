@extends('layouts.app')

@section('content')
<h2>Arsip Surat >> Lihat</h2>
<hr>
<h3>{{ $surat->judul }}</h3>
<p>Nomor: {{ $surat->nomor_surat }}</p>
<p>Kategori: {{ $surat->kategori->nama_kategori }}</p>
<p>Waktu Unggah: {{ $surat->created_at->format('Y-m-d H:i') }}</p>

<div class="card p-3 my-3">
    <embed src="{{ Storage::url($surat->file_path) }}" type="application/pdf" width="100%" height="600px" />
</div>

<div class="d-flex gap-2 mt-3">
    <a href="{{ route('surat.index') }}" class="btn btn-secondary"><< Kembali</a>
    <a href="{{ route('surat.download', $surat) }}" class="btn btn-success">Unduh</a>
</div>
@endsection