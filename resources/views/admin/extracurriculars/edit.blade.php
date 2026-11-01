@extends('layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
    <form action="{{ route('dashboard.extracurriculars.update', $extracurricular) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.extracurriculars._form', [
            'extracurricular' => $extracurricular,
            'submitButtonText' => 'Update Ekskul',
        ])
    </form>
@endsection
