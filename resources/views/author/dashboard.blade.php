@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 md:px-8 py-12">

    {{-- Header --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="w-8 h-[3px] bg-[#B33A3A]"></span>
                <span class="font-news uppercase tracking-widest text-xs text-[#B33A3A] font-bold">Espace auteur</span>
            </div>
            <h1 class="font-headline text-4xl font-bold text-[#1d1b19]">Mon Dashboard</h1>
            <p class="text-[#584140] mt-1">Bienvenue, <strong>{{ auth()->user()->name }}</strong> 👋</p>
        </div>
        <a href="{{ route('posts.create') }}"
           class="bg-[#B33A3A] text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 hover:opacity-90 transition-all shadow-lg w-fit">
            <span class="material-symbols-outlined text-lg">add</span>
            Nouvel article
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
            <div class="w-10 h-10 bg-[#B33A3A]/10 rounded-full flex items-center justify-center mb-3">
                <span class="material-symbols-outlined text-[#B33A3A]" style="font-variation-settings:'FILL' 1">article</span>
            </div>
            <p class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-1">Articles</p>
            <h3 class="font-headline text-3xl text-[#1d1b19] font-bold">{{ $totalPosts }}</h3>
            <p class="text-xs text-stone-400 mt-1">{{ $publishedPosts }} publiés</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
            <div class="w-10 h-10 bg-[#B33A3A]/10 rounded-full flex items-center justify-center mb-3">
                <span class="material-symbols-outlined text-[#B33A3A]" style="font-variation-settings:'FILL' 1">favorite</span>
            </div>
            <p class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-1">Likes</p>
            <h3 class="font-headline text-3xl text-[#1d1b19] font-bold">{{ $totalLikes }}</h3>
            <p class="text-xs text-stone-400 mt-1">Sur tous vos articles</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
            <div class="w-10 h-10 bg-[#B33A3A]/10 rounded-full flex items-center justify-center mb-3">
                <span class="material-symbols-outlined text-[#B33A3A]" style="font-variation-settings:'FILL' 1">forum</span>
            </div>
            <p class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-1">Commentaires</p>
            <h3 class="font-headline text-3xl text-[#1d1b19] font-bold">{{ $totalComments }}</h3>
            <p class="text-xs text-stone-400 mt-1">Reçus au total</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
            <div class="w-10 h-10 bg-[#B33A3A]/10 rounded-full flex items-center justify-center mb-3">
                <span class="material-symbols-outlined text-[#B33A3A]" style="font-variation-settings:'FILL' 1">visibility</span>
            </div>
            <p class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-1">Vues</p>
            <h3 class="font-headline text-3xl text-[#1d1b19] font-bold">{{ number_format($totalViews) }}</h3>
            <p class="text-xs text-stone-400 mt-1">Lectures totales</p>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">

        {{-- Top Articles --}}
        <div class="lg:col-span-7 bg-white rounded-xl p-8 shadow-[0_2px_16px_rgba(179,58,58,0.03)]">
            <h2 class="font-headline text-2xl text-[#1d1b19] mb-6">Mes meilleurs articles</h2>
            @forelse($topPosts as $index => $post)
            <div class="flex items-start gap-4 {{ !$loop->last ? 'pb-5 mb-5 border-b border-[#f2ede8]' : '' }}">
                <span class="font-headline text-3xl font-black text-[#B33A3A]/20 leading-none w-8 flex-shrink-0">
                    {{ $index + 1 }}
                </span>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('posts.show', $post) }}"
                       class="font-headline font-bold text-[#1d1b19] hover:text-[#B33A3A] transition-colors line-clamp-1">
                        {{ $post->title }}
                    </a>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="flex items-center gap-1 text-xs text-stone-400">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">favorite</span>
                            {{ $post->likes->count() }} likes
                        </span>
                        <span class="flex items-center gap-1 text-xs text-stone-400">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">visibility</span>
                            {{ number_format($post->views) }} vues
                        </span>
                        <span class="flex items-center gap-1 text-xs text-stone-400">
                            <span class="material-symbols-outlined text-sm">forum</span>
                            {{ $post->comments->count() }} commentaires
                        </span>
                    </div>
                </div>
                <a href="{{ route('posts.edit', $post) }}"
                   class="text-stone-400 hover:text-[#B33A3A] transition-colors flex-shrink-0">
                    <span class="material-symbols-outlined text-lg">edit_note</span>
                </a>
            </div>
            @empty
            <div class="text-center py-10">
                <span class="material-symbols-outlined text-5xl text-[#B33A3A] opacity-20">article</span>
                <p class="text-stone-400 mt-3">Aucun article publié pour l'instant.</p>
                <a href="{{ route('posts.create') }}"
                   class="inline-block mt-4 bg-[#B33A3A] text-white px-6 py-2 rounded-lg text-sm font-bold hover:opacity-90 transition-all">
                    Rédiger mon premier article
                </a>
            </div>
            @endforelse
        </div>

        {{-- Statut + Activité récente --}}
        <div class="lg:col-span-5 space-y-6">

            {{-- Statut articles --}}
            <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.03)]">
                <h3 class="font-headline text-xl text-[#1d1b19] mb-5">Statut de mes articles</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span class="text-sm text-stone-600">Publiés</span>
                        </div>
                        <span class="font-bold text-[#1d1b19]">{{ $publishedPosts }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                            <span class="text-sm text-stone-600">En attente</span>
                        </div>
                        <span class="font-bold text-[#1d1b19]">{{ $pendingPosts }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                            <span class="text-sm text-stone-600">Rejetés</span>
                        </div>
                        <span class="font-bold text-[#1d1b19]">{{ $rejectedPosts }}</span>
                    </div>
                </div>
                {{-- Barre progression --}}
                @if($totalPosts > 0)
                <div class="mt-4 h-2 bg-[#f2ede8] rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full transition-all"
                         style="width: {{ ($publishedPosts / $totalPosts) * 100 }}%"></div>
                </div>
                <p class="text-xs text-stone-400 mt-2">
                    {{ round(($publishedPosts / $totalPosts) * 100) }}% de vos articles sont publiés
                </p>
                @endif
            </div>

            {{-- Articles récents --}}
            <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.03)]">
                <h3 class="font-headline text-xl text-[#1d1b19] mb-5">Articles récents</h3>
                <div class="space-y-3">
                    @forelse($recentPosts as $post)
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-[#1d1b19] truncate">{{ Str::limit($post->title, 35) }}</p>
                            <p class="text-xs text-stone-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="flex-shrink-0 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase
                            {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' :
                               ($post->status === 'draft' ? 'bg-amber-50 text-amber-700' :
                               'bg-red-50 text-red-700') }}">
                            {{ $post->status === 'published' ? 'Publié' :
                               ($post->status === 'draft' ? 'En attente' : 'Rejeté') }}
                        </span>
                    </div>
                    @empty
                    <p class="text-stone-400 text-sm">Aucun article.</p>
                    @endforelse
                </div>
                <a href="{{ route('posts.my-posts') }}"
                   class="mt-4 flex items-center gap-1 text-xs font-bold text-[#B33A3A] hover:underline">
                    Voir tous mes articles
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

        </div>
    </div>

</div>
@endsection