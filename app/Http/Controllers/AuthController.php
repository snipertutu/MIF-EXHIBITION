<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProjectMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    protected function getStatistics() {
        $totalProjects = ProjectMahasiswa::count();
        $totalProjectsThisYear = ProjectMahasiswa::whereYear('created_at', now()->year)->count();
        $totalUsers = User::count();

        return compact('totalProjects', 'totalProjectsThisYear', 'totalUsers');
    }

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
            $statistics = $this->getStatistics();
            return redirect()->intended('/adm')->with(['user' => $user, 'statistics' => $statistics]);
        } elseif ($user->role === 'mahasiswa') {
            return redirect()->intended('/mhs')->with('user', $user);
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
        // Temukan pengguna berdasarkan NIM
        $user = User::where('nim', $request->nim)->first();
    
        // Jika pengguna dengan NIM tersebut sudah ada
        if ($user) {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Jika validasi berhasil, gunakan akun yang sudah ada dengan NIM tersebut
            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Melakukan login setelah registrasi
            Auth::login($user);
    
            return redirect('/mhs');
        } else {
            // Jika pengguna dengan NIM tersebut belum ada
            return redirect()->back()->withErrors(['nim' => 'NIM tidak terdaftar. Mohon periksa kembali.'])->withInput();
        }
    }
    

    public function updateProfile(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'email' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'akun_github' => 'nullable|string|max:200',
            'akun_linkedin' => 'nullable|string|max:200',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Sesuaikan dengan aturan validasi yang diperlukan
        ], [
            'profile_picture.max' => 'Gambar profil tidak boleh lebih besar dari 2 megabita.',
        ]);
    
        // Ambil user yang sedang login
        $user = Auth::user();
    
        // Update data pada user
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->akun_github= $request->akun_github;
        $user->akun_linkedin= $request->akun_linkedin;
        $user->address = $request->address;
    
        // Cek apakah ada file foto yang dikirimkan
        if ($request->hasFile('profile_picture')) {
            // Cek ukuran file gambar
            $fileSize = $request->file('profile_picture')->getSize(); // Dapatkan ukuran file dalam byte
            $maxFileSize = 2048 * 1024; // 2048 KB, konversi ke byte
    
            // Jika ukuran file melebihi batas maksimum
            if ($fileSize > $maxFileSize) {
                return redirect()->back()->withErrors(['error' => 'Ukuran file gambar terlalu besar.'])->withInput();
            }
    
            // Hapus gambar profil lama jika ada
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
    
            // Simpan foto baru
            $imagePath = $request->file('profile_picture')->store('images/profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }
    
        // Simpan perubahan pada user
        $user->save();
    
        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }  

}
