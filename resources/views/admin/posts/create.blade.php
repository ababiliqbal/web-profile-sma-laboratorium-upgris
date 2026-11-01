@extends('layouts.app')
@section('title', 'Tambah Postingan Baru')
@section('content')
    <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.posts._form', ['submitButtonText' => 'Simpan Postingan'])
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#tags', {
                // Opsi ini mengizinkan pembuatan item baru jika tidak ditemukan
                create: true,
                // Opsi ini akan menghapus item baru dari daftar setelah dibuat
                persist: false,
                // Menambahkan tombol hapus pada setiap item
                plugins: ['remove_button'],
            });
        });
        tinymce.init({
            selector: 'textarea#content', // Menargetkan textarea dengan ID 'content'
            plugins: 'code table lists image link fullscreen',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link image | fullscreen',
            height: 400,
        });
    </script>
@endpush
