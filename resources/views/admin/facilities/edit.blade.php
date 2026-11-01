@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
    <form action="{{ route('dashboard.facilities.update', $facility) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.facilities._form', [
            'facility' => $facility,
            'submitButtonText' => 'Update Fasilitas',
        ])
    </form>
@endsection
