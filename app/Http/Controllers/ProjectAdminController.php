<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\User;
use App\Models\ProjectDetail;
use Illuminate\Support\Facades\Auth;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = ProjectMahasiswa::paginate(10);
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

    public function searchMahasiswa(Request $request)
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

    public function getMembersProject($projectId)
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

    public function editProject($id)
    {
        $project = ProjectMahasiswa::find($id);
        
        if (!$project) {
            return redirect()->route('project.index')->with('error', 'Proyek tidak ditemukan.');
        }

        // Lanjutkan untuk menampilkan modal edit dengan informasi proyek
        return view('pages.tables.project', compact('project')); // Perbaikan: Kirim data proyek ke view
    }

    public function updateAnggotaProject(Request $request, $id)
    {
        $project = ProjectMahasiswa::find($id);
        
        // Update project details (members)
        if ($request->has('anggota')) {
            // Ambil anggota yang dipilih dari form
            $selectedMembers = $request->anggota;
    
            // Hapus anggota yang tidak dipilih dari database
            $project->detail()->whereNotIn('anggota', $selectedMembers)->delete();
    
            // Tambahkan anggota yang dipilih jika belum ada dalam database
            foreach ($selectedMembers as $member) {
                $existingMember = $project->detail()->where('anggota', $member)->first();
                if (!$existingMember) {
                    $project->detail()->create([
                        'anggota' => $member,
                    ]);
                }
            }
        }
    
        return redirect()->route('project.index')->with('success', 'Proyek berhasil diperbarui.');
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
