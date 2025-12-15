<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ========================
    //  FRONTEND (visitor)
    // ========================
    public function frontendIndex(Request $request)
    {
        $query = Product::query();

        // Ambil kategori filter dari request
        $category = $request->get('category');

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        // Ambil produk sesuai filter
        $products = $query->latest()->get();

        // Ambil semua kategori unik untuk filter
        $categories = Product::whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('visit.products', compact('products', 'categories'));
    }

    // ========================
    //  SHOW SINGLE PRODUCT (frontend)
    // ========================
    public function show(Product $product)
    {
        return view('visit.show-product', compact('product'));
    }

    // ========================
    //  ADMIN CRUD
    // ========================
    public function index(Request $request, $role)
    {
        $query = Product::query();

        $category = $request->get('category');
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $products = $query->latest()->get();

        // Ambil kategori unik untuk dropdown / filter di admin
        $categories = Product::whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('dashboardadmin.produk.edit', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'category'    => $request->category,
            'image'       => $imagePath,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($role, Product $product)
    {
        $products = Product::latest()->get();
        return view('dashboardadmin.produk.edit', compact('product','products'));
    }

    public function update(Request $request, $role, Product $product)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10024',
        ]);

        if($request->hasFile('image')){
            if ($product->image) {
                Storage::delete('public/'.$product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'category'    => $request->category,
        ]);

        return redirect()->route('admin.products.index', ['role' => $role])
            ->with('success','Produk diperbarui');
    }

    public function destroy($role, Product $product)
    {
        if ($product->image) {
            Storage::delete('public/'.$product->image);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}
