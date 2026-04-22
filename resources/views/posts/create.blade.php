@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Nouvel article</h1>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Titre</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Contenu</label>
            <textarea name="body" rows="8"
                class="w-full border rounded p-2" required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-4">
        <label class="block font-semibold mb-1">Image de couverture</label>
        <input type="file" name="image" accept="image/*"
            class="w-full border rounded p-2">
    </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Catégorie</label>
            <select name="category_id" class="w-full border rounded p-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Tags</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <button class="bg-indigo-500 text-white px-6 py-2 rounded">Publier</button>
    </form>
</div>
@endsection