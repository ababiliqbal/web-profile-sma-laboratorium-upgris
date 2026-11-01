@extends('layouts.app')

@section('title', 'Tambah Testimoni Baru')

@section('content')
    <form action="{{ route('dashboard.alumni-testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.alumni-testimonials._form', ['submitButtonText' => 'Simpan Testimoni'])
    </form>
@endsection
