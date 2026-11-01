@extends('layouts.app')

@section('title', 'Tambah Ekstrakurikuler Baru')

@section('content')
    <form action="{{ route('dashboard.extracurriculars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.extracurriculars._form', ['submitButtonText' => 'Simpan Ekskul'])
    </form>
@endsection
