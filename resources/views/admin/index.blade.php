@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="mb-10 flex justify-between items-end">
    <div>
        <h2 class="font-headline text-[38px] text-[#1d1b19] leading-tight">Vue d'ensemble</h2>
        <p class="text-stone-500 font-medium">Bienvenue dans votre espace de gestion éditoriale.</p>
    </div>
    <a href="{{ route('posts.create') }}"
       class="bg-[#B33A3A] text-white px-6 py-2.5 rounded-lg font-medium shadow-lg hover:opacity-90 transition-all flex items-center gap-2">
        <span class="material-symbols-outlined text-xl">add</span>
        Nouvel Article
    </a>
</header>

{{-- Stats Row --}}
<section class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">

    <div class="bg-white p-6 rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
        <div class="w-12 h-12 bg-[#B33A3A]/10 text-[#B33A3A] rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">article</span>
        </div>
        <p class="text-stone-500 text-xs font-bold uppercase tracking-widest mb-1">Articles Publiés</p>
        <h3 class="font-headline text-3xl text-[#1d1b19]">{{ $totalPosts }}</h3>
        <p class="text-stone-400 text-xs font-semibold mt-2">{{ $pendingPosts }} en attente</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
        <div class="w-12 h-12 bg-[#B33A3A]/10 text-[#B33A3A] rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">pending_actions</span>
        </div>
        <p class="text-stone-500 text-xs font-bold uppercase tracking-widest mb-1">En attente</p>
        <h3 class="font-headline text-3xl text-[#1d1b19]">{{ $pendingPosts }}</h3>
        <p class="text-[#B33A3A] text-xs font-semibold mt-2">À approuver</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
        <div class="w-12 h-12 bg-[#B33A3A]/10 text-[#B33A3A] rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">forum</span>
        </div>
        <p class="text-stone-500 text-xs font-bold uppercase tracking-widest mb-1">Commentaires</p>
        <h3 class="font-headline text-3xl text-[#1d1b19]">{{ $pendingComments }}</h3>
        <p class="text-[#B33A3A] text-xs font-semibold mt-2 flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">priority_high</span>
            À modérer
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.05)]">
        <div class="w-12 h-12 bg-[#B33A3A]/10 text-[#B33A3A] rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">group</span>
        </div>
        <p class="text-stone-500 text-xs font-bold uppercase tracking-widest mb-1">Utilisateurs</p>
        <h3 class="font-headline text-3xl text-[#1d1b19]">{{ $totalUsers }}</h3>
        <p class="text-stone-400 text-xs font-semibold mt-2">Inscrits</p>
    </div>

</section>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    {{-- Recent Activity --}}
    <section class="lg:col-span-8 bg-white rounded-xl p-8 shadow-[0_2px_16px_rgba(179,58,58,0.03)]">
        <div class="flex justify-between items-center mb-8">
            <h4 class="font-headline text-2xl text-[#1d1b19]">Activité Récente</h4>
        </div>
        <div class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[1px] before:bg-stone-200">

            @foreach($recentPosts as $post)
            <div class="relative pl-8">
                <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-[#B33A3A] border-4 border-white"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[#1d1b19] font-semibold">
                            Article {{ $post->status === 'published' ? 'publié' : 'soumis' }} :
                            "{{ Str::limit($post->title, 50) }}"
                        </p>
                        <p class="text-stone-500 text-sm mt-1">
                            Par <span class="font-medium text-stone-700">{{ $post->user->name }}</span>
                            dans <span class="text-[#B33A3A]">{{ $post->category->name }}</span>
                        </p>
                    </div>
                    <span class="text-stone-400 text-xs font-medium whitespace-nowrap ml-4">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach

            @foreach($recentComments as $comment)
            <div class="relative pl-8">
                <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-amber-500 border-4 border-white"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[#1d1b19] font-semibold">Nouveau commentaire en attente</p>
                        <p class="text-stone-500 text-sm mt-1">
                            Par <span class="font-medium text-stone-700">{{ $comment->user->name }}</span>
                            sur "{{ Str::limit($comment->post->title, 40) }}"
                        </p>
                    </div>
                    <span class="text-stone-400 text-xs font-medium whitespace-nowrap ml-4">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @endforeach

            @if($recentPosts->isEmpty() && $recentComments->isEmpty())
            <p class="text-stone-400 pl-8">Aucune activité récente.</p>
            @endif

        </div>
    </section>

    {{-- Quick Actions --}}
    <aside class="lg:col-span-4 space-y-6">
        <div class="bg-white p-6 rounded-xl border border-stone-200/50 shadow-[0_2px_16px_rgba(179,58,58,0.03)]">
            <h4 class="font-headline text-xl text-[#1d1b19] mb-6">Actions Rapides</h4>
            <div class="space-y-3">
                <a href="{{ route('admin.articles') }}"
                   class="w-full bg-emerald-600/10 text-emerald-700 hover:bg-emerald-600/20 py-3 px-4 rounded-lg flex items-center justify-between group transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">done_all</span>
                        <span class="font-semibold">Articles en attente</span>
                    </div>
                    <span class="material-symbols-outlined text-lg opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                </a>
                <a href="{{ route('admin.comments') }}"
                   class="w-full bg-[#B33A3A]/10 text-[#B33A3A] hover:bg-[#B33A3A]/20 py-3 px-4 rounded-lg flex items-center justify-between group transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">gavel</span>
                        <span class="font-semibold">Modérer commentaires</span>
                    </div>
                    <span class="material-symbols-outlined text-lg opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                </a>
                <a href="{{ route('admin.users') }}"
                   class="w-full bg-[#fda77d]/20 text-[#8f4c2a] hover:bg-[#fda77d]/30 py-3 px-4 rounded-lg flex items-center justify-between group transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined">manage_accounts</span>
                        <span class="font-semibold">Gérer utilisateurs</span>
                    </div>
                    <span class="material-symbols-outlined text-lg opacity-0 group-hover:opacity-100 transition-opacity">chevron_right</span>
                </a>
            </div>
        </div>
    </aside>

</div>

@endsection