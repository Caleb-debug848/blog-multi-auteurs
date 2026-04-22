@extends('layouts.app')

@section('content')

<main class="pt-16 pb-20 px-6">
    <div class="max-w-[800px] mx-auto">

        {{-- Header Profile --}}
        <header class="flex flex-col items-center mb-16 text-center">
            <div class="relative mb-6">
                <div class="w-20 h-20 rounded-full bg-[#B33A3A] flex items-center justify-center text-white font-bold text-3xl shadow-lg ring-4 ring-[#ece7e2]">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
            <h1 class="font-headline text-3xl font-bold text-[#1d1b19] mb-2">
                {{ auth()->user()->name }}
            </h1>
            <span class="bg-[#ffdbcc] text-[#773a19] px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </header>

        <div class="space-y-12">

            {{-- Card 1: Informations --}}
            <section class="bg-white p-8 md:p-10 rounded-xl relative overflow-hidden shadow-[0_2px_16px_rgba(179,58,58,0.04)]">
                <div class="absolute bottom-0 right-0 w-32 h-32 opacity-5 pointer-events-none"
                     style="background-image: url('data:image/svg+xml,%3Csvg width=40 height=40 viewBox=0 0 40 40 xmlns=http://www.w3.org/2000/svg%3E%3Cpath d=M0 0h20v20H0V0zm20 20h20v20H20V20zM0 20h20v20H0V20zm20-20h20v20H20V0z fill=%23b33a3a fill-opacity=0.04/%3E%3C/svg%3E')">
                </div>

                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-[#B33A3A]">person</span>
                    <h2 class="font-headline text-2xl text-[#1d1b19]">Informations Personnelles</h2>
                </div>

                @if(session('status') === 'profile-updated')
                <div class="bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded-lg mb-6 text-sm text-green-700">
                    ✓ Profil mis à jour avec succès.
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}"
                      class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-tighter text-[#584140]">
                            Nom Complet
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-t p-3 text-[#1d1b19] transition-all outline-none"/>
                        @error('name')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-tighter text-[#584140]">
                            Adresse E-mail
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email) }}"
                               class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-t p-3 text-[#1d1b19] transition-all outline-none"/>
                        @error('email')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 pt-4">
                        <button type="submit"
                                class="bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold uppercase tracking-widest text-xs hover:opacity-90 transition-all active:scale-95">
                            Sauvegarder les modifications
                        </button>
                    </div>
                </form>
            </section>

            {{-- Card 2: Sécurité --}}
            <section class="bg-white p-8 md:p-10 rounded-xl shadow-[0_2px_16px_rgba(179,58,58,0.04)]">
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-[#B33A3A]">lock_open</span>
                    <h2 class="font-headline text-2xl text-[#1d1b19]">Sécurité du Compte</h2>
                </div>

                @if(session('status') === 'password-updated')
                <div class="bg-green-50 border-l-4 border-green-500 px-4 py-3 rounded-lg mb-6 text-sm text-green-700">
                    ✓ Mot de passe mis à jour avec succès.
                </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}"
                      class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-tighter text-[#584140]">
                                Ancien Mot de Passe
                            </label>
                            <input type="password"
                                   name="current_password"
                                   placeholder="••••••••"
                                   class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-t p-3 text-[#1d1b19] outline-none"/>
                            @error('current_password')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-tighter text-[#584140]">
                                Nouveau Mot de Passe
                            </label>
                            <input type="password"
                                   name="password"
                                   id="new-password"
                                   placeholder="••••••••"
                                   class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-t p-3 text-[#1d1b19] outline-none"/>
                            @error('password')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-tighter text-[#584140]">
                                Confirmer le Mot de Passe
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   class="w-full bg-[#ece7e2] border-none border-b-2 border-transparent focus:border-[#B33A3A] focus:ring-0 rounded-t p-3 text-[#1d1b19] outline-none"/>
                        </div>
                    </div>

                    {{-- Strength Bar --}}
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest text-[#584140]">
                            <span>Force du mot de passe</span>
                            <span id="strength-label" class="text-[#005650]">—</span>
                        </div>
                        <div class="h-1.5 w-full bg-[#ece7e2] rounded-full overflow-hidden flex gap-0.5">
                            <div id="bar-1" class="h-full w-1/4 bg-[#ece7e2] rounded-full transition-colors"></div>
                            <div id="bar-2" class="h-full w-1/4 bg-[#ece7e2] rounded-full transition-colors"></div>
                            <div id="bar-3" class="h-full w-1/4 bg-[#ece7e2] rounded-full transition-colors"></div>
                            <div id="bar-4" class="h-full w-1/4 bg-[#ece7e2] rounded-full transition-colors"></div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="bg-[#B33A3A] text-white px-8 py-3 rounded-lg font-bold uppercase tracking-widest text-xs hover:opacity-90 transition-all active:scale-95">
                            Mettre à jour la sécurité
                        </button>
                    </div>
                </form>
            </section>

            {{-- Danger Zone --}}
            <section class="border-t-2 border-[#C0392B]/20 pt-12">
                <div class="bg-red-50 p-8 rounded-xl border border-[#C0392B]/30 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <h3 class="font-headline text-xl text-[#C0392B] font-bold mb-1">Zone de Danger</h3>
                        <p class="text-sm text-[#584140]">
                            Cette action est irréversible. Toutes vos données seront définitivement effacées.
                        </p>
                    </div>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')"
                                class="bg-[#C0392B] text-white px-6 py-3 rounded-lg font-bold uppercase tracking-widest text-xs hover:bg-[#A93226] transition-colors whitespace-nowrap">
                            Supprimer mon compte
                        </button>
                    </form>
                </div>
            </section>

        </div>
    </div>
</main>

{{-- Password Strength Script --}}
<script>
    const input = document.getElementById('new-password');
    const bars = [
        document.getElementById('bar-1'),
        document.getElementById('bar-2'),
        document.getElementById('bar-3'),
        document.getElementById('bar-4'),
    ];
    const label = document.getElementById('strength-label');

    input.addEventListener('input', function () {
        const val = this.value;
        let strength = 0;
        if (val.length >= 8) strength++;
        if (/[A-Z]/.test(val)) strength++;
        if (/[0-9]/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        const colors = ['#C0392B', '#D4860A', '#2E7D4F', '#005650'];
        const labels = ['Faible', 'Moyen', 'Fort', 'Très fort'];

        bars.forEach((bar, i) => {
            bar.style.backgroundColor = i < strength ? colors[strength - 1] : '#ece7e2';
        });

        label.textContent = strength > 0 ? labels[strength - 1] : '—';
        label.style.color = strength > 0 ? colors[strength - 1] : '#584140';
    });
</script>

@endsection