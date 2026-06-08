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
        // Menyesuaikan nama tabel menjadi dosen_s2
        Schema::create('profil_dosen', function (Blueprint $table) {
            $table->id();
            // id_sinta dibuat nullable jika ada dosen yang belum memiliki ID tersebut
            $table->string('id_sinta')->nullable()->unique(); 
            $table->string('nama_dosen');
            $table->string('prodi')->nullable();
            $table->text('profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_dosen');
    }
};