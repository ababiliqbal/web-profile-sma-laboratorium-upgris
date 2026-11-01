@extends('layouts.app')

@section('title', 'Tambah Prestasi Baru')

@section('content')
    <form action="{{ route('dashboard.achievements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.achievements._form', ['submitButtonText' => 'Simpan Prestasi'])
    </form>
@endsection
