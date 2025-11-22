<?php

namespace App\Http\Controllers;

use App\Models\LayananList;
use App\Models\Slider;
use App\Models\HomeContent;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $layanan = LayananList::all();
        $content = HomeContent::first(); // ← ini penting

        return view('visit.home', compact('sliders', 'layanan', 'content'));
    }
}
