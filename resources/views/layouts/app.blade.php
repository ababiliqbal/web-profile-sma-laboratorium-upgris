<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Panel Admin Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nk87br3s4s5ctnkss8w5fq8kvq4fojhlkyxowrnx0qu8lhoz/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    {{-- Tambahkan CSS Tom Select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">


</head>

<body class="bg-background text-text-dark">

    <div class="flex h-screen">
        <!-- SIDEBAR -->
        @include('layouts.partials.sidebar')

        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden lg:hidden"></div>

        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out">
            @include('layouts.partials.header')

            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Tambahkan JS Tom Select sebelum penutup </body> --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    {{-- Tambahkan stack untuk script khusus halaman --}}
    @stack('scripts')

</body>

</html>
