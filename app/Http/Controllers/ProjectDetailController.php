<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\ProjectDetail;
use App\Models\User;

class ProjectDetailController extends Controller
{
    
    public function show($id)
    {
        // Mengambil detail proyek dengan ID yang diberikan
        $project = ProjectMahasiswa::with('detail.user')->findOrFail($id);

        // Mengirimkan data proyek ke tampilan
        return view('project-details', compact('project'));
    }
}
