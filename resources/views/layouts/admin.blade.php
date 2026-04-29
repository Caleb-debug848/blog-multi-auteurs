<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin — Blog Multi-auteurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
        body { background-color: #fef8f3; color: #1d1b19; font-family: 'Source Sans 3', sans-serif; }
        .font-headline { font-family: 'Playfair Display', serif; }
        #sidebar { transition: transform 0.3s ease; }
        #main-content { transition: margin-left 0.3s ease; }
        #sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 30; }
        #sidebar-overlay.active { display: block; }
        .sidebar-active {
            background-color: #B33A3A; color: white; border-radius: 0.5rem;
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem 1rem; margin: 0.125rem 0;
        }
        .sidebar-inactive {
            color: #a8a29e; border-radius: 0.5rem; display: flex;
            align-items: center; gap: 0.75rem; padding: 0.75rem 1rem;
            margin: 0.125rem 0; transition: background-color 0.2s, color 0.2s;
        }
        .sidebar-inactive:hover { background-color: rgba(68,64,60,0.5); color: white; }
    </style>
</head>
<body class="min-h-screen">

{{-- Overlay mobile --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar"
       class="bg-[#1A1A1A] w-[260px] h-full fixed left-0 top-0 z-40 flex flex-col py-6 shadow-2xl overflow-y-auto"
       style="transform: translateX(-100%);">

    {{-- Header sidebar --}}
    <div class="px-6 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                <path d="M12 2 C6 2 2 7 2 12 C2 10 5 6 10 6 C8 9 7 13 9 17 C7 15 4 18 4 22 C6 18 9 17 12 18 C15 17 18 18 20 22 C20 18 17 15 15 17 C17 13 16 9 14 6 C19 6 22 10 22 12 C22 7 18 2 12 2 Z" fill="#B33A3A"/>
                <path d="M12 8 L12 20" stroke="#B33A3A" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
            <div>
                <h1 class="text-[#B33A3A] font-headline text-base font-bold italic leading-none">Blog Multi-auteurs</h1>
                <p class="text-stone-500 text-[9px] uppercase tracking-widest mt-0.5">Espace Administration</p>
            </div>
        </div>
        <button onclick="closeSidebar()"
                class="text-stone-400 hover:text-white transition-colors p-1 rounded-lg hover:bg-stone-800">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    {{-- User --}}
    <div class="px-4 mb-6">
        <div class="flex items-center gap-3 p-3 bg-stone-800/40 rounded-xl">
            <div class="w-10 h-10 rounded-full bg-[#B33A3A] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-stone-400 text-xs">Administrateur</p>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-grow px-3">
        <a href="{{ route('admin.index') }}"
           class="{{ request()->routeIs('admin.index') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined" style="{{ request()->routeIs('admin.index') ? 'font-variation-settings:\'FILL\' 1' : '' }}">dashboard</span>
            <span class="font-medium">Vue d'ensemble</span>
        </a>
        <a href="{{ route('admin.articles') }}"
           class="{{ request()->routeIs('admin.articles') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined">description</span>
            <span class="font-medium">Articles en attente</span>
        </a>
        <a href="{{ route('admin.comments') }}"
           class="{{ request()->routeIs('admin.comments') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined">forum</span>
            <span class="font-medium">Commentaires</span>
        </a>
        <a href="{{ route('admin.users') }}"
           class="{{ request()->routeIs('admin.users') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined">group</span>
            <span class="font-medium">Utilisateurs</span>
        </a>
        <a href="{{ route('categories.index') }}"
           class="{{ request()->routeIs('categories.index') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined">category</span>
            <span class="font-medium">Catégories</span>
        </a>
        <a href="{{ route('tags.index') }}"
           class="{{ request()->routeIs('tags.index') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined">sell</span>
            <span class="font-medium">Tags</span>
        </a>
    </nav>

    {{-- Bottom --}}
    <div class="px-4 pt-6 mt-auto border-t border-stone-800 space-y-1">
        <a href="{{ route('posts.index') }}" class="sidebar-inactive">
            <span class="material-symbols-outlined">open_in_new</span>
            <span class="font-medium text-sm">Voir le site</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="sidebar-inactive w-full text-left">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-medium text-sm">Déconnexion</span>
            </button>
        </form>
    </div>
</aside>

{{-- TOP BAR --}}
<div class="fixed top-0 left-0 right-0 z-30 h-14 bg-white border-b border-[#E2D9D0] flex items-center px-4 gap-4 shadow-sm">

    {{-- Burger --}}
    <button onclick="toggleSidebar()"
            class="p-2 rounded-lg hover:bg-[#F5F0EB] text-[#B33A3A] transition-colors">
        <span class="material-symbols-outlined" id="burger-icon">menu</span>
    </button>

    {{-- Logo topbar --}}
    <a href="{{ route('posts.index') }}" class="flex items-center gap-2">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M12 2 C6 2 2 7 2 12 C2 10 5 6 10 6 C8 9 7 13 9 17 C7 15 4 18 4 22 C6 18 9 17 12 18 C15 17 18 18 20 22 C20 18 17 15 15 17 C17 13 16 9 14 6 C19 6 22 10 22 12 C22 7 18 2 12 2 Z" fill="#B33A3A"/>
            <path d="M12 8 L12 20" stroke="#B33A3A" stroke-width="1.2" stroke-linecap="round"/>
        </svg>
        <span class="font-headline text-[#B33A3A] font-bold italic text-lg">Blog Multi-auteurs</span>
    </a>
    <span class="text-stone-400 text-xs uppercase tracking-widest hidden md:block">— Administration</span>

    {{-- Right --}}
    <div class="ml-auto flex items-center gap-3">
        <a href="{{ route('posts.index') }}"
           class="text-stone-500 hover:text-[#B33A3A] text-sm flex items-center gap-1 transition-colors">
            <span class="material-symbols-outlined text-sm">open_in_new</span>
            <span class="hidden md:block">Voir le site</span>
        </a>
        <div class="w-8 h-8 rounded-full bg-[#B33A3A] flex items-center justify-center text-white font-bold text-sm">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    </div>
</div>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-msg" class="fixed top-16 right-6 z-50 bg-white border-l-4 border-green-500 px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
    <span class="material-symbols-outlined text-green-500">check_circle</span>
    <span class="text-sm font-medium text-stone-700">{{ session('success') }}</span>
</div>
@endif

{{-- Main Content --}}
<main id="main-content" class="pt-14 min-h-screen transition-all duration-300">
    <div class="p-6 md:p-10">
        @yield('content')
    </div>
</main>

{{-- Footer --}}
<footer id="main-footer" class="py-8 px-8 border-t-4 border-[#B33A3A] bg-[#1A1A1A] text-stone-400 transition-all duration-300">
    <div class="flex flex-col items-center gap-2">
        <div class="flex items-center gap-2">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M12 2 C6 2 2 7 2 12 C2 10 5 6 10 6 C8 9 7 13 9 17 C7 15 4 18 4 22 C6 18 9 17 12 18 C15 17 18 18 20 22 C20 18 17 15 15 17 C17 13 16 9 14 6 C19 6 22 10 22 12 C22 7 18 2 12 2 Z" fill="#B33A3A"/>
                <path d="M12 8 L12 20" stroke="#B33A3A" stroke-width="1.2" stroke-linecap="round"/>
            </svg>
            <h5 class="text-[#B33A3A] font-headline italic text-lg">Blog Multi-auteurs</h5>
        </div>
        <p class="text-sm">
            © {{ date('Y') }} Blog Multi-auteurs. Développé avec ❤️ par
            <a href="https://github.com/Caleb-debug848"
               target="_blank"
               class="text-[#E8956D] hover:text-white transition-colors font-bold">
                Caleb Dassi
            </a>
        </p>
    </div>
</footer>

<script>
    let sidebarOpen = false;

    function openSidebar() {
        document.getElementById('sidebar').style.transform = 'translateX(0)';
        document.getElementById('sidebar-overlay').classList.add('active');
        document.getElementById('burger-icon').textContent = 'menu_open';
        sidebarOpen = true;
        if (window.innerWidth >= 1024) {
            document.getElementById('main-content').style.marginLeft = '260px';
            document.getElementById('main-footer').style.marginLeft = '260px';
        }
    }

    function closeSidebar() {
        document.getElementById('sidebar').style.transform = 'translateX(-100%)';
        document.getElementById('sidebar-overlay').classList.remove('active');
        document.getElementById('burger-icon').textContent = 'menu';
        sidebarOpen = false;
        document.getElementById('main-content').style.marginLeft = '0';
        document.getElementById('main-footer').style.marginLeft = '0';
    }

    function toggleSidebar() {
        sidebarOpen ? closeSidebar() : openSidebar();
    }

    setTimeout(() => {
        const flash = document.getElementById('flash-msg');
        if (flash) flash.style.display = 'none';
    }, 4000);
</script>

</body>
</html>