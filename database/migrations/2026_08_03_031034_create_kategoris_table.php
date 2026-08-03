<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Menggunakan UUID
            $table->string('nama_kategori');
            $table->timestamps();
            $table->softDeletes(); // Menambahkan kolom deleted_at untuk Soft Delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
