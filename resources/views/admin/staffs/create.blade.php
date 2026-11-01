@extends('layouts.app')

@section('title', 'Tambah Data Guru & Staf')

@section('content')
    <form action="{{ route('dashboard.staffs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.staffs._form', ['submitButtonText' => 'Simpan Data'])
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Tom Select untuk mata pelajaran
            new TomSelect('#subjects', {
                plugins: ['remove_button'],
            });
        });
    </script>
@endpush
