<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectMahasiswaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $projects = ProjectMahasiswa::where('user_id', $userId)->get();
        return view('pages.tables.project-mhs', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required',
            'semester' => 'required',
            'angkatan' => 'required',
            'golongan' => 'required',
            'ketua_kelompok' => 'required',
            'link_github' => 'required',
            'video_aplikasi' => 'required|mimes:mp4,jpeg,png,jpg|max:102400', // maksimal 100MB
            'gambar_1' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gambar_2' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gambar_3' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gambar_4' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $userId = Auth::id();
        $project = new ProjectMahasiswa();
        $project->user_id = $userId; // Menyimpan ID pengguna yang login
        $project->nama_aplikasi = $request->nama_aplikasi;
        $project->semester = $request->semester;
        $project->angkatan = $request->angkatan;
        $project->golongan = $request->golongan;
        $project->ketua_kelompok = $request->ketua_kelompok;
        $project->link_github = $request->link_github;

        // Upload video aplikasi
        $videoPath = $request->file('video_aplikasi')->store('videos/project_video', 'public');
        $project->video_aplikasi = $videoPath;

        // Upload gambar-gambar
        $gambarPaths = [];
        foreach (['gambar_1', 'gambar_2', 'gambar_3', 'gambar_4'] as $field) {
            if ($request->hasFile($field)) {
                $gambarPath = $request->file($field)->store('images/project_picture', 'public');
                $gambarPaths[$field] = $gambarPath;
            }
        }

        $project->gambar_1 = $gambarPaths['gambar_1'] ?? null;
        $project->gambar_2 = $gambarPaths['gambar_2'] ?? null;
        $project->gambar_3 = $gambarPaths['gambar_3'] ?? null;
        $project->gambar_4 = $gambarPaths['gambar_4'] ?? null;

        $project->save();

        return redirect()->route('project-mhs')->with('success', 'Data project berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $project = ProjectMahasiswa::find($id);
    
        if (!$project) {
            return redirect()->route('project-mhs')->with('error', 'Proyek tidak ditemukan.');
        }
    
        // Periksa izin pengguna untuk mengedit proyek
        if ($project->user_id !== Auth::id()) {
            return redirect()->route('project-mhs')->with('error', 'Anda tidak memiliki izin untuk mengedit proyek ini.');
        }
    
        // Lanjutkan untuk menampilkan modal edit dengan informasi proyek
        return view('pages.tables.project-mhs', compact('project'));
    }
    



    public function update(Request $request, $id)
    {
        $project = ProjectMahasiswa::find($id);

        // Periksa apakah proyek ditemukan dan apakah pengguna yang sedang login adalah pemilik proyek
        if (!$project || $project->user_id !== Auth::id()) {
            return redirect()->route('project-mhs')->with('error', 'Proyek tidak ditemukan atau Anda tidak memiliki izin untuk mengedit proyek ini.');
        }

        $request->validate([
            // Anda dapat menyesuaikan aturan validasi sesuai dengan bagian-bagian yang dapat diedit
            'nama_aplikasi' => 'sometimes|required',
            'semester' => 'sometimes|required',
            'angkatan' => 'sometimes|required',
            'golongan' => 'sometimes|required',
            'ketua_kelompok' => 'sometimes|required',
            'link_github' => 'sometimes|required',
            'video_aplikasi' => 'sometimes|mimes:mp4,jpeg,png,jpg|max:102400', // maksimal 100MB
            'gambar_1' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_2' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_3' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_4' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data proyek
        // Simpan perubahan yang diterapkan pada proyek
        foreach (['nama_aplikasi', 'semester', 'angkatan', 'golongan', 'ketua_kelompok', 'link_github'] as $field) {
            $project->{$field} = $request->{$field};
        }

        // Upload ulang video aplikasi jika ada yang diunggah
        if ($request->hasFile('video_aplikasi')) {
            // Hapus file lama jika ada
            if ($project->video_aplikasi) {
                Storage::disk('public')->delete($project->video_aplikasi);
            }
            // Upload file baru
            $videoPath = $request->file('video_aplikasi')->store('videos/project_video', 'public');
            $project->video_aplikasi = $videoPath;
        }

        // Upload ulang gambar-gambar jika ada yang diunggah
        foreach (['gambar_1', 'gambar_2', 'gambar_3', 'gambar_4'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($project->{$field}) {
                    Storage::disk('public')->delete($project->{$field});
                }
                // Upload file baru
                $gambarPath = $request->file($field)->store('images/project_picture', 'public');
                $project->{$field} = $gambarPath;
            }
        }

        // Simpan perubahan pada proyek
        $project->save();

        return redirect()->route('project-mhs')->with('success', 'Proyek berhasil diperbarui.');
    }


}
