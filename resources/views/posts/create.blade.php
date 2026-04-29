@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 md:px-6 py-12">

    {{-- Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <span class="w-8 h-[3px] bg-[#B33A3A]"></span>
            <span class="font-news uppercase tracking-widest text-xs text-[#B33A3A] font-bold">Rédaction</span>
        </div>
        <h1 class="font-headline text-4xl font-bold text-[#1d1b19]">Nouvel article</h1>
        <p class="text-[#584140] mt-2">Rédigez et publiez votre article pour soumission.</p>
    </div>

    {{-- Errors --}}
    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 px-4 py-3 rounded-xl mb-8">
        <ul class="text-sm text-red-600 space-y-1">
            @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
          class="space-y-8">
        @csrf

        {{-- Titre --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-3">
                Titre de l'article <span class="text-[#B33A3A]">*</span>
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   placeholder="Ex: Le numérique au Cameroun en 2026..."
                   class="w-full px-4 py-4 bg-white border-2 border-[#e6e2dd] rounded-xl font-headline text-xl text-[#1d1b19] focus:border-[#B33A3A] focus:outline-none transition-colors placeholder:text-stone-300"
                   required/>
        </div>

        {{-- Contenu --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-3">
                Contenu <span class="text-[#B33A3A]">*</span>
            </label>
            <p class="text-xs text-stone-400 mb-2">Vous pouvez utiliser **gras**, *italique*, ## Titre pour la mise en forme.</p>
            <textarea name="body"
                      rows="14"
                      placeholder="Rédigez votre article ici..."
                      class="w-full px-4 py-4 bg-white border-2 border-[#e6e2dd] rounded-xl text-sm text-[#1d1b19] focus:border-[#B33A3A] focus:outline-none transition-colors resize-y font-mono leading-relaxed placeholder:text-stone-300"
                      required>{{ old('body') }}</textarea>
        </div>

        {{-- Image --}}
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-3">
                Image de couverture
            </label>
            <div class="border-2 border-dashed border-[#e6e2dd] rounded-xl p-8 text-center hover:border-[#B33A3A] transition-colors cursor-pointer bg-white"
                 onclick="document.getElementById('image-input').click()">
                <span class="material-symbols-outlined text-4xl text-[#B33A3A] opacity-40 mb-3 block">add_photo_alternate</span>
                <p class="text-sm font-medium text-[#584140]">Cliquez pour importer une image</p>
                <p class="text-xs text-stone-400 mt-1">JPG, PNG, WEBP, GIF — max 5MB</p>
                <p id="file-name" class="text-xs text-[#B33A3A] font-bold mt-3 hidden"></p>
            </div>
            <input type="file"
                   id="image-input"
                   name="image"
                   accept="image/*"
                   class="hidden"
                   onchange="previewImage(this)"/>
            <div id="image-preview" class="mt-4 hidden">
                <img id="preview-img" src="" alt="Aperçu"
                     class="w-full max-h-64 object-cover rounded-xl border-2 border-[#e6e2dd]"/>
            </div>
        </div>

        {{-- Catégorie + Tags --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Catégorie --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-3">
                    Catégorie <span class="text-[#B33A3A]">*</span>
                </label>
                <select name="category_id"
                        class="w-full px-4 py-3 bg-white border-2 border-[#e6e2dd] rounded-xl text-sm text-[#1d1b19] focus:border-[#B33A3A] focus:outline-none transition-colors"
                        required>
                    <option value="">Choisir une catégorie...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tags --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-[#584140] mb-3">
                    Tags
                </label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $tag->id }}"
                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                               class="hidden peer"/>
                        <span class="px-3 py-1.5 rounded-full text-xs font-bold border-2 border-[#e6e2dd] text-[#584140] peer-checked:bg-[#B33A3A] peer-checked:text-white peer-checked:border-[#B33A3A] transition-all select-none hover:border-[#B33A3A]">
                            #{{ $tag->name }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Info statut --}}
        <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 flex items-center gap-3">
            <span class="material-symbols-outlined text-amber-500">info</span>
            <p class="text-sm text-amber-700">
                Votre article sera soumis en <strong>brouillon</strong> et devra être approuvé par un administrateur avant publication.
            </p>
        </div>

        {{-- Submit --}}
        <div class="flex gap-4 pt-2">
            <button type="submit"
                    class="bg-[#B33A3A] hover:opacity-90 active:scale-[0.98] text-white font-bold px-8 py-4 rounded-xl text-sm uppercase tracking-widest shadow-[0_4px_12px_rgba(179,58,58,0.25)] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">send</span>
                Soumettre l'article
            </button>
            <a href="{{ route('posts.index') }}"
               class="px-8 py-4 rounded-xl text-sm font-bold text-[#584140] border-2 border-[#e6e2dd] hover:border-[#B33A3A] hover:text-[#B33A3A] transition-all">
                Annuler
            </a>
        </div>

    </form>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('file-name').textContent = '✅ ' + file.name;
            document.getElementById('file-name').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection