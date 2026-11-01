@extends('layouts.app')

@section('title', 'Edit Kelas')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kelas Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.klasses.store') }}" method="POST">
                    @include('admin.klasses._form', ['submitButtonText' => 'Tambah Kelas'])
                </form>
            </div>
        </div>
    </div>
@endsection
