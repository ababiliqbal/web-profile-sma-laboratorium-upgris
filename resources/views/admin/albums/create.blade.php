@extends('layouts.app')

@section('title', 'Buat Album Baru')

@section('content')
    <form action="{{ route('dashboard.albums.store') }}" method="POST">
        @csrf
        @include('admin.albums._form', ['submitButtonText' => 'Buat Album'])
    </form>
@endsection
