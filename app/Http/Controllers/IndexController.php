<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\CarouselImage;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $projects = ProjectMahasiswa::query();

        // Tangkap nilai pencarian dari permintaan HTTP
        $tahun = $request->tahun;
        $kategori = $request->kategori;

        // Tambahkan kondisi pencarian berdasarkan tahun jika ada
        if ($tahun) {
            $projects->where('angkatan', $tahun);
        }

        // Tambahkan kondisi pencarian berdasarkan kategori jika ada
        if ($kategori) {
            $projects->where('kategori', $kategori);
        }

        // Dapatkan hasil pencarian proyek
        $projects = $projects->get();

        // Dapatkan data banner
        $banners = CarouselImage::all();

        // Jika permintaan adalah AJAX, kembalikan tampilan parsial
        if ($request->ajax()) {
            return view('partials.project-list', compact('projects'));
        }

        // Jika bukan permintaan AJAX, kembalikan tampilan penuh
        return view('index', compact('projects', 'banners'));
    }

}
