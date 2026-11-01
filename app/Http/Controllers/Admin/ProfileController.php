<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(UpdateProfileRequest $request)
    {
        // Ambil data yang sudah tervalidasi dan update
        $request->user()->update($request->validated());

        return redirect()->route('dashboard.profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }

    /**
     * Memperbarui password pengguna.
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard.profile.edit')->with('status', 'Password berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        // Validasi bahwa password yang dimasukkan benar
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout pengguna sebelum menghapus akun
        Auth::logout();

        $user->delete();

        // Hapus sesi dan regenerasi token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman utama dengan pesan sukses
        return redirect('/')->with('status', 'Akun Anda telah berhasil dihapus.');
    }
}
