<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_dosen', function (Blueprint $table) {
            // 1. SINTA ID sebagai Primary Key (Otomatis NOT NULL dalam database)
            $table->string('sinta_id')->primary();
            
            // 2. Nama Dosen (Wajib diisi / NOT NULL)
            $table->string('nama');
            
            // 3. Kolom-kolom lainnya yang diizinkan kosong (Nullable)
            $table->string('departemen')->nullable();
            
            // Catatan: Tipe data string digunakan karena pada contoh data Anda,
            // nilai H-Index tertulis sebagai teks gabungan (misal: "Scopus H-Index : 2GS H-Index : 14")
            $table->string('scopus_h_index')->nullable();
            $table->string('google_scholar_h_index')->nullable();
            
            // Kolom skor dan nilai statistik SINTA
            $table->string('sinta_score_3yr')->nullable();
            $table->string('sinta_score')->nullable();
            $table->string('affiliation_score_3yr')->nullable();
            $table->string('affiliation_score')->nullable();
            
            // URL Profil menggunakan tipe text karena karakternya bisa cukup panjang
            $table->text('profile_url')->nullable();
            
            // Kolom pencatatan waktu standar Laravel (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_dosen');
    }
};