@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<!-- Articles en attente -->
<div class="bg-white rounded shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4">Articles en attente</h2>
    @forelse($posts as $post)
        <div class="border-b py-3 flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $post->title }}</p>
                <p class="text-sm text-gray-500">Par {{ $post->user->name }}</p>
            </div>
            <div class="flex gap-2">
                <form method="POST" action="{{ route('admin.approvePost', $post) }}">
                    @csrf
                    <button class="bg-green-500 text-white px-3 py-1 rounded">Approuver</button>
                </form>
                <form method="POST" action="{{ route('admin.rejectPost', $post) }}">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Rejeter</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Aucun article en attente.</p>
    @endforelse
</div>

<!-- Commentaires en attente -->
<div class="bg-white rounded shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4">Commentaires en attente</h2>
    @forelse($comments as $comment)
        <div class="border-b py-3 flex justify-between items-center">
            <div>
                <p class="text-gray-700">{{ $comment->body }}</p>
                <p class="text-sm text-gray-500">
                    Par {{ $comment->user->name }} sur "{{ $comment->post->title }}"
                </p>
            </div>
            <div class="flex gap-2">
                <form method="POST" action="{{ route('admin.approveComment', $comment) }}">
                    @csrf
                    <button class="bg-green-500 text-white px-3 py-1 rounded">Approuver</button>
                </form>
                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Aucun commentaire en attente.</p>
    @endforelse
</div>

<!-- Gestion des utilisateurs -->
<div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-bold mb-4">Utilisateurs</h2>
    @foreach($users as $user)
        <div class="border-b py-3 flex justify-between items-center">
            <div>
                <p class="font-semibold">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }} — Rôle : {{ $user->role }}</p>
            </div>
            <div class="flex gap-2">
                @foreach(['admin', 'author', 'reader'] as $role)
                    @if($user->role !== $role)
                        <form method="POST"
                            action="{{ route('admin.updateUserRole', [$user, $role]) }}">
                            @csrf
                            <button class="bg-indigo-400 text-white px-3 py-1 rounded text-sm">
                                → {{ ucfirst($role) }}
                            </button>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection