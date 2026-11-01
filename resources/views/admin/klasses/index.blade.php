@extends('layouts.app')

@section('title', 'Manajemen Kelas')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Manajemen Kelas</h1>
        <p class="mb-4">Daftar semua kelas yang tersedia di sekolah.</p>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('dashboard.klasses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kelas Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($klasses as $class)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->description ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.klasses.edit', $class->id) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('dashboard.klasses.destroy', $class->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Link Paginasi --}}
                <div class="mt-3">
                    {{ $klasses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
