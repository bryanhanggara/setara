<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->latest()->paginate(9);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if ($news->status !== 'published') {
            abort(404);
        }
        
        $latestNews = News::published()->where('id', '!=', $news->id)->latest()->take(3)->get();
        
        return view('news.show', compact('news', 'latestNews'));
    }
} 