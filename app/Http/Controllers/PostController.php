<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Liste des posts publiés (page d'accueil)
    public function index()
    {
        $posts = Post::where('status', 'published')
                     ->with(['user', 'category', 'tags'])
                     ->latest()
                     ->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Formulaire de création
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    // Enregistrer un post
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'body'        => $request->body,
            'status'      => 'draft',
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
        ]);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Article créé avec succès !');
    }

    // Afficher un post
    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    // Formulaire d'édition
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    // Mettre à jour un post
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'body'        => $request->body,
            'category_id' => $request->category_id,
        ]);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.show', $post)->with('success', 'Article mis à jour !');
    }

    // Supprimer un post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Article supprimé !');
    }

    // Liker un post
    public function like(Post $post)
    {
        $existing = $post->likes()->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
        }
        return back();
    }
}