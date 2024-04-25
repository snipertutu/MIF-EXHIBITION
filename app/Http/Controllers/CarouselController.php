<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarouselImage;

class CarouselController extends Controller
{
    public function index()
    {
        $banners = CarouselImage::all();
        return view('index', compact('banners'));
    }
}