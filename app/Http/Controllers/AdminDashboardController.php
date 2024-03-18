<?php

namespace App\Http\Controllers;

use App\Models\ProjectMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function home()
    {
        $projects = ProjectMahasiswa::all();
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        $totalProjects = ProjectMahasiswa::count();
        $totalProjectsThisYear = ProjectMahasiswa::whereYear('created_at', now()->year)->count();
        $totalUsers = User::count();

        return view('dashboard', compact('projects', 'mahasiswa', 'totalProjects', 'totalProjectsThisYear', 'totalUsers'));
    }
}
