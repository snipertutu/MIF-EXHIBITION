<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Mengambil informasi pengguna yang sedang login
        $user = Auth::user();

        // Mengirim data pengguna ke tampilan
        return view('pages.user-pages.profile-mhs', compact('user'));
    }
}
