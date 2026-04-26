@extends('layouts.app')
@section('content')
<div class="max-w-[1200px] mx-auto px-6 py-16">
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <span class="w-8 h-[3px] bg-[#B33A3A]"></span>
            <span class="font-news uppercase tracking-widest text-xs text-[#B33A3A] font-bold">
                Les plus populaires
            </span>
        </div>
        <h1 class="font-headline text-4xl font-bold text-[#1d1b19]">Tendances</h1>
        <p class="text-[#584140] mt-2">Les articles les plus aimés par notre communauté.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($posts as $post)
        <article class="bg-white rounded-xl overflow-hidden shadow-[0_2px_16px_rgba(179,58,58,0.07)] flex flex-col group hover:shadow-[0_6px_24px_rgba(179,58,58,0.13)] hover:-translate-y-1 transition-all duration-300">
            <div class="relative h-48 overflow-hidden">
                @if($post->image)
                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#F5F0EB] to-[#fda77d]/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#B33A3A] text-5xl opacity-30">article</span>
                    </div>
                @endif
                <span class="absolute top-4 left-4 bg-[#B33A3A] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $post->category->name }}
                </span>
                <span class="absolute top-4 right-4 bg-white/90 text-[#B33A3A] text-[10px] font-bold px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">favorite</span>
                    {{ $post->likes_count }}
                </span>
            </div>
            <div class="p-5 flex-grow flex flex-col">
                <h2 class="font-headline text-lg font-bold text-[#1d1b19] mb-2 group-hover:text-[#B33A3A] transition-colors line-clamp-2">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-[#584140] line-clamp-2 flex-grow">
                    {{ Str::limit($post->body, 120) }}
                </p>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-[#E2D9D0]">
                    <span class="text-xs text-[#584140]">Par {{ $post->user->name }}</span>
                    <a href="{{ route('posts.show', $post) }}"
                       class="text-xs font-bold text-[#B33A3A] hover:underline">
                        Lire →
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-20">
            <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">trending_up</span>
            <p class="text-[#584140] mt-4 font-headline text-xl">Aucune tendance pour le moment</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection