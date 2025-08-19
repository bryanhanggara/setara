<?php

namespace App\Http\Controllers;

use App\Models\SastraTulis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil artikel terbaru sebagai main article
        $mainArticle = SastraTulis::latest()->first();

        // Ambil sisanya untuk small articles
        $smallArticles = SastraTulis::latest()->skip(1)->take(6)->get();

        return view('welcome', compact('mainArticle', 'smallArticles'));
    }

    public function tentang()
    {
        return view('pages.about');
    }
}
