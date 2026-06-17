# 🎬 Sinema Kajanglako - Website Komunitas Film Jambi

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-5.x-FBAA18?style=flat&logo=filament)](https://filamentphp.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.x-FB70A9?style=flat&logo=livewire)](https://livewire.laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4+-777BB4?style=flat&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.x-06B6D4?style=flat&logo=tailwindcss)](https://tailwindcss.com)

Website resmi **sinemakajanglako.com**, komunitas film independen di Jambi. Platform ini menjadi pusat informasi komunitas, arsip film lokal, dan sistem pendaftaran event dengan seleksi berkas oleh admin.

---

## 📋 Fitur Utama

### 🌐 Halaman Publik

- **Profil Komunitas** — Sejarah, visi-misi, kontak, media sosial
- **Program** — Program dan kegiatan rutin komunitas
- **Galeri Kegiatan** — Album foto dan video dokumentasi
- **Berita / Tulisan** — Artikel, opini, dan kabar terbaru
- **Daftar Anggota** — Profil anggota komunitas
- **Arsip Film Lokal Jambi** — Katalog film karya sineas Jambi
- **Daftar Event** — Event terbuka dengan sistem pendaftaran online

### 🔐 Dashboard Admin (Filament Panel)

- Manajemen seluruh konten (CRUD untuk semua modul)
- Membuat event dengan persyaratan berkas dinamis
- Melihat daftar pendaftar dan mengunduh berkas
- Menyeleksi peserta (terima/tolak) dengan catatan
- Ringkasan data pendaftaran

### 👤 Dashboard User (Jetstream + Livewire)

- Registrasi dan login
- Mendaftar event dan mengunggah berkas persyaratan
- Melihat status pendaftaran (pending/diterima/ditolak)
- Riwayat pendaftaran event
- Manajemen profil pribadi

---

## 🧱 Tech Stack

| Komponen            | Teknologi          | Versi |
| ------------------- | ------------------ | ----- |
| Backend Framework   | Laravel            | 13.x  |
| Admin Panel         | Filament           | 5.x   |
| Frontend Interaktif | Livewire           | 4.x   |
| Autentikasi         | Laravel Jetstream  | 6.x   |
| CSS Framework       | Tailwind CSS       | 4.x   |
| Database            | MySQL / PostgreSQL | -     |
| PHP                 | PHP                | 8.4+  |

---

## 🚀 Instalasi

### Prasyarat

- PHP 8.4 atau lebih tinggi
- Composer 2.x
- Node.js 20+ & NPM
- MySQL 8.0+ / PostgreSQL 15+
- Git

### Langkah Instalasi

1. **Clone repository**

    ```bash
    git clone https://github.com/fazaDev/sinemakajanglako.git
    cd sinemakajanglako

    ```

2. **Install dependensi PHP**

    ```bash
    composer install

    ```

3. **Salin file environment**

    ```bash
    cp .env.example .env

    ```

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Konfigurasi database di** `.env`

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kajanglako
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Jalankan migration dan seeder**

    ```bash
    php artisan migrate:fresh --seed
    ```

7. **Install dependensi Node.js dan build assets**

    ```bash
    npm install
    npm run build
    ```

8. **Buat symbolic link untuk storage**

    ```bash
    php artisan storage:link
    ```

9. **Jalankan server development**

    ```bash
    composer run dev
    ```

Website dapat diakses di: http://localhost:8000

# 🔑 Akun Default

Setelah menjalankan seeder, tersedia akun default:

| Role  | Email                      | Password   |
| ----- | -------------------------- | ---------- |
| Admin | admin@sinemakajanglako.com | `password` |
| User  | user@sinemakajanglako.com  | `password` |

> ⚠️ **Penting:** Segera ubah password setelah login pertama, terutama untuk akun admin.

---

# 📁 Struktur Direktori

```text
sinema-kajanglako/
├── app/
│   ├── Filament/
│   │   └── Resources/
│   │       ├── ArticleResource.php
│   │       ├── EventRegistrationResource.php
│   │       ├── EventResource.php
│   │       ├── FilmResource.php
│   │       ├── GalleryResource.php
│   │       ├── MemberResource.php
│   │       ├── ProfileResource.php
│   │       └── ProgramResource.php
│   ├── Http/
│   │   └── Controllers/
│   ├── Livewire/
│   │   ├── EventRegistration.php
│   │   └── UserDashboard.php
│   └── Models/
│       ├── Article.php
│       ├── Event.php
│       ├── EventRegistration.php
│       ├── EventRequirement.php
│       ├── Film.php
│       ├── Gallery.php
│       ├── GalleryItem.php
│       ├── Member.php
│       ├── Profile.php
│       ├── Program.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
├── routes/
│   └── web.php
└── tests/
```

---

# 📊 Skema Database

| Tabel                         | Deskripsi                        |
| ----------------------------- | -------------------------------- |
| `users`                       | User admin & pendaftar           |
| `profiles`                    | Profil komunitas (singleton)     |
| `programs`                    | Program komunitas                |
| `galleries` + `gallery_items` | Album galeri & item (foto/video) |
| `articles`                    | Berita / tulisan                 |
| `members`                     | Daftar anggota komunitas         |
| `films`                       | Arsip film lokal Jambi           |
| `events`                      | Event yang bisa didaftari        |
| `event_requirements`          | Persyaratan berkas per event     |
| `event_registrations`         | Data pendaftaran user            |
| `event_registration_files`    | File yang diunggah user          |

---

# 🎯 Alur Pendaftaran Event

1. **Admin** membuat event dan menentukan persyaratan berkas  
   _(contoh: KTP, Portofolio, Surat Rekomendasi)_.

2. **User** melihat event yang status pendaftarannya **Buka**.

3. User mendaftar dan mengunggah berkas sesuai persyaratan.

4. Pendaftaran masuk dengan status **Pending**.

5. Admin meninjau data dan berkas user melalui panel **Filament**.

6. Admin memilih **Terima** atau **Tolak** _(dengan alasan)_.

7. User melihat status pendaftaran di dashboard.

### Diagram Alur

```text
┌──────────┐     ┌──────────┐     ┌──────────┐     ┌──────────┐
│  Admin   │────▶│  Event   │◀────│   User   │     │  Admin   │
│ Buat     │     │ Terbuka  │     │ Mendaftar│     │ Seleksi  │
│ Event    │     │          │     │ + Upload │     │ Terima/  │
│          │     │          │     │ Berkas   │     │ Tolak    │
└──────────┘     └──────────┘     └──────────┘     └──────────┘
```

---

# 🛠️ Perintah Penting

```bash
# Development server
composer run dev

# Hanya PHP server
php artisan serve

# Build ulang assets
npm run dev       # Development
npm run build     # Production

# Migration
php artisan migrate
php artisan migrate:fresh --seed

# Cache
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Queue (jika menggunakan notifikasi email)
php artisan queue:work

# Testing
php artisan test
```

---

# 📝 Lisensi

Proyek ini bersifat **private** untuk internal komunitas **sinemakajanglako.com**.

Hak cipta © 2026 **sinemakajanglako.com**.

---

# 👥 Tim Pengembang

| Peran         | Nama                   |
| ------------- | ---------------------- |
| Product Owner | `[Sinema Kajang Lako]` |
| Developer     | `[fazaDev]`            |
| Designer      | `[fazaDev]`            |

---

# 📞 Kontak

- **Email:** `office@sinemakajanglako.com`
- **Instagram:** `@sinemakajanglako`

---

<div align="center">

Dibangun dengan ❤️ untuk memajukan perfilman lokal Jambi.

</div>
