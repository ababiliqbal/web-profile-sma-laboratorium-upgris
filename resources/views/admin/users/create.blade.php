@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')
    <form action="{{ route('dashboard.users.store') }}" method="POST">
        @csrf
        @include('admin.users._form', ['submitButtonText' => 'Simpan Pengguna'])
    </form>
@endsection
