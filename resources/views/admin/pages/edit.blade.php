@extends('layouts.app')

@section('title', 'Edit Halaman')

@section('content')
    {{-- 1. Buat "wadah" Alpine.js untuk menampung logika hapus --}}
    <div x-data="{
        confirmDelete(actionUrl) {
            if (confirm('Anda yakin ingin menghapus item ini?')) {
                this.$refs.deleteForm.action = actionUrl;
                this.$refs.deleteForm.submit();
            }
        }
    }">

        {{-- Form Edit Utama --}}
        <form action="{{ route('dashboard.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages._form', ['page' => $page, 'submitButtonText' => 'Update Halaman'])
        </form>

        {{-- 2. (BARU) Form Hapus Tunggal yang Tersembunyi --}}
        <form x-ref="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        tinymce.init({
            selector: 'textarea#content', // Menargetkan textarea dengan ID 'content'
            plugins: 'code table lists image link fullscreen',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link image | fullscreen',
            height: 400,
        });
    </script>
@endpush
