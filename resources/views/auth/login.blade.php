<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Connexion — Blog Multi-auteurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Source Sans 3', sans-serif; background-color: #F5F0EB; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; position: relative; overflow: hidden; }
        .font-headline { font-family: 'Playfair Display', serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; font-family: 'Material Symbols Outlined'; }
        .kente-overlay { position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h30v30H0V0zm30 30h30v30H30V30z' fill='%23B33A3A' fill-opacity='0.03'/%3E%3Cpath d='M30 0h30v30H30V0zM0 30h30v30H0V30z' fill='%23E8956D' fill-opacity='0.03'/%3E%3C/svg%3E"); pointer-events: none; }
        .peach-blob { position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(232,149,109,0.15) 0%, rgba(232,149,109,0) 70%); border-radius: 50%; pointer-events: none; }
    </style>
</head>
<body>

    <div class="kente-overlay"></div>
    <div class="peach-blob" style="top:-100px; left:-100px;"></div>
    <div class="peach-blob" style="bottom:-100px; right:-100px;"></div>

    <main style="position:relative; z-index:10; width:100%; max-width:900px; background:white; border-radius:16px; overflow:hidden; display:flex; min-height:580px; box-shadow: 0 8px 40px rgba(179,58,58,0.12);">

        {{-- LEFT PANEL --}}
        <section style="width:42%; background:#B33A3A; padding:48px; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;">

            {{-- Baobab watermark --}}
            <div style="position:absolute; bottom:-20px; left:-20px; opacity:0.08; pointer-events:none; font-size:200px; color:white; font-family:'Material Symbols Outlined'; font-variation-settings:'FILL' 1;">park</div>

            <div style="position:relative; z-index:1;">
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:28px;">
                    <span class="material-symbols-outlined" style="color:white; font-size:32px; font-variation-settings:'FILL' 1;">park</span>
                    <span class="font-headline" style="color:white; font-size:20px; font-weight:700;">Blog Multi-auteurs</span>
                </div>
                <h1 class="font-headline" style="color:white; font-size:30px; line-height:1.3; margin-bottom:28px;">
                    L'actualité camerounaise vue par ses experts.
                </h1>
                <ul style="display:flex; flex-direction:column; gap:20px; list-style:none;">
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:#fda77d; font-size:20px; flex-shrink:0; margin-top:2px;">verified</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Analyses exclusives rédigées par des journalistes locaux.</p>
                    </li>
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:#fda77d; font-size:20px; flex-shrink:0; margin-top:2px;">history_edu</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Participez au débat public et suivez les tendances culturelles.</p>
                    </li>
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:#fda77d; font-size:20px; flex-shrink:0; margin-top:2px;">auto_stories</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Une expérience de lecture éditoriale pensée pour l'excellence.</p>
                    </li>
                </ul>
            </div>

            <div style="position:relative; z-index:1; padding-top:28px; border-top:1px solid rgba(255,255,255,0.15);">
                <p style="color:rgba(255,255,255,0.6); font-size:11px; text-transform:uppercase; letter-spacing:0.15em; font-style:italic;">Patrimoine & Innovation</p>
            </div>
        </section>

        {{-- RIGHT PANEL --}}
        <section style="width:58%; background:white; padding:48px 56px; display:flex; flex-direction:column; justify-content:center;">
            <div style="max-width:380px; width:100%; margin:0 auto;">

                <div style="margin-bottom:32px;">
                    <h2 class="font-headline" style="font-size:32px; color:#922225; margin-bottom:6px;">Connexion</h2>
                    <p style="color:#6b7280; font-size:14px;">Bienvenue dans votre espace éditorial personnel.</p>
                </div>

                @if($errors->any())
                <div style="background:#fef2f2; border-left:4px solid #ef4444; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; color:#dc2626;">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" style="display:flex; flex-direction:column; gap:20px;">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140; margin-bottom:8px;">Adresse Email</label>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;">mail</span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="nom@exemple.cm"
                                   style="width:100%; padding:14px 14px 14px 44px; background:#f2ede8; border:none; border-radius:10px; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif;"/>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                            <label style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140;">Mot de passe</label>
                            @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size:11px; font-weight:700; color:#B33A3A; text-decoration:none; text-transform:uppercase; letter-spacing:0.05em;">Oublié ?</a>
                            @endif
                        </div>
                        <div style="position:relative;">
                            <span class="material-symbols-outlined" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af; font-size:18px;">lock</span>
                            <input type="password" name="password"
                                   placeholder="••••••••"
                                   style="width:100%; padding:14px 14px 14px 44px; background:#f2ede8; border:none; border-radius:10px; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif;"/>
                        </div>
                    </div>

                    {{-- Remember --}}
                    <div style="display:flex; align-items:center; gap:10px;">
                        <input type="checkbox" name="remember" id="remember"
                               style="width:18px; height:18px; accent-color:#B33A3A; cursor:pointer;"/>
                        <label for="remember" style="font-size:14px; color:#6b7280; cursor:pointer;">Se souvenir de moi</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            style="width:100%; background:#B33A3A; color:white; font-weight:700; padding:16px; border-radius:10px; border:none; font-size:15px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; font-family:'Source Sans 3',sans-serif; box-shadow:0 4px 12px rgba(179,58,58,0.25); transition:opacity 0.2s;"
                            onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        Se connecter
                        <span class="material-symbols-outlined" style="font-size:20px;">arrow_forward</span>
                    </button>
                </form>

                <div style="margin-top:32px; padding-top:24px; border-top:1px solid #f2ede8; text-align:center;">
                    <p style="font-size:14px; color:#6b7280;">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" style="color:#B33A3A; font-weight:700; text-decoration:none;">S'inscrire</a>
                    </p>
                </div>

            </div>
        </section>

    </main>

    {{-- Bottom seal --}}
    <div style="position:fixed; bottom:24px; left:50%; transform:translateX(-50%); opacity:0.15; pointer-events:none; text-align:center;">
        <span class="material-symbols-outlined" style="font-size:28px;">park</span>
        <p style="font-size:8px; text-transform:uppercase; letter-spacing:0.4em; margin-top:2px;">Archive Numérique</p>
    </div>

</body>
</html>