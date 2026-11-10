<p align="center">
  <h1 align="center">🏫 Web Profile & CMS Resmi SMA Laboratorium UPGRIS</h1>
  <p align="center">
    <strong>Website Profil Sekolah & Content Management System (CMS) Terintegrasi</strong><br>
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
- [Fitur Utama Berdasarkan Tampilan (Views)](#-fitur-utama-berdasarkan-tampilan-views)
  - [1. Halaman Publik (Pengunjung)](#1-halaman-publik-pengunjung)
  - [2. Panel Dashboard Admin (CMS Back-Office)](#2-panel-dashboard-admin-cms-back-office)
- [Tech Stack](#-tech-stack)
- [Struktur Direktori](#-struktur-direktori)
- [Panduan Instalasi Lokal](#-panduan-instalasi-lokal)
- [Data Akun Bawaan (Seeder)](#-data-akun-bawaan-seeder)
- [Perintah yang Sering Digunakan](#-perintah-yang-sering-digunakan)
- [Keamanan & Praktik Terbaik](#-keamanan--praktik-terbaik)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Proyek

**Web Profile SMA Laboratorium UPGRIS** adalah aplikasi web berbasis monolit modern yang dirancang sebagai sarana publikasi informasi dan representasi digital resmi bagi SMA Laboratorium UPGRIS (Semarang). 

Aplikasi ini memiliki dua sisi utama:
1. **Portal Publik**: Menampilkan informasi institusi secara elegan, interaktif, responsif, dan mudah diakses oleh calon siswa, orang tua, dan masyarakat umum.
2. **Dashboard Admin (CMS)**: Panel administrasi mandiri untuk mempermudah staf atau administrator sekolah dalam mengelola seluruh konten website (artikel berita, agenda, sarpras, guru, prestasi, dan pengaturan situs) tanpa perlu menyentuh kode program.

---

## ✨ Fitur Utama Berdasarkan Tampilan (Views)

Fitur-fitur di bawah ini mencerminkan apa yang **benar-benar tampil dan dapat diakses** pada antarmuka web:

### 1. Halaman Publik (Pengunjung)
- **Beranda (Home)**:
  - *Hero Section* dengan latar belakang kampus dan tombol pintas ke informasi profil / PPDB.
  - Kartu statistik pencapaian sekolah (Jumlah Pendidik, Siswa Aktif, Ekstrakurikuler, dan Prestasi) dengan animasi penghitung interaktif.
  - Seksi Berita & Informasi Terkini (menampilkan artikel terbaru dengan thumbnail dan badge kategori).
  - Seksi Agenda Kalender Akademik (menampilkan agenda terdekat dengan penanggalan yang jelas).
  - Seksi Jejak Alumni (testimoni alumni beserta pekerjaan dan foto).
- **Profil Sekolah**: Halaman statis dinamis yang dimuat melalui navigasi dropdown (misalnya Visi Misi, Sejarah, Akreditasi).
- **Akademik**:
  - **Kalender Akademik**: Daftar kegiatan dan agenda sekolah terstruktur.
  - **Prestasi Sekolah**: Galeri pencapaian prestasi akademik dan non-akademik siswa/sekolah.
- **Kesiswaan**:
  - **Organisasi Siswa**: Profil organisasi kesiswaan (OSIS, MPK, dsb.).
  - **Ekstrakurikuler**: Daftar kegiatan ekskul beserta dokumentasi dan pembimbingnya.
- **Sarana & Prasarana**: Katalog fasilitas fisik sekolah penunjang kegiatan belajar mengajar.
- **Berita & Artikel**: Daftar berita lengkap dengan pagination, filter kategori, tagar (tags), dan halaman baca detail artikel.
- **Pencarian Global**: Fitur modal pencarian instan pada navbar untuk memudahkan menemukan artikel atau informasi di website.
- **Footer Terpadu**: Informasi kontak resmi, tautan media sosial, serta sematan peta lokasi (*Google Maps Embed*).

### 2. Panel Dashboard Admin (CMS Back-Office)
- **Dashboard Ringkasan**: Menampilkan kartu metrik cepat (Total Guru & Staf, Total Postingan, Galeri) dan tabel draft/published berita terbaru.
- **Manajemen Konten**:
  - **Berita & Artikel**: CRUD artikel lengkap dengan editor konten, thumbnail, status publikasi (*Draft/Published*), kategori, dan tag.
  - **Halaman Statis**: Kelola halaman dinamis profil sekolah beserta lampiran dokumen pendukung.
  - **Kategori & Tag**: Pengelompokan taksonomi artikel secara fleksibel.
- **Media & Galeri**: Pengelolaan album kegiatan sekolah dan multi-upload foto.
- **Prestasi & Testimoni**: Kelola daftar prestasi dan kutipan testimoni alumni.
- **Kotak Masuk Pesan Kontak**: Melihat dan mengelola pesan kritik/saran yang dikirimkan pengunjung.
- **Data Akademik**:
  - **Guru & Tenaga Kependidikan**: Pendataan staf pengajar dan relasi mata pelajaran yang diampu.
  - **Mata Pelajaran**: Manajemen daftar mata pelajaran sekolah.
  - **Fasilitas**: Pendataan sarana prasarana sekolah.
  - **Jurusan / Peminatan**: Informasi program peminatan siswa.
  - **Ekstrakurikuler & Organisasi**: Kelola deskripsi dan pembina ekskul/organisasi.
  - **Agenda Akademik**: Jadwal dan kalender kegiatan sekolah.
- **Manajemen Pengguna & Otorisasi**: Manajemen pengguna internal dengan pembagian peran (*Role-Based Access Control*) menggunakan `spatie/laravel-permission` (Super Admin, Editor Konten, Staf PPDB, Guru).
- **Pengaturan Situs (Settings)**: Pengaturan identitas sekolah (Nama, Slogan, Alamat, No. Telepon, Email, URL Media Sosial, Logo, Favicon, dan Peta Lokasi) yang langsung diterapkan ke seluruh halaman publik.

---

## 🛠 Tech Stack

### Backend
- **Framework**: [Laravel 10.x](https://laravel.com/)
- **Bahasa**: [PHP 8.1+](https://www.php.net/)
- **Database**: [MySQL](https://www.mysql.com/) / [MariaDB](https://mariadb.org/)
- **Autentikasi**: [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)
- **Otorisasi (RBAC)**: [Spatie Laravel-Permission v6](https://spatie.be/docs/laravel-permission/)
- **Asset Storage**: Laravel Local Storage dengan *public symlink*

### Frontend
- **Template Engine**: Laravel Blade Components & Layouts
- **CSS Framework**: [Tailwind CSS v3.4](https://tailwindcss.com/)
- **Plugins**: `@tailwindcss/typography`, `@tailwindcss/forms`
- **Reactivity & Interaktivitas**: [Alpine.js v3.4](https://alpinejs.dev/) & Vanilla JavaScript (collapsible sidebar, drawer mobile, modal search)
- **Asset Bundler**: [Vite 5.x](https://vitejs.dev/)

---

## 📂 Struktur Direktori

```text
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controller publik (Home, Post, Search, dsb.)
│   │   │   └── Admin/            # Controller panel dashboard back-office
│   │   └── View/Composers/       # View Composers (SettingComposer, NavigationComposer)
│   └── Models/                   # Model Eloquent (Post, Staff, Facility, Setting, dsb.)
├── config/                       # Konfigurasi aplikasi, database, dan permission
├── database/
│   ├── migrations/               # Skema migrasi database
│   └── seeders/                  # Seeder pengguna, peran (roles), dan pengaturan default
├── public/                       # Aset publik statis, favicon, gambar, dan link storage
├── resources/
│   ├── css/                      # Konfigurasi Tailwind CSS
│   ├── js/                       # Script interaktivitas & logika sidebar dashboard
│   └── views/                    # Template Blade
│       ├── admin/                # Tampilan seluruh modul CMS back-office
│       ├── layouts/              # Master layout (template publik & dashboard app)
│       └── public/               # Tampilan portal pengunjung
├── routes/
│   ├── auth.php                  # Rute autentikasi Breeze
│   └── web.php                   # Rute publik & rute manajemen dashboard
└── storage/                      # File log, cache, sesi, dan berkas unggahan pengguna
```

---

## 🚀 Panduan Instalasi Lokal

Pastikan perangkat Anda telah terpasang:
- **PHP >= 8.1** (beserta ekstensi PDO MySQL, Fileinfo, Mbstring, OpenSSL)
- **Composer** (v2.x)
- **Node.js** (v18.x atau lebih baru) & **NPM**
- **MySQL / MariaDB** (via XAMPP, Laragon, atau standalone)

### 1. Kloning Repository
```bash
git clone https://github.com/<username>/web-profile-sma-laboratorium-upgris.git
cd web-profile-sma-laboratorium-upgris
```

### 2. Pasang Dependensi
```bash
composer install
npm install
```

### 3. Konfigurasi File Environment (`.env`)
Salin file konfigurasi contoh:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan koneksi database lokal:
```env
APP_NAME="SMA Laboratorium UPGRIS"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smalab_upgris_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Database Seeder
Perintah ini akan membuat semua tabel database beserta data peran (*roles*), akun administrator, dan pengaturan default sekolah:
```bash
php artisan migrate:fresh --seed
```

### 6. Hubungkan Storage ke Folder Publik
Agar foto berita, gambar fasilitas, dan berkas upload dapat tampil di browser:
```bash
php artisan storage:link
```

### 7. Jalankan Server Pengembangan
Jalankan kompilasi aset frontend di satu terminal:
```bash
npm run dev
```

Buka terminal kedua dan jalankan server lokal Laravel:
```bash
php artisan serve
```

Akses website melalui browser di: **`http://127.0.0.1:8000`**

---

## 🔐 Data Akun Bawaan (Seeder)

Setelah menjalankan `php artisan migrate:fresh --seed`, akun administrator berikut siap digunakan untuk masuk ke dashboard admin:

| Role | Email | Password Bawaan |
| :--- | :--- | :--- |
| **Super Admin** | `admin@mail.com` | `Kurosaki0105$` |

> [!WARNING]
> Sangat disarankan untuk segera mengubah password default tersebut melalui menu profil dashboard atau pada seeder sebelum digunakan di lingkungan produksi (*production*).

---

## 📋 Perintah yang Sering Digunakan

```bash
# Menjalankan build aset untuk produksi
npm run build

# Membersihkan seluruh cache konfigurasi & view
php artisan optimize:clear

# Membuat symlink storage jika gambar tidak muncul
php artisan storage:link
```

---

## 🛡 Keamanan & Praktik Terbaik

- File `.env` tidak pernah di-commit ke Git.
- Proteksi CSRF aktif di seluruh form data.
- Upload berkas dilengkapi validasi tipe MIME dan ekstensi yang diizinkan.
- Sistem otorisasi berbasis hak akses (*Permission*) untuk mencegah akses unauthorized ke menu CMS.

---

## 📄 Lisensi

Proyek ini dikembangkan di bawah lisensi [MIT License](LICENSE).  
Hak Cipta &copy; SMA Laboratorium UPGRIS Semarang.
