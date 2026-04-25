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
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Source Sans 3', sans-serif;
            min-height: 100vh;
            background-color: #F5F0EB;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h30v30H0V0zm30 30h30v30H30V30z' fill='%23B33A3A' fill-opacity='0.03'/%3E%3C/svg%3E");
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .font-headline { font-family: 'Playfair Display', serif; }
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }
        .blob {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 880px;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 60px rgba(179,58,58,0.15), 0 4px 20px rgba(0,0,0,0.08);
        }
        @media (min-width: 768px) {
            .card { flex-direction: row; min-height: 600px; }
        }
        .panel-left {
            background: linear-gradient(145deg, #C1403F 0%, #922225 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        @media (min-width: 768px) { .panel-left { width: 42%; } }
        .panel-left::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -40px;
            width: 250px; height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        .panel-right {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 48px 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }
        @media (min-width: 768px) { .panel-right { width: 58%; } }
        @media (max-width: 767px) {
            .panel-right { padding: 40px 28px; }
            .panel-left { padding: 36px 28px; }
        }
        .form-inner { width: 100%; max-width: 360px; }
        .input-field {
            width: 100%;
            padding: 13px 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid #e6e2dd;
            font-size: 14px;
            font-family: 'Source Sans 3', sans-serif;
            color: #1d1b19;
            transition: border-color 0.2s;
            outline: none;
        }
        .input-field:focus { border-bottom-color: #B33A3A; }
        .input-field::placeholder { color: #b0a8a0; }
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #C1403F 0%, #922225 100%);
            color: white;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 13px;
            padding: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            box-shadow: 0 6px 20px rgba(179,58,58,0.3);
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-primary:hover { opacity: 0.92; transform: translateY(-1px); }
        .btn-primary:active { transform: scale(0.98); }
        .feature-item { display: flex; gap: 12px; align-items: flex-start; }
        .feature-icon { color: rgba(255,255,255,0.9); flex-shrink: 0; margin-top: 1px; }
        .feature-text { color: rgba(255,255,255,0.88); font-size: 13px; line-height: 1.65; }
        label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #584140;
            margin-bottom: 8px;
        }
        .strength-bar {
            flex: 1;
            height: 4px;
            border-radius: 999px;
            background: #e6e2dd;
            transition: background 0.3s;
        }
    </style>
</head>
<body>

    <div class="blob" style="top:-150px; left:-150px; background:radial-gradient(circle, rgba(232,149,109,0.2) 0%, transparent 70%);"></div>
    <div class="blob" style="bottom:-150px; right:-150px; background:radial-gradient(circle, rgba(179,58,58,0.12) 0%, transparent 70%);"></div>

    <main class="card">

        {{-- LEFT --}}
        <section class="panel-left">
            <div style="position:relative; z-index:2;">

                <h1 class="font-headline" style="color:white; font-size:18px; font-weight:700; font-style:italic; margin-bottom:24px;">
                    Blog Multi-auteurs
                </h1>

                <h2 class="font-headline" style="color:white; font-size:28px; line-height:1.3; margin-bottom:32px; font-weight:700;">
                    Créez, publiez, inspirez.
                </h2>

                <div style="display:flex; flex-direction:column; gap:20px;">
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <p class="feature-text">Partagez votre point de vue avec des milliers de lecteurs engagés.</p>
                    </div>
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <p class="feature-text">Outils d'édition sophistiqués respectant la typographie africaine.</p>
                    </div>
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <p class="feature-text">Rejoignez une communauté d'auteurs camerounais engagés.</p>
                    </div>
                </div>
            </div>

            <div style="position:relative; z-index:2; margin-top:32px;">
                <p style="color:rgba(255,255,255,0.55); font-size:12px; font-style:italic;">
                    Participez à la préservation du patrimoine par l'innovation.
                </p>
            </div>
        </section>

        {{-- RIGHT --}}
        <section class="panel-right">
            <div class="form-inner">

                <div style="margin-bottom:28px;">
                    <h2 class="font-headline" style="font-size:30px; color:#1d1b19; margin:0 0 6px;">Créer un compte</h2>
                    <p style="font-size:14px; color:#8b7d7b; margin:0;">
                        Déjà membre ?
                        <a href="{{ route('login') }}" style="color:#B33A3A; font-weight:700; text-decoration:none;">Connexion</a>
                    </p>
                </div>

                @if($errors->any())
                <div style="background:#fef2f2; border-left:4px solid #ef4444; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; color:#dc2626;">
                    <ul style="margin:0; padding:0; list-style:none;">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:18px;">
                    @csrf

                    <div>
                        <label>Nom complet</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Jean-Pierre Bemba" class="input-field"/>
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="jp.bemba@exemple.cm" class="input-field"/>
                    </div>

                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                            <label style="margin:0;">Mot de passe</label>
                            <span id="strength-label" style="font-size:10px; font-weight:700; color:#8f4c2a; text-transform:uppercase;">—</span>
                        </div>
                        <input type="password" name="password" id="password"
                               placeholder="••••••••••••" class="input-field"/>
                        <div style="display:flex; gap:4px; margin-top:8px;">
                            <div class="strength-bar" id="bar-1"></div>
                            <div class="strength-bar" id="bar-2"></div>
                            <div class="strength-bar" id="bar-3"></div>
                            <div class="strength-bar" id="bar-4"></div>
                        </div>
                    </div>

                    <div>
                        <label>Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                               placeholder="••••••••••••" class="input-field"/>
                    </div>

                    <div style="padding-top:8px;">
                        <button type="submit" class="btn-primary">S'inscrire</button>
                    </div>
                </form>

                <div style="margin-top:24px; padding-top:20px; border-top:1px solid #f2ede8; text-align:center;">
                    <p style="font-size:10px; color:#8b716f; text-transform:uppercase; letter-spacing:0.04em; margin:0;">
                        En vous inscrivant, vous acceptez nos
                        <a href="#" style="text-decoration:underline; color:#8b716f;">Conditions</a>
                        et notre
                        <a href="#" style="text-decoration:underline; color:#8b716f;">Politique de confidentialité</a>.
                    </p>
                </div>

            </div>
        </section>

    </main>

    <script>
        const input = document.getElementById('password');
        const bars = ['bar-1','bar-2','bar-3','bar-4'].map(id => document.getElementById(id));
        const label = document.getElementById('strength-label');
        const colors = ['#C0392B','#D4860A','#2E7D4F','#005650'];
        const labels = ['Faible','Moyen','Fort','Très fort'];

        if(input) {
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
        }
    </script>

</body>
</html>