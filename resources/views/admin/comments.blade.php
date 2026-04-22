@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="mb-12">
    <div class="flex items-end gap-4 mb-2">
        <h2 class="text-4xl font-headline font-bold text-[#1d1b19] tracking-tight">
            Modération des commentaires
        </h2>
        <span class="bg-[#B33A3A] text-white px-3 py-1 rounded-full text-xs font-bold tracking-widest uppercase mb-2">
            {{ $comments->total() }} en attente
        </span>
    </div>
    <p class="text-[#584140] max-w-2xl italic">
        Gérez les interactions de votre communauté. Assurez un dialogue respectueux et constructif.
    </p>
</header>

{{-- Comments List --}}
<div class="flex flex-col gap-6">
    @forelse($comments as $comment)
    <div class="bg-white rounded-xl p-6 flex flex-col md:flex-row gap-6 items-start shadow-[0_2px_16px_rgba(179,58,58,0.07)] border-l-4 border-[#B33A3A]">

        {{-- Avatar --}}
        <div class="flex-shrink-0">
            <div class="w-14 h-14 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-xl">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
        </div>

        {{-- Content --}}
        <div class="flex-1 space-y-3">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-bold text-lg text-[#1d1b19]">{{ $comment->user->name }}</h4>
                    <p class="text-xs text-[#584140] uppercase tracking-wide">
                        {{ $comment->created_at->diffForHumans() }} •
                        Sur <span class="text-[#8f4c2a] font-medium italic">
                            "{{ Str::limit($comment->post->title, 40) }}"
                        </span>
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('admin.approveComment', $comment) }}">
                        @csrf
                        <button class="w-10 h-10 flex items-center justify-center rounded-full bg-green-50 text-green-700 hover:bg-green-600 hover:text-white transition-all active:scale-95"
                                title="Approuver">
                            <span class="material-symbols-outlined">check_circle</span>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                        @csrf @method('DELETE')
                        <button class="w-10 h-10 flex items-center justify-center rounded-full bg-red-50 text-red-700 hover:bg-red-600 hover:text-white transition-all active:scale-95"
                                title="Supprimer">
                            <span class="material-symbols-outlined">cancel</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Comment body --}}
            <p class="text-[#1d1b19] leading-relaxed italic border-l-2 border-[#dfbfbd] pl-4 py-1">
                "{{ $comment->body }}"
            </p>

            {{-- Link to article --}}
            <a href="{{ route('posts.show', $comment->post) }}"
               class="inline-flex items-center gap-1 text-xs text-[#B33A3A] hover:underline font-bold uppercase tracking-wider">
                <span class="material-symbols-outlined text-sm">open_in_new</span>
                Voir l'article
            </a>
        </div>

    </div>
    @empty
    <div class="text-center py-20 bg-white rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
        <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">forum</span>
        <p class="text-[#584140] mt-4 font-headline text-xl">Aucun commentaire en attente</p>
        <p class="text-[#8b716f] text-sm mt-2">Tous les commentaires ont été modérés.</p>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<footer class="mt-16 pt-8 border-t border-[#ece7e2] flex flex-col md:flex-row justify-between items-center gap-4">
    <p class="text-[#584140] text-sm uppercase tracking-widest">
        Affichage de {{ $comments->firstItem() ?? 0 }} sur {{ $comments->total() }} commentaires
    </p>
    {{ $comments->links() }}
</footer>

{{-- Decorative --}}
<div class="fixed bottom-8 right-8 opacity-5 pointer-events-none select-none">
    <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">forest</span>
</div>

@endsection