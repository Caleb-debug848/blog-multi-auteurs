<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Blog Multi-auteurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Source+Sans+3:wght@300;400;500;600;700&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .kente-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h50v50H0z' fill='%23B33A3A' fill-opacity='0.04'/%3E%3Cpath d='M50 50h50v50H50z' fill='%23E8956D' fill-opacity='0.04'/%3E%3Cpath d='M50 0h50v50H50z' fill='none'/%3E%3Cpath d='M0 50h50v50H0z' fill='none'/%3E%3C/svg%3E");
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
        body { background-color: #fef8f3; color: #1d1b19; font-family: 'Source Sans 3', sans-serif; }
        .font-headline { font-family: 'Playfair Display', serif; }
        .font-news { font-family: 'Newsreader', serif; }
    </style>
</head>
<body class="selection:bg-[#fda77d] selection:text-[#351000]">

{{-- NAVBAR --}}
<nav class="fixed top-0 w-full h-[68px] z-50 bg-[#F5F0EB]/80 backdrop-blur-xl border-b border-stone-200/20 shadow-sm">
    <div class="flex justify-between items-center px-6 md:px-12 w-full max-w-screen-2xl mx-auto h-full">

        {{-- Logo --}}
        <a href="{{ route('posts.index') }}" class="text-xl font-bold font-headline text-[#B33A3A]">
            Blog Multi-auteurs
        </a>

        {{-- Nav Links --}}
        <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('posts.index') }}"
   class="font-news uppercase tracking-widest text-sm {{ request()->routeIs('posts.index') ? 'text-[#B33A3A] border-b-2 border-[#B33A3A] pb-1 font-bold' : 'text-stone-600 hover:text-[#B33A3A] transition-colors' }}">
    Accueil
</a>
<a href="{{ route('categories.public') }}"
   class="font-news uppercase tracking-widest text-sm {{ request()->routeIs('categories.public') ? 'text-[#B33A3A] border-b-2 border-[#B33A3A] pb-1 font-bold' : 'text-stone-600 hover:text-[#B33A3A] transition-colors' }}">
    Catégories
</a>
<a href="{{ route('posts.trending') }}"
   class="font-news uppercase tracking-widest text-sm {{ request()->routeIs('posts.trending') ? 'text-[#B33A3A] border-b-2 border-[#B33A3A] pb-1 font-bold' : 'text-stone-600 hover:text-[#B33A3A] transition-colors' }}">
    Tendances
</a>
        </div>

        {{-- Auth Buttons --}}
        <div class="flex items-center gap-4">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}"
                       class="font-news uppercase tracking-widest text-sm text-stone-600 hover:text-[#B33A3A] transition-colors">
                        Admin ⚙
                    </a>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'author']))
                    <a href="{{ route('posts.create') }}"
                       class="font-news uppercase tracking-widest text-xs font-bold text-stone-600 hover:text-[#B33A3A] transition-colors">
                        + Article
                    </a>
                @endif

                {{-- Avatar dropdown --}}
                <div class="relative group">
                    <button class="w-9 h-9 rounded-full bg-[#E8956D] text-white font-bold flex items-center justify-center text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>
                    <div class="absolute right-0 top-12 w-48 bg-white border border-stone-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-3 text-sm text-stone-700 hover:text-[#B33A3A] hover:bg-[#F5F0EB] rounded-t-xl transition-colors">
                            Mon profil
                        </a>
                        @if(in_array(auth()->user()->role, ['admin', 'author']))
                        <a href="{{ route('posts.my-posts') }}" class="block px-4 py-3 text-sm text-stone-700 hover:text-[#B33A3A] hover:bg-[#F5F0EB] transition-colors">
    Mes articles
     </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-[#F5F0EB] rounded-b-xl transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="font-news uppercase tracking-widest text-sm text-stone-600 hover:text-[#B33A3A] transition-colors">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="bg-[#B33A3A] text-white px-6 py-2 rounded-full font-news uppercase tracking-widest text-xs font-bold hover:opacity-80 transition-all active:scale-95 duration-150">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="fixed top-20 right-6 z-50 bg-white border-l-4 border-green-500 px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 animate-pulse">
    <span class="material-symbols-outlined text-green-500">check_circle</span>
    <span class="text-sm font-medium text-stone-700">{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="fixed top-20 right-6 z-50 bg-white border-l-4 border-[#B33A3A] px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
    <span class="material-symbols-outlined text-[#B33A3A]">warning</span>
    <span class="text-sm font-medium text-stone-700">{{ session('error') }}</span>
</div>
@endif

{{-- Content --}}
<main class="pt-[68px]">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="w-full border-t-4 border-[#B33A3A] bg-[#1A1A1A] text-stone-400 text-sm">
    <div class="flex flex-col items-center py-12 px-8 w-full max-w-screen-2xl mx-auto">
        <div class="text-[#B33A3A] font-headline italic text-3xl mb-8">
            Blog Multi-auteurs
        </div>
        <a href="{{ route('posts.index') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Accueil</a>
<a href="{{ route('categories.public') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Catégories</a>
<a href="{{ route('posts.trending') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Tendances</a>
        <div class="w-full max-w-xs h-px bg-stone-800 mb-8"></div>
        
        <div class="text-center text-xs opacity-60">
    © {{ date('Y') }} Blog Multi-auteurs. Développé avec ❤️ par
    <a href="https://github.com/Caleb-debug848"
       target="_blank"
       class="text-[#E8956D] hover:text-white transition-colors font-bold underline underline-offset-2">
        Caleb Dassi
    </a>
</div>
    </div>
</footer>

</body>
</html>