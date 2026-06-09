<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_dosens', function (Blueprint $table) {
            $table->string('sinta_id')->primary(); // Menjadikan sinta_id sebagai primary key
            $table->string('nama')->nullable();
            $table->string('institusi')->nullable();
            $table->string('program_studi')->nullable();
            $table->text('profile_photo')->nullable();
            $table->string('bidang_minat')->nullable();
            $table->integer('sinta_score_overall')->nullable();
            $table->integer('sinta_score_3yr')->nullable();
            $table->integer('affil_score')->nullable();
            $table->integer('affil_score_3yr')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_dosens');
    }
};