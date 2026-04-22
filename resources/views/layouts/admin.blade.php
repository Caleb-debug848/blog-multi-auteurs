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
        .sidebar-active {
            background-color: #B33A3A;
            color: white;
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
        }
        .sidebar-inactive {
            color: #a8a29e;
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            transition: background-color 0.2s, color 0.2s;
        }
        .sidebar-inactive:hover {
            background-color: rgba(68, 64, 60, 0.5);
            color: white;
        }
        body { background-color: #fef8f3; color: #1d1b19; font-family: 'Source Sans 3', sans-serif; }
        .font-headline { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen">

{{-- SIDEBAR --}}
<aside class="bg-[#1A1A1A] w-[260px] h-full fixed left-0 top-0 z-40 flex flex-col py-6 shadow-2xl overflow-y-auto">

    {{-- Logo --}}
    <div class="px-6 mb-10">
        <h1 class="text-[#B33A3A] font-headline text-2xl font-bold italic">Blog Multi-auteurs</h1>
        <p class="text-stone-500 text-xs uppercase tracking-widest mt-1">Espace Administration</p>
    </div>

    {{-- User --}}
    <div class="px-4 mb-8">
        <div class="flex items-center gap-3 p-3 bg-stone-800/40 rounded-xl">
            <div class="w-10 h-10 rounded-full bg-[#B33A3A] flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-white text-sm font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-stone-400 text-xs">Administrateur</p>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-grow">
        <a href="{{ route('admin.index') }}"
           class="{{ request()->routeIs('admin.index') ? 'sidebar-active' : 'sidebar-inactive' }}">
            <span class="material-symbols-outlined"
                  style="{{ request()->routeIs('admin.index') ? 'font-variation-settings: FILL 1' : '' }}">
                dashboard
            </span>
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
    <div class="px-6 pt-6 mt-auto space-y-3">
        <a href="{{ route('posts.index') }}"
           class="w-full flex items-center gap-3 text-stone-500 hover:text-[#E8956D] transition-colors py-2">
            <span class="material-symbols-outlined">open_in_new</span>
            <span class="font-medium text-sm">Voir le site</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-3 text-stone-500 hover:text-white transition-colors py-2">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-medium text-sm">Déconnexion</span>
            </button>
        </form>
    </div>

</aside>

{{-- Flash Messages --}}
@if(session('success'))
<div class="fixed top-6 right-6 z-50 bg-white border-l-4 border-green-500 px-6 py-4 rounded-xl shadow-lg flex items-center gap-3">
    <span class="material-symbols-outlined text-green-500">check_circle</span>
    <span class="text-sm font-medium text-stone-700">{{ session('success') }}</span>
</div>
@endif

{{-- Main Content --}}
<main class="ml-[260px] p-10 min-h-screen">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="ml-[260px] py-10 px-8 border-t-4 border-[#B33A3A] bg-[#1A1A1A] text-stone-400">
    <div class="flex flex-col items-center gap-4">
        <h5 class="text-[#B33A3A] font-headline italic text-lg">Blog Multi-auteurs</h5>
        <p class="text-sm">© {{ date('Y') }} Blog Multi-auteurs. Actualité & Innovation Cameroun.</p>
    </div>
</footer>

</body>
</html>