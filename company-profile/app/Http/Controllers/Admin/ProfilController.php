<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profil;
use App\Models\ProfilSection;
use App\Models\Layanan;


class ProfilController extends Controller
{
    public function edit($role)
    {
        $profil = Profil::first();
        $layanans = Layanan::all();
        $sections = ProfilSection::all();

        return view('dashboardadmin.profil.edit', compact('profil', 'layanans', 'sections'));
    }

    public function update(Request $request, $role)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'tentang' => 'required|string',
            'visi'    => 'required|string',
            'misi'    => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profil = Profil::firstOrNew();

        $profil->fill($request->only(['title', 'tentang', 'visi', 'misi']));

        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($profil->image && Storage::disk('public')->exists($profil->image)) {
                Storage::disk('public')->delete($profil->image);
            }
            $path = $request->file('image')->store('profil', 'public');
            $profil->image = $path;
        }

        $profil->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }


    // Tambah layanan
    public function tambahLayanan(Request $request, $role)
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

    // Edit layanan
    public function editLayanan(Request $request, $role, $id)
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


    public function tambahSection(Request $request, $role)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        ProfilSection::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return back()->with('success', 'Section berhasil ditambahkan!');
    }

    public function editSection(Request $request, $role, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $section = ProfilSection::findOrFail($id);
        $section->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return back()->with('success', 'Section berhasil diperbarui!');
    }

    public function hapusSection($role, $id)
    {
        $section = ProfilSection::findOrFail($id);
        $section->delete();

        return back()->with('success', 'Section berhasil dihapus!');
    }
}
