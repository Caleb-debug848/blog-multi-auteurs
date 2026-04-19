@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Articles publiés</h1>

@forelse($posts as $post)
    <div class="bg-white rounded shadow p-4 mb-4">
        <h2 class="text-xl font-semibold">
            <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:underline">
                {{ $post->title }}
            </a>
        </h2>
        <p class="text-sm text-gray-500">
            Par {{ $post->user->name }} •
            {{ $post->category->name }} •
            {{ $post->created_at->format('d/m/Y') }}
        </p>
        <p class="mt-2 text-gray-700">{{ Str::limit($post->body, 150) }}</p>
        <div class="mt-2 flex gap-2">
            @foreach($post->tags as $tag)
                <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    </div>
@empty
    <p class="text-gray-500">Aucun article publié pour le moment.</p>
@endforelse

{{ $posts->links() }}
@endsection