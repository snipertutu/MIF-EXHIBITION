<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20'],
            'angkatan' => ['required', 'numeric'], // Ubah sesuai kebutuhan Anda
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Tambahkan validasi email
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Validasi email
        $email = isset($data['email']) ? $data['email'] : null;

        return User::create([
            'name' => $data['name'],
            'nim' => $data['nim'],
            'angkatan' => $data['angkatan'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mahasiswa', // Set default value for role column
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Redirect user after successful registration
        return redirect($this->redirectPath());
    }

    protected function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/pages/auth/login';
    }
}
