<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_application_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('academic_programs')->onDelete('cascade');
            
            $table->integer('step_number'); // Contoh: 1, 2, 3
            $table->string('title');
            $table->text('description');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_application_steps');
    }
};