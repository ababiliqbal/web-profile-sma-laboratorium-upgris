@extends('layouts.app')

@section('title', 'Edit Organisasi Siswa')

@section('content')
    <form action="{{ route('dashboard.student-organizations.update', $studentOrganization) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.student-organizations._form', [
            'studentOrganization' => $studentOrganization,
            'submitButtonText' => 'Update Organisasi',
        ])
    </form>
@endsection
