@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
    <form action="{{ route('dashboard.study-programs.update', $studyProgram) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.study-programs._form', [
            'studyProgram' => $studyProgram,
            'submitButtonText' => 'Update Jurusan',
        ])
    </form>
@endsection
