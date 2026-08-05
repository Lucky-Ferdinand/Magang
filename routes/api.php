<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\BookController; // <-- Ubah di sini


Route::apiResource('kategori', KategoriController::class);
Route::apiResource('buku', BookController::class);
