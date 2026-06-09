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
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->string('sinta_id');
            $table->foreign('sinta_id')->references('sinta_id')->on('detail_dosens')->onDelete('cascade');
            $table->text('judul')->nullable();
            $table->string('leader')->nullable();
            $table->string('skema')->nullable();
            $table->text('personils')->nullable();
            $table->string('tahun')->nullable();
            $table->string('dana')->nullable();
            $table->string('status')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
