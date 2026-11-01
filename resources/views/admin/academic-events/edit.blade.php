@extends('layouts.app')

@section('title', 'Edit Agenda')

@section('content')
    {{-- 1. Buat "wadah" Alpine.js untuk menampung logika --}}
    <div x-data="{
        // Fungsi ini akan dipanggil oleh tombol hapus
        confirmDelete(actionUrl) {
            if (confirm('Anda yakin ingin menghapus item ini?')) {
                // Cari form hapus, set action-nya, lalu submit
                this.$refs.deleteForm.action = actionUrl;
                this.$refs.deleteForm.submit();
            }
        }
    }">

        {{-- Form Edit Utama --}}
        <form action="{{ route('dashboard.academic-events.update', $academicEvent) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.academic-events._form', [
                'academicEvent' => $academicEvent,
                'submitButtonText' => 'Update Agenda',
            ])
        </form>

        {{-- 2. (BARU) Form Hapus Tunggal yang Tersembunyi di luar form utama --}}
        <form x-ref="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection
