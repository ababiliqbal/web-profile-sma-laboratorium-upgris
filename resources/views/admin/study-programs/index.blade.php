@extends('layouts.app')

@section('title', 'Manajemen Jurusan')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-surface rounded-2xl shadow-soft">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="text-xl font-bold text-text-dark">Daftar Program Studi / Jurusan</h3>

            {{-- Perbaikan: Tombol dilindungi permission --}}
            @can('manage-study-programs')
                <a href="{{ route('dashboard.study-programs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Jurusan</span>
                </a>
            @endcan
        </div>

        <div class="p-6">
            @if ($studyPrograms->isEmpty())
                <div class="text-center p-10">
                    <div class="text-text-light">
                        <i class="fas fa-school fa-3x"></i>
                        <p class="mt-4">Belum ada data jurusan yang ditambahkan.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Perbaikan: Menggunakan variabel $studyProgram --}}
                    @foreach ($studyPrograms as $studyProgram)
                        <div class="bg-white rounded-xl shadow-soft overflow-hidden flex flex-col group relative">
                            {{-- Gambar Jurusan --}}
                            <div class="relative h-48 w-full">
                                @if ($studyProgram->image_path)
                                    <img src="{{ asset('storage/' . $studyProgram->image_path) }}"
                                        alt="{{ $studyProgram->image_alt ?? $studyProgram->name }}"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Informasi --}}
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-bold text-lg text-text-dark mb-1">{{ $studyProgram->name }}</h4>
                                <p class="text-sm text-text-light mb-2">
                                    {{-- Perbaikan: Menggunakan relasi headStaff --}}
                                    Kepala Jurusan: <span
                                        class="font-medium text-text-dark">{{ $studyProgram->headStaff->name ?? 'N/A' }}</span>
                                </p>
                                <p class="text-sm text-text-light flex-grow">
                                    {{ Str::limit($studyProgram->description, 70) }}</p>
                            </div>

                            {{-- Dropdown Aksi dilindungi permission --}}
                            @can('manage-study-programs')
                                <div x-data="{ open: false }" class="absolute top-3 right-3">
                                    <button @click="open = !open"
                                        class="bg-white/70 backdrop-blur-sm text-text-dark hover:bg-primary-light hover:text-primary rounded-full w-8 h-8 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-primary">
                                        <i class="fas fa-ellipsis-v text-sm"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-20 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            <a href="{{ route('dashboard.study-programs.edit', $studyProgram) }}"
                                                class="dropdown-item">
                                                <i class="fas fa-edit w-5"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.study-programs.destroy', $studyProgram) }}"
                                                method="POST"
                                                onsubmit="return confirm('Anda yakin ingin menghapus jurusan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-item text-red-600 hover:!bg-red-50 w-full text-left">
                                                    <i class="fas fa-trash-alt w-5"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Menambahkan Paginasi jika ada --}}
        @if ($studyPrograms->hasPages())
            <div class="p-6 border-t border-border">
                {{ $studyPrograms->links() }}
            </div>
        @endif
    </div>
@endsection
