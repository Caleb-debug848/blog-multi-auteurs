@extends('layouts.admin')

@section('content')

{{-- Header --}}
<header class="mb-12">
    <h2 class="text-4xl font-headline font-bold text-[#1d1b19] tracking-tight">Tags</h2>
    <p class="text-[#584140] mt-2 max-w-2xl">
        Gérez les étiquettes de vos articles pour optimiser le référencement et la navigation.
    </p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

    {{-- Left: Add Form --}}
    <section class="lg:col-span-4 space-y-8">
        <div class="bg-[#f8f3ee] p-8 rounded-xl relative overflow-hidden">
            <div class="absolute bottom-0 right-0 w-24 h-24 opacity-4 pointer-events-none"
                 style="background-image: radial-gradient(#b33a3a 0.5px, transparent 0.5px); background-size: 12px 12px;"></div>

            <h3 class="text-xl font-headline font-bold mb-6 text-[#B33A3A]">Ajouter un nouveau tag</h3>

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded-lg mb-6 text-sm text-green-700">
                ✓ {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('tags.store') }}" class="space-y-6 relative z-10">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-[#584140] mb-2">
                        Nom du tag
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ex: Innovation Numérique"
                           class="w-full bg-[#ece7e2] border-0 border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 px-4 py-3 transition-colors text-[#1d1b19] outline-none"/>
                    <p class="text-[11px] text-stone-500 mt-2 italic">
                        Le nom tel qu'il apparaîtra sur le site.
                    </p>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-[#B33A3A] text-white py-4 px-6 rounded-lg font-semibold hover:opacity-90 transition-all flex justify-center items-center gap-2 active:scale-95">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Créer le tag
                </button>
            </form>
        </div>

        {{-- Tip Card --}}
        <div class="p-6 rounded-xl border border-[#dfbfbd]/20 flex gap-4 items-start bg-white">
            <span class="material-symbols-outlined text-[#8f4c2a]">lightbulb</span>
            <div>
                <h4 class="text-sm font-bold text-[#1d1b19]">Conseil éditorial</h4>
                <p class="text-xs text-[#584140] mt-1 leading-relaxed">
                    Privilégiez des tags courts et précis. Un tag efficace aide à regrouper les contenus transversaux au-delà des catégories.
                </p>
            </div>
        </div>
    </section>

    {{-- Right: Tags Grid --}}
    <section class="lg:col-span-8">
        <div class="bg-white p-8 rounded-xl shadow-sm min-h-[400px]">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-headline font-bold text-[#1d1b19]">Tags existants</h3>
                <span class="bg-[#e6e2dd] px-3 py-1 rounded-full text-xs font-black text-[#584140]">
                    {{ $tags->count() }} tags
                </span>
            </div>

            @if($tags->count() > 0)
            <div class="flex flex-wrap gap-4">
                @foreach($tags as $tag)
                <div class="group flex items-center gap-2 bg-[#ece7e2] border-2 border-transparent hover:border-[#B33A3A] text-[#1d1b19] px-5 py-3 rounded-full transition-all">
                    <span class="text-sm font-medium tracking-wide">{{ $tag->name }}</span>
                    <span class="text-[10px] bg-stone-300 text-stone-700 px-2 py-0.5 rounded-full">
                        {{ $tag->posts->count() }}
                    </span>
                    <form method="POST" action="{{ route('tags.destroy', $tag) }}"
                          class="opacity-0 group-hover:opacity-100 transition-all">
                        @csrf @method('DELETE')
                        <button class="text-stone-400 hover:text-red-600 transition-colors"
                                onclick="return confirm('Supprimer ce tag ?')">
                            <span class="material-symbols-outlined text-base">close</span>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-6xl text-[#B33A3A] opacity-20">sell</span>
                <p class="text-[#584140] mt-4 font-headline text-xl">Aucun tag créé</p>
                <p class="text-[#8b716f] text-sm mt-2">Ajoutez votre premier tag via le formulaire.</p>
            </div>
            @endif

            {{-- Info footer --}}
            @if($tags->count() > 0)
            <div class="mt-12 text-center border-t border-[#dfbfbd] border-dashed pt-8">
                <p class="text-stone-400 text-sm">{{ $tags->count() }} tag(s) au total</p>
            </div>
            @endif
        </div>
    </section>

</div>

@endsection