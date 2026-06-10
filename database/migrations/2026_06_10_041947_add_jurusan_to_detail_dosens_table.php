<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_dosens', function (Blueprint $table) {
            // Menambahkan kolom jurusan setelah program_studi
            $table->string('jurusan')->nullable()->after('program_studi');
        });
    }

    public function down(): void
    {
        Schema::table('detail_dosens', function (Blueprint $table) {
            $table->dropColumn('jurusan');
        });
    }
};