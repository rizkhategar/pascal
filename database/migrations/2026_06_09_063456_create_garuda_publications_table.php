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
        Schema::create('sinta_garuda_publications', function (Blueprint $table) {
            $table->id();
            $table->string('sinta_id');
            $table->foreign('sinta_id')->references('sinta_id')->on('sinta_detail_dosens')->onDelete('cascade');
            $table->text('judul')->nullable();
            $table->text('url_artikel')->nullable();
            $table->string('publisher')->nullable();
            $table->string('journal')->nullable();
            $table->text('url_journal')->nullable();
            $table->string('author_order')->nullable();
            $table->text('authors')->nullable();
            $table->string('tahun')->nullable();
            $table->string('doi')->nullable();
            $table->string('accreditation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinta_garuda_publications');
    }
};
