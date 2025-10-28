<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketplaceController extends Controller
{
    public function index()
    {
        $marketplaces = Marketplace::all(); // ambil semua data
        return view('visit.marketplace', compact('marketplaces'));
    }
    // ✅ Halaman untuk admin & superadmin
    public function editPage()
    {
        $marketplaces = Marketplace::all();
        return view('dashboardadmin.marketplace.edit', compact('marketplaces'));
    }

    // ✅ Simpan marketplace baru
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'username' => 'nullable|string',
            'followers' => 'nullable|string',
            'link' => 'nullable|url',
            'icon' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'platform', 'username', 'followers', 'link'
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        Marketplace::create($data);

        return back()->with('success', 'Marketplace berhasil ditambahkan!');
    }

     /**
     * ✅ Menampilkan form edit untuk marketplace tertentu
     */
    public function edit($role, $id)
    {
        $marketplace = Marketplace::findOrFail($id);
        return view('dashboardadmin.marketplace.edit_single', compact('marketplace'));
    }

    /**
     * ✅ Update data marketplace tertentu
     */
    public function update(Request $request, $role, $id)
    {
        $marketplace = Marketplace::findOrFail($id);

        $request->validate([
            'platform' => 'required|string',
            'username' => 'nullable|string',
            'followers' => 'nullable|string',
            'link' => 'nullable|url',
            'icon' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['platform', 'username', 'followers', 'link']);

        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($marketplace->icon && Storage::disk('public')->exists($marketplace->icon)) {
                Storage::disk('public')->delete($marketplace->icon);
            }
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $marketplace->update($data);

        return redirect()->route('admin.marketplace.edit', ['role' => $role])
                         ->with('success', 'Marketplace berhasil diperbarui!');
    }

    // ✅ Hapus marketplace
    public function destroy($role, $id)
    {
        $marketplace = Marketplace::findOrFail($id);

        if ($marketplace->icon && \Storage::disk('public')->exists($marketplace->icon)) {
            \Storage::disk('public')->delete($marketplace->icon);
        }

        $marketplace->delete();

        return back()->with('success', 'Marketplace berhasil dihapus!');
    }
}
