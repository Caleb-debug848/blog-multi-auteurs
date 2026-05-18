@extends('layouts.app')

@section('content')

<main class="pt-16 pb-20 px-6 md:px-12 max-w-screen-xl mx-auto min-h-screen">

    {{-- Header --}}
    <header class="mb-12">
        <h1 class="font-headline text-[38px] font-bold text-[#1d1b19] leading-tight mb-2">
            Mes articles
        </h1>
        <p class="text-[#584140] font-light tracking-wide uppercase text-xs">
            Tableau de bord de gestion éditoriale
        </p>
    </header>

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.04)] relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none opacity-4"
                 style="background-image: radial-gradient(#B33A3A 0.5px, transparent 0.5px); background-size: 12px 12px;"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-[#005650] p-2 bg-[#005650]/10 rounded-lg">description</span>
                    <span class="text-[#005650] text-xs font-bold uppercase tracking-widest">Total</span>
                </div>
                <p class="text-[#584140] text-sm uppercase tracking-widest mb-1">Total Articles</p>
                <p class="text-4xl font-headline font-bold text-[#1d1b19]">{{ $total }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.04)] relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none opacity-4"
                 style="background-image: radial-gradient(#B33A3A 0.5px, transparent 0.5px); background-size: 12px 12px;"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-[#8f4c2a] p-2 bg-[#8f4c2a]/10 rounded-lg">pending_actions</span>
                    <span class="text-[#8f4c2a] text-xs font-bold uppercase tracking-widest">En cours</span>
                </div>
                <p class="text-[#584140] text-sm uppercase tracking-widest mb-1">En attente</p>
                <p class="text-4xl font-headline font-bold text-[#1d1b19]">{{ str_pad($pending, 2, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-[0_2px_16px_rgba(179,58,58,0.04)] relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none opacity-4"
                 style="background-image: radial-gradient(#B33A3A 0.5px, transparent 0.5px); background-size: 12px 12px;"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-4">
                    <span class="material-symbols-outlined text-[#B33A3A] p-2 bg-[#B33A3A]/10 rounded-lg">cancel</span>
                    <span class="text-[#B33A3A] text-xs font-bold uppercase tracking-widest">À revoir</span>
                </div>
                <p class="text-[#584140] text-sm uppercase tracking-widest mb-1">Rejetés</p>
                <p class="text-4xl font-headline font-bold text-[#1d1b19]">{{ str_pad($rejected, 2, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

    </div>

    {{-- Filters --}}
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-8 border-b border-[#e6e2dd]">
        <nav class="flex gap-8">
            <a href="{{ route('posts.my-posts') }}"
               class="pb-4 text-sm uppercase tracking-widest transition-all
               {{ !request('status') ? 'text-[#B33A3A] font-bold border-b-2 border-[#B33A3A]' : 'text-[#584140] hover:text-[#B33A3A] font-medium' }}">
                Tous
            </a>
            <a href="{{ route('posts.my-posts', ['status' => 'published']) }}"
               class="pb-4 text-sm uppercase tracking-widest transition-all
               {{ request('status') === 'published' ? 'text-[#B33A3A] font-bold border-b-2 border-[#B33A3A]' : 'text-[#584140] hover:text-[#B33A3A] font-medium' }}">
                Publiés
            </a>
            <a href="{{ route('posts.my-posts', ['status' => 'draft']) }}"
               class="pb-4 text-sm uppercase tracking-widest transition-all
               {{ request('status') === 'draft' ? 'text-[#B33A3A] font-bold border-b-2 border-[#B33A3A]' : 'text-[#584140] hover:text-[#B33A3A] font-medium' }}">
                Brouillons
            </a>
            <a href="{{ route('posts.my-posts', ['status' => 'rejected']) }}"
               class="pb-4 text-sm uppercase tracking-widest transition-all
               {{ request('status') === 'rejected' ? 'text-[#B33A3A] font-bold border-b-2 border-[#B33A3A]' : 'text-[#584140] hover:text-[#B33A3A] font-medium' }}">
                Rejetés
            </a>
        </nav>
    </div>

    {{-- Article List --}}
<div class="space-y-4">
    @forelse($posts as $post)
    <div class="bg-white rounded-xl overflow-hidden border border-[#E2D9D0] group hover:shadow-[0_4px_24px_rgba(179,58,58,0.06)] transition-all">

        {{-- Image --}}
        <div class="w-full h-48 overflow-hidden bg-[#f2ede8]">
            @if($post->image)
                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#B33A3A] opacity-30 text-4xl">article</span>
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="p-4">

            {{-- Catégorie + Date --}}
            <div class="flex items-center gap-2 mb-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#8f4c2a]">
                    {{ $post->category->name }}
                </span>
                <span class="text-stone-300">•</span>
                <span class="text-[10px] text-[#584140]/60 uppercase tracking-widest">
                    {{ $post->created_at->format('d M Y') }}
                </span>
            </div>

            {{-- Titre --}}
            <h3 class="font-headline text-base font-bold text-[#1d1b19] mb-3 line-clamp-2">
                {{ $post->title }}
            </h3>

            {{-- Stats --}}
            <div class="flex items-center gap-4 mb-4">
                <span class="flex items-center gap-1 text-xs text-stone-400">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">visibility</span>
                    {{ number_format($post->views) }}
                </span>
                <span class="flex items-center gap-1 text-xs text-stone-400">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">favorite</span>
                    {{ $post->likes->count() }}
                </span>
                <span class="flex items-center gap-1 text-xs text-stone-400">
                    <span class="material-symbols-outlined text-sm">forum</span>
                    {{ $post->comments->count() }}
                </span>
            </div>

            {{-- Statut + Actions --}}
            <div class="flex items-center justify-between">
                @if($post->status === 'published')
                    <span class="px-3 py-1 bg-[#005650]/10 text-[#005650] text-[10px] font-bold uppercase tracking-widest rounded-full">Publié</span>
                @elseif($post->status === 'draft')
                    <span class="px-3 py-1 bg-[#8f4c2a]/10 text-[#8f4c2a] text-[10px] font-bold uppercase tracking-widest rounded-full">En attente</span>
                @else
                    <span class="px-3 py-1 bg-[#B33A3A]/10 text-[#B33A3A] text-[10px] font-bold uppercase tracking-widest rounded-full">Rejeté</span>
                @endif

                <div class="flex items-center gap-2">
                    <a href="{{ route('posts.edit', $post) }}"
                       class="p-2 text-[#584140] hover:text-[#B33A3A] hover:bg-[#B33A3A]/5 rounded-lg transition-all">
                        <span class="material-symbols-outlined text-xl">edit_note</span>
                    </a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf @method('DELETE')
                        <button class="p-2 text-[#584140] hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                onclick="return confirm('Supprimer cet article ?')">
                            <span class="material-symbols-outlined text-xl">delete_outline</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @empty
    <div class="text-center py-20">
        <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">article</span>
        <p class="text-[#584140] mt-4 font-headline text-xl">Vous n'avez pas encore d'articles</p>
        <a href="{{ route('posts.create') }}"
           class="inline-flex items-center gap-2 mt-6 bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-all">
            <span class="material-symbols-outlined text-sm">add</span>
            Créer mon premier article
        </a>
    </div>
    @endforelse
</div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>

</main>

{{-- FAB --}}
<a href="{{ route('posts.create') }}"
   class="fixed bottom-8 right-8 w-14 h-14 bg-[#B33A3A] text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-all z-40 group">
    <span class="material-symbols-outlined text-3xl">add</span>
    <span class="absolute right-full mr-4 bg-[#1d1b19] text-white px-4 py-2 rounded-lg text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none uppercase tracking-widest">
        Nouvel Article
    </span>
</a>

@endsection