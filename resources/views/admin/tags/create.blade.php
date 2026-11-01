@extends('layouts.app')

@section('title', 'Tambah Tag Baru')

@section('content')
    <form action="{{ route('dashboard.tags.store') }}" method="POST">
        @csrf
        @include('admin.tags._form', ['submitButtonText' => 'Simpan Tag'])
    </form>
@endsection
