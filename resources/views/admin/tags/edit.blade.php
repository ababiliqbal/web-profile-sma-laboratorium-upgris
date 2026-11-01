@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <form action="{{ route('dashboard.tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.tags._form', [
            'tag' => $tag,
            'submitButtonText' => 'Update Tag',
        ])
    </form>
@endsection
