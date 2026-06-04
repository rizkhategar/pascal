<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_concentrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('academic_programs')->onDelete('cascade');
            
            $table->string('name'); // Contoh: Hukum Pidana
            $table->text('if_condition'); // Teks untuk logika "JIKA"
            $table->text('then_outcome'); // Teks untuk logika "MAKA"
            $table->string('curriculum_link')->nullable(); // Link download PDF kurikulum
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_concentrations');
    }
};