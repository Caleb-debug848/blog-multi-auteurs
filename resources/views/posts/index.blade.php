@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative h-[500px] overflow-hidden flex items-center bg-gradient-to-br from-[#F5F0EB] to-[#f2ede8] kente-pattern">
    <div class="max-w-screen-2xl mx-auto px-6 md:px-12 grid md:grid-cols-2 gap-12 items-center w-full">

        {{-- Left --}}
        <div class="max-w-2xl">
            <span class="inline-block px-3 py-1 bg-[#fda77d] text-[#351000] text-[10px] uppercase tracking-[0.2em] font-bold rounded-full mb-6">
                🌍 Actualité Cameroun & Innovation
            </span>
            <h1 class="text-5xl md:text-[60px] font-headline font-black text-[#922225] leading-[1.1] mb-6">
                L'actualité qui vous ressemble
            </h1>
            <p class="text-lg text-[#584140] max-w-lg mb-8 leading-relaxed">
                Le Cameroun sous toutes ses facettes — économie, société, technologie.
            </p>
            <div class="flex items-center bg-white/70 backdrop-blur-sm rounded-xl p-2 max-w-md shadow-sm border border-[#dfbfbd]/30">
                <span class="material-symbols-outlined px-3 text-[#8b716f]">search</span>
                <input class="bg-transparent border-none focus:ring-0 w-full text-sm font-medium outline-none"
                       placeholder="Rechercher un article..." type="text"/>
                <button class="bg-[#922225] text-white px-6 py-2 rounded-lg font-bold text-sm hover:brightness-110 transition-all">
                    Découvrir
                </button>
            </div>
        </div>

        {{-- Right decorative card --}}
        <div class="hidden md:block relative">
            <div class="relative w-[380px] h-[280px] bg-white rounded-xl shadow-[0_20px_50px_rgba(179,58,58,0.1)] rotate-3 p-4 border border-[#dfbfbd]/20">
               <img src="https://www.image2url.com/r2/default/images/1776601704294-0755c9e3-956d-4fd8-9db9-b1b519f68a39.jpg"
     alt="Actualité Cameroun"
     class="w-full h-full object-cover rounded-lg"/>
                <div class="absolute -bottom-6 -left-6 bg-[#922225] p-6 rounded-xl shadow-xl -rotate-6">
                    <span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED ARTICLE --}}
@if($posts->count() > 0)
<section class="py-20 px-6 md:px-12 max-w-screen-2xl mx-auto">
    <div class="flex items-end justify-between mb-12">
        <div>
            <h2 class="text-3xl font-headline font-bold text-[#1d1b19] italic mb-2">À la une</h2>
            <div class="h-1 w-20 bg-[#B33A3A]"></div>
        </div>
    </div>

    @php $featured = $posts->first(); @endphp
    <article class="flex flex-col md:flex-row gap-0 rounded-xl overflow-hidden bg-white shadow-[0_2px_16px_rgba(179,58,58,0.07)]">
        <div class="md:w-[58%] h-[400px] md:h-auto overflow-hidden">
            @if($featured->image)
                <img src="{{ $featured->image }}"
                     alt="{{ $featured->title }}"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"/>
            @else
                <div class="w-full h-full bg-gradient-to-br from-[#F5F0EB] to-[#fda77d]/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#B33A3A] text-8xl opacity-30">article</span>
                </div>
            @endif
        </div>
        <div class="md:w-[42%] p-8 md:p-12 flex flex-col justify-center bg-white relative">
            <span class="text-[#B33A3A] font-bold text-xs uppercase tracking-widest mb-4">
                {{ $featured->category->name }}
            </span>
            <h3 class="text-4xl font-headline font-black mb-6 leading-tight text-[#1d1b19]">
                {{ $featured->title }}
            </h3>
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr($featured->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold">{{ $featured->user->name }}</p>
                    <p class="text-xs text-[#584140] italic">{{ $featured->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <p class="text-[#584140] mb-8 line-clamp-3">
                {{ Str::limit($featured->body, 200) }}
            </p>
            <a href="{{ route('posts.show', $featured) }}"
               class="inline-flex items-center gap-2 text-[#B33A3A] font-bold group">
                Lire la suite
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </article>
</section>
@endif

{{-- ARTICLES GRID --}}
<section class="py-20 bg-[#f2ede8]">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-2xl font-headline font-bold text-[#1d1b19]">Dernières publications</h2>
                <div class="h-1 w-12 bg-[#B33A3A] mt-2"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($posts->skip(1) as $post)
            <article class="bg-white rounded-xl overflow-hidden shadow-[0_2px_16px_rgba(179,58,58,0.07)] flex flex-col group hover:shadow-[0_6px_24px_rgba(179,58,58,0.13)] hover:-translate-y-1 transition-all duration-300">
                <div class="relative h-56 overflow-hidden">
                    @if($post->image)
                        <img src="{{ $post->image }}"
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
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] text-[#584140] font-medium uppercase tracking-widest">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                        <div class="flex items-center gap-1 text-[#B33A3A]">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">favorite</span>
                            <span class="text-xs font-bold">{{ $post->likes->count() }}</span>
                        </div>
                    </div>
                    <h4 class="text-xl font-headline font-bold mb-3 group-hover:text-[#B33A3A] transition-colors line-clamp-2">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h4>
                    <p class="text-sm text-[#584140] mb-4 line-clamp-2 flex-grow">
                        {{ Str::limit($post->body, 120) }}
                    </p>
                    <div class="flex flex-wrap gap-2 mt-auto">
                        @foreach($post->tags as $tag)
                            <span class="text-[10px] font-bold text-[#8f4c2a] bg-[#ffdbcc]/50 px-2 py-0.5 rounded">
                                #{{ strtoupper($tag->name) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-20">
                <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-30">article</span>
                <p class="text-[#584140] mt-4">Aucun article publié pour le moment.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center mt-20 gap-2">
            {{ $posts->links() }}
        </div>
    </div>
</section>

@endsection