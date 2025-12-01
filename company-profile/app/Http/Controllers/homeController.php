<?php

namespace App\Http\Controllers;

use App\Models\LayananList;
use App\Models\Slider;
use App\Models\HomeContent;
use App\Models\Product;
use App\Models\Marketplace;
use App\Models\Profil;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $layanan = LayananList::all();
        $content = HomeContent::first();
        $products = Product::all();           // ← perbaikan
        $marketplaces = Marketplace::all();   // ← perbaikan
        $profil = Profil::first();            // ← perbaikan
        $contact = Contact::first();          // ← perbaikan

        return view('visit.home', compact(
            'content', 
            'sliders', 
            'products',        // ← harus jamak
            'marketplaces', 
            'profil', 
            'contact'
        ));
    }
}
