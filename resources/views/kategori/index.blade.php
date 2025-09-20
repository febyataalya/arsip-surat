@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kategori Surat</h3>
    <p>Berikut adalah kategori surat yang bisa digunakan untuk melabeli surat.</p>

    <a href="{{ route('kategori.create') }}" class="btn btn-success mb-3">
        [+] Tambah Kategori Baru...
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Kategori</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th> {{-- pindahkan isi kolom aksi ke sini --}}
                <th>Aksi</th> {{-- heading baru untuk tombol edit/hapus --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $kategori)
                <tr>
                    <td>{{ $kategori->id }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>{{ $kategori->keterangan ?? '-' }}</td> {{-- ini sekarang isi keterangan --}}
                    <td>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $kategoris->links() }}
</div>
@endsection
