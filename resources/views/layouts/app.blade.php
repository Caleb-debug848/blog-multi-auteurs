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
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h50v50H0z' fill='%23B33A3A' fill-opacity='0.04'/%3E%3Cpath d='M50 50h50v50H50z' fill='%23E8956D' fill-opacity='0.04'/%3E%3C/svg%3E");
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
<nav class="fixed top-0 w-full z-50 bg-[#F5F0EB]/95 backdrop-blur-xl border-b border-stone-200/20 shadow-sm">

    {{-- Main bar --}}
    <div class="flex justify-between items-center px-4 md:px-12 w-full max-w-screen-2xl mx-auto h-[68px]">

        {{-- Logo --}}
        <a href="{{ route('posts.index') }}"
           class="font-bold font-headline text-[#B33A3A] text-base md:text-xl leading-tight flex-shrink-0">
            Blog Multi-auteurs
        </a>

        {{-- Nav Links Desktop --}}
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

        {{-- Right side --}}
        <div class="flex items-center gap-2 md:gap-4">

            @auth
                {{-- Admin link desktop --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}"
                       class="hidden md:block font-news uppercase tracking-widest text-xs text-stone-600 hover:text-[#B33A3A] transition-colors">
                        Admin ⚙
                    </a>
                @endif

                {{-- New article desktop --}}
                @if(in_array(auth()->user()->role, ['admin', 'author']))
                    <a href="{{ route('posts.create') }}"
                       class="hidden md:block font-news uppercase tracking-widest text-xs font-bold text-stone-600 hover:text-[#B33A3A] transition-colors">
                        + Article
                    </a>
                @endif

                {{-- Avatar dropdown --}}
                <div class="relative group">
                    <button class="w-9 h-9 rounded-full bg-[#E8956D] text-white font-bold flex items-center justify-center text-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>
                    <div class="absolute right-0 top-12 w-52 bg-white border border-stone-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('profile.show') }}"
                           class="block px-4 py-3 text-sm text-stone-700 hover:text-[#B33A3A] hover:bg-[#F5F0EB] rounded-t-xl transition-colors">
                            Mon profil
                        </a>
                        @if(in_array(auth()->user()->role, ['admin', 'author']))
                        <a href="{{ route('posts.my-posts') }}"
                           class="block px-4 py-3 text-sm text-stone-700 hover:text-[#B33A3A] hover:bg-[#F5F0EB] transition-colors">
                            Mes articles
                        </a>
                        @endif
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.index') }}"
                           class="block px-4 py-3 text-sm text-stone-700 hover:text-[#B33A3A] hover:bg-[#F5F0EB] transition-colors">
                            Dashboard Admin
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
                   class="hidden md:block font-news uppercase tracking-widest text-sm text-stone-600 hover:text-[#B33A3A] transition-colors">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="bg-[#B33A3A] text-white px-4 md:px-6 py-2 rounded-full font-news uppercase tracking-widest text-xs font-bold hover:opacity-80 transition-all active:scale-95">
                    S'inscrire
                </a>
            @endauth

            {{-- Hamburger Mobile --}}
            <button onclick="toggleMobileMenu()"
                    id="hamburger-btn"
                    class="md:hidden flex flex-col justify-center items-center w-9 h-9 rounded-lg hover:bg-[#F5F0EB] transition-colors flex-shrink-0"
                    aria-label="Menu">
                <span id="bar1" class="block w-5 h-0.5 bg-[#B33A3A] transition-all duration-300"></span>
                <span id="bar2" class="block w-5 h-0.5 bg-[#B33A3A] mt-1 transition-all duration-300"></span>
                <span id="bar3" class="block w-5 h-0.5 bg-[#B33A3A] mt-1 transition-all duration-300"></span>
            </button>

        </div>
    </div>

    {{-- Mobile Drawer --}}
    <div id="mobile-menu"
         class="md:hidden hidden bg-[#F5F0EB]/98 backdrop-blur-xl border-t border-stone-200/30 shadow-lg">
        <div class="px-6 py-4 space-y-1 max-w-screen-2xl mx-auto">

            {{-- Navigation links --}}
            <a href="{{ route('posts.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm {{ request()->routeIs('posts.index') ? 'text-[#B33A3A] bg-[#B33A3A]/5 font-bold' : 'text-stone-600' }} hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                <span class="material-symbols-outlined text-lg">home</span>
                Accueil
            </a>
            <a href="{{ route('categories.public') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm {{ request()->routeIs('categories.public') ? 'text-[#B33A3A] bg-[#B33A3A]/5 font-bold' : 'text-stone-600' }} hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                <span class="material-symbols-outlined text-lg">category</span>
                Catégories
            </a>
            <a href="{{ route('posts.trending') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm {{ request()->routeIs('posts.trending') ? 'text-[#B33A3A] bg-[#B33A3A]/5 font-bold' : 'text-stone-600' }} hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                <span class="material-symbols-outlined text-lg">trending_up</span>
                Tendances
            </a>

            {{-- Divider --}}
            <div class="border-t border-stone-200 my-2"></div>

            @auth
                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-stone-600 hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                    <span class="material-symbols-outlined text-lg">person</span>
                    Mon profil
                </a>
                @if(in_array(auth()->user()->role, ['admin', 'author']))
                <a href="{{ route('posts.my-posts') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-stone-600 hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                    <span class="material-symbols-outlined text-lg">article</span>
                    Mes articles
                </a>
                <a href="{{ route('posts.create') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-[#B33A3A] font-bold hover:bg-[#B33A3A]/5 transition-colors">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Nouvel article
                </a>
                @endif
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.index') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-stone-600 hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                    <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                    Dashboard Admin
                </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-red-500 hover:bg-red-50 transition-colors">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl font-news uppercase tracking-widest text-sm text-stone-600 hover:bg-[#B33A3A]/5 hover:text-[#B33A3A] transition-colors">
                    <span class="material-symbols-outlined text-lg">login</span>
                    Connexion
                </a>
            @endauth

        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-success" class="fixed top-20 right-4 md:right-6 z-50 bg-white border-l-4 border-green-500 px-4 md:px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-sm">
    <span class="material-symbols-outlined text-green-500">check_circle</span>
    <span class="text-sm font-medium text-stone-700">{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div id="flash-error" class="fixed top-20 right-4 md:right-6 z-50 bg-white border-l-4 border-[#B33A3A] px-4 md:px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 max-w-sm">
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
        <div class="flex flex-wrap justify-center gap-6 md:gap-8 mb-8">
            <a href="{{ route('posts.index') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Accueil</a>
            <a href="{{ route('categories.public') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Catégories</a>
            <a href="{{ route('posts.trending') }}" class="text-stone-500 hover:text-[#E8956D] transition-all duration-300">Tendances</a>
        </div>
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

<script>
    let menuOpen = false;

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');

        menuOpen = !menuOpen;

        if (menuOpen) {
            menu.classList.remove('hidden');
            // Animate to X
            bar1.style.transform = 'translateY(6px) rotate(45deg)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'translateY(-6px) rotate(-45deg)';
        } else {
            menu.classList.add('hidden');
            // Reset
            bar1.style.transform = '';
            bar2.style.opacity = '';
            bar3.style.transform = '';
        }
    }

    // Auto dismiss flash messages
    setTimeout(() => {
        const s = document.getElementById('flash-success');
        const e = document.getElementById('flash-error');
        if (s) s.style.display = 'none';
        if (e) e.style.display = 'none';
    }, 4000);
</script>

</body>
</html>