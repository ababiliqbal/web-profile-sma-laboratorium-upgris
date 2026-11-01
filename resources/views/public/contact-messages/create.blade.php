@extends('layouts.template') {{-- Ganti dengan nama layout publik Anda --}}

{{-- Meta tags SEO --}}
@section('title', 'Kontak Kami - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, program, atau pertanyaan
    lainnya. Temukan alamat, telepon, dan email kami di sini.')

@section('content')
    <main id="main-content">
        <!-- Hero -->
        <section class="bg-gradient-to-b from-white to-blue-50/40 pt-28 pb-10 border-b border-gray-100/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-blue-900">
                    Hubungi Kami
                </h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Kami senang mendengar dari Anda. Silakan gunakan informasi di bawah ini atau kirimkan pesan melalui
                    formulir.
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-16 sm:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <!-- Info + Map -->
                    <div data-aos="fade-right">
                        <h2 class="text-2xl font-bold text-blue-900 mb-6">Informasi Kontak</h2>

                        <div class="space-y-4 text-gray-700">
                            {{-- Alamat --}}
                            <div
                                class="flex items-start gap-4 p-4 rounded-xl ring-1 ring-gray-200/70 bg-white shadow-sm hover:shadow-md hover:ring-blue-300/40 transition">
                                <i class="fas fa-map-marker-alt fa-fw text-2xl text-primary mt-1 shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-text-dark">Alamat</h3>
                                    <p class="text-text-light">{{ $settings['school_address'] ?? 'Alamat belum diatur' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div
                                class="flex items-start gap-4 p-4 rounded-xl ring-1 ring-gray-200/70 bg-white shadow-sm hover:shadow-md hover:ring-blue-300/40 transition">
                                <i class="fas fa-phone-alt fa-fw text-2xl text-primary mt-1 shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-text-dark">Telepon</h3>
                                    <a href="tel:{{ $settings['school_phone'] ?? '' }}"
                                        class="text-text-light hover:text-primary underline decoration-transparent hover:decoration-current underline-offset-4 transition">
                                        {{ $settings['school_phone'] ?? '-' }}
                                    </a>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div
                                class="flex items-start gap-4 p-4 rounded-xl ring-1 ring-gray-200/70 bg-white shadow-sm hover:shadow-md hover:ring-blue-300/40 transition">
                                <i class="fas fa-envelope fa-fw text-2xl text-primary mt-1 shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-text-dark">Email</h3>
                                    <a href="mailto:{{ $settings['school_email'] ?? '' }}"
                                        class="text-text-light hover:text-primary underline decoration-transparent hover:decoration-current underline-offset-4 transition">
                                        {{ $settings['school_email'] ?? '-' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-blue-900 mt-12 mb-6">Lokasi Kami</h2>
                        <div
                            class="rounded-2xl overflow-hidden shadow-lg ring-1 ring-gray-200/70 hover:ring-blue-300/40 transition">
                            <iframe src="{{ $settings['gmaps_url'] }}" width="100%" height="300" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                title="Peta Lokasi Sekolah">
                            </iframe>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="bg-white p-8 rounded-2xl shadow-xl ring-1 ring-gray-200/70 transition transform-gpu hover:shadow-2xl hover:ring-blue-300/40 focus-within:ring-blue-400/50"
                        data-aos="fade-left" data-aos-delay="100">
                        <h2 class="text-2xl font-bold text-blue-900 mb-6">Kirim Pesan</h2>

                        {{-- Notifikasi Sukses --}}
                        @if (session('success'))
                            <div class="bg-green-50 ring-1 ring-green-200 text-green-800 rounded-xl p-4 mb-6"
                                role="alert">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        {{-- Menampilkan Error Validasi --}}
                        @if ($errors->any())
                            <div class="bg-red-50 ring-1 ring-red-200 text-red-800 rounded-xl p-4 mb-6" role="alert">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kontak.contact.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="name" class="form-label text-sm font-medium text-blue-900">Nama
                                    Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="input-form rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition w-full"
                                    required>
                            </div>
                            <div>
                                <label for="email" class="form-label text-sm font-medium text-blue-900">Alamat
                                    Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="input-form rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition w-full"
                                    required>
                            </div>
                            <div>
                                <label for="subject" class="form-label text-sm font-medium text-blue-900">Subjek
                                    (Opsional)</label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                    class="input-form rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition w-full">
                            </div>
                            <div>
                                <label for="message" class="form-label text-sm font-medium text-blue-900">Pesan
                                    Anda</label>
                                <textarea id="message" name="message" rows="5"
                                    class="input-form rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition w-full"
                                    required>{{ old('message') }}</textarea>
                            </div>
                            <div class="pt-2">
                                <button type="submit"
                                    class="btn btn-primary w-full transform-gpu transition hover:-translate-y-0.5 active:translate-y-0">
                                    <i class="fas fa-paper-plane"></i> Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
