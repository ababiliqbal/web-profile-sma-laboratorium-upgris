@extends('layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Menampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form utama yang membungkus semua pengaturan --}}
    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Kolom Kiri: Form Utama --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Kartu: Informasi Umum Sekolah --}}
                <div class="bg-surface p-6 rounded-2xl shadow-soft">
                    <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Informasi Umum</h4>
                    <div class="space-y-4">
                        <div>
                            <label for="school_name" class="form-label">Nama Sekolah</label>
                            <input type="text" id="school_name" name="school_name"
                                value="{{ old('school_name', $settings['school_name'] ?? '') }}" class="input-form"
                                required>
                        </div>
                        <div>
                            <label for="school_address" class="form-label">Alamat Sekolah</label>
                            <textarea id="school_address" name="school_address" rows="3" class="input-form">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="school_phone" class="form-label">No. Telepon</label>
                                <input type="text" id="school_phone" name="school_phone"
                                    value="{{ old('school_phone', $settings['school_phone'] ?? '') }}" class="input-form">
                            </div>
                            <div>
                                <label for="school_email" class="form-label">Email Sekolah</label>
                                <input type="email" id="school_email" name="school_email"
                                    value="{{ old('school_email', $settings['school_email'] ?? '') }}" class="input-form">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu: Media Sosial --}}
                <div class="bg-surface p-6 rounded-2xl shadow-soft">
                    <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Media Sosial</h4>
                    <div class="space-y-4">
                        <div>
                            <label for="gmaps_url" class="form-label">URL Google Maps</label>
                            <input type="url" id="gmaps_url" name="gmaps_url"
                                value="{{ old('gmaps_url', $settings['gmaps_url'] ?? '') }}" class="input-form"
                                placeholder="https://www.google.com/maps/sekolah">
                        </div>
                        <div>
                            <label for="facebook_url" class="form-label">URL Facebook</label>
                            <input type="url" id="facebook_url" name="facebook_url"
                                value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="input-form"
                                placeholder="https://facebook.com/sekolah">
                        </div>
                        <div>
                            <label for="twitter_url" class="form-label">URL Twitter (X)</label>
                            <input type="url" id="twitter_url" name="twitter_url"
                                value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" class="input-form"
                                placeholder="https://x.com/sekolah">
                        </div>
                        <div>
                            <label for="instagram_url" class="form-label">URL Instagram</label>
                            <input type="url" id="instagram_url" name="instagram_url"
                                value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="input-form"
                                placeholder="https://instagram.com/sekolah">
                        </div>
                        <div>
                            <label for="youtube_url" class="form-label">URL YouTube</label>
                            <input type="url" id="youtube_url" name="youtube_url"
                                value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" class="input-form"
                                placeholder="https://youtube.com/sekolah">
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Branding & Aksi --}}
            <div class="space-y-8">
                <div class="bg-surface p-6 rounded-2xl shadow-soft">
                    <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Branding</h4>

                    {{-- Logo Sekolah --}}
                    <div class="mb-6">
                        <label class="form-label">Logo Sekolah</label>
                        <div x-data="{ imagePreview: '{{ isset($settings['school_logo']) ? asset('storage/' . $settings['school_logo']) : '' }}' }">
                            <input type="file" name="school_logo" class="hidden" x-ref="logo"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                            <div x-show="imagePreview"
                                class="my-2 p-2 border border-dashed border-border rounded-xl flex justify-center">
                                <img :src="imagePreview" alt="Preview Logo" class="h-20 object-contain">
                            </div>
                            <button type="button" @click="$refs.logo.click()" class="btn-secondary w-full text-sm">
                                <i class="fas fa-upload"></i> Ganti Logo
                            </button>
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div>
                        <label class="form-label">Favicon</label>
                        <div x-data="{ imagePreview: '{{ isset($settings['school_favicon']) ? asset('storage/' . $settings['school_favicon']) : '' }}' }">
                            <input type="file" name="school_favicon" class="hidden" x-ref="favicon"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                            <div x-show="imagePreview"
                                class="my-2 p-2 border border-dashed border-border rounded-xl flex justify-center">
                                <img :src="imagePreview" alt="Preview Favicon" class="w-16 h-16 object-contain">
                            </div>
                            <button type="button" @click="$refs.favicon.click()" class="btn-secondary w-full text-sm">
                                <i class="fas fa-upload"></i> Ganti Favicon
                            </button>
                        </div>
                        <p class="text-xs text-text-light mt-1">Gunakan format .ico atau .png</p>
                    </div>
                </div>

                {{-- Tombol Simpan dilindungi permission --}}
                @can('manage-settings')
                    <div class="bg-surface p-6 rounded-2xl shadow-soft">
                        <button type="submit" class="btn btn-primary w-full">
                            <i class="fas fa-save"></i>
                            <span>Simpan Semua Pengaturan</span>
                        </button>
                    </div>
                @endcan
            </div>
        </div>
    </form>
@endsection
