@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Modifier l'article</h1>

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Contenu</label>
            <textarea name="body" rows="8"
                class="w-full border rounded p-2" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Catégorie</label>
            <select name="category_id" class="w-full border rounded p-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <button class="bg-yellow-400 text-white px-6 py-2 rounded">Mettre à jour</button>
    </form>
</div>
@endsection