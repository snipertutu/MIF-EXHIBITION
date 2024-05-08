<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nama_aplikasi', 'angkatan', 'semester', 'golongan', 'video_aplikasi', 'gambar_1'
        // tambahkan atribut lain yang sesuai dengan kebutuhan
    ];
}
