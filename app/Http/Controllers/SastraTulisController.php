<?php

namespace App\Http\Controllers;

use App\Models\SastraTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SastraTulisController extends Controller
{
    public function index()
    {
        $data = SastraTulis::latest()->paginate(10);
        return view('admin.sastra-tulis.index', compact('data'));
    }

    public function create()
    {
        return view('admin.sastra-tulis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|in:CERPEN,PUISI,KARYA PEGAWAI',
            'body'      => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sastra-tulis', 'public');
        }

        $validated['status'] = 'PUBLISHED';
        $validated['views'] = 0;
        SastraTulis::create($validated);

        return redirect()->route('sastra.index')->with('success', 'Sastra Tulis berhasil ditambahkan.');
    }

    public function edit(SastraTulis $sastraTuli)
    {
        return view('admin.sastra-tulis.edit', compact('sastraTuli'));
    }

    public function update(Request $request, SastraTulis $sastraTuli)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'category'  => 'required|in:CERPEN,PUISI,KARYA PEGAWAI',
            'body'      => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($sastraTuli->image && Storage::disk('public')->exists($sastraTuli->image)) {
                Storage::disk('public')->delete($sastraTuli->image);
            }
            $validated['image'] = $request->file('image')->store('sastra-tulis', 'public');
        }

        $sastraTuli->update($validated);

        return redirect()->route('sastra.index')->with('success', 'Sastra Tulis berhasil diperbarui.');
    }

    public function destroy(SastraTulis $sastraTuli)
    {
        if ($sastraTuli->image && Storage::disk('public')->exists($sastraTuli->image)) {
            Storage::disk('public')->delete($sastraTuli->image);
        }
        $sastraTuli->delete();

        return redirect()->route('sastra.index')->with('success', 'Sastra Tulis berhasil dihapus.');
    }

    public function approve(SastraTulis $sastraTuli)
    {
        $sastraTuli->update(['status' => 'PUBLISHED']);
        return redirect()->route('sastra.index')->with('success', 'Karya berhasil dipublish.');
    }
}
