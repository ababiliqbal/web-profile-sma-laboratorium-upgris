@extends('layouts.app')
@section('content')
    <!-- Konten utama lainnya tetap sama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div
            class="bg-surface p-6 rounded-2xl shadow-soft hover:shadow-medium transition-shadow duration-300 flex items-center gap-5 transform hover:-translate-y-1">
            <div class="bg-blue-100 text-blue-500 w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-chalkboard-teacher text-2xl"></i>
            </div>
            <div>
                <p class="text-text-light text-sm font-medium">Total Guru & Staf</p>
                <p class="text-3xl font-bold text-text-dark">#</p>
            </div>
        </div>
        <div
            class="bg-surface p-6 rounded-2xl shadow-soft hover:shadow-medium transition-shadow duration-300 flex items-center gap-5 transform hover:-translate-y-1">
            <div
                class="bg-orange-100 text-orange-500 w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-newspaper text-2xl"></i>
            </div>
            <div>
                <p class="text-text-light text-sm font-medium">Total Postingan</p>
                <p class="text-3xl font-bold text-text-dark">#</p>
            </div>
        </div>
        {{-- <div
            class="bg-surface p-6 rounded-2xl shadow-soft hover:shadow-medium transition-shadow duration-300 flex items-center gap-5 transform hover:-translate-y-1">
            <div class="bg-green-100 text-green-500 w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <p class="text-text-light text-sm font-medium">Pendaftar Baru</p>
                <p class="text-3xl font-bold text-text-dark">15</p>
            </div>
        </div> --}}
        <div
            class="bg-surface p-6 rounded-2xl shadow-soft hover:shadow-medium transition-shadow duration-300 flex items-center gap-5 transform hover:-translate-y-1">
            <div class="bg-red-100 text-red-500 w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-image text-2xl"></i>
            </div>
            <div>
                <p class="text-text-light text-sm font-medium">Album Galeri</p>
                <p class="text-3xl font-bold text-text-dark">#</p>
            </div>
        </div>
    </div>
    <div class="bg-surface rounded-2xl shadow-soft overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="text-xl font-bold">Postingan Terbaru</h3><a href="#"
                class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 transition-colors"><i
                    class="fas fa-plus"></i><span class="hidden sm:inline">Tambah Baru</span></a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul Postingan</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Penulis</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-surface border-b border-border hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-text-dark whitespace-nowrap">Upacara
                            Bendera HUT RI ke-80</td>
                        <td class="px-6 py-4">Acara Sekolah</td>
                        <td class="px-6 py-4">Admin Budi</td>
                        <td class="px-6 py-4">07 Jul 2025</td>
                        <td class="px-6 py-4"><span
                                class="px-3 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">Published</span>
                        </td>
                        <td class="px-6 py-4 text-center"><button class="text-text-light hover:text-primary"><i
                                    class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr class="bg-surface border-b border-border hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-text-dark whitespace-nowrap">Penerimaan
                            Siswa Baru Dibuka</td>
                        <td class="px-6 py-4">PPDB</td>
                        <td class="px-6 py-4">Admin Ana</td>
                        <td class="px-6 py-4">02 Jul 2025</td>
                        <td class="px-6 py-4"><span
                                class="px-3 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">Published</span>
                        </td>
                        <td class="px-6 py-4 text-center"><button class="text-text-light hover:text-primary"><i
                                    class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr class="bg-surface border-b border-border hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-text-dark whitespace-nowrap">Jadwal Ujian
                            Akhir Semester</td>
                        <td class="px-6 py-4">Akademik</td>
                        <td class="px-6 py-4">Admin Budi</td>
                        <td class="px-6 py-4">28 Jun 2025</td>
                        <td class="px-6 py-4"><span
                                class="px-3 py-1 text-xs font-bold text-orange-800 bg-orange-200 rounded-full">Draft</span>
                        </td>
                        <td class="px-6 py-4 text-center"><button class="text-text-light hover:text-primary"><i
                                    class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr class="bg-surface hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-text-dark whitespace-nowrap">Juara 1 Lomba
                            Cerdas Cermat</td>
                        <td class="px-6 py-4">Prestasi</td>
                        <td class="px-6 py-4">Admin Ana</td>
                        <td class="px-6 py-4">25 Jun 2025</td>
                        <td class="px-6 py-4"><span
                                class="px-3 py-1 text-xs font-bold text-gray-800 bg-gray-200 rounded-full">Archived</span>
                        </td>
                        <td class="px-6 py-4 text-center"><button class="text-text-light hover:text-primary"><i
                                    class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection