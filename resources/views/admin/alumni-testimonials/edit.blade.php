@extends('layouts.app')

@section('title', 'Edit Testimoni')

@section('content')
    <form action="{{ route('dashboard.alumni-testimonials.update', $alumniTestimonial) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.alumni-testimonials._form', [
            'alumniTestimonial' => $alumniTestimonial,
            'submitButtonText' => 'Update Testimoni',
        ])
    </form>
@endsection
