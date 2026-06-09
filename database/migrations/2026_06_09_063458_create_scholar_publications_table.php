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
        Schema::create('scholar_publications', function (Blueprint $table) {
            $table->id();
            $table->string('sinta_id');
            $table->foreign('sinta_id')->references('sinta_id')->on('detail_dosens')->onDelete('cascade');
            $table->text('judul')->nullable();
            $table->text('url_scholar')->nullable();
            $table->text('authors')->nullable();
            $table->string('source')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('citation')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholar_publications');
    }
};
