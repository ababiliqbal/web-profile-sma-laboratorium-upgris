@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('content')
    <form action="{{ route('dashboard.subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.subjects._form', [
            'subject' => $subject,
            'submitButtonText' => 'Update Mata Pelajaran',
        ])
    </form>
@endsection
