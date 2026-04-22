@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="mb-12 flex justify-between items-end">
    <div>
        <nav class="flex gap-2 text-xs uppercase tracking-widest text-[#584140] font-medium mb-4">
            <span>Admin</span>
            <span class="opacity-30">/</span>
            <span class="text-[#B33A3A] font-bold">Catégories</span>
        </nav>
        <h2 class="text-4xl md:text-5xl font-headline text-[#1d1b19] font-black">Catégories</h2>
    </div>
    <p class="hidden md:block text-[#584140] italic text-sm font-headline">
        Gérer les thématiques éditoriales
    </p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

    {{-- Left: Add Form --}}
    <section class="lg:col-span-4">
        <div class="bg-white rounded-xl p-8 shadow-sm relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-32 h-32 opacity-4 rotate-12 pointer-events-none"
                 style="background-image: url('data:image/svg+xml,%3Csvg width=40 height=40 viewBox=0 0 40 40 xmlns=http://www.w3.org/2000/svg%3E%3Cpath d=M0 0h20v20H0V0zm20 20h20v20H20V20zM0 20h20v20H0V20zm20-20h20v20H20V0z fill=%23b33a3a fill-opacity=0.04/%3E%3C/svg%3E')">
            </div>

            <h3 class="text-xl font-headline font-bold mb-6 text-[#1d1b19] border-b border-[#ece7e2] pb-4">
                Nouvelle Catégorie
            </h3>

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded-lg mb-6 text-sm text-green-700">
                ✓ {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-widest text-[#584140]">
                        Nom de la catégorie
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="ex: Innovation Technologique"
                           class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-lg p-4 text-[#1d1b19] placeholder:text-stone-400 transition-all outline-none"/>
                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-[#B33A3A] text-white py-4 px-6 rounded-lg font-bold flex items-center justify-center gap-2 hover:opacity-90 transition-all active:scale-95 shadow-md">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Ajouter la catégorie
                    </button>
                </div>
            </form>
        </div>

        {{-- Tip Card --}}
        <div class="mt-8 bg-[#f8f3ee] rounded-xl p-6">
            <div class="flex items-start gap-4">
                <span class="material-symbols-outlined text-[#B33A3A] mt-1">info</span>
                <div>
                    <h4 class="text-sm font-bold text-[#1d1b19] mb-1 uppercase tracking-tight">Conseil Éditorial</h4>
                    <p class="text-sm text-[#584140] leading-relaxed">
                        Utilisez des noms évocateurs pour vos catégories. Cela aide vos lecteurs à naviguer et améliore votre référencement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Right: List --}}
    <section class="lg:col-span-8">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-[#ece7e2] flex justify-between items-center bg-[#f8f3ee]/30">
                <h3 class="text-xl font-headline font-bold text-[#1d1b19]">Catégories Existantes</h3>
                <div class="flex items-center gap-2 text-[#584140]">
                    <span class="text-xs font-bold uppercase tracking-tighter">Total:</span>
                    <span class="bg-[#e6e2dd] px-3 py-1 rounded-full text-xs font-black">
                        {{ $categories->count() }}
                    </span>
                </div>
            </div>

            <div class="divide-y divide-[#f2ede8]">
                @forelse($categories as $category)
                <div class="flex items-center justify-between p-6 hover:bg-[#FDF8F4] transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-[#ece7e2] flex items-center justify-center text-[#B33A3A]">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">folder</span>
                        </div>
                        <div>
                            <h4 class="font-headline font-bold text-lg text-[#1d1b19] group-hover:text-[#B33A3A] transition-colors">
                                {{ $category->name }}
                            </h4>
                            <p class="text-xs text-[#584140] font-medium">
                                {{ $category->posts->count() }} article(s)
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <span class="bg-[#fda77d] text-[#773a19] px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest shadow-sm">
                            {{ $category->posts->count() }} Articles
                        </span>
                        <form method="POST" action="{{ route('categories.destroy', $category) }}">
                            @csrf @method('DELETE')
                            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-100 text-stone-300 hover:text-red-600 transition-all"
                                    onclick="return confirm('Supprimer cette catégorie ?')">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">folder_open</span>
                    <p class="text-[#584140] mt-4 font-headline text-xl">Aucune catégorie créée</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</div>

@endsection