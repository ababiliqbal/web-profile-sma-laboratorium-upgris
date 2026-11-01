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

<div class="bg-surface p-6 rounded-2xl shadow-soft">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                class="input-form" required>
        </div>
        <div>
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                class="input-form" required>
        </div>
        <div>
            <label for="role" class="form-label">Peran (Role)</label>
            <select id="role" name="role" class="input-form" required>
                <option value="">-- Pilih Peran --</option>
                @foreach ($roles as $role)
                    {{-- Jangan tampilkan Super Admin jika user yang diedit bukan Super Admin --}}
                    @if ($role->name !== 'Super Admin' || (isset($user) && $user->hasRole('Super Admin')))
                        <option value="{{ $role->name }}" @if (isset($user) && $user->hasRole($role->name)) selected @endif
                            @if (old('role') == $role->name) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-6 pt-6 border-t border-border">
        <p class="text-sm font-medium text-text-dark">Pengaturan Password</p>
        <p class="text-xs text-text-light mt-1">
            @if (isset($user))
                Kosongkan jika Anda tidak ingin mengubah password.
            @else
                Wajib diisi untuk pengguna baru.
            @endif
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="input-form"
                    {{ isset($user) ? '' : 'required' }}>
            </div>
            <div>
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-form"
                    {{ isset($user) ? '' : 'required' }}>
            </div>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="flex justify-end mt-6 gap-4">
    <a href="{{ route('dashboard.users.index') }}" class="btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        <span>{{ $submitButtonText ?? 'Simpan' }}</span>
    </button>
</div>
