<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Multi-auteurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold text-indigo-600">
                Blog Multi-auteurs
            </a>
            <div class="flex gap-4 items-center">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="text-red-500 font-semibold">Admin</a>
                    @endif
                    @if(in_array(auth()->user()->role, ['admin', 'author']))
                        <a href="{{ route('posts.create') }}" class="text-green-600 font-semibold">+ Article</a>
                    @endif
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-400 hover:text-red-600">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-500">Connexion</a>
                    <a href="{{ route('register') }}" class="text-indigo-500">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Messages flash -->
    <div class="max-w-5xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Contenu -->
    <main class="max-w-5xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>