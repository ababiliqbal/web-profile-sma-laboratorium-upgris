@extends('layouts.app')

@section('title', 'Edit Data Guru & Staf')

@section('content')
    <form action="{{ route('dashboard.staffs.update', $staff) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.staffs._form', ['staff' => $staff, 'submitButtonText' => 'Update Data'])
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
