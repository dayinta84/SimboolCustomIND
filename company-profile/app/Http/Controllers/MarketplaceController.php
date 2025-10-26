<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use Illuminate\Http\Request;

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
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'icon' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'platform', 'username', 'followers', 'description', 'link'
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        Marketplace::create($data);

        return back()->with('success', 'Marketplace berhasil ditambahkan!');
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
