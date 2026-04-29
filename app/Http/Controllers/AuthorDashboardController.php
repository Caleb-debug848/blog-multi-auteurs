<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AuthorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)
                     ->with(['likes', 'comments'])
                     ->latest()
                     ->get();

        $totalPosts     = $posts->count();
        $publishedPosts = $posts->where('status', 'published')->count();
        $pendingPosts   = $posts->where('status', 'draft')->count();
        $rejectedPosts  = $posts->where('status', 'rejected')->count();
        $totalLikes     = $posts->sum(fn($p) => $p->likes->count());
        $totalComments  = $posts->sum(fn($p) => $p->comments->count());
        $totalViews     = $posts->sum('views');

        // Top 3 articles les plus likés
        $topPosts = $posts->where('status', 'published')
                          ->sortByDesc(fn($p) => $p->likes->count())
                          ->take(3)
                          ->values();

        // Articles récents
        $recentPosts = $posts->take(5);

        return view('author.dashboard', compact(
            'totalPosts', 'publishedPosts', 'pendingPosts',
            'rejectedPosts', 'totalLikes', 'totalComments',
            'totalViews', 'topPosts', 'recentPosts'
        ));
    }
}