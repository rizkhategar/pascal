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
        Schema::create('scopus_yearly_stats', function (Blueprint $table) {
            $table->id();
            $table->string('sinta_id');
            $table->foreign('sinta_id')->references('sinta_id')->on('detail_dosens')->onDelete('cascade');
            $table->string('tahun');
            $table->integer('jumlah')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scopus_yearly_stats');
    }
};
