@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
    {{-- Perbaikan: Menggunakan route 'dashboard.categories.store' --}}
    <form action="{{ route('dashboard.categories.store') }}" method="POST">
        @csrf
        @include('admin.categories._form', ['submitButtonText' => 'Simpan Kategori'])
    </form>
@endsection
