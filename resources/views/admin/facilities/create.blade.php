@extends('layouts.app')

@section('title', 'Tambah Fasilitas Baru')

@section('content')
    <form action="{{ route('dashboard.facilities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.facilities._form', ['submitButtonText' => 'Simpan Fasilitas'])
    </form>
@endsection
