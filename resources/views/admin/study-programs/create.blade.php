@extends('layouts.app')

@section('title', 'Tambah Jurusan Baru')

@section('content')
    <form action="{{ route('dashboard.study-programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.study-programs._form', ['submitButtonText' => 'Simpan Jurusan'])
    </form>
@endsection
