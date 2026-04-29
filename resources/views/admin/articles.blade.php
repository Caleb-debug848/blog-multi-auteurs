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
        <div class="flex items-center gap-4 flex-wrap">
            <h2 class="text-2xl md:text-4xl font-headline text-[#1d1b19] font-bold">Articles en attente</h2>
            <span class="bg-[#fda77d] text-[#773a19] px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                {{ $posts->total() }} article(s)
            </span>
        </div>
    </div>
    <a href="{{ route('posts.create') }}"
       class="bg-[#B33A3A] text-white px-5 py-2.5 rounded-lg font-medium text-sm transition-all active:scale-95 flex items-center gap-2 shadow-lg w-fit">
        <span class="material-symbols-outlined text-sm">add</span>
        Rédiger
    </a>
</header>

{{-- Desktop Table --}}
<div class="hidden md:block bg-white rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)] overflow-hidden">
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
                <td class="px-6 py-5">
                    <div class="w-[60px] h-[60px] rounded-lg overflow-hidden bg-[#ece7e2]">
                        @if($post->image)
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-[#B33A3A] opacity-30">article</span>
                            </div>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-5">
                    <h4 class="font-headline font-bold text-[#1d1b19] mb-1 text-lg leading-tight group-hover:text-[#B33A3A] transition-colors">
                        {{ Str::limit($post->title, 50) }}
                    </h4>
                    <span class="inline-block bg-[#ffdbcc]/50 text-[#773a19] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">
                        {{ $post->category->name }}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-[#1d1b19]">{{ $post->user->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-5 text-sm text-[#8b716f]">{{ $post->created_at->diffForHumans() }}</td>
                <td class="px-6 py-5">
                    <div class="flex justify-end items-center gap-2">
                        <form method="POST" action="{{ route('admin.approvePost', $post) }}">
                            @csrf
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm" title="Approuver">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.rejectPost', $post) }}">
                            @csrf
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Rejeter">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                            </button>
                        </form>
                        <a href="{{ route('posts.edit', $post) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg text-[#8b716f] hover:bg-[#ece7e2] transition-all" title="Modifier">
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
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="bg-[#f8f3ee]/50 px-6 py-4 flex items-center justify-between">
        <p class="text-xs text-[#8b716f] font-medium">
            Affichage de {{ $posts->firstItem() ?? 0 }} à {{ $posts->lastItem() ?? 0 }} sur {{ $posts->total() }} articles
        </p>
        {{ $posts->links() }}
    </div>
</div>

{{-- Mobile Cards --}}
<div class="md:hidden space-y-4">
    @forelse($posts as $post)
    <div class="bg-white rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)] overflow-hidden">

        {{-- Image + Title --}}
        <div class="flex gap-4 p-4">
            <div class="w-16 h-16 rounded-lg overflow-hidden bg-[#ece7e2] flex-shrink-0">
                @if($post->image)
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover"/>
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#B33A3A] opacity-30">article</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="font-headline font-bold text-[#1d1b19] text-base leading-tight mb-1 line-clamp-2">
                    {{ $post->title }}
                </h4>
                <span class="inline-block bg-[#ffdbcc]/50 text-[#773a19] px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider mb-1">
                    {{ $post->category->name }}
                </span>
                <p class="text-xs text-[#8b716f]">
                    Par {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="border-t border-[#f2ede8] px-4 py-3 flex gap-3">
            <form method="POST" action="{{ route('admin.approvePost', $post) }}" class="flex-1">
                @csrf
                <button class="w-full py-2.5 bg-emerald-500 text-white rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:bg-emerald-600 transition-all">
                    <span class="material-symbols-outlined text-sm">check</span>
                    Approuver
                </button>
            </form>
            <form method="POST" action="{{ route('admin.rejectPost', $post) }}" class="flex-1">
                @csrf
                <button class="w-full py-2.5 bg-red-50 text-red-600 border border-red-200 rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:bg-red-500 hover:text-white transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Rejeter
                </button>
            </form>
            <a href="{{ route('posts.edit', $post) }}"
               class="px-3 py-2.5 bg-[#f8f3ee] text-[#8b716f] rounded-lg flex items-center justify-center hover:bg-[#ece7e2] transition-all">
                <span class="material-symbols-outlined text-sm">edit_note</span>
            </a>
        </div>
    </div>
    @empty
    <div class="text-center py-20 bg-white rounded-xl">
        <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">done_all</span>
        <p class="text-[#584140] mt-4 font-headline text-xl">Aucun article en attente</p>
    </div>
    @endforelse

    {{-- Pagination mobile --}}
    <div class="flex justify-center mt-4">
        {{ $posts->links() }}
    </div>
</div>

@endsection