@extends('layouts.app')

@section('title', 'Tambah Halaman Baru')

@section('content')
    {{-- Menggunakan route yang benar sesuai standar kita --}}
    <form action="{{ route('dashboard.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages._form', ['submitButtonText' => 'Simpan Halaman'])
    </form>
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
