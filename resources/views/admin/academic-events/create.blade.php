@extends('layouts.app')

@section('title', 'Tambah Agenda Baru')

@section('content')
    <form action="{{ route('dashboard.academic-events.store') }}" method="POST">
        @csrf
        @include('admin.academic-events._form', ['submitButtonText' => 'Simpan Agenda'])
    </form>
@endsection
