<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // GET: Menampilkan semua buku beserta relasi kategorinya
    public function index()
    {
        // with('kategori') adalah "pointing" relasi ke tabel kategori
        $books = Book::with('kategori')->latest()->get();
        return reponse()->json([
            'message' => 'Berhasil menampilkan semua buku beserta relasi kategorinya',
        ]);
        return response()->json($books);
    }

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

    // GET: Menampilkan satu buku beserta detail kategorinya
    public function show($id)
    {
        $book = Book::with('kategori')->find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json($book);
    }

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
