<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inscription — Blog Multi-auteurs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Source Sans 3', sans-serif; background-color: #F5F0EB; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; position: relative; overflow: hidden; }
        .font-headline { font-family: 'Playfair Display', serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; font-family: 'Material Symbols Outlined'; }
        .kente-overlay { position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h30v30H0V0zm30 30h30v30H30V30z' fill='%23B33A3A' fill-opacity='0.03'/%3E%3C/svg%3E"); pointer-events: none; }
        .peach-blob { position: absolute; width: 400px; height: 400px; background: radial-gradient(circle, rgba(232,149,109,0.15) 0%, rgba(232,149,109,0) 70%); border-radius: 50%; pointer-events: none; }
    </style>
</head>
<body>

    <div class="kente-overlay"></div>
    <div class="peach-blob" style="top:-100px; left:-100px;"></div>
    <div class="peach-blob" style="bottom:-100px; right:-100px;"></div>

    <main style="position:relative; z-index:10; width:100%; max-width:900px; background:white; border-radius:16px; overflow:hidden; display:flex; min-height:620px; box-shadow:0 8px 40px rgba(179,58,58,0.12);">

        {{-- LEFT PANEL --}}
        <section style="width:42%; background:#B33A3A; padding:48px; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;">

            <div style="position:absolute; bottom:-20px; left:-20px; opacity:0.08; pointer-events:none; font-size:200px; color:white; font-family:'Material Symbols Outlined'; font-variation-settings:'FILL' 1;">park</div>

            <div style="position:relative; z-index:1;">
                <h1 class="font-headline" style="color:white; font-size:20px; font-weight:700; font-style:italic; margin-bottom:28px;">Blog Multi-auteurs</h1>
                <h2 class="font-headline" style="color:white; font-size:30px; line-height:1.3; margin-bottom:28px;">Créez, publiez, inspirez.</h2>
                <ul style="display:flex; flex-direction:column; gap:20px; list-style:none;">
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:white; font-size:20px; flex-shrink:0; margin-top:2px; font-variation-settings:'FILL' 1;">check_circle</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Partagez votre point de vue avec des milliers de lecteurs.</p>
                    </li>
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:white; font-size:20px; flex-shrink:0; margin-top:2px; font-variation-settings:'FILL' 1;">check_circle</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Outils d'édition sophistiqués respectant la typographie.</p>
                    </li>
                    <li style="display:flex; gap:12px; align-items:flex-start;">
                        <span class="material-symbols-outlined" style="color:white; font-size:20px; flex-shrink:0; margin-top:2px; font-variation-settings:'FILL' 1;">check_circle</span>
                        <p style="color:rgba(255,255,255,0.88); font-size:13px; line-height:1.6;">Rejoignez une communauté d'auteurs engagés.</p>
                    </li>
                </ul>
            </div>

            <div style="position:relative; z-index:1;">
                <p style="color:rgba(255,255,255,0.6); font-size:12px; font-style:italic;">
                    Participez à la préservation du patrimoine par l'innovation.
                </p>
            </div>
        </section>

        {{-- RIGHT PANEL --}}
        <section style="width:58%; background:white; padding:48px 56px; display:flex; flex-direction:column; justify-content:center; overflow-y:auto;">
            <div style="max-width:380px; width:100%; margin:0 auto;">

                <div style="margin-bottom:28px;">
                    <h2 class="font-headline" style="font-size:30px; color:#1d1b19; margin-bottom:6px;">Créer un compte</h2>
                    <p style="font-size:14px; color:#6b7280;">
                        Déjà membre ?
                        <a href="{{ route('login') }}" style="color:#B33A3A; font-weight:700; text-decoration:none;">Connexion</a>
                    </p>
                </div>

                @if($errors->any())
                <div style="background:#fef2f2; border-left:4px solid #ef4444; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; color:#dc2626;">
                    <ul style="list-style:none;">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:18px;">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140; margin-bottom:8px;">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Jean-Pierre Bemba"
                               style="width:100%; padding:12px 0; background:transparent; border:none; border-bottom:2px solid #e6e2dd; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif; transition:border-color 0.2s;"
                               onfocus="this.style.borderBottomColor='#B33A3A'" onblur="this.style.borderBottomColor='#e6e2dd'"/>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140; margin-bottom:8px;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="jp.bemba@exemple.cm"
                               style="width:100%; padding:12px 0; background:transparent; border:none; border-bottom:2px solid #e6e2dd; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif; transition:border-color 0.2s;"
                               onfocus="this.style.borderBottomColor='#B33A3A'" onblur="this.style.borderBottomColor='#e6e2dd'"/>
                    </div>

                    {{-- Password --}}
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                            <label style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140;">Mot de passe</label>
                            <span id="strength-label" style="font-size:10px; font-weight:700; color:#8f4c2a; text-transform:uppercase;">—</span>
                        </div>
                        <input type="password" name="password" id="password"
                               placeholder="••••••••••••"
                               style="width:100%; padding:12px 0; background:transparent; border:none; border-bottom:2px solid #e6e2dd; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif;"
                               onfocus="this.style.borderBottomColor='#B33A3A'" onblur="this.style.borderBottomColor='#e6e2dd'"/>
                        <div style="display:flex; gap:4px; height:4px; margin-top:8px;">
                            <div id="bar-1" style="flex:1; border-radius:999px; background:#e6e2dd; transition:background 0.3s;"></div>
                            <div id="bar-2" style="flex:1; border-radius:999px; background:#e6e2dd; transition:background 0.3s;"></div>
                            <div id="bar-3" style="flex:1; border-radius:999px; background:#e6e2dd; transition:background 0.3s;"></div>
                            <div id="bar-4" style="flex:1; border-radius:999px; background:#e6e2dd; transition:background 0.3s;"></div>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label style="display:block; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#584140; margin-bottom:8px;">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                               placeholder="••••••••••••"
                               style="width:100%; padding:12px 0; background:transparent; border:none; border-bottom:2px solid #e6e2dd; font-size:14px; color:#1d1b19; outline:none; font-family:'Source Sans 3',sans-serif;"
                               onfocus="this.style.borderBottomColor='#B33A3A'" onblur="this.style.borderBottomColor='#e6e2dd'"/>
                    </div>

                    {{-- Submit --}}
                    <div style="padding-top:8px;">
                        <button type="submit"
                                style="width:100%; background:#B33A3A; color:white; font-weight:700; padding:16px; border-radius:8px; border:none; font-size:13px; cursor:pointer; text-transform:uppercase; letter-spacing:0.1em; font-family:'Source Sans 3',sans-serif; box-shadow:0 4px 12px rgba(179,58,58,0.25);"
                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            S'inscrire
                        </button>
                    </div>
                </form>

                <div style="margin-top:24px; padding-top:20px; border-top:1px solid #f2ede8; text-align:center;">
                    <p style="font-size:10px; color:#8b716f; text-transform:uppercase; letter-spacing:0.05em;">
                        En vous inscrivant, vous acceptez nos
                        <a href="#" style="text-decoration:underline; color:#8b716f;">Conditions d'utilisation</a>
                        et notre
                        <a href="#" style="text-decoration:underline; color:#8b716f;">Politique de confidentialité</a>.
                    </p>
                </div>

            </div>
        </section>

    </main>

    <div style="position:fixed; bottom:20px; width:100%; text-align:center; pointer-events:none; opacity:0.3;">
        <p style="font-family:'Playfair Display',serif; font-style:italic; font-size:12px; color:#584140;">
            © {{ date('Y') }} Blog Multi-auteurs. Patrimoine et Innovation.
        </p>
    </div>

    <script>
        const input = document.getElementById('password');
        const bars = ['bar-1','bar-2','bar-3','bar-4'].map(id => document.getElementById(id));
        const label = document.getElementById('strength-label');
        const colors = ['#C0392B','#D4860A','#2E7D4F','#005650'];
        const labels = ['Faible','Moyen','Fort','Très fort'];

        input.addEventListener('input', function() {
            const val = this.value;
            let s = 0;
            if (val.length >= 8) s++;
            if (/[A-Z]/.test(val)) s++;
            if (/[0-9]/.test(val)) s++;
            if (/[^A-Za-z0-9]/.test(val)) s++;
            bars.forEach((b,i) => b.style.background = i < s ? colors[s-1] : '#e6e2dd');
            label.textContent = s > 0 ? labels[s-1] : '—';
            label.style.color = s > 0 ? colors[s-1] : '#584140';
        });
    </script>

</body>
</html>