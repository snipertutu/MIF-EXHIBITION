<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'nim' => ['required', 'string', 'max:255'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Redirect ke halaman sesuai dengan peran (role) pengguna
        if ($user->role === 'admin') {
            return redirect()->intended('/adm');
        } elseif ($user->role === 'mahasiswa') {
            return redirect()->intended('/mhs');
        }
    }

    return back()->withErrors(['nim' => 'Invalid credentials']);
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegistrationForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
{
    $validator = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'nim' => ['required', 'string', 'max:20'],
        'angkatan' => ['required', 'numeric'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'name' => $validator['name'],
        'nim' => $validator['nim'],
        'angkatan' => $validator['angkatan'],
        'email' => $validator['email'],
        'password' => Hash::make($validator['password']),
        'role' => 'mahasiswa',
    ]);

    Auth::login($user);

    return redirect('/mhs');
}

}
