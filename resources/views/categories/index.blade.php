@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Catégories</h1>

    <form method="POST" action="{{ route('categories.store') }}" class="flex gap-2 mb-6">
        @csrf
        <input type="text" name="name" placeholder="Nouvelle catégorie"
            class="border rounded p-2 flex-1" required>
        <button class="bg-indigo-500 text-white px-4 py-2 rounded">Ajouter</button>
    </form>

    @foreach($categories as $category)
        <div class="border-b py-3 flex justify-between items-center">
            <span>{{ $category->name }}</span>
            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                @csrf @method('DELETE')
                <button class="text-red-500 hover:underline">Supprimer</button>
            </form>
        </div>
    @endforeach
</div>
@endsection