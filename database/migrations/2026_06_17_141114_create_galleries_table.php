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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();      // Cover album
            $table->date('date')->nullable();               // Tanggal kegiatan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel untuk item di dalam galeri (foto/video)
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['image', 'video']);       // Jenis media
            $table->string('file_path')->nullable();        // Path file gambar
            $table->string('video_url')->nullable();        // URL embed (YouTube, dll.)
            $table->string('caption')->nullable();          // Keterangan
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
