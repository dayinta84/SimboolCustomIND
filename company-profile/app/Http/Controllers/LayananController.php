<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index($role)
    {
        $layanans = Layanan::all();
        return view('dashboardadmin.profil.layanan_index', compact('layanans'));
    }

    public function store(Request $request, $role)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Layanan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $role, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($role, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus!');
    }
}
