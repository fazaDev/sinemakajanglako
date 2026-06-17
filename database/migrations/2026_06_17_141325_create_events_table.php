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
        // Tabel events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->dateTime('start_date');                 // Tanggal mulai
            $table->dateTime('end_date');                   // Tanggal selesai
            $table->string('location');                     // Lokasi
            $table->integer('quota')->nullable();           // Kuota peserta
            $table->enum('registration_status', ['open', 'closed'])->default('open');
            $table->string('image')->nullable();            // Gambar event
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel persyaratan berkas per event
        Schema::create('event_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');                         // Nama dokumen (misal: "KTP", "Portofolio")
            $table->text('description')->nullable();        // Deskripsi persyaratan
            $table->boolean('is_required')->default(true);  // Wajib atau tidak
            $table->string('allowed_types')->nullable();    // Format diizinkan, comma-separated (pdf,jpg,png)
            $table->integer('max_size_kb')->default(5120);  // Maks 5MB default
            $table->integer('order')->default(0);           // Urutan tampil
            $table->timestamps();
        });

        // Tabel pendaftaran event oleh user
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();         // Catatan dari admin (terutama jika ditolak)
            $table->timestamp('submitted_at')->nullable();  // Waktu submit
            $table->timestamp('processed_at')->nullable();  // Waktu admin proses
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Tabel file yang diunggah user untuk setiap persyaratan
        Schema::create('event_registration_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('event_registrations')->cascadeOnDelete();
            $table->foreignId('requirement_id')->constrained('event_requirements')->cascadeOnDelete();
            $table->string('file_path');                    // Path file yang diunggah
            $table->string('original_name');                // Nama asli file
            $table->string('mime_type')->nullable();
            $table->integer('size_kb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registration_files');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('event_requirements');
        Schema::dropIfExists('events');
    }
};
