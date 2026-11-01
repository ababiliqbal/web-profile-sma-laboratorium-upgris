@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran Baru')

@section('content')
    <form action="{{ route('dashboard.subjects.store') }}" method="POST">
        @csrf
        @include('admin.subjects._form', ['submitButtonText' => 'Simpan Mata Pelajaran'])
    </form>
@endsection
