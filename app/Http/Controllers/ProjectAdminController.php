<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = ProjectMahasiswa::all();
        return view('pages.tables.project', compact('projects'));
    }
    
    public function hidden($id)
    {
        // Temukan proyek berdasarkan ID
        $project = ProjectMahasiswa::findOrFail($id);

        // Periksa apakah status tersembunyi atau tidak, lalu ubah statusnya
        $project->hidden = !$project->hidden;
        $project->save();

        // Redirect kembali ke halaman index atau lakukan respons JSON sesuai kebutuhan
        return redirect()->route('project.index')->with('success', 'Visibility toggled successfully.');
    }

    public function delete($id)
{
    try {
        $project = ProjectMahasiswa::findOrFail($id);
        $project->delete();
        
        return response()->json(['message' => 'Proyek berhasil dihapus']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal menghapus proyek'], 500);
    }
}

}
