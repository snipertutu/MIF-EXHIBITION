<?php

namespace App\Http\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Illuminate\Validation\ValidationException;

trait AuthenticatesUsers
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'mahasiswa') {
                return redirect()->route('pages.tables.Project-mhs');
            }
        }

        // Jika autentikasi gagal, redirect kembali ke halaman login dengan pesan error
        throw ValidationException::withMessages([
            'nim' => [trans('auth.failed')],
        ]);
    }

    public function logout()
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('login');
    }
}
