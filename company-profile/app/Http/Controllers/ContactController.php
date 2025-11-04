<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
     public function frontendIndex()
    {
        $contact = Contact::first();
         if ($contact && !empty($contact->map)) {
        $contact->map = $this->generateMapEmbed($contact->map);
    }
        return view('visit.contact', compact('contact'));
    }

    private function generateMapEmbed($url)
{
    // Jika link berasal dari google.com/maps atau maps.app.goo.gl
    if (str_contains($url, 'google.com/maps') || str_contains($url, 'maps.app.goo.gl')) {
        // Ambil bagian koordinat atau alamat dari URL
        $encodedUrl = urlencode($url);

        return '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d65389.75669183935!2d111.52666663007666!3d-7.630002101876529!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79bd753f5cadd3%3A0xd41bd2bae580b564!2sSimbool%20Custom%20Industries!5e0!3m2!1sid!2sid!4v1761543297440!5m2!1sid!2sid" 
         width="800" 
        height="600" 
       style="border:0;" 
         allowfullscreen="" 
       loading="lazy" 
         referrerpolicy="no-referrer-when-downgrade">
        </iframe>';
    }

    // Jika bukan link Google Maps, tampilkan link teks biasa
    return '<p><a href="' . e($url) . '" target="_blank">Lihat di Google Maps</a></p>';
}


    // ✅ Halaman edit
    public function editPage()
    {
        $contact = Contact::first(); // ambil data pertama
        return view('dashboardadmin.contact.edit', compact('contact'));
    }

    // ✅ Simpan perubahan
    public function updatePage(Request $request)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
        'whatsapp' => 'array',
        'whatsapp.*' => 'nullable|string|max:13',
        'map' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    // Ambil data pertama, atau buat baru jika belum ada
    $contact = Contact::first() ?? new Contact();

    $contact->alamat = $request->alamat;
    $contact->whatsapp = array_filter($request->whatsapp ?? []); // hapus nilai kosong
    $contact->map = $request->map;

    // Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('contacts_images', 'public');
        $contact->gambar = $path;
    }

    $contact->save();
    

    return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
}
}