<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Slider;
use App\Models\LayananList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONTEND HOME
    |--------------------------------------------------------------------------
    */
    public function publicHome()
    {
        $content  = HomeContent::first();
        $slides  = Slider::all();
        $layanan  = LayananList::all();

        return view('frontend.home.index', compact(
            'content',
            'slides',
            'layanan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN EDIT HOME (ADMIN)
    |--------------------------------------------------------------------------
    */
    public function edit()
    {
        $content  = HomeContent::first();
        $slides  = Slider::all();
        $layanan  = LayananList::all();
        $role = Auth::user()->role; // Mendapatkan segmen pertama dari URL sebagai role

        return view('dashboardadmin.home_content.edit', compact(
            'content',
            'slides',
            'layanan',
            'role'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE HOME CONTENT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request)
    {
        $request->validate([
            'title'        => 'nullable|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'why_1_title'  => 'nullable|string|max:255',
            'why_1_desc'   => 'nullable|string',
            'why_2_title'  => 'nullable|string|max:255',
            'why_2_desc'   => 'nullable|string',
            'why_3_title'  => 'nullable|string|max:255',
            'why_3_desc'   => 'nullable|string',
        ]);

        $data = $request->only([
            'title', 'subtitle',
            'why_1_title', 'why_1_desc',
            'why_2_title', 'why_2_desc',
            'why_3_title', 'why_3_desc',
        ]);

        $content = HomeContent::first();

        if (!$content) {
            HomeContent::create($data);
        } else {
            $content->update($data);
        }

        return back()->with('success', 'Konten home berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | SLIDER
    |--------------------------------------------------------------------------
    */
    public function addSlider(Request $request)
    {
        $request->validate([
            'image'    => 'required|image|max:2048',
            'title'    => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('slide', 'public');

        Slider::create([
            'image'    => $path,
            'title'    => $request->title,
            'subtitle' => $request->subtitle,
        ]);

        return back()->with('success', 'Slider berhasil ditambahkan.');
    }

    public function deleteSlider($role, $id) #ini yg menyebabkan hapus eror, tambahkan role jgn lupa   
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return back()->with('success', 'Slider berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | LAYANAN LIST (SAMA DENGAN ROUTE)
    |--------------------------------------------------------------------------
    */

    /** ADD LAYANAN */
    public function addLayananList(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
        ]);

        LayananList::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        return back()->with('success', 'Layanan berhasil ditambahkan');
    }

    /** UPDATE LAYANAN */
    public function updateLayananList(Request $request, $id)
    {
        $layanan = LayananList::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
        ]);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        return back()->with('success', 'Layanan berhasil diperbarui');
    }

    /** DELETE LAYANAN */
    public function deleteLayananList($id)
    {
        $layanan = LayananList::findOrFail($id);
        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus');
    }
}