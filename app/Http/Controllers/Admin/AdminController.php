<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SastraTulis;
use App\Models\News;
use App\Models\Newsletter;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Get basic statistics from database
        $totalUsers = User::count();
        $totalCerpen = SastraTulis::where('category', 'CERPEN')->count();
        $totalBerita = News::count();
        $totalPembaca = Newsletter::active()->count();
        
        // Additional statistics for better insights
        $totalSastra = SastraTulis::count();
        $publishedSastra = SastraTulis::where('status', 'PUBLISHED')->count();
        $pendingSastra = SastraTulis::where('status', 'PENDING')->count();
        $totalViews = SastraTulis::sum('views');
        
        // Recent activities (last 30 days)
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $newUsersThisMonth = User::where('created_at', '>=', $thirtyDaysAgo)->count();
        $newSastraThisMonth = SastraTulis::where('created_at', '>=', $thirtyDaysAgo)->count();
        $newNewsThisMonth = News::where('created_at', '>=', $thirtyDaysAgo)->count();
        $newSubscribersThisMonth = Newsletter::where('created_at', '>=', $thirtyDaysAgo)->count();
        
        // Category breakdown
        $cerpenCount = SastraTulis::where('category', 'CERPEN')->count();
        $puisiCount = SastraTulis::where('category', 'PUISI')->count();
        $karyaPegawaiCount = SastraTulis::where('category', 'KARYA PEGAWAI')->count();
        
        // Comments statistics
        $totalComments = Comment::count();
        $recentComments = Comment::with('user', 'post')->latest()->take(5)->get();
        
        // Most viewed articles
        $mostViewedArticles = SastraTulis::where('status', 'PUBLISHED')
                                        ->orderByDesc('views')
                                        ->take(5)
                                        ->get();
        
        return view('admin.index', compact(
            'totalUsers',
            'totalCerpen', 
            'totalBerita',
            'totalPembaca',
            'totalSastra',
            'publishedSastra',
            'pendingSastra',
            'totalViews',
            'newUsersThisMonth',
            'newSastraThisMonth',
            'newNewsThisMonth',
            'newSubscribersThisMonth',
            'cerpenCount',
            'puisiCount',
            'karyaPegawaiCount',
            'totalComments',
            'recentComments',
            'mostViewedArticles'
        ));
    }
}
