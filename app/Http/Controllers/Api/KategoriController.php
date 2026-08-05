<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
    * Menampilkan Daftar Kategori
    *
    * @queryParam search string Kata kunci untuk mencari kategori. Example: Teknologi
    * @queryParam sort string Pengurutan data (contoh: nama_kategori_asc, nama_kategori_desc). Example: nama_kategori_desc
    * @queryParam page integer Nomor halaman untuk pagination. Example: 1
    * @queryParam per_page integer Jumlah item yang ditampilkan per halaman. Example: 10
    */

    // GET: Menampilkan semua kategori
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Filter Search (Berdasarkan nama_kategori)
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        // Menggunakan str_ends_with agar aman dengan nama kolom yang memiliki underscore (seperti nama_kategori)
        if ($request->has('sort') && $request->sort != '') {
            $sort = $request->sort;
            if (str_ends_with($sort, '_desc')) {
                $column = str_replace('_desc', '', $sort);
                $query->orderBy($column, 'desc');
            } elseif (str_ends_with($sort, '_asc')) {
                $column = str_replace('_asc', '', $sort);
                $query->orderBy($column, 'asc');
            } else {
                $query->orderBy($sort, 'asc');
            }
        } else {
            // Default sorting jika tidak ada parameter sort
            $query->latest();
        }

        // Pagination
        $perPage = $request->input('per_page', 10); // Default 10 jika per_page kosong
        $kategori = $query->paginate($perPage);

        return response()->json($kategori);
    }
    /**
     * Menambahkan Daftar Kategori
     */
    // POST: Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan!',
            'data' => $kategori
        ], 201);
    }

    /**
     * Menampilkan Satu Kategori
     */
    // GET: Menampilkan satu kategori berdasarkan ID (UUID)
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($kategori);
    }

    /**
     * Mengubah Kategori
     */
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

    /**
     * Menghapus Kategori
     */
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
