<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use App\Models\ProfilSection;

class ProfilController extends Controller
{
    // Tampilkan halaman profil untuk pengunjung
    public function index()
    {
        $profil = Profil::first();
        return view('visit.profile', compact('profil'));
    }

    // (opsional) jika ada halaman detail profil
    public function show($id)
    {
        $profil = Profil::findOrFail($id);
        return view('visit.profile-detail', compact('profil'));
    }
}
