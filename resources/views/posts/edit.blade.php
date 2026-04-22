@extends('layouts.app')

@section('content')

<main class="pt-16 pb-20 px-6">
    <div class="max-w-[920px] mx-auto">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h1 class="font-headline text-4xl md:text-5xl text-[#1d1b19] mb-2">
                    Modifier l'article
                </h1>
                <p class="text-[#584140] font-light italic">
                    Dernière modification le {{ $post->updated_at->format('d M Y') }}
                </p>
            </div>
            <div class="flex items-center">
                <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-semibold tracking-widest uppercase
                    {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                    <span class="w-2 h-2 rounded-full mr-2
                        {{ $post->status === 'published' ? 'bg-green-500' : ($post->status === 'draft' ? 'bg-yellow-500' : 'bg-red-500') }}">
                    </span>
                    {{ $post->status === 'published' ? 'Publié' : ($post->status === 'draft' ? 'Brouillon' : 'Rejeté') }}
                </span>
            </div>
        </div>

        {{-- Errors --}}
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 px-6 py-4 rounded-xl mb-8">
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}"
              enctype="multipart/form-data"
              class="space-y-10">
            @csrf
            @method('PUT')

            {{-- Image Section --}}
            <div class="relative group h-[400px] w-full rounded-xl overflow-hidden shadow-xl bg-[#ece7e2]">
                @if($post->image)
                    <img src="{{ $post->image }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         id="current-image"/>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#F5F0EB] to-[#fda77d]/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#B33A3A] text-8xl opacity-20">image</span>
                    </div>
                @endif

                {{-- Preview nouvelle image --}}
                <img id="image-preview"
                     class="hidden w-full h-full object-cover absolute inset-0"
                     src="" alt="Aperçu"/>

                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <label class="flex items-center gap-3 bg-white/90 backdrop-blur-md text-[#1d1b19] px-6 py-3 rounded-lg font-medium shadow-2xl cursor-pointer active:scale-95 transition-all">
                        <span class="material-symbols-outlined">image_search</span>
                        Changer l'image
                        <input type="file"
                               name="image"
                               id="image-input"
                               accept="image/*"
                               class="hidden"/>
                    </label>
                </div>
            </div>

            {{-- Fields --}}
            <div class="space-y-8 bg-[#f8f3ee] p-8 md:p-12 rounded-xl relative overflow-hidden">

                {{-- Kente decoration --}}
                <div class="absolute bottom-0 right-0 w-32 h-32 opacity-5 -mr-8 -mb-8 rotate-12"
                     style="background-image: radial-gradient(#b33a3a 0.5px, transparent 0.5px); background-size: 12px 12px;">
                </div>

                {{-- Title --}}
                <div class="space-y-2">
                    <label class="block font-headline text-sm uppercase tracking-[0.2em] text-[#B33A3A]">
                        Titre de l'article
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $post->title) }}"
                           class="w-full bg-transparent border-0 border-b-2 border-[#dfbfbd] focus:border-[#B33A3A] focus:ring-0 text-2xl md:text-3xl font-headline py-4 transition-all outline-none text-[#1d1b19]"
                           placeholder="Saisissez votre titre..."
                           required/>
                </div>

                {{-- Category & Tags --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Category --}}
                    <div class="space-y-2">
                        <label class="block font-headline text-sm uppercase tracking-[0.2em] text-[#B33A3A]">
                            Catégorie
                        </label>
                        <select name="category_id"
                                class="w-full bg-transparent border-0 border-b-2 border-[#dfbfbd] focus:border-[#B33A3A] focus:ring-0 py-3 outline-none text-[#1d1b19]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tags --}}
                    <div class="space-y-2">
                        <label class="block font-headline text-sm uppercase tracking-[0.2em] text-[#B33A3A]">
                            Tags
                        </label>
                        <div class="flex flex-wrap gap-2 pt-2">
                            @foreach($tags as $tag)
                                <label class="cursor-pointer">
                                    <input type="checkbox"
                                           name="tags[]"
                                           value="{{ $tag->id }}"
                                           class="hidden peer"
                                           {{ $post->tags->contains($tag->id) ? 'checked' : '' }}/>
                                    <span class="inline-block bg-[#ece7e2]/50 px-3 py-1.5 rounded-full text-xs font-medium text-[#584140] peer-checked:bg-[#B33A3A] peer-checked:text-white transition-colors hover:bg-[#B33A3A]/10">
                                        #{{ $tag->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- Body --}}
                <div class="space-y-2">
                    <label class="block font-headline text-sm uppercase tracking-[0.2em] text-[#B33A3A]">
                        Corps de l'article
                    </label>
                    <textarea name="body"
                              rows="15"
                              class="w-full bg-[#e6e2dd]/30 border-0 rounded-lg focus:ring-2 focus:ring-[#B33A3A]/20 p-6 text-lg leading-relaxed text-[#584140] transition-all outline-none resize-none">{{ old('body', $post->body) }}</textarea>
                </div>

            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse md:flex-row items-center justify-end gap-6 pt-4 border-t border-[#dfbfbd]/20">
                <a href="{{ route('posts.show', $post) }}"
                   class="w-full md:w-auto px-10 py-4 text-stone-500 hover:text-[#B33A3A] font-headline uppercase tracking-widest text-sm transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">close</span>
                    Annuler
                </a>
                <button type="submit"
                        class="w-full md:w-auto bg-[#B33A3A] hover:bg-[#922225] text-white px-12 py-4 rounded-lg font-headline uppercase tracking-widest text-sm shadow-lg shadow-[#B33A3A]/20 transition-all flex items-center justify-center gap-2 group active:scale-95">
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">check</span>
                    Mettre à jour
                </button>
            </div>

        </form>
    </div>
</main>

{{-- Image Preview Script --}}
<script>
    const input = document.getElementById('image-input');
    const preview = document.getElementById('image-preview');
    const currentImage = document.getElementById('current-image');

    if (input) {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (currentImage) currentImage.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>

@endsection