<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // GET: Menampilkan semua kategori
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return response()->json($kategori);
    }

    // POST: Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan!',
        ], 201);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan!',
            'data' => $kategori
        ], 201);
    }

    // GET: Menampilkan satu kategori berdasarkan ID (UUID)
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($kategori);
    }

    // PUT/PATCH: Mengubah data kategori
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui!',
            'data' => $kategori
        ]);
    }

    // DELETE: Menghapus kategori (Otomatis masuk ke Soft Deletes)
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $kategori->delete(); // Karena model memakai SoftDeletes, ini hanya akan mengisi kolom deleted_at

        return response()->json([
            'message' => 'Kategori berhasil dihapus (Soft Delete)!'
        ]);
    }
}
