@extends('layouts.app')

@section('content')
<h2>Arsip Surat >> Unggah</h2>
<p>Berikut adalah surat-surat yang telah terbit dan diarsipkan.<br>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('surat.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Cari surat..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nomor Surat</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Waktu Pengarsipan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($surats as $surat)
        <tr>
            <td>{{ $surat->nomor_surat }}</td>
            <td>{{ $surat->kategori->nama_kategori }}</td>
            <td>{{ $surat->judul }}</td>
            <td>{{ $surat->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <div class="d-flex gap-2">
                    <form action="{{ route('surat.destroy', $surat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip surat ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <a href="{{ route('surat.download', $surat) }}" class="btn btn-success btn-sm">Unduh</a>
                    <a href="{{ route('surat.show', $surat) }}" class="btn btn-info btn-sm">Lihat >></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('surat.create') }}" class="btn btn-primary">Arsipkan Surat..</a>
@endsection