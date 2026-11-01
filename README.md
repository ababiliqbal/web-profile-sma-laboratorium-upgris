<p align="center">
  <h1 align="center">🏫 Web Profile & CMS Resmi SMA Laboratorium UPGRIS</h1>
  <p align="center">
    <strong>Sistem Informasi Profil Sekolah, Manajemen Konten (CMS), dan Layanan Siswa Digital</strong><br>
    SMA Laboratorium Universitas PGRI Semarang
  </p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 10" />
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.1+" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License" />
</p>

---

## 📌 Daftar Isi
- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
  - [Portal Publik](#1-portal-publik)
  - [Panel Dashboard Admin (CMS)](#2-panel-dashboard-admin-cms)
  - [Layanan Digital Siswa](#3-layanan-digital-siswa)
- [Tech Stack](#-tech-stack)
- [Struktur Direktori](#-struktur-direktori)
- [Panduan Instalasi Lokal](#-panduan-instalasi-lokal)
- [Data Akun Bawaan (Seeder)](#-data-akun-bawaan-seeder)
- [Perintah yang Sering Digunakan](#-perintah-yang-sering-digunakan)
- [Keamanan & Praktik Terbaik](#-keamanan--praktik-terbaik)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Proyek

**Web Profile SMA Laboratorium UPGRIS** adalah aplikasi web berbasis monolit modern yang dirancang untuk memenuhi kebutuhan digitalisasi institusi pendidikan. Aplikasi ini menggabungkan portal informasi publik sekolah yang elegan dan responsif dengan sistem manajemen konten (*Content Management System*) yang fleksibel.

Melalui platform ini, pihak sekolah dapat mempublikasikan seluruh informasi penting—mulai dari profil lembaga, tenaga pendidik, agenda kegiatan, galeri dokumentasi, hingga pengumuman kelulusan siswa secara mandiri dan terstruktur.

---

## ✨ Fitur Utama

### 1. Portal Publik
- **Beranda Interaktif**: Menampilkan *hero section*, statistik sekolah yang di-cache untuk performa maksimal, sambutan kepala sekolah, artikel/berita terbaru, agenda terdekat, serta testimoni alumni.
- **Profil Sekolah**: Menampilkan visi & misi, sejarah, program studi/peminatan, serta halaman profil dinamis.
- **Direktori Guru & Staf**: Menampilkan daftar pendidik dan tenaga kependidikan lengkap dengan mata pelajaran yang diampu.
- **Akademik & Kesiswaan**: Informasi prestasi siswa/sekolah, kalender & agenda akademik, ekstrakurikuler, dan organisasi kesiswaan (OSIS/MPK).
- **Sarana & Prasarana**: Galeri fasilitas dan sarana penunjang kegiatan belajar mengajar.
- **Pemberitaan & Blog**: Publikasi berita dengan kategori, tag, dan integrasi relasi *many-to-many*.
- **Galeri & Dokumentasi**: Album foto kegiatan sekolah yang terorganisir rapi.
- **Pusat Unduhan (Dokumen)**: Berkas, formulir, atau silabus resmi yang dapat diunduh publik secara langsung.
- **Pencarian Global (`/search`)**: Fitur pencarian multi-tabel untuk memudahkan pengunjung menemukan berita, prestasi, atau dokumen sekolah.
- **Formulir Kontak**: Saluran bagi pengunjung untuk mengirimkan pertanyaan atau kritik/saran yang terhubung langsung ke dashboard admin.

### 2. Panel Dashboard Admin (CMS)
- **Role-Based Access Control (RBAC)**: Menggunakan `spatie/laravel-permission` dengan pemisahan peran:
  - `Super Admin`: Akses penuh ke seluruh konfigurasi sistem, peran, pengguna, dan konten.
  - `Editor Konten`: Pengelolaan artikel, berita, tag, kategori, galeri, dan prestasi.
  - `Staf PPDB`: Pengelolaan data pendaftaran dan publikasi informasi terkait PPDB.
  - `Guru`: Akses mandiri untuk mengelola profil dan mata pelajaran terkait.
- **Manajemen Konten Lengkap (CRUD)**:
  - Berita / Artikel (Draft & Published, Thumbnail, Relasi Tag & Kategori)
  - Halaman Dinamis (*Static Pages*)
  - Galeri Album & Foto Kegiatan
  - Guru, Staf, & Relasi Mata Pelajaran
  - Sarpras / Fasilitas Sekolah
  - Ekstrakurikuler & Organisasi Siswa
  - Agenda Akademik & Kalender Pendidikan
  - Testimoni Alumni & Prestasi Sekolah
- **Kotak Masuk Kontak (*Inbox*)**: Notifikasi dan peninjauan pesan yang masuk melalui formulir kontak publik.
- **Pengaturan Situs (*Site Settings*)**: Pengaturan identitas sekolah, logo, favicon, kontak, alamat, dan media sosial tanpa menyentuh kode.

### 3. Layanan Digital Siswa
- **Pengumuman Kelulusan Online (`/pengumuman-kelulusan`)**:
  - Pengecekan status kelulusan mandiri oleh siswa.
  - Validasi berbasis Nomor Induk Siswa Nasional (NISN) dan verifikasi kode keamanan institusi.
  - Menampilkan Surat Keterangan Kelulusan (SK Kelulusan) digital yang siap dicetak.

---

## 🛠 Tech Stack

### Backend
- **Framework**: [Laravel 10.x](https://laravel.com/)
- **Bahasa**: [PHP 8.1+](https://www.php.net/)
- **Database**: [MySQL](https://www.mysql.com/) / [MariaDB](https://mariadb.org/)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)
- **Authorization**: [Spatie Laravel-Permission v6](https://spatie.be/docs/laravel-permission/)
- **API Token**: [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)

### Frontend
- **CSS Framework**: [Tailwind CSS v3.4](https://tailwindcss.com/)
- **Plugins**: `@tailwindcss/typography`, `@tailwindcss/forms`
- **Reactivity**: [Alpine.js v3.4](https://alpinejs.dev/) & Vanilla JavaScript
- **Asset Bundler**: [Vite 5.x](https://vitejs.dev/)

---

## 📂 Struktur Direktori

```text
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controller halaman publik & administrasi
│   │   │   └── Admin/            # Controller khusus modul dashboard back-office
│   │   └── Middleware/           # Middleware autentikasi dan otorisasi peran
│   └── Models/                   # Model Eloquent (Post, Staff, Facility, Student, dsb.)
├── config/                       # Konfigurasi aplikasi, database, dan permission
├── database/
│   ├── migrations/               # Skema migrasi database
│   └── seeders/                  # Seeder pengguna awal, peran (roles), dan permissions
├── public/                       # Entry point aplikasi (index.php), aset statis, dan unggahan
├── resources/
│   ├── css/                      # Konfigurasi Tailwind CSS
│   ├── js/                       # Script interaktivitas & logika sidebar dashboard
│   └── views/                    # Template Blade (layout publik, komponen, dan admin)
│       ├── admin/                # Tampilan dashboard manajemen
│       ├── kelulusan/            # Halaman cek kelulusan dan hasil SKL
│       └── public/               # Tampilan pengunjung portal utama
├── routes/
│   ├── auth.php                  # Rute autentikasi bawaan Breeze
│   └── web.php                   # Rute web publik dan dashboard admin
└── storage/                      # File log, cache, sesi, dan berkas unggahan publik
```

---

## 🚀 Panduan Instalasi Lokal

Pastikan perangkat Anda telah terpasang:
- **PHP >= 8.1** (beserta ekstensi `bcmath`, `ctype`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`)
- **Composer** (v2.x)
- **Node.js** (v18.x atau lebih baru) & **NPM**
- **MySQL / MariaDB**

### 1. Kloning Repository
```bash
git clone https://github.com/<username>/web-profile-sma-laboratorium-upgris.git
cd web-profile-sma-laboratorium-upgris
```

### 2. Pasang Dependensi PHP (Composer)
```bash
composer install
```

### 3. Pasang Dependensi Frontend (NPM)
```bash
npm install
```

### 4. Konfigurasi File Environment (`.env`)
Salin file konfigurasi contoh:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan pengaturan koneksi database Anda:
```env
APP_NAME="SMA Laboratorium UPGRIS"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Migrasi & Database Seeder
Perintah ini akan membuat semua tabel database beserta data peran/pengguna awal:
```bash
php artisan migrate --seed
```

### 7. Hubungkan Storage ke Folder Publik
Agar foto berita, berkas unduhan, dan gambar galeri dapat diakses di browser:
```bash
php artisan storage:link
```

### 8. Jalankan Server Pengembangan
Jalankan kompilasi aset frontend (Vite):
```bash
npm run dev
```

Buka terminal baru dan jalankan server lokal Laravel:
```bash
php artisan serve
```

Akses website melalui browser di: `http://127.0.0.1:8000`

---

## 🔐 Data Akun Bawaan (Seeder)

Setelah menjalankan `php artisan db:seed`, akun awal berikut siap digunakan untuk menguji dashboard:

| Role | Email | Password Bawaan |
| :--- | :--- | :--- |
| **Super Admin** | `admin@mail.com` | `Kurosaki0105$` |

> [!WARNING]
> Sangat disarankan untuk segera mengubah password default tersebut melalui menu **Profil Pengguna** di dashboard atau mengubahnya langsung pada `database/seeders/UserSeeder.php` sebelum digunakan di server produksi.

---

## 📋 Perintah yang Sering Digunakan

```bash
# Menjalankan build aset produksi
npm run build

# Membersihkan seluruh cache sistem
php artisan optimize:clear

# Melakukan cache konfigurasi & route untuk produksi
php artisan optimize

# Membuat link symlink storage (jika gambar tidak muncul)
php artisan storage:link
```

---

## 🛡 Keamanan & Praktik Terbaik

- **Jangan pernah melakukan commit file `.env`** ke version control. Gunakan selalu `.env.example` sebagai referensi variabel konfigurasi.
- **Mode Produksi**: Pastikan `APP_ENV=production` dan `APP_DEBUG=false` saat aplikasi di-deploy ke server online.
- Seluruh formulir menggunakan perlindungan token **CSRF** bawaan Laravel (`@csrf`).
- Manajemen upload file menerapkan validasi ukuran file dan tipe MIME (MIME-type validation).

---

## 📄 Lisensi

Proyek ini dikembangkan di bawah lisensi [MIT License](LICENSE).
Hak Cipta &copy; SMA Laboratorium UPGRIS Semarang.
