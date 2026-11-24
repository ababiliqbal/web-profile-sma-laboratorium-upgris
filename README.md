<p align="center">
  <h1 align="center">🏫 Web Profile & Integrated CMS</h1>
  <h3 align="center">SMA Laboratorium Universitas PGRI Semarang</h3>
  <p align="center">
    Platform web profil institusi terpadu dengan sistem manajemen konten mandiri (CMS Back-Office) yang cepat, aman, dan responsif.
  </p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 10" />
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.1+" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/License-Proprietary-blue?style=for-the-badge" alt="License" />
</p>

---

## 📌 Gambaran Proyek

### 💡 Latar Belakang & Apa Aplikasi Ini? (What)
Banyak institusi pendidikan menghadapi kendala dalam mengelola kehadiran digital mereka: website yang kaku, informasi kegiatan yang lambat diperbarui, serta ketergantungan teknis yang tinggi pada pihak ketiga hanya untuk sekadar mempublikasikan berita atau agenda sederhana.

Proyek ini hadir sebagai **solusi web portal institusi modern berbasis monolit yang dilengkapi dengan sistem CMS (*Content Management System*) mandiri**. Aplikasi ini menggabungkan etalase informasi publik yang elegan dengan panel kendali administrasi yang ramah pengguna, memungkinkan pihak sekolah mengelola konten secara dinamis tanpa perlu menyentuh baris kode program sedikit pun.

### 🎯 Tujuan Aplikasi (For)
Aplikasi ini dikembangkan secara terukur untuk:
1. **Digital Branding & Kredibilitas Resmi**: Menjadi pintu gerbang digital utama bagi calon peserta didik, wali murid, alumni, dan masyarakat luas untuk mengenal identitas, kultur, dan keunggulan SMA Laboratorium UPGRIS.
2. **Sentralisasi Informasi Akademik & Kesiswaan**: Menyajikan agenda kegiatan, kalender akademik, direktori tenaga pendidik, katalog sarana prasarana, serta rekam jejak prestasi siswa secara transparan dan mudah diakses.
3. **Kemandirian Pengelolaan Konten (No-Code CMS)**: Memberikan keleluasaan bagi staf internal sekolah untuk mempublikasikan artikel berita, galeri dokumentasi foto, dokumen lampiran, dan pengumuman secara mandiri, terstruktur, dan terjadwal.
4. **Saluran Komunikasi Terpusat**: Memfasilitasi interaksi dua arah dengan masyarakat melalui formulir kontak terintegrasi yang langsung terhubung ke kotak masuk admin.

---

## 🏗 Arsitektur Sistem & Tech Stack

Aplikasi ini dibangun menggunakan arsitektur **Modern Monolithic MVC (Model-View-Controller)** yang berfokus pada keandalan performa, pemeliharaan jangka panjang (*maintainability*), dan keamanan data institusi:

```text
[ Browser / Klien ]
        │
   (HTTPS / Web)
        │
┌───────▼────────────────────────────────────────────────────────┐
│                   PRESENTATION & ROUTING LAYER                 │
│  - Tailwind CSS 3.4 (Utility-First Responsive UI)              │
│  - Blade Template Engine (Modular Views & Components)          │
│  - Alpine.js 3.4 & Vanilla JS (Lightweight Micro-Interactions) │
│  - Vite 5.x (Modern Asset Bundler & HMR)                       │
└───────┬────────────────────────────────────────────────────────┘
        │
┌───────▼────────────────────────────────────────────────────────┐
│                     APPLICATION & LOGIC LAYER                  │
│  - Laravel 10.x Framework (Routing, Controllers, Form Requests)│
│  - View Composers (SettingComposer, NavigationComposer)        │
│  - Cache Engine (Cache::remember untuk agregasi metrik publik) │
└───────┬────────────────────────────────────────────────────────┘
        │
┌───────▼────────────────────────────────────────────────────────┐
│                   SECURITY & AUTHORIZATION LAYER               │
│  - Spatie Laravel-Permission (Role-Based Access Control)       │
│  - Laravel Breeze (Secure Session Authentication)              │
│  - CSRF Token Protection & Strict MIME-Type File Validation    │
└───────┬────────────────────────────────────────────────────────┘
        │
┌───────▼────────────────────────────────────────────────────────┐
│                   PERSISTENCE & STORAGE LAYER                  │
│  - MySQL / MariaDB (Database Terindeks via Eloquent ORM)       │
│  - Laravel Filesystem (Asset & Media Storage via Symlink)      │
└────────────────────────────────────────────────────────────────┘
```

### Rincian Teknologi Pilihan
- **Backend Core**: **PHP 8.1+ & Laravel 10.x** — Menawarkan performa andal, ekosistem keamanan matang, arsitektur MVC yang bersih, dan Expressive Eloquent ORM.
- **Role-Based Access Control (RBAC)**: **`spatie/laravel-permission v6`** — Memisahkan hak akses secara granular antara Super Admin, Editor Konten, Staf PPDB, dan Tenaga Pengajar sesuai prinsip *least privilege*.
- **Frontend Styling**: **Tailwind CSS v3.4** dengan `@tailwindcss/typography` dan `@tailwindcss/forms` — Desain responsif (*mobile-first*), bebas bloatware, dan konsisten di berbagai ukuran layar.
- **Interaktivitas Ringan**: **Alpine.js v3.4 & Vanilla JavaScript** — Reaktivitas deklaratif yang sangat ringan untuk mengendalikan *mobile drawer*, *dropdown navigation*, *modal search*, dan *collapsible admin sidebar* tanpa membebani browser pengunjung dengan framework SPA yang berat.
- **Asset Bundler**: **Vite 5.x** — Kompilasi aset modern yang cepat untuk meminimalkan ukuran transfer CSS dan JavaScript.
- **Decoupling Data**: **View Composers** — Data konfigurasi identitas sekolah (*school settings*) dan menu halaman dinamis di-inject secara terisolasi tanpa membebani logika controller utama.

---

## 💻 Panduan Instalasi & Menjalankan di Lingkungan Lokal

Ikuti langkah-langkah berikut untuk mengkloning dan menjalankan proyek ini di lingkungan pengembangan lokal Anda:

### 1. Kebutuhan Sistem (Prerequisites)
Pastikan perangkat Anda telah terpasang:
- **PHP >= 8.1** (dengan ekstensi: `pdo_mysql`, `mbstring`, `fileinfo`, `openssl`, `tokenizer`, `xml`)
- **Composer 2.x**
- **Node.js >= 18.x** & **NPM**
- **MySQL / MariaDB Server** (via Laragon, XAMPP, atau instalasi mandiri)

---

### 2. Kloning Repository
```bash
git clone https://github.com/<username>/<nama-repo>.git
cd <nama-repo>
```

---

### 3. Pasang Dependensi Proyek
Pasang paket pustaka PHP dan modul JavaScript:
```bash
# Dependensi PHP backend
composer install

# Dependensi frontend
npm install
```

---

### 4. Konfigurasi File Lingkungan (`.env`)
Salin file konfigurasi contoh menjadi file environment aktif:
```bash
cp .env.example .env
```

Buka file `.env` menggunakan teks editor Anda, lalu sesuaikan konfigurasi koneksi database lokal:
```env
APP_NAME="SMA Laboratorium UPGRIS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_lokal_anda
DB_USERNAME=root
DB_PASSWORD=
```
*(Pastikan Anda telah membuat database kosong di MySQL dengan nama yang sesuai)*.

---

### 5. Generate Application Key
Buat kunci enkripsi unik aplikasi Laravel:
```bash
php artisan key:generate
```

---

### 6. Migrasi & Seeding Database
Jalankan seluruh migrasi skema tabel beserta data dasar awal (*roles*, *permissions*, konfigurasi identitas sekolah, dan data dummy pratinjau):
```bash
php artisan migrate --seed
```

> [!NOTE]
> Proyek ini menyertakan `SettingSeeder` dan `DummyDataSeeder` bawaan agar Anda dapat langsung meninjau tampilan antarmuka web secara utuh dan terisi tanpa halaman kosong.

---

### 7. Buat Symlink Storage Publik
Hubungkan folder penyimpanan file internal ke direktori publik agar gambar, logo, dan berkas unggahan dapat diakses oleh browser:
```bash
php artisan storage:link
```

---

### 8. Jalankan Aplikasi
Buka **dua jendela terminal** terpisah:

* **Terminal 1** — Jalankan pemantauan dan kompilasi aset frontend:
  ```bash
  npm run dev
  ```

* **Terminal 2** — Jalankan server lokal Laravel:
  ```bash
  php artisan serve
  ```

Buka peramban (*browser*) Anda dan akses alamat:
```text
http://127.0.0.1:8000
```

---

## 🔒 Konfigurasi Akun Pengguna & Keamanan

Demi menjaga kerahasiaan dan privasi data institusi klien:
- **Kredensial Akun Administrator**: Tidak dipublikasikan secara terbuka pada dokumentasi publik ini. Kredensial akun untuk keperluan pengujian lokal dapat ditinjau atau dikonfigurasi secara mandiri melalui file seeder lokal di:
  ```text
  database/seeders/UserSeeder.php
  ```
- **Keamanan Lingkungan Produksi**:
  - Selalu pastikan variabel `APP_DEBUG=false` dan `APP_ENV=production` saat sistem di-deploy ke server online.
  - Jangan pernah mengikutsertakan file `.env` ke dalam *version control* (Git).
  - Seluruh formulir telah dilengkapi token proteksi terhadap serangan *Cross-Site Request Forgery* (CSRF).

---

## 📄 Hak Cipta & Kepemilikan

Proyek ini dikembangkan secara profesional dan bersifat *Proprietary*. Seluruh hak cipta materi, aset identitas, dan nama institusi dimiliki oleh **SMA Laboratorium Universitas PGRI Semarang**.
