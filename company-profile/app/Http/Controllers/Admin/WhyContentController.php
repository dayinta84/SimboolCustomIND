<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\WhyContent;
use Illuminate\Http\Request;

class WhyContentController extends Controller
{
    public function store($role, Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        WhyContent::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Why berhasil ditambahkan');
    }

    public function update(Request $request, $role, $id)
    {
        $why = WhyContent::findOrFail($id);
        // $role = Auth::user()->role;

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $why->update($request->all());

        return back()->with('success', 'Why berhasil diperbarui');
    }

    public function delete($role, $id)
    {
        WhyContent::findOrFail($id)->delete();

        return back()->with('success', 'Why berhasil dihapus');
    }

    public function edit($role, $id)
    {
        // $why = WhyContent::findOrFail($id);
        // return view('dashboardadmin.home_content.why_edit', compact('why', 'role'));
    }

}
