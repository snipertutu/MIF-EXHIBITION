<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarouselImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminCarouselController extends Controller
{
    public function index()
    {
        $banners = CarouselImage::all();
        return view('homepage', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048', // maksimum 2MB
        ]);

        $imagePath = $request->file('image_url')->store('images/carousel_images', 'public');

        CarouselImage::create([
            'title' => $request->title,
            'image_url' => $imagePath,
        ]);

        Session::flash('success', 'Banner berhasil ditambahkan.');
        return redirect()->route('homepage.index');
    }

    public function destroy($id)
    {
        $banner = CarouselImage::findOrFail($id);
        Storage::disk('public')->delete($banner->image_url);
        $banner->delete();

        Session::flash('success', 'Banner berhasil dihapus.');
        return redirect()->route('homepage.index');
    }
}
