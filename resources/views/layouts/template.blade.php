<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Pengaturan Dasar --}}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- =================================================================
    [PERBAIKAN SEO PROFESIONAL] Meta Tags Dinamis
    ================================================================== --}}

    {{-- Judul dan Deskripsi Halaman (Dinamis per Halaman) --}}
    <title>@yield('title', $settings['school_name'] ?? 'Website Sekolah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="description" content="@yield('description', 'Selamat datang di situs web resmi ' . ($settings['school_name'] ?? 'sekolah kami') . '. Temukan informasi lengkap mengenai profil, pendaftaran, dan kegiatan terbaru.')">

    {{-- Meta Keywords (Opsional, tapi baik untuk dimiliki) --}}
    <meta name="keywords" content="sekolah, sma, ppdb, pendaftaran siswa, profil sekolah, @yield('keywords')">
    <meta name="author" content="{{ $settings['school_name'] ?? 'Admin Sekolah' }}">

    {{-- Canonical URL (Penting untuk menghindari duplikat konten) --}}
    <link rel="canonical" href="{{ url()->current() }}" />

    {{-- Open Graph Tags (Untuk Facebook, WhatsApp, LinkedIn, dll.) --}}
    <meta property="og:title" content="@yield('title', $settings['school_name'] ?? 'Website Sekolah')" />
    <meta property="og:description" content="@yield('description', 'Selamat datang di situs web resmi ' . ($settings['school_name'] ?? 'sekolah kami') . '.')" />
    <meta property="og:image" content="@yield('og_image', isset($settings['school_logo']) ? asset('storage/' . $settings['school_logo']) : asset('placeholder.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $settings['school_name'] ?? 'Website Sekolah')">
    <meta name="twitter:description" content="@yield('description', 'Selamat datang di situs web resmi ' . ($settings['school_name'] ?? 'sekolah kami') . '.')" />
    <meta name="twitter:image" content="@yield('og_image', isset($settings['school_logo']) ? asset('storage/' . $settings['school_logo']) : asset('placeholder.jpg'))">

    {{-- Favicon Dinamis --}}
    @if (isset($settings['school_favicon']))
        <link rel="icon" href="{{ asset('storage/' . $settings['school_favicon']) }}" type="image/png">
    @else
        <link rel="icon" href="https://placehold.co/32x32/1E3A8A/FFFFFF?text=L" type="image/png">
    @endif

    {{-- =================================================================
    AKHIR DARI PERBAIKAN SEO
    ================================================================== --}}

    {{-- Aset CSS dan Font --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Aset JavaScript --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* [PENYEMPURNAAN] Animasi Ken Burns untuk gambar hero */
        .ken-burns {
            animation: ken-burns-animation 20s ease-in-out infinite alternate;
        }

        @keyframes ken-burns-animation {
            0% {
                transform: scale(1) translate(0, 0);
            }

            100% {
                transform: scale(1.1) translate(-1%, 2%);
            }
        }

        /* [PENYEMPURNAAN ANIMASI] Animasi garis bawah dari kiri ke kanan */
        .nav-link {
            position: relative;
            /* Diperlukan untuk posisi pseudo-element */
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            /* Ketebalan garis */
            bottom: -4px;
            /* Jarak garis dari teks */
            left: 0;
            background-color: #1D4ED8;
            /* Warna biru (Tailwind blue-700) */
            transform: scaleX(0);
            /* Awalnya, garis tidak terlihat (skala 0) */
            transform-origin: bottom left;
            /* Animasi dimulai dari kiri */
            transition: transform 0.3s ease-out;
            /* Durasi dan efek transisi */
        }

        /* Saat link di-hover atau aktif, lebarkan garisnya */
        .nav-link:hover::after,
        .nav-link.active::after {
            transform: scaleX(1);
            /* Lebarkan garis menjadi 100% */
        }
    </style>
</head>

<body x-data="{ searchOpen: false }" class="bg-gray-50 text-gray-800 antialiased">

    <!-- Aksesibilitas: Tautan "Lewati ke Konten Utama" untuk screen reader -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:px-4 focus:py-2 focus:bg-white focus:text-gray-900">
        Lewati ke Konten Utama
    </a>

    {{-- HEADER --}}
    @include('layouts.partials.navbar')


    {{-- KONTEN UTAMA --}}
    @yield('content')


    {{-- FOOTER --}}
    @include('layouts.partials.footer')

    <!-- [PENYEMPURNAAN] Script untuk AOS dan Counter -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // [Fungsionalitas] Mengatur tahun hak cipta secara dinamis
        document.getElementById('copyright-year').textContent = new Date().getFullYear();

        // Inisialisasi AOS
        AOS.init({
            once: true, // Animasi hanya berjalan sekali
            duration: 800, // Durasi animasi
        });

        // Fungsi counter untuk Alpine.js
        document.addEventListener('alpine:initializing', () => {
            Alpine.data('counter', (target) => ({
                current: 0,
                target: target,
                start() {
                    let hasStarted = false;
                    if (hasStarted) return;
                    hasStarted = true;

                    const duration = 2000;
                    const stepTime = Math.abs(Math.floor(duration / this.target));

                    const timer = setInterval(() => {
                        this.current += 1;
                        if (this.current >= this.target) {
                            this.current = this.target;
                            clearInterval(timer);
                        }
                    }, stepTime);
                }
            }));
        });
    </script>

</body>

</html>
