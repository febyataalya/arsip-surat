@extends('layouts.app')

@section('content')
<h2>Arsip Surat >> Unggah</h2>
<p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.</p>
<p>Catatan:</p>
<ul>
    <li>Gunakan file berformat PDF</li>
</ul>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nomor_surat" class="form-label">Nomor Surat</label>
        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-control" id="kategori" name="kategori" required>
            @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" required>
    </div>
    <div class="mb-3">
        <label for="file_surat" class="form-label">File Surat (PDF)</label>
        <input type="file" class="form-control" id="file_surat" name="file_surat" accept=".pdf" required>
    </div>
    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection