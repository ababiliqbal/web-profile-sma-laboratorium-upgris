@extends('layouts.app')

@section('title', 'Edit Album')

@section('content')
    <div class="mb-6">
        <a href="{{ route('dashboard.albums.index') }}"
            class="flex items-center text-sm text-text-light hover:text-primary transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Album
        </a>
    </div>

    <form action="{{ route('dashboard.albums.update', $album) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.albums._form', ['album' => $album, 'submitButtonText' => 'Update Album'])
    </form>
@endsection
