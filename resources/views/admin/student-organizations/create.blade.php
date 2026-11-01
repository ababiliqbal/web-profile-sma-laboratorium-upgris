@extends('layouts.app')

@section('title', 'Tambah Organisasi Siswa Baru')

@section('content')
    <form action="{{ route('dashboard.student-organizations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.student-organizations._form', ['submitButtonText' => 'Simpan Organisasi'])
    </form>
@endsection
