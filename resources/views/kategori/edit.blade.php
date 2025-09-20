@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Kategori</h3>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="kode_kategori">Kode Kategori</label>
            <input type="text" name="kode_kategori" id="kode_kategori"
                   class="form-control @error('kode_kategori') is-invalid @enderror"
                   value="{{ old('kode_kategori', $kategori->kode_kategori) }}" required maxlength="10">
            @error('kode_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori"
                   class="form-control @error('nama_kategori') is-invalid @enderror"
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
            @error('nama_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan"
                      class="form-control @error('keterangan') is-invalid @enderror"
                      rows="3">{{ old('keterangan', $kategori->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
