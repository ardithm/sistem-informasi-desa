<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'username.required' => 'Username akun wajib diisi.',
            'name.required' => 'Nama lengkap terdaftar wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::where('username', trim($request->username))->first();

        if (!$user) {
            return back()
                ->withInput($request->only('username', 'name'))
                ->withErrors(['username' => 'Akun dengan username tersebut tidak ditemukan dalam sistem.']);
        }

        // Verifikasi nama lengkap pemegang akun (case-insensitive & trimmed)
        if (strcasecmp(trim($user->name), trim($request->name)) !== 0) {
            return back()
                ->withInput($request->only('username', 'name'))
                ->withErrors(['name' => 'Nama lengkap tidak cocok dengan data akun ini. Jika lupa, silakan hubungi Super Administrator.']);
        }

        if (!$user->is_active) {
            return back()
                ->withInput($request->only('username', 'name'))
                ->withErrors(['username' => 'Akun ini sedang dinonaktifkan. Silakan hubungi Super Administrator untuk mengaktifkan kembali akun Anda.']);
        }

        // Perbarui kata sandi langsung
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return redirect()->route('login')->with('status', 'Kata sandi untuk akun ' . $user->username . ' berhasil diperbarui! Silakan masuk dengan kata sandi baru Anda.');
    }
}
