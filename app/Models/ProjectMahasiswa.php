<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMahasiswa extends Model
{
    protected $table = 'project_mahasiswa';
    
    protected $fillable = [
        'nama_aplikasi',
        'semester', 
        'angkatan', 
        'golongan', 
        'ketua_kelompok',
        'kategori',
        'anggota',
        'git',
        'link_github', 
        'link_Youtube', 
        'gambar_1',
        'gambar_2',
        'gambar_3',
        'gambar_4',
        'hidden',
        'user_id',
    ];
    // Tambahkan definisi relasi atau metode lainnya di sini jika diperlukan
    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
