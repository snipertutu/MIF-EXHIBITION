<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('pages.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Pastikan email ada di salah satu dari dua tabel
        $emailExists = User::where('email', $request->email)->exists() || 
                       PasswordResetToken::where('email', $request->email)->exists();

        if (!$emailExists) {
            return back()->withErrors(['email' => 'Invalid email or not found']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            // Hapus token reset password dari tabel password_reset_token
            PasswordResetToken::where('email', $request->email)->delete();

            return redirect()->route('login')->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
