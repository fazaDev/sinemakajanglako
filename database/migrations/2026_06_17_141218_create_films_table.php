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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('director');                     // Sutradara
            $table->year('year');                           // Tahun rilis
            $table->text('synopsis');
            $table->string('poster')->nullable();           // Poster film
            $table->string('trailer_url')->nullable();      // URL trailer
            $table->string('genre')->nullable();            // Genre
            $table->string('duration')->nullable();         // Durasi (misal: "15 menit")
            $table->string('language')->nullable();         // Bahasa
            $table->string('production')->nullable();       // Rumah produksi
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
