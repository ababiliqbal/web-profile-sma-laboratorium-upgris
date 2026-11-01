<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-users');

        $query = User::with('roles');

        // Tambahkan filter pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Jangan tampilkan user yang sedang login agar tidak bisa mengedit diri sendiri
        $users = $query->where('id', '!=', auth()->id())->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('manage-users');
        // Ambil semua role untuk ditampilkan di dropdown form
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('manage-users');

        $data = $request->validated();

        // Buat user baru dengan password yang sudah di-hash
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Berikan role yang dipilih
        $user->assignRole($data['role']);

        return redirect()->route('dashboard.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $this->authorize('manage-users');
        $roles = Role::all();
        // Eager load role yang dimiliki user saat ini
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('manage-users');

        $data = $request->validated();

        // Jika password diisi, update passwordnya. Jika tidak, biarkan password lama.
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Hapus key password dari array agar tidak meng-update password menjadi kosong
            unset($data['password']);
        }

        $user->update($data);

        // Sinkronisasi role. Ini akan menghapus role lama dan menerapkan yang baru.
        $user->syncRoles($data['role']);

        return redirect()->route('dashboard.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->authorize('manage-users');

        // Mencegah super admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
