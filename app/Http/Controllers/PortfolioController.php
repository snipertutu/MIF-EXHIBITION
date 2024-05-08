<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Pagination\Paginator; // Impor Paginator

class PortfolioController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap(); // Menggunakan Bootstrap pagination style

        $projects = Project::paginate(9); // Menampilkan 9 proyek per halaman
        return view('portfolio.index', compact('projects'));
    }
}
