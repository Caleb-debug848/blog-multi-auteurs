<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalPosts      = Post::count();
        $pendingPosts    = Post::where('status', 'draft')->count();
        $pendingComments = Comment::where('approved', false)->count();
        $totalUsers      = User::count();
        $recentPosts     = Post::with(['user', 'category'])->latest()->take(3)->get();
        $recentComments  = Comment::with(['user', 'post'])->where('approved', false)->latest()->take(2)->get();

        return view('admin.index', compact(
            'totalPosts', 'pendingPosts', 'pendingComments',
            'totalUsers', 'recentPosts', 'recentComments'
        ));
    }

    public function articles()
    {
        $posts = Post::with(['user', 'category'])
                    ->where('status', 'draft')
                    ->latest()
                    ->paginate(10);
        return view('admin.articles', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'post'])
                    ->where('approved', false)
                    ->latest()
                    ->paginate(10);
        return view('admin.comments', compact('comments'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function approvePost(Post $post)
    {
        $post->update(['status' => 'published']);
        return back()->with('success', 'Article approuvé !');
    }

    public function rejectPost(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return back()->with('success', 'Article rejeté.');
    }

    public function approveComment(Comment $comment)
    {
        $comment->update(['approved' => true]);
        return back()->with('success', 'Commentaire approuvé !');
    }

    public function updateUserRole(User $user, $role)
    {
        $user->update(['role' => $role]);
        return back()->with('success', 'Rôle mis à jour !');
    }
}

