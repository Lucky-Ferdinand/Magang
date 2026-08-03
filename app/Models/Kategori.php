<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // <-- 1. Tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    // 2. Tambahkan HasUuids di baris ini
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'nama_kategori',
    ];

    public function buku()
    {
        return $this->hasMany(Book::class, 'kategori_id', 'id');
    }
}
