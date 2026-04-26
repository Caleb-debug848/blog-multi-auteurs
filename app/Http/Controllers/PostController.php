<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    // Liste des posts publiés (page d'accueil)
    public function index()
    {
        $posts = Post::where('status', 'published')
                     ->with(['user', 'category', 'tags'])
                     ->latest()
                     ->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function trending()
{
    $posts = Post::where('status', 'published')
                 ->with(['user', 'category', 'tags', 'likes'])
                 ->withCount('likes')
                 ->orderBy('likes_count', 'desc')
                 ->paginate(10);
    return view('posts.trending', compact('posts'));
}

public function search(Request $request)
{
    $query = $request->get('q');
    $posts = Post::where('status', 'published')
                 ->where(function($q) use ($query) {
                     $q->where('title', 'like', "%{$query}%")
                       ->orWhere('body', 'like', "%{$query}%");
                 })
                 ->with(['user', 'category', 'tags', 'likes'])
                 ->latest()
                 ->paginate(10);
    return view('posts.search', compact('posts', 'query'));
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
        'image'       => 'nullable|image|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    $post = Post::create([
        'title'       => $request->title,
        'slug'        => Str::slug($request->title),
        'body'        => $request->body,
        'image'       => $imagePath,
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
        'image'       => 'nullable|image|max:2048',
    ]);

    $imagePath = $post->image;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    $post->update([
        'title'       => $request->title,
        'slug'        => Str::slug($request->title),
        'body'        => $request->body,
        'image'       => $imagePath,
        'category_id' => $request->category_id,
    ]);

    if ($request->tags) {
        $post->tags()->sync($request->tags);
    }

    return redirect()->route('posts.show', $post)->with('success', 'Article mis à jour !');
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

    public function myPosts()
{
    $query = Post::where('user_id', auth()->id())
                 ->with(['category', 'tags'])
                 ->latest();

    if (request('status')) {
        $query->where('status', request('status'));
    }

    $posts    = $query->paginate(10);
    $total    = Post::where('user_id', auth()->id())->count();
    $pending  = Post::where('user_id', auth()->id())->where('status', 'draft')->count();
    $rejected = Post::where('user_id', auth()->id())->where('status', 'rejected')->count();

    return view('posts.my-posts', compact('posts', 'total', 'pending', 'rejected'));
    }

}