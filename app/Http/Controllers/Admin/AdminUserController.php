<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Menampilkan daftar user admin.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $role = $request->get('role');

        $query = User::whereIn('role', ['admin', 'super_admin']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->orderByRaw("CASE WHEN role = 'super_admin' THEN 1 ELSE 2 END")
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $totalSuperAdmin = User::where('role', 'super_admin')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('admin.users.index', compact('users', 'search', 'role', 'totalSuperAdmin', 'totalAdmin'));
    }

    /**
     * Menampilkan form tambah user admin baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user admin baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:admin,super_admin'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
            'username.unique' => 'Username ini sudah digunakan oleh akun lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'role.required' => 'Role user wajib dipilih.',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => strtolower($validated['username']),
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User admin baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit user admin biasa.
     */
    public function edit(User $user)
    {
        // Proteksi: Hanya user admin biasa yang dapat diedit
        if ($user->role !== 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Hanya akun Administrator biasa yang dapat diedit melalui fitur ini.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui data user admin biasa.
     */
    public function update(Request $request, User $user)
    {
        // Proteksi: Hanya user admin biasa yang dapat diedit
        if ($user->role !== 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Hanya akun Administrator biasa yang dapat diedit melalui fitur ini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'is_active' => ['nullable'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
            'username.unique' => 'Username ini sudah digunakan oleh akun lain.',
            'password.min' => 'Password baru minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        $userData = [
            'name' => $validated['name'],
            'username' => strtolower($validated['username']),
            'is_active' => $request->boolean('is_active', true),
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun admin '{$user->name}' berhasil diperbarui.");
    }

    /**
     * Mengubah status aktif user admin.
     */
    public function toggleActive(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        $statusTeks = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$statusTeks}.");
    }

    /**
     * Menghapus user admin dari sistem.
     */
    public function destroy(User $user)
    {
        // Proteksi 1: Tidak bisa menghapus akun sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        // Proteksi 2: Tidak bisa menghapus super admin terakhir
        if ($user->role === 'super_admin') {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'Tidak dapat menghapus Super Admin terakhir pada sistem.');
            }
        }

        // Proteksi 3: Jika user pernah menerbitkan surat resmi desa
        if ($user->suratDiterbitkan()->exists()) {
            return back()->with('error', "User '{$user->name}' telah memiliki arsip penerbitan surat resmi desa sehingga tidak dapat dihapus permanen. Anda dapat menonaktifkan status akunnya.");
        }

        $namaUser = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User admin '{$namaUser}' berhasil dihapus.");
    }
}
