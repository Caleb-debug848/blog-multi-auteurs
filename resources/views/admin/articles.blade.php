@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <nav class="flex items-center gap-2 text-[#8b716f] text-xs uppercase tracking-widest font-bold mb-4">
            <span>Admin</span>
            <span class="material-symbols-outlined text-[10px]">chevron_right</span>
            <span class="text-[#B33A3A]">Articles</span>
        </nav>
        <div class="flex items-center gap-4">
            <h2 class="text-4xl font-headline text-[#1d1b19] font-bold">Articles en attente</h2>
            <span class="bg-[#fda77d] text-[#773a19] px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                {{ $posts->total() }} article(s)
            </span>
        </div>
    </div>
    <a href="{{ route('posts.create') }}"
       class="bg-[#B33A3A] text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-all active:scale-95 flex items-center gap-2 shadow-lg">
        <span class="material-symbols-outlined text-sm">add</span>
        Rédiger
    </a>
</header>

{{-- Table Card --}}
<div class="bg-white rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)] overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-[#f8f3ee]/50">
                <th class="px-6 py-4 text-[11px] uppercase tracking-widest text-[#8b716f] font-bold">Aperçu</th>
                <th class="px-6 py-4 text-[11px] uppercase tracking-widest text-[#8b716f] font-bold">Détails</th>
                <th class="px-6 py-4 text-[11px] uppercase tracking-widest text-[#8b716f] font-bold">Auteur</th>
                <th class="px-6 py-4 text-[11px] uppercase tracking-widest text-[#8b716f] font-bold">Soumis</th>
                <th class="px-6 py-4 text-right text-[11px] uppercase tracking-widest text-[#8b716f] font-bold">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#f2ede8]">
            @forelse($posts as $post)
            <tr class="hover:bg-[#f8f3ee]/30 transition-colors group">

                {{-- Thumbnail --}}
                <td class="px-6 py-5">
                    <div class="w-[60px] h-[60px] rounded-lg overflow-hidden bg-[#ece7e2]">
                        @if($post->image)
                            <img src="{{ $post->image }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-[#B33A3A] opacity-30">article</span>
                            </div>
                        @endif
                    </div>
                </td>

                {{-- Details --}}
                <td class="px-6 py-5">
                    <h4 class="font-headline font-bold text-[#1d1b19] mb-1 text-lg leading-tight group-hover:text-[#B33A3A] transition-colors">
                        {{ Str::limit($post->title, 50) }}
                    </h4>
                    <span class="inline-block bg-[#ffdbcc]/50 text-[#773a19] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                        {{ $post->category->name }}
                    </span>
                </td>

                {{-- Author --}}
                <td class="px-6 py-5">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-[#1d1b19]">{{ $post->user->name }}</span>
                    </div>
                </td>

                {{-- Date --}}
                <td class="px-6 py-5 text-sm text-[#8b716f]">
                    {{ $post->created_at->diffForHumans() }}
                </td>

                {{-- Actions --}}
                <td class="px-6 py-5">
                    <div class="flex justify-end items-center gap-2">
                        {{-- Approuver --}}
                        <form method="POST" action="{{ route('admin.approvePost', $post) }}">
                            @csrf
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm"
                                    title="Approuver">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </button>
                        </form>

                        {{-- Rejeter --}}
                        <form method="POST" action="{{ route('admin.rejectPost', $post) }}">
                            @csrf
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                    title="Rejeter">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                            </button>
                        </form>

                        {{-- Modifier --}}
                        <a href="{{ route('posts.edit', $post) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg text-[#8b716f] hover:bg-[#ece7e2] transition-all"
                           title="Modifier">
                            <span class="material-symbols-outlined text-[20px]">edit_note</span>
                        </a>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-20 text-center">
                    <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">done_all</span>
                    <p class="text-[#584140] mt-4 font-headline text-xl">Aucun article en attente</p>
                    <p class="text-[#8b716f] text-sm mt-2">Tous les articles ont été traités.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="bg-[#f8f3ee]/50 px-6 py-4 flex items-center justify-between">
        <p class="text-xs text-[#8b716f] font-medium">
            Affichage de {{ $posts->firstItem() ?? 0 }} à {{ $posts->lastItem() ?? 0 }}
            sur {{ $posts->total() }} articles
        </p>
        <div class="flex gap-1">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection