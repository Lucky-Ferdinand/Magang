<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
    * Menampilkan Daftar Buku
    *
    * @queryParam search string Kata kunci untuk mencari judul buku. Example: laravel
    * @queryParam sort string Pengurutan data (contoh: judul_asc, harga_desc). Example: harga_desc
    * @queryParam page integer Nomor halaman untuk pagination. Example: 1
    * @queryParam per_page integer Jumlah item yang ditampilkan per halaman. Example: 10
     */

    // GET: Menampilkan semua buku beserta relasi kategorinya
    public function index(Request $request)
    {
        // 1. Siapkan query dasar beserta relasinya
        $query = Book::with('kategori');

        // 2. Filter Search (Berdasarkan Judul)
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 3. Filter Sort (Memecah string seperti 'harga_desc' menjadi 'harga' dan 'desc')
        if ($request->has('sort') && $request->sort != '') {
            $sortParts = explode('_', $request->sort);
            if (count($sortParts) == 2) {
                $column = $sortParts[0]; // contoh: harga
                $direction = $sortParts[1]; // contoh: desc
                $query->orderBy($column, $direction);
            }
        } else {
            // Default sorting jika tidak ada parameter sort
            $query->latest();
        }

        // 4. Pagination
        $perPage = $request->input('per_page', 10); // Default 10 jika per_page kosong
        $books = $query->paginate($perPage);

        return response()->json($books);
    }

    /**
     * Menambahkan Daftar Buku
     */
    // POST: Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|string',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|integer' // Menyimpan UUID dari kategori
        ]);

        $book = Book::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk
        ]);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan!',
            'data' => $book
        ], 201);
    }

    /**
     * Menampilkan Satu Buku
     */
    // GET: Menampilkan satu buku beserta detail kategorinya
    public function show($id)
    {
        $book = Book::with('kategori')->find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json($book);
    }

    /**
     * Mengubah Daftar Buku
     */
    // PUT/PATCH: Mengubah data buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'kategori_id' => 'sometimes|required|string',
            'harga' => 'sometimes|required|numeric',
            'jumlah_produk' => 'sometimes|required|integer'
        ]);

        $book->update($request->only(['judul', 'kategori_id', 'harga', 'jumlah_produk']));

        return response()->json([
            'message' => 'Buku berhasil diperbarui!',
            'data' => $book
        ]);
    }

    /**
     * Menghapus Daftar Buku
     */
    // DELETE: Menghapus buku (Otomatis masuk ke Soft Deletes)
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        $book->delete(); // Akan mengisi kolom deleted_at tanpa menghapus data asli dari database

        return response()->json([
            'message' => 'Buku berhasil dihapus (Soft Delete)!'
        ]);
    }
}
