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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('sinta_id')->nullable()->unique();
            $table->string('departemen')->nullable();
            
            // Kolom di bawah menggunakan tipe string untuk menghindari error saat import 
            // karena ada data berformat teks (ex: "Scopus H-Index : 2GS H-Index : 14") 
            // dan angka desimal/ribuan (ex: "1.702") dari file Excel.
            $table->string('scopus_h_index')->nullable();
            $table->string('google_scholar_h_index')->nullable();
            $table->string('sinta_score_3yr')->nullable();
            $table->string('sinta_score')->nullable();
            $table->string('affiliation_score_3yr')->nullable();
            $table->string('affiliation_score')->nullable();
            
            $table->string('profile_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};