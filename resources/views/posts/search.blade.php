@extends('layouts.app')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 md:px-6 py-12">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <span class="w-8 h-[3px] bg-[#B33A3A]"></span>
            <span class="font-news uppercase tracking-widest text-xs text-[#B33A3A] font-bold">Recherche</span>
        </div>
        <h1 class="font-headline text-4xl font-bold text-[#1d1b19]">
            @if($query) Résultats pour "{{ $query }}" @else Recherche avancée @endif
        </h1>
        <p class="text-[#584140] mt-2">{{ $posts->total() }} article(s) trouvé(s)</p>
    </div>

    {{-- Formulaire recherche avancée --}}
    <form method="GET" action="{{ route('posts.search') }}"
          class="bg-white rounded-2xl shadow-[0_2px_20px_rgba(179,58,58,0.07)] p-6 mb-10">

        {{-- Barre recherche principale --}}
        <div class="flex gap-3 mb-6">
            <div class="flex-1 flex items-center bg-[#F5F0EB] rounded-xl px-4 gap-2">
                <span class="material-symbols-outlined text-[#8b716f]">search</span>
                <input type="text"
                       name="q"
                       value="{{ $query }}"
                       placeholder="Rechercher un article..."
                       class="flex-1 bg-transparent py-3 text-sm text-[#1d1b19] placeholder:text-stone-400 outline-none"/>
            </div>
            <button type="submit"
                    class="bg-[#B33A3A] text-white px-6 py-3 rounded-xl font-bold text-sm hover:opacity-90 transition-all shadow-md">
                Rechercher
            </button>
        </div>

        {{-- Filtres --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Catégorie --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-2">
                    Catégorie
                </label>
                <select name="category"
                        class="w-full px-4 py-3 bg-[#F5F0EB] rounded-xl text-sm text-[#1d1b19] border-none outline-none focus:ring-2 focus:ring-[#B33A3A]/20">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Auteur --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-2">
                    Auteur
                </label>
                <select name="author"
                        class="w-full px-4 py-3 bg-[#F5F0EB] rounded-xl text-sm text-[#1d1b19] border-none outline-none focus:ring-2 focus:ring-[#B33A3A]/20">
                    <option value="">Tous les auteurs</option>
                    @foreach($authors as $auth)
                    <option value="{{ $auth->id }}" {{ $author == $auth->id ? 'selected' : '' }}>
                        {{ $auth->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Date --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-2">
                    Période
                </label>
                <select name="date"
                        class="w-full px-4 py-3 bg-[#F5F0EB] rounded-xl text-sm text-[#1d1b19] border-none outline-none focus:ring-2 focus:ring-[#B33A3A]/20">
                    <option value="">Toute période</option>
                    <option value="week"  {{ $date === 'week'  ? 'selected' : '' }}>Cette semaine</option>
                    <option value="month" {{ $date === 'month' ? 'selected' : '' }}>Ce mois-ci</option>
                    <option value="year"  {{ $date === 'year'  ? 'selected' : '' }}>Cette année</option>
                </select>
            </div>

        </div>

        {{-- Filtres actifs --}}
        @if($query || $category || $author || $date)
        <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-[#f2ede8]">
            <span class="text-xs text-stone-400 font-bold uppercase tracking-widest mr-2 self-center">Filtres actifs :</span>
            @if($query)
            <span class="flex items-center gap-1 bg-[#B33A3A]/10 text-[#B33A3A] px-3 py-1 rounded-full text-xs font-bold">
                "{{ $query }}"
                <a href="{{ request()->fullUrlWithoutQuery(['q']) }}" class="hover:text-[#922225]">✕</a>
            </span>
            @endif
            @if($category)
            <span class="flex items-center gap-1 bg-[#B33A3A]/10 text-[#B33A3A] px-3 py-1 rounded-full text-xs font-bold">
                {{ $categories->find($category)?->name }}
                <a href="{{ request()->fullUrlWithoutQuery(['category']) }}" class="hover:text-[#922225]">✕</a>
            </span>
            @endif
            @if($author)
            <span class="flex items-center gap-1 bg-[#B33A3A]/10 text-[#B33A3A] px-3 py-1 rounded-full text-xs font-bold">
                {{ $authors->find($author)?->name }}
                <a href="{{ request()->fullUrlWithoutQuery(['author']) }}" class="hover:text-[#922225]">✕</a>
            </span>
            @endif
            @if($date)
            <span class="flex items-center gap-1 bg-[#B33A3A]/10 text-[#B33A3A] px-3 py-1 rounded-full text-xs font-bold">
                {{ match($date) { 'week' => 'Cette semaine', 'month' => 'Ce mois-ci', 'year' => 'Cette année', default => '' } }}
                <a href="{{ request()->fullUrlWithoutQuery(['date']) }}" class="hover:text-[#922225]">✕</a>
            </span>
            @endif
            <a href="{{ route('posts.search') }}"
               class="flex items-center gap-1 bg-stone-100 text-stone-500 px-3 py-1 rounded-full text-xs font-bold hover:bg-stone-200 transition-colors">
                Effacer tout ✕
            </a>
        </div>
        @endif

    </form>

    {{-- Résultats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <article class="bg-white rounded-xl overflow-hidden shadow-[0_2px_16px_rgba(179,58,58,0.07)] flex flex-col group hover:shadow-[0_6px_24px_rgba(179,58,58,0.13)] hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-48 overflow-hidden">
                @if($post->image)
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#F5F0EB] to-[#fda77d]/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#B33A3A] text-5xl opacity-30">article</span>
                    </div>
                @endif
                <span class="absolute top-4 left-4 bg-[#B33A3A] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $post->category->name }}
                </span>
            </div>
            <div class="p-5 flex-grow flex flex-col">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-6 h-6 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-xs">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                    <span class="text-xs text-[#584140]">{{ $post->user->name }}</span>
                    <span class="text-stone-300">·</span>
                    <span class="text-xs text-[#584140]">{{ $post->created_at->format('d M Y') }}</span>
                </div>
                <h2 class="font-headline text-lg font-bold text-[#1d1b19] mb-2 group-hover:text-[#B33A3A] transition-colors line-clamp-2">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-[#584140] line-clamp-2 flex-grow">
                    {{ Str::limit(strip_tags($post->body), 100) }}
                </p>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-[#E2D9D0]">
                    <div class="flex items-center gap-3 text-xs text-stone-400">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">favorite</span>
                            {{ $post->likes->count() }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1">visibility</span>
                            {{ $post->views }}
                        </span>
                    </div>
                    <a href="{{ route('posts.show', $post) }}"
                       class="text-xs font-bold text-[#B33A3A] hover:underline">
                        Lire →
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-20">
            <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">search_off</span>
            <p class="text-[#584140] mt-4 font-headline text-xl">Aucun article trouvé</p>
            <p class="text-[#8b716f] text-sm mt-2">Essayez avec d'autres critères de recherche.</p>
            <a href="{{ route('posts.search') }}"
               class="inline-block mt-6 bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-all">
                Nouvelle recherche
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
        {{ $posts->appends(request()->query())->links() }}
    </div>

</div>
@endsection