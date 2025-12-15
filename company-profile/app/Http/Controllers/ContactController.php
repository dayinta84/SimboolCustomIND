<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    // =========================
    // FRONTEND (VISITOR)
    // =========================
    public function frontendIndex()
    {
        $contact = Contact::first(); // ambil data pertama
        return view('visit.contact', compact('contact'));
    }

    // =========================
    // ADMIN - EDIT PAGE
    // =========================
    public function editPage()
    {
        $contact = Contact::first();
        return view('dashboardadmin.contact.edit', compact('contact'));
    }

    // =========================
    // ADMIN - UPDATE PAGE
    // =========================
    public function updatePage(Request $request)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
        'whatsapp' => 'nullable|array',
        'whatsapp.*' => 'nullable|string|max:13',
        'map' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    $contact = Contact::first() ?? new Contact();

    $contact->alamat = $request->alamat;
    $contact->whatsapp = array_values(array_filter($request->whatsapp ?? []));

    $mapInput = trim((string) $request->map);
    if ($mapInput !== '') {
        if (str_contains($mapInput, 'maps.app.goo.gl') || str_contains($mapInput, 'goo.gl')) {
            $mapInput = $this->resolveFinalUrl($mapInput);
        }

        if ($this->looksLikeCoords($mapInput)) {
            $contact->map = $mapInput;
        } else {
            $coords = $this->extractCoordsFromGoogleUrl($mapInput);
            $contact->map = $coords ?: $mapInput;
        }
    } else {
        $contact->map = null;
    }

    if ($request->hasFile('gambar')) {
        if (!empty($contact->gambar) && Storage::disk('public')->exists($contact->gambar)) {
            Storage::disk('public')->delete($contact->gambar);
        }

        $path = $request->file('gambar')->store('contacts_images', 'public');
        $contact->gambar = $path;
    }

    $contact->save();

    return redirect()->back()->with('success', 'Kontak berhasil diperbarui!');
    }

    private function resolveFinalUrl(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
            // penting: JANGAN NOBODY (biar GET beneran)
            CURLOPT_NOBODY => false,
            CURLOPT_HEADER => false,
        ]);

        curl_exec($ch);
        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        return $finalUrl ?: $url;
    }
    private function looksLikeCoords(string $text): bool
    {
        return (bool) preg_match('/^\s*-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?\s*$/', $text);
    }

    private function extractCoordsFromGoogleUrl(string $url): ?string
    {
        // 1) Embed pattern sering paling dekat ke lokasi place
        if (preg_match('/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/', $url, $m)) {
            return $m[1] . ',' . $m[2];
        }

        // 2) q=lat,lng lumayan jelas kalau memang koordinat
        if (preg_match('/[?&]q=(-?\d+\.\d+),\s*(-?\d+\.\d+)/', $url, $m)) {
            return $m[1] . ',' . $m[2];
        }

        // 3) @lat,lng paling terakhir karena sering cuma posisi kamera
        if (preg_match('/@(-?\d+\.\d+),\s*(-?\d+\.\d+)/', $url, $m)) {
            return $m[1] . ',' . $m[2];
        }

        return null;
    }
}