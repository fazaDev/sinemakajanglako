Resource yang perlu dibuat di Filament:

1. ProfileResource (singleton) – edit profil komunitas

2. ProgramResource – CRUD program

3. GalleryResource – CRUD galeri

4. ArticleResource – CRUD berita/tulisan

5. MemberResource – CRUD anggota

6. FilmResource – CRUD arsip film lokal Jambi

7. EventResource – CRUD event + atur persyaratan

8. EventRegistrationResource – view/list seleksi pendaftar

9. Tambah Kolom role di Tabel users
   Buat migration baru untuk menambahkan kolom role:

bash
php artisan make:migration add_role_to_users_table
php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
            $table->string('phone', 20)->nullable()->after('role');
            $table->string('avatar')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'avatar', 'bio']);
        });
    }
};
2. Tabel profiles (Profil Komunitas - Singleton)
bash
php artisan make:migration create_profiles_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
3. Tabel programs
bash
php artisan make:migration create_programs_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();            // Gambar program
            $table->string('schedule')->nullable();         // Jadwal (teks bebas)
            $table->boolean('is_active')->default(true);    // Aktif/tidak
            $table->integer('order')->default(0);           // Urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
4. Tabel galleries
bash
php artisan make:migration create_galleries_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
        Schema::dropIfExists('galleries');
    }
};
5. Tabel articles (Berita / Tulisan)
bash
php artisan make:migration create_articles_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();            // Ringkasan
            $table->longText('content');                    // Isi lengkap
            $table->string('featured_image')->nullable();   // Gambar unggulan
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
6. Tabel members (Daftar Anggota)
bash
php artisan make:migration create_members_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('role')->nullable();             // Peran di komunitas
            $table->text('bio')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
7. Tabel films (Arsip Film Lokal Jambi)
bash
php artisan make:migration create_films_table
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
8. Tabel events + event_requirements + event_registrations + event_registration_files
bash
php artisan make:migration create_events_tables
php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

    public function down(): void
    {
        Schema::dropIfExists('event_registration_files');
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('event_requirements');
        Schema::dropIfExists('events');
    }
};
📋 Ringkasan Semua Tabel
No	Nama Tabel	Deskripsi
1	users	User admin & pendaftar (tambah kolom role, phone, avatar, bio)
2	profiles	Profil komunitas (singleton, satu baris data)
3	programs	Program/kegiatan rutin komunitas
4	galleries	Album galeri
5	gallery_items	Item di dalam album (foto/video)
6	articles	Berita/tulisan
7	members	Daftar anggota komunitas
8	films	Arsip film lokal Jambi
9	events	Event yang bisa didaftari
10	event_requirements	Persyaratan berkas per event
11	event_registrations	Data pendaftaran user
12	event_registration_files	File yang diunggah user
