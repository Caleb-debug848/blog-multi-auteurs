@extends('layouts.app')
@section('content')
<div class="max-w-[1200px] mx-auto px-6 py-16">
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <span class="w-8 h-[3px] bg-[#B33A3A]"></span>
            <span class="font-news uppercase tracking-widest text-xs text-[#B33A3A] font-bold">
                Explorer
            </span>
        </div>
        <h1 class="font-headline text-4xl font-bold text-[#1d1b19]">Catégories</h1>
        <p class="text-[#584140] mt-2">Explorez nos articles par thématique.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
           class="bg-white rounded-xl p-8 border border-[#E2D9D0] hover:border-[#B33A3A] hover:shadow-[0_6px_24px_rgba(179,58,58,0.13)] hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-[#B33A3A]/10 flex items-center justify-center mb-4 group-hover:bg-[#B33A3A] transition-colors">
                <span class="material-symbols-outlined text-[#B33A3A] group-hover:text-white transition-colors"
                      style="font-variation-settings:'FILL' 1;">folder</span>
            </div>
            <h2 class="font-headline text-xl font-bold text-[#1d1b19] mb-2 group-hover:text-[#B33A3A] transition-colors">
                {{ $category->name }}
            </h2>
            <p class="text-[#8b716f] text-sm">
                {{ $category->posts_count }} article(s)
            </p>
        </a>
        @endforeach
    </div>
</div>
@endsection