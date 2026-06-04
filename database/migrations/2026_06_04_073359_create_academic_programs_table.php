<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Contoh: magister-hukum
            $table->string('name'); // Contoh: Magister Hukum
            $table->string('degree'); // Contoh: M.H.
            
            // Hero Section
            $table->string('hero_title');
            $table->text('hero_desc');
            $table->string('hero_image')->nullable();
            
            // Overview Section
            $table->string('overview_title');
            $table->json('overview_content')->nullable(); // JSON agar mudah memecah paragraf
            $table->string('overview_image')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_programs');
    }
};