@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
    <div>
        <nav class="flex items-center gap-2 text-xs uppercase tracking-widest text-[#584140] mb-4">
            <span>Admin</span>
            <span class="material-symbols-outlined text-[10px]">chevron_right</span>
            <span class="text-[#B33A3A] font-bold">Utilisateurs</span>
        </nav>
        <h2 class="font-headline text-4xl font-bold text-[#1d1b19]">Gestion des utilisateurs</h2>
        <p class="text-[#584140] mt-2 max-w-md">
            Supervisez les membres, gérez les permissions et suivez les nouvelles inscriptions.
        </p>
    </div>
</header>

{{-- Stats Row --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="bg-[#f8f3ee] p-6 rounded-xl shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-[#B33A3A]/10 flex items-center justify-center">
            <span class="material-symbols-outlined text-[#B33A3A]">groups</span>
        </div>
        <div>
            <p class="text-xs uppercase tracking-wider text-[#8b716f] font-bold">Total</p>
            <p class="text-2xl font-headline font-bold text-[#1d1b19]">{{ $users->total() }}</p>
        </div>
    </div>

    <div class="bg-[#f8f3ee] p-6 rounded-xl shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-[#8f4c2a]/10 flex items-center justify-center">
            <span class="material-symbols-outlined text-[#8f4c2a]">edit_note</span>
        </div>
        <div>
            <p class="text-xs uppercase tracking-wider text-[#8b716f] font-bold">Auteurs</p>
            <p class="text-2xl font-headline font-bold text-[#1d1b19]">
                {{ \App\Models\User::where('role', 'author')->count() }}
            </p>
        </div>
    </div>

    <div class="bg-[#f8f3ee] p-6 rounded-xl shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-[#005650]/10 flex items-center justify-center">
            <span class="material-symbols-outlined text-[#005650]">how_to_reg</span>
        </div>
        <div>
            <p class="text-xs uppercase tracking-wider text-[#8b716f] font-bold">Lecteurs</p>
            <p class="text-2xl font-headline font-bold text-[#1d1b19]">
                {{ \App\Models\User::where('role', 'reader')->count() }}
            </p>
        </div>
    </div>

</div>

{{-- Users Table --}}
<div class="bg-white rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.07)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#f8f3ee]">
                    <th class="px-8 py-5 text-xs uppercase tracking-widest text-[#8b716f] font-bold">Utilisateur</th>
                    <th class="px-6 py-5 text-xs uppercase tracking-widest text-[#8b716f] font-bold">Email</th>
                    <th class="px-6 py-5 text-xs uppercase tracking-widest text-[#8b716f] font-bold">Rôle</th>
                    <th class="px-6 py-5 text-xs uppercase tracking-widest text-[#8b716f] font-bold">Inscription</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#f2ede8]">
                @forelse($users as $user)
                <tr class="hover:bg-[#fef8f3]/50 transition-colors">

                    {{-- User --}}
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#E8956D] flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-[#1d1b19]">{{ $user->name }}</p>
                                <p class="text-xs text-[#8b716f]">ID: #{{ $user->id }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td class="px-6 py-5 text-sm text-[#584140]">{{ $user->email }}</td>

                    {{-- Role Switcher --}}
                    <td class="px-6 py-5">
                        <div class="inline-flex bg-[#f2ede8] p-1 rounded-full border border-[#dfbfbd]/20">
                            @foreach(['admin' => 'Admin', 'author' => 'Auteur', 'reader' => 'Lecteur'] as $role => $label)
                                @if($user->role === $role)
                                    <span class="px-3 py-1 text-[10px] uppercase tracking-wider font-bold rounded-full bg-[#B33A3A] text-white">
                                        {{ $label }}
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('admin.updateUserRole', [$user, $role]) }}">
                                        @csrf
                                        <button class="px-3 py-1 text-[10px] uppercase tracking-wider font-bold rounded-full text-[#8b716f] hover:text-[#B33A3A] transition-colors">
                                            {{ $label }}
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </td>

                    {{-- Date --}}
                    <td class="px-6 py-5 text-sm text-[#584140]">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">group</span>
                        <p class="text-[#584140] mt-4 font-headline text-xl">Aucun utilisateur trouvé</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="bg-[#f8f3ee] px-8 py-6 flex items-center justify-between">
        <p class="text-xs text-[#8b716f] font-medium">
            Affichage de {{ $users->firstItem() ?? 0 }} à {{ $users->lastItem() ?? 0 }}
            sur {{ $users->total() }} membres
        </p>
        {{ $users->links() }}
    </div>
</div>

{{-- Permissions Legend --}}
<div class="mt-12 p-8 rounded-xl bg-[#f2ede8] border border-[#dfbfbd]/20 flex flex-col md:flex-row items-center justify-between gap-8">
    <div class="flex items-center gap-6">
        <div class="flex -space-x-3">
            <div class="w-12 h-12 rounded-full border-4 border-[#f2ede8] bg-[#B33A3A] flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
            </div>
            <div class="w-12 h-12 rounded-full border-4 border-[#f2ede8] bg-[#8f4c2a] flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-xl">edit_square</span>
            </div>
            <div class="w-12 h-12 rounded-full border-4 border-[#f2ede8] bg-[#005650] flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-xl">menu_book</span>
            </div>
        </div>
        <div>
            <h4 class="font-headline text-xl font-bold text-[#1d1b19]">Guide des Permissions</h4>
            <p class="text-sm text-[#584140]">Chaque rôle possède des droits spécifiques sur le contenu.</p>
        </div>
    </div>
    <div class="flex items-center gap-8 text-xs font-bold uppercase tracking-widest text-[#8b716f]">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#B33A3A]"></span>
            <span>Admin : Accès total</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#8f4c2a]"></span>
            <span>Auteur : Rédaction</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#005650]"></span>
            <span>Lecteur : Commentaire</span>
        </div>
    </div>
</div>

@endsection