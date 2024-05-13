<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\User;
use App\Models\ProjectDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectMahasiswaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // Mendapatkan ID proyek yang ditambahkan pengguna sebagai anggota
        $projectIds = ProjectDetail::where('anggota', $userId)->pluck('project_mahasiswa_id');
        
        // Memuat proyek yang ditambahkan pengguna sebagai anggota atau proyek yang ditambahkan oleh pengguna itu sendiri
        $projects = ProjectMahasiswa::with('Detail.users')
                        ->where('user_id', $userId)
                        ->orWhereIn('id', $projectIds)
                        ->get();
        return view('pages.tables.project-mhs', compact('projects'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_aplikasi' => 'required|string',
            'semester' => 'required|string',
            // 'angkatan' => 'required|string',
            'golongan' => 'required|string',
            'kategori' => 'required|string',
            'link_github' => 'nullable|string',
            'link_website' => 'nullable|string',
            'link_youtube' => 'required|string',
            'narasi' => 'nullable|string',
            'gambar_1' => 'image|mimes:jpeg,png,jpg|max:5048',
            'gambar_2' => 'image|mimes:jpeg,png,jpg|max:5048',
            'gambar_3' => 'image|mimes:jpeg,png,jpg|max:5048',
            'gambar_4' => 'image|mimes:jpeg,png,jpg|max:5048',
            'anggota' => 'nullable|array', // Menambahkan validasi untuk anggota
        ]);

        // Lakukan operasi penyimpanan data jika validasi berhasil
        $userId = Auth::id();
        $userNim = Auth::user()->nim;
        $userAngkatan = Auth::user()->angkatan;
        $project = new ProjectMahasiswa();
        $project->user_id = $userId;
        $project->nama_aplikasi = $request->nama_aplikasi;
        $project->semester = $request->semester;
        $project->kategori = $request->kategori;
        // $project->angkatan = $request->angkatan;
        $project->golongan = $request->golongan;
        
        // Cek kategori, jika "Tugas Akhir", abaikan nilai "ketua_kelompok"
        if ($request->kategori != 'Tugas Akhir') {
            $project->ketua_kelompok = $userNim;
            
        }
        $project->angkatan= $userAngkatan;
        $project->link_github = $request->link_github;
        $project->link_website = $request->link_website;
        $project->link_youtube = $request->link_youtube;
        $project->narasi = $request->narasi;

        // Upload gambar-gambar jika ada
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

        // Simpan proyek
        if ($project->save()) {
            if ($request->has('anggota')) {
                foreach ($request->anggota as $anggota) {
                    // Periksa apakah anggota telah terdaftar dalam proyek lain dengan semester yang sama
                    $existingProjects = ProjectDetail::where('anggota', $anggota)
                        ->whereHas('projectMahasiswa', function ($query) use ($project) {
                            $query->where('semester', $project->semester);
                        })
                        ->exists();
            
                    // Jika anggota telah terdaftar dalam proyek dengan semester yang sama, abaikan anggota tersebut
                    if ($existingProjects) {
                        continue;
                    }
            
                    // Tambahkan anggota ke proyek saat ini
                    ProjectDetail::create([
                        'project_mahasiswa_id' => $project->id,
                        'anggota' => $anggota
                    ]);
                }
            }            
    
            return redirect()->route('project-mhs')->with('success', 'Data proyek berhasil ditambahkan.');
        } else {
            // Penanganan kesalahan jika penyimpanan proyek gagal
            return redirect()->back()->with('error', 'Gagal menyimpan data proyek. Silakan coba lagi.');
        }
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('q'); // Mendapatkan kata kunci pencarian dari permintaan

        // Lakukan pencarian berdasarkan NIM atau nama untuk pengguna dengan peran mahasiswa
        $users = User::where(function ($query) use ($searchTerm) {
                    $query->where('nim', 'like', "%{$searchTerm}%")
                        ->orWhere('name', 'like', "%{$searchTerm}%");
                })
                ->where('role', 'mahasiswa') // Filter berdasarkan peran 'mahasiswa'
                ->get();

        // Format hasil pencarian menjadi format yang diharapkan oleh Select2
        $formattedUsers = [];
        foreach ($users as $user) {
            $formattedUsers[] = ['id' => $user->id, 'text' => $user->nim . ' - ' . $user->name];
        }

        return response()->json($formattedUsers);
    }

    public function getMembers($projectId)
    {
        // Dapatkan anggota dari proyek tertentu yang memiliki peran mahasiswa
        $members = ProjectDetail::where('project_mahasiswa_id', $projectId)
        ->with('users') // Menggunakan 'users' karena itulah nama relasinya
        ->whereHas('users', function ($query) {
            $query->where('role', 'mahasiswa');
        })
        ->get()
        ->map(function ($detail) {
            return [
                'id' => $detail->users->id, // Menggunakan 'users' untuk mendapatkan data anggota
                'name' => $detail->users->name, // Menggunakan 'users' untuk mendapatkan data anggota
            ];
        });


        // Kirim data anggota sebagai respons JSON
        return response()->json(['data' => $members]);
    }
    

    public function edit($id)
    {
        $project = ProjectMahasiswa::find($id);
        
        if (!$project) {
            return redirect()->route('project-mhs')->with('error', 'Proyek tidak ditemukan.');
        }

        // Periksa izin pengguna untuk mengedit proyek
        if ($project->user_id !== Auth::id() && !ProjectDetail::where('project_mahasiswa_id', $id)->where('anggota', Auth::id())->exists()) {
            return redirect()->route('project-mhs')->with('error', 'Anda tidak memiliki izin untuk mengedit proyek ini.');
        }

        // Lanjutkan untuk menampilkan modal edit dengan informasi proyek
        return view('pages.tables.project-mhs', compact('project')); // Perbaikan: Kirim data proyek ke view
    }

    public function update(Request $request, $id)
    {
        $project = ProjectMahasiswa::find($id);

        // Periksa apakah pengguna yang sedang melakukan permintaan adalah pemilik proyek atau anggota proyek
        if (!$project || ($project->user_id !== Auth::id() && !ProjectDetail::where('project_mahasiswa_id', $id)->where('anggota', Auth::id())->exists())) {
            return redirect()->route('project-mhs')->with('error', 'Proyek tidak ditemukan atau Anda tidak memiliki izin untuk mengedit proyek ini.');
        }

        $request->validate([
            'nama_aplikasi' => 'required|string',
            'golongan' => 'required|string',
            'link_github' => 'required|string',
            'link_website' => 'required|string',
            'link_youtube' => 'required|string',
            'narasi' => 'required|string',
            'gambar_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data proyek
        $project->nama_aplikasi = $request->nama_aplikasi;
        $project->golongan = $request->golongan;
        $project->link_github = $request->link_github;
        $project->link_website = $request->link_website;
        $project->link_youtube = $request->link_youtube;
        $project->narasi = $request->narasi;

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
        
        // Update project details (members)
        if ($request->has('anggota')) {
            // Dapatkan anggota yang sudah ada
            $existingMembers = $project->detail->pluck('anggota')->toArray();

            // Loop melalui anggota yang ingin ditambahkan
            foreach ($request->anggota as $member) {
                // Periksa apakah anggota telah terdaftar dalam proyek lain dengan semester yang sama
                $existingProjects = ProjectDetail::where('anggota', $member)
                    ->whereHas('projectMahasiswa', function ($query) use ($project) {
                        $query->where('semester', $project->semester);
                    })
                    ->exists();
        
                // Jika anggota telah terdaftar dalam proyek dengan semester yang sama, abaikan anggota tersebut
                if ($existingProjects) {
                    continue;
                }

                // Jika anggota belum ada dalam daftar anggota yang sudah ada, tambahkan anggota baru
                if (!in_array($member, $existingMembers)) {
                    $projectDetail = new ProjectDetail();
                    $projectDetail->project_mahasiswa_id = $project->id;
                    $projectDetail->anggota = $member;
                    $projectDetail->save();
                }
            }
        }

        return redirect()->route('project-mhs')->with('success', 'Proyek berhasil diperbarui.');
    }

}
