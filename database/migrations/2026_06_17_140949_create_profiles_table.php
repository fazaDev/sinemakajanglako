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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nama komunitas
            $table->text('description');                    // Sejarah / tentang
            $table->string('vision')->nullable();           // Visi
            $table->string('mission')->nullable();          // Misi
            $table->string('logo')->nullable();             // Logo komunitas
            $table->string('address')->nullable();          // Alamat
            $table->string('email')->nullable();            // Email resmi
            $table->string('phone')->nullable();            // Telepon
            $table->string('facebook')->nullable();         // URL Facebook
            $table->string('instagram')->nullable();        // URL Instagram
            $table->string('youtube')->nullable();          // URL YouTube
            $table->string('twitter')->nullable();          // URL Twitter/X
            $table->string('tiktok')->nullable();           // URL TikTok
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
