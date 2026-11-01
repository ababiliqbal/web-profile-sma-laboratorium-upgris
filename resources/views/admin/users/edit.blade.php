@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.users._form', [
            'user' => $user,
            'submitButtonText' => 'Update Pengguna',
        ])
    </form>
@endsection
