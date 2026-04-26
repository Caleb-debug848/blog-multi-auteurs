@extends('layouts.app')
@section('content')
<div class="max-w-[1200px] mx-auto px-6 py-16">
    <div class="mb-10">
        <h1 class="font-headline text-4xl font-bold text-[#1d1b19] mb-2">
            Résultats pour "{{ $query }}"
        </h1>
        <p class="text-[#584140]">{{ $posts->total() }} article(s) trouvé(s)</p>
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
            </div>
            <div class="p-5 flex-grow flex flex-col">
                <h2 class="font-headline text-lg font-bold text-[#1d1b19] mb-2 group-hover:text-[#B33A3A] transition-colors line-clamp-2">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-[#584140] line-clamp-2 flex-grow">
                    {{ Str::limit($post->body, 120) }}
                </p>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-[#E2D9D0]">
                    <span class="text-xs text-[#584140]">{{ $post->created_at->format('d M Y') }}</span>
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
            <p class="text-[#8b716f] text-sm mt-2">Essayez avec d'autres mots-clés.</p>
            <a href="{{ route('posts.index') }}"
               class="inline-block mt-6 bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-all">
                Retour à l'accueil
            </a>
        </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $posts->appends(['q' => $query])->links() }}
    </div>
</div>
@endsection