@extends('layouts.app')

@section('content')

{{-- READING PROGRESS BAR --}}
<div class="fixed top-[68px] left-0 h-[3px] bg-[#B33A3A] z-50 transition-all duration-300" 
     id="reading-progress" style="width: 0%"></div>

{{-- HERO BANNER --}}
<section class="relative w-full h-[460px] overflow-hidden">
    @if($post->image)
        <img src="{{ $post->image }}"
             alt="{{ $post->title }}"
             class="w-full h-full object-cover"/>
    @else
        <div class="w-full h-full bg-gradient-to-br from-[#F5F0EB] to-[#fda77d]/30"></div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

    <div class="absolute bottom-0 left-0 w-full p-8 md:p-12">
        <div class="max-w-[760px] mx-auto text-white">
            <span class="font-news text-xs uppercase tracking-[0.2em] bg-[#B33A3A] px-3 py-1 mb-4 inline-block">
                {{ $post->category->name }}
            </span>
            <h1 class="font-headline text-4xl md:text-6xl leading-tight mb-4">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-4 text-stone-200 italic text-sm">
                <span>Par {{ $post->user->name }}</span>
                <span class="w-1 h-1 bg-white rounded-full"></span>
                <span>{{ $post->created_at->format('d M Y') }}</span>
                <span class="w-1 h-1 bg-white rounded-full"></span>
                <span>{{ ceil(str_word_count($post->body) / 200) }} min de lecture</span>
            </div>
        </div>
    </div>
</section>

<div class="max-w-[1200px] mx-auto px-6 flex flex-col items-center">

    {{-- FLOATING LIKE BUTTON --}}
    <div class="fixed right-8 top-1/2 -translate-y-1/2 hidden lg:flex flex-col gap-4 items-center z-40">
        @auth
        <form method="POST" action="{{ route('posts.like', $post) }}">
            @csrf
            <button class="w-14 h-14 rounded-full bg-white shadow-lg flex flex-col items-center justify-center text-[#B33A3A] hover:bg-[#B33A3A] hover:text-white transition-all duration-300 group">
                <span class="material-symbols-outlined"
                      style="font-variation-settings: 'FILL' 1;">favorite</span>
            </button>
        </form>
        @endauth
        <span class="text-xs font-news uppercase tracking-widest text-stone-400">
            {{ $post->likes->count() }}
        </span>
        <button onclick="sharePost()"
        class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-stone-500 hover:text-[#B33A3A] transition-colors">
    <span class="material-symbols-outlined">share</span>
</button>
    </div>

    {{-- ARTICLE BODY --}}
    <article class="w-full max-w-[760px] py-16" id="article-content">

        {{-- Tags --}}
        <div class="flex flex-wrap gap-2 mb-10">
            @foreach($post->tags as $tag)
                <span class="text-[10px] font-bold text-[#8f4c2a] bg-[#ffdbcc]/50 px-3 py-1 rounded-full uppercase tracking-wider">
                    #{{ $tag->name }}
                </span>
            @endforeach
        </div>

        {{-- Intro quote --}}
        <div class="font-headline text-xl md:text-2xl leading-relaxed text-stone-600 mb-12 border-l-4 border-[#E8956D] pl-8 italic">
            {{ Str::limit($post->body, 200) }}
        </div>

        {{-- Body --}}
        <div class="space-y-6 text-lg leading-relaxed text-[#1d1b19]">
           {!! \League\CommonMark\CommonMarkConverter::class && class_exists('\League\CommonMark\CommonMarkConverter')
    ? (new \League\CommonMark\CommonMarkConverter())->convert($post->body)
    : nl2br(e($post->body)) !!}
        </div>

        {{-- Edit/Delete bar (author/admin) --}}
        @can('update', $post)
        <div class="fixed bottom-0 left-0 w-full bg-white border-t border-[#E2D9D0] px-8 py-4 flex justify-between items-center z-40 shadow-lg">
            <a href="{{ route('posts.edit', $post) }}"
               class="inline-flex items-center gap-2 bg-[#2E7D4F] text-white px-6 py-2 rounded-lg font-bold text-sm hover:opacity-90 transition-all">
                <span class="material-symbols-outlined text-sm">edit</span>
                Modifier l'article
            </a>
            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                @csrf @method('DELETE')
                <button class="inline-flex items-center gap-2 border-2 border-red-500 text-red-500 px-6 py-2 rounded-lg font-bold text-sm hover:bg-red-50 transition-all">
                    <span class="material-symbols-outlined text-sm">delete</span>
                    Supprimer
                </button>
            </form>
        </div>
        @endcan

        {{-- AUTHOR BOX --}}
        <section class="mt-20 p-8 bg-[#f8f3ee] border-l-8 border-[#B33A3A] flex gap-6 items-center rounded-r-xl">
            <div class="w-16 h-16 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-2xl flex-shrink-0">
                {{ strtoupper(substr($post->user->name, 0, 1)) }}
            </div>
            <div>
                <h4 class="font-headline text-xl mb-1 text-[#1d1b19]">
                    {{ $post->user->name }}
                </h4>
                <p class="text-xs uppercase tracking-wider text-[#B33A3A] font-bold mb-2">
                    {{ ucfirst($post->user->role) }}
                </p>
                <p class="text-stone-600 italic text-sm">
                    Auteur sur Blog Multi-auteurs
                </p>
            </div>
        </section>

        {{-- COMMENTS SECTION --}}
        <section class="mt-24">
            <h3 class="font-headline text-2xl mb-10 border-b border-[#dfbfbd]/30 pb-4">
                Commentaires ({{ $post->comments->where('approved', true)->count() }})
            </h3>

            <div class="space-y-8">

                {{-- Approved comments --}}
                @foreach($post->comments->where('approved', true) as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <span class="font-bold text-sm">{{ $comment->user->name }}</span>
                            <span class="text-xs text-stone-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                            @if(auth()->check() && (auth()->user()->role === 'admin'))
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}"
                                      class="ml-auto">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-400 hover:text-red-600">
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="text-stone-600 leading-relaxed">{{ $comment->body }}</p>
                    </div>
                </div>
                @endforeach

                {{-- NOT LOGGED IN --}}
                @guest
                <div class="bg-[#f2ede8]/60 rounded-xl p-10 flex flex-col items-center text-center gap-6 border-2 border-dashed border-[#dfbfbd]/50">
                    <div class="w-16 h-16 rounded-full bg-[#B33A3A]/10 flex items-center justify-center text-[#B33A3A]">
                        <span class="material-symbols-outlined text-4xl"
                              style="font-variation-settings: 'FILL' 1;">lock</span>
                    </div>
                    <div>
                        <h4 class="font-headline text-2xl mb-2">Rejoignez la conversation</h4>
                        <p class="text-stone-500">
                            Connectez-vous ou créez un compte pour laisser un commentaire.
                        </p>
                    </div>
                    <div class="flex gap-4 w-full max-w-sm">
                        <a href="{{ route('login') }}"
                           class="flex-1 bg-[#B33A3A] text-white font-news uppercase tracking-widest text-xs py-4 rounded-lg shadow-md hover:opacity-90 transition-all text-center">
                            Se connecter
                        </a>
                        <a href="{{ route('register') }}"
                           class="flex-1 border-2 border-[#B33A3A] text-[#B33A3A] font-news uppercase tracking-widest text-xs py-4 rounded-lg hover:bg-[#B33A3A]/5 transition-all text-center">
                            S'inscrire
                        </a>
                    </div>
                </div>
                @endguest

                {{-- LOGGED IN COMMENT FORM --}}
                @auth
                <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-8">
                    @csrf
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <textarea name="body" rows="4"
                                placeholder="Partagez votre avis sur cet article..."
                                class="w-full border border-[#E2D9D0] rounded-xl p-4 text-sm focus:border-[#B33A3A] focus:ring-1 focus:ring-[#B33A3A] outline-none resize-none bg-white"></textarea>
                            <div class="flex justify-end mt-3">
                                <button class="bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold text-sm hover:opacity-90 transition-all">
                                    Publier mon commentaire
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                @endauth

            </div>
        </section>

    </article>
</div>

{{-- Reading Progress Script --}}
<script>
    window.addEventListener('scroll', () => {
        const article = document.getElementById('article-content');
        const progress = document.getElementById('reading-progress');
        if (!article || !progress) return;
        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const scrolled = window.scrollY - articleTop;
        const percentage = Math.min(Math.max((scrolled / articleHeight) * 100, 0), 100);
        progress.style.width = percentage + '%';
    });
</script>

<script>
function sharePost() {
    if (navigator.share) {
        navigator.share({
            title: '{{ addslashes($post->title) }}',
            text: '{{ addslashes(Str::limit($post->body, 100)) }}',
            url: window.location.href,
        });
    } else {
        // Fallback : copier le lien
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Lien copié dans le presse-papiers !');
        });
    }
}
</script>

@endsection