<?php

namespace App\Http\Controllers;

use App\Models\SastraTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserSastraSubmissionController extends Controller
{
    public function create()
    {
        return view('pages.pojok-cerita.submit');
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

        $validated['status'] = 'PENDING';
        $validated['views'] = 0;
        $validated['user_id'] = Auth::id();
        $validated['penulis'] = Auth::user()->name;

        SastraTulis::create($validated);

        return redirect()->route('pojok-cerita.index')->with('success', 'Karya Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    public function myWorks()
    {
        $myWorks = SastraTulis::where('user_id', Auth::id())
                              ->latest()
                              ->paginate(10);
        
        return view('pages.pojok-cerita.my-works', compact('myWorks'));
    }

    public function editMyWork(SastraTulis $sastraTuli)
    {
        // Check if user owns this work
        if ($sastraTuli->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.pojok-cerita.edit-my-work', compact('sastraTuli'));
    }

    public function updateMyWork(Request $request, SastraTulis $sastraTuli)
    {
        // Check if user owns this work
        if ($sastraTuli->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

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

        // Reset status to PENDING when user edits their work
        $validated['status'] = 'PENDING';
        $validated['penulis'] = Auth::user()->name;

        $sastraTuli->update($validated);

        return redirect()->route('pojok-cerita.my-works')->with('success', 'Karya Anda berhasil diperbarui dan sedang menunggu persetujuan admin.');
    }

    public function deleteMyWork(SastraTulis $sastraTuli)
    {
        // Check if user owns this work
        if ($sastraTuli->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($sastraTuli->image && Storage::disk('public')->exists($sastraTuli->image)) {
            Storage::disk('public')->delete($sastraTuli->image);
        }

        $sastraTuli->delete();

        return redirect()->route('pojok-cerita.my-works')->with('success', 'Karya Anda berhasil dihapus.');
    }
} 