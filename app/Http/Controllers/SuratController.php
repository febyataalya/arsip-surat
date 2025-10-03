<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuratController extends Controller
{
    /**
     * Daftar surat (dengan pencarian & pagination).
     */
    public function index(Request $request)
    {
        $query = Surat::with('kategori')->latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $surats = $query->paginate(10)->withQueryString();

        return view('surat.index', compact('surats'));
    }

    /**
     * Form tambah surat.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('surat.create', compact('kategoris'));
    }

    /**
     * Simpan surat baru (upload file ke disk 'public').
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:surats,nomor_surat',
            'kategori'    => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'file_surat'  => 'required|file|mimes:pdf|max:10240',
        ]);

        $filePath = null;
        $filenameOriginal = null;
        $filenameStored = null;
        $fileSize = null;
        $mime = null;

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filenameOriginal = $file->getClientOriginalName();
            $safeName = time() . '_' . Str::slug(pathinfo($filenameOriginal, PATHINFO_FILENAME));
            $safeName .= '.' . $file->getClientOriginalExtension();
            $filenameStored = $safeName;
            $filePath = $file->storeAs('surat', $safeName, 'public');
            $fileSize = $file->getSize();
            $mime = $file->getMimeType();
        }

        Surat::create([
            'nomor_surat'       => $validated['nomor_surat'],
            'kategori_id'       => $validated['kategori'],
            'judul'             => $validated['judul'],
            'file_path'         => $filePath,
            'filename_original' => $filenameOriginal,
            'filename_stored'   => $filenameStored,
            'file_size'         => $fileSize,
            'mime'              => $mime,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil disimpan.');
    }

    /**
     * Tampilkan detail / preview surat.
     */
    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    /**
     * Download file surat.
     */
    public function download(Surat $surat)
    {
        // Kalau tidak ada file
        if (!$surat->file_path) {
            return redirect()->back()->with('error', 'File surat belum diunggah.');
        }

        // Kalau file tidak ditemukan di disk public
        if (! Storage::disk('public')->exists($surat->file_path)) {
            return redirect()->back()->with('error', 'File surat tidak ditemukan pada penyimpanan.');
        }

        // Nama file yang diunduh: judul-suratslug.pdf (atau gunakan nama file asli)
        $ext = pathinfo($surat->file_path, PATHINFO_EXTENSION);
        $downloadName = Str::slug($surat->judul) . '.' . ($ext ?: 'pdf');

        return Storage::disk('public')->download($surat->file_path, $downloadName);
    }

    /**
     * Hapus surat dan file terkait.
     */
    public function destroy(Surat $surat)
    {
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus.');
    }

    /**
     * Form edit (opsional).
     */
    public function edit(Surat $surat)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('surat.edit', compact('surat', 'kategoris'));
    }

    /**
     * Update surat (jika upload file baru, hapus file lama).
     */
    public function update(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|unique:surats,nomor_surat,' . $surat->id,
            'kategori'    => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'file_surat'  => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $filenameOriginal = $surat->filename_original;
        $filenameStored = $surat->filename_stored;
        $fileSize = $surat->file_size;
        $mime = $surat->mime;

        if ($request->hasFile('file_surat')) {
            if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
                Storage::disk('public')->delete($surat->file_path);
            }

            $file = $request->file('file_surat');
            $filenameOriginal = $file->getClientOriginalName();
            $safeName = time() . '_' . Str::slug(pathinfo($filenameOriginal, PATHINFO_FILENAME));
            $safeName .= '.' . $file->getClientOriginalExtension();
            $filenameStored = $safeName;
            $filePath = $file->storeAs('surat', $safeName, 'public');
            $fileSize = $file->getSize();
            $mime = $file->getMimeType();
        } else {
            $filePath = $surat->file_path;
        }

        $surat->update([
            'nomor_surat'       => $validated['nomor_surat'],
            'kategori_id'       => $validated['kategori'],
            'judul'             => $validated['judul'],
            'file_path'         => $filePath,
            'filename_original' => $filenameOriginal,
            'filename_stored'   => $filenameStored,
            'file_size'         => $fileSize,
            'mime'              => $mime,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diubah.');
    }
}
