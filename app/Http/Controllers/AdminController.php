<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class AdminController extends Controller
{
    // Dashboard admin
    public function index()
    {
        $posts    = Post::with('user')->where('status', 'draft')->get();
        $comments = Comment::with(['user', 'post'])->where('approved', false)->get();
        $users    = User::all();
        return view('admin.index', compact('posts', 'comments', 'users'));
    }

    // Approuver un post
    public function approvePost(Post $post)
    {
        $post->update(['status' => 'published']);
        return back()->with('success', 'Article approuvé !');
    }

    // Rejeter un post
    public function rejectPost(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return back()->with('success', 'Article rejeté.');
    }

    // Approuver un commentaire
    public function approveComment(Comment $comment)
    {
        $comment->update(['approved' => true]);
        return back()->with('success', 'Commentaire approuvé !');
    }

    // Changer le rôle d'un utilisateur
    public function updateUserRole(User $user, $role)
    {
        $user->update(['role' => $role]);
        return back()->with('success', 'Rôle mis à jour !');
    }
}