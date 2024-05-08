<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $table = 'project_details';

    protected $fillable = [
        'anggota',
        'project_mahasiswa_id',
    ];

    // Relasi ke tabel project_mahasiswa
    public function projectMahasiswa()
    {
        return $this->belongsTo(ProjectMahasiswa::class, 'project_mahasiswa_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'anggota');
    }

    
}
