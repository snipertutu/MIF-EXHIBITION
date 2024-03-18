<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMahasiswa;
use App\Models\CarouselImage;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        $projects = ProjectMahasiswa::all();
        $banners = CarouselImage::all();

        return view('index', compact('projects', 'banners' ));
    }


}
