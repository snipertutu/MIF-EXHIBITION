<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\User;

class ProjectDetailController extends Controller
{
    
    public function show($id)
    {
        $project = ProjectMahasiswa::findOrFail($id);
        $userPhoneNumber = $project->user->phone_number;
        $userEmail = $project->user->email;

        return view('project-details', compact('project', 'userPhoneNumber', 'userEmail'));
    }
}
