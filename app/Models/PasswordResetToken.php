<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'email', 'token', 'created_at'
    ];

    // Menentukan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    // Metode untuk menghasilkan token reset password
    public static function generateToken($email)
    {
        $token = sha1($email . time()); // Generate token unik
        return $token;
    }
}
