<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SastraTulis;
use App\Models\Comment;

class PojokCeritaController extends Controller
{
    public function index(Request $request)
    {
        $categoryParam = $request->query('category');

        $slugToCategory = [
            'cerpen' => 'CERPEN',
            'puisi' => 'PUISI',
            'karya-pegawai' => 'KARYA PEGAWAI',
            'karyapegawai' => 'KARYA PEGAWAI',
        ];

        $normalizedCategory = null;
        if ($categoryParam) {
            $key = strtolower(str_replace(' ', '-', $categoryParam));
            if (isset($slugToCategory[$key])) {
                $normalizedCategory = $slugToCategory[$key];
            } else {
                $upper = strtoupper($categoryParam);
                if (in_array($upper, array_values($slugToCategory), true)) {
                    $normalizedCategory = $upper;
                }
            }
        }

        $query = SastraTulis::query()->where('status', 'PUBLISHED')->latest();
        if ($normalizedCategory) {
            $query->where('category', $normalizedCategory);
        }

        $posts = $query->paginate(9)->withQueryString();

        $activeCategory = $normalizedCategory;

        return view('pages.pojok-cerita.index', compact('posts', 'activeCategory'));
    }

    public function search(Request $request)
    {
        $query = SastraTulis::query()->where('status', 'PUBLISHED');
        
        // Search by title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        
        // Filter by category
        if ($request->filled('category') && $request->category !== 'Genre') {
            $categoryMap = [
                'cerpen' => 'CERPEN',
                'puisi' => 'PUISI', 
                'karya-pegawai' => 'KARYA PEGAWAI',
                'karyapegawai' => 'KARYA PEGAWAI',
            ];
            
            $category = $request->category;
            if (isset($categoryMap[strtolower($category)])) {
                $query->where('category', $categoryMap[strtolower($category)]);
            } else {
                $query->where('category', $category);
            }
        }
        
        $results = $query->latest()->paginate(12)->withQueryString();
        
        return view('pages.pojok-cerita.search', compact('results'));
    }

    public function showThumb($id)
    {
        $post = SastraTulis::findOrFail($id);
        return view('pages.pojok-cerita.thumb', compact('post'));
    }

    public function showOpenBook($id)
    {
        $post = SastraTulis::findOrFail($id);

        // Increment views once per session per post
        $sessionKey = 'sastra_viewed_' . $post->id;
        if (!session()->has($sessionKey)) {
            $post->increment('views');
            session()->put($sessionKey, true);
        }

        // Prepare word-based pagination (500 words per page)
        $plainText = trim(preg_replace('/\s+/', ' ', strip_tags($post->body)));
        $words = $plainText === '' ? [] : explode(' ', $plainText);
        $wordsPerPage = 500;
        $totalPages = max(1, (int) ceil(count($words) / $wordsPerPage));

        $currentPage = (int) request()->query('page', 1);
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $wordsPerPage;
        $pageWords = array_slice($words, $offset, $wordsPerPage);
        $pageContent = implode(' ', $pageWords);

        // Load comments with users
        $comments = $post->comments()->with('user')->latest()->get();

        return view('pages.pojok-cerita.open-book', [
            'post' => $post,
            'pageContent' => $pageContent,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'wordCount' => count($words),
            'comments' => $comments,
        ]);
    }

    public function storeComment(Request $request, $id)
    {
        $post = SastraTulis::findOrFail($id);

        $validated = $request->validate([
            'body' => ['required', 'string', 'min:3', 'max:2000'],
        ]);

        Comment::create([
            'sastra_tulis_id' => $post->id,
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        $query = [];
        if ($request->has('page')) {
            $query['page'] = (int) $request->input('page');
        }

        return redirect()
            ->route('pojok-cerita.open-book', array_filter(['id' => $post->id] + $query))
            ->with('success', 'Komentar berhasil dikirim.');
    }

    public function deleteComment(Request $request, $id, $commentId)
    {
        $post = SastraTulis::findOrFail($id);
        $comment = Comment::findOrFail($commentId);

        // Check if user can delete this comment
        $user = $request->user();
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // User can delete if they own the comment or if they are admin
        if ($comment->user_id !== $user->id && $user->role !== 'ADMIN') {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        $query = [];
        if ($request->has('page')) {
            $query['page'] = (int) $request->input('page');
        }

        return redirect()
            ->route('pojok-cerita.open-book', array_filter(['id' => $post->id] + $query))
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
