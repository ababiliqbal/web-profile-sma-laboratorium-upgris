@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    {{-- Perbaikan: Menggunakan route 'dashboard.categories.update' --}}
    <form action="{{ route('dashboard.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.categories._form', [
            'category' => $category,
            'submitButtonText' => 'Update Kategori',
        ])
    </form>
@endsection
