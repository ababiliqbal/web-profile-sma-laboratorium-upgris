@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

    {{-- Notifikasi Status --}}
    @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-xl shadow-soft ring-1 ring-green-200/70"
            role="alert">
            <p class="font-medium">{{ session('status') }}</p>
        </div>
    @endif

    <div class="space-y-8">

        {{-- Kartu untuk Update Informasi Profil --}}
        <div
            class="bg-surface p-6 rounded-2xl shadow-soft ring-1 ring-gray-200/70 transition focus-within:ring-2 focus-within:ring-blue-400/50 hover:shadow-md">
            <div class="max-w-xl">
                <h2 class="text-lg font-bold text-text-dark tracking-tight">Informasi Profil</h2>
                <p class="mt-1 text-sm text-text-light">Perbarui informasi profil dan alamat email akun Anda.</p>

                <form method="post" action="{{ route('dashboard.profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="form-label text-sm font-medium text-blue-900">Nama</label>
                        <input id="name" name="name" type="text"
                            class="input-form w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @error('name')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label text-sm font-medium text-blue-900">Email</label>
                        <input id="email" name="email" type="email"
                            class="input-form w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @error('email')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        {{-- BTN PRIMARY: Simpan --}}
                        <button type="submit"
                            class="btn btn-primary rounded-xl px-5 py-2.5 font-semibold shadow-sm hover:shadow-lg transform-gpu transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kartu untuk Update Password --}}
        <div
            class="bg-surface p-6 rounded-2xl shadow-soft ring-1 ring-gray-200/70 transition focus-within:ring-2 focus-within:ring-blue-400/50 hover:shadow-md">
            <div class="max-w-xl">
                <h2 class="text-lg font-bold text-text-dark tracking-tight">Ubah Password</h2>
                <p class="mt-1 text-sm text-text-light">Pastikan akun Anda menggunakan password yang panjang dan acak agar
                    tetap aman.</p>

                <form method="post" action="{{ route('dashboard.password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="form-label text-sm font-medium text-blue-900">Password Saat
                            Ini</label>
                        <input id="current_password" name="current_password" type="password"
                            class="input-form w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition"
                            autocomplete="current-password" required />
                        @error('current_password', 'updatePassword')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label text-sm font-medium text-blue-900">Password Baru</label>
                        <input id="password" name="password" type="password"
                            class="input-form w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition"
                            autocomplete="new-password" required />
                        @error('password', 'updatePassword')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label text-sm font-medium text-blue-900">Konfirmasi
                            Password Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="input-form w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200/80 transition"
                            autocomplete="new-password" required />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        {{-- BTN PRIMARY: Simpan Password --}}
                        <button type="submit"
                            class="btn btn-primary rounded-xl px-5 py-2.5 font-semibold shadow-sm hover:shadow-lg transform-gpu transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                            Simpan Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kartu untuk Hapus Akun --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft ring-1 ring-gray-200/70 transition hover:shadow-md">
            <div class="max-w-xl" x-data="{ confirmingUserDeletion: false }">
                <h2 class="text-lg font-bold text-danger tracking-tight">Hapus Akun</h2>
                <p class="mt-1 text-sm text-text-light">
                    Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus
                    akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                </p>

                <div class="mt-6">
                    {{-- BTN DANGER: Hapus Akun (trigger modal) --}}
                    <button type="button" @click="confirmingUserDeletion = true"
                        class="btn btn-danger rounded-xl px-5 py-2.5 font-semibold shadow-sm hover:shadow-lg transform-gpu transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500">
                        Hapus Akun
                    </button>
                </div>

                {{-- Modal Konfirmasi Penghapusan --}}
                <div x-show="confirmingUserDeletion" @keydown.escape.window="confirmingUserDeletion = false" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
                    style="display: none;">

                    <div @click.away="confirmingUserDeletion = false"
                        class="bg-surface rounded-2xl shadow-xl w-full max-w-lg p-6 ring-1 ring-gray-200/70">
                        <form method="post" action="{{ route('dashboard.profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-bold text-text-dark tracking-tight">
                                Apakah Anda yakin ingin menghapus akun Anda?
                            </h2>

                            <p class="mt-2 text-sm text-text-light">
                                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap
                                masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara
                                permanen.
                            </p>

                            <div class="mt-6">
                                <label for="password" class="sr-only">Password</label>
                                <input id="password" name="password" type="password"
                                    class="input-form w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200/80 transition"
                                    placeholder="Password" required>
                                @error('password', 'userDeletion')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6 flex justify-end gap-3">

                                <button type="button" @click="confirmingUserDeletion = false"
                                    class="btn-secondary rounded-xl hover:shadow-sm transition">
                                    Batal
                                </button>

                                {{-- BTN DANGER: Hapus Akun (submit) --}}
                                <button type="submit"
                                    class="btn btn-danger rounded-xl px-5 py-2.5 font-semibold shadow-sm hover:shadow-lg transform-gpu transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
