<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;

class ProjectDetailController extends Controller
{
    
    public function show($id)
    {
        $project = ProjectMahasiswa::findOrFail($id);

        return view('project-details', compact('project'));
    }
}
