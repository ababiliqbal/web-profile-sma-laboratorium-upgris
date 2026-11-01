@extends('layouts.app')

@section('title', 'Edit Prestasi')

@section('content')
    <form action="{{ route('dashboard.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.achievements._form', [
            'achievement' => $achievement,
            'submitButtonText' => 'Update Prestasi',
        ])
    </form>
@endsection
