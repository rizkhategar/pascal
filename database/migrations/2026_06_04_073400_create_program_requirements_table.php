<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_requirements', function (Blueprint $table) {
            $table->id();
            // Relasi ke academic_programs dengan cascade delete
            $table->foreignId('program_id')->constrained('academic_programs')->onDelete('cascade');
            
            $table->text('requirement_text');
            $table->integer('sort_order')->default(0); // Untuk mengurutkan list
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_requirements');
    }
};