@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6 mb-6">
    <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
    <p class="text-sm text-gray-500 mb-4">
        Par {{ $post->user->name }} •
        {{ $post->category->name }} •
        {{ $post->created_at->format('d/m/Y') }}
    </p>

    <div class="prose mb-4">{{ $post->body }}</div>

    <!-- Tags -->
    <div class="flex gap-2 mb-4">
        @foreach($post->tags as $tag)
            <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded">
                {{ $tag->name }}
            </span>
        @endforeach
    </div>

    <!-- Like -->
    @auth
    <form method="POST" action="{{ route('posts.like', $post) }}">
        @csrf
        <button class="bg-pink-100 text-pink-600 px-4 py-1 rounded hover:bg-pink-200">
            ❤️ {{ $post->likes->count() }} Like(s)
        </button>
    </form>
    @endauth

    <!-- Actions auteur/admin -->
    @can('update', $post)
    <div class="mt-4 flex gap-3">
        <a href="{{ route('posts.edit', $post) }}"
           class="bg-yellow-400 text-white px-4 py-1 rounded">Modifier</a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
            @csrf @method('DELETE')
            <button class="bg-red-500 text-white px-4 py-1 rounded">Supprimer</button>
        </form>
    </div>
    @endcan
</div>

<!-- Commentaires -->
<div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-bold mb-4">Commentaires</h2>

    @foreach($post->comments->where('approved', true) as $comment)
        <div class="border-b py-3">
            <p class="text-sm text-gray-500">{{ $comment->user->name }} — {{ $comment->created_at->format('d/m/Y') }}</p>
            <p class="text-gray-700">{{ $comment->body }}</p>
        </div>
    @endforeach

    @auth
    <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-4">
        @csrf
        <textarea name="body" rows="3" placeholder="Votre commentaire..."
            class="w-full border rounded p-2 mb-2"></textarea>
        <button class="bg-indigo-500 text-white px-4 py-2 rounded">Commenter</button>
    </form>
    @endauth
</div>
@endsection