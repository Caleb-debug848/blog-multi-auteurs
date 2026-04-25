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
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Source Sans 3', sans-serif;
            min-height: 100vh;
            background-color: #F5F0EB;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h30v30H0V0zm30 30h30v30H30V30z' fill='%23B33A3A' fill-opacity='0.03'/%3E%3Cpath d='M30 0h30v30H30V0zM0 30h30v30H0V30z' fill='%23E8956D' fill-opacity='0.03'/%3E%3C/svg%3E");
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
        /* Card */
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
            .card { flex-direction: row; min-height: 560px; }
        }
        /* Left panel */
        .panel-left {
            background: linear-gradient(145deg, #C1403F 0%, #922225 100%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        @media (min-width: 768px) {
            .panel-left { width: 42%; }
        }
        .panel-left::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        /* Right panel */
        .panel-right {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 48px 56px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media (min-width: 768px) {
            .panel-right { width: 58%; }
        }
        @media (max-width: 767px) {
            .panel-right { padding: 40px 32px; }
            .panel-left { padding: 40px 32px; }
        }
        .form-inner { width: 100%; max-width: 360px; }
        /* Input */
        .input-field {
            width: 100%;
            padding: 14px 14px 14px 44px;
            background: rgba(242,237,232,0.8);
            border: 2px solid transparent;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Source Sans 3', sans-serif;
            color: #1d1b19;
            transition: border-color 0.2s, background 0.2s;
            outline: none;
        }
        .input-field:focus {
            border-color: #B33A3A;
            background: #fff;
        }
        .input-field::placeholder { color: #b0a8a0; }
        .input-wrap {
            position: relative;
        }
        .input-wrap .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0a8a0;
            font-size: 18px;
        }
        /* Button */
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #C1403F 0%, #922225 100%);
            color: white;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 15px;
            padding: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(179,58,58,0.3);
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-primary:hover { opacity: 0.92; transform: translateY(-1px); }
        .btn-primary:active { transform: scale(0.98); }
        /* Feature item */
        .feature-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .feature-icon {
            color: #fda77d;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .feature-text {
            color: rgba(255,255,255,0.88);
            font-size: 13px;
            line-height: 1.65;
        }
        label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #584140;
            margin-bottom: 8px;
        }
        .divider {
            height: 1px;
            background: rgba(242,237,232,0.8);
            margin: 28px 0;
        }
    </style>
</head>
<body>

    {{-- Blobs --}}
    <div class="blob" style="top:-150px; left:-150px; background:radial-gradient(circle, rgba(232,149,109,0.2) 0%, transparent 70%);"></div>
    <div class="blob" style="bottom:-150px; right:-150px; background:radial-gradient(circle, rgba(179,58,58,0.12) 0%, transparent 70%);"></div>

    <main class="card">

        {{-- LEFT --}}
        <section class="panel-left">
            <div style="position:relative; z-index:2;">

                {{-- Logo --}}
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:32px;">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                        <circle cx="14" cy="14" r="14" fill="rgba(255,255,255,0.15)"/>
                        <path d="M14 6 L20 20 H8 Z" fill="white" opacity="0.9"/>
                        <rect x="12" y="20" width="4" height="4" rx="1" fill="white" opacity="0.7"/>
                    </svg>
                    <span class="font-headline" style="color:white; font-size:18px; font-weight:700; letter-spacing:-0.02em;">Blog Multi-auteurs</span>
                </div>

                {{-- Title --}}
                <h1 class="font-headline" style="color:white; font-size:26px; line-height:1.35; margin-bottom:32px; font-weight:700;">
                    L'actualité camerounaise,<br/>vue par ses experts.
                </h1>

                {{-- Features --}}
                <div style="display:flex; flex-direction:column; gap:20px;">
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">verified</span>
                        <p class="feature-text">Analyses exclusives rédigées par des journalistes et intellectuels locaux.</p>
                    </div>
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">history_edu</span>
                        <p class="feature-text">Participez au débat public et suivez les tendances culturelles et économiques.</p>
                    </div>
                    <div class="feature-item">
                        <span class="material-symbols-outlined feature-icon" style="font-variation-settings:'FILL' 1;">auto_stories</span>
                        <p class="feature-text">Une expérience de lecture éditoriale pensée pour l'excellence intellectuelle.</p>
                    </div>
                </div>
            </div>

            {{-- Bottom --}}
            <div style="position:relative; z-index:2; padding-top:28px; border-top:1px solid rgba(255,255,255,0.15); margin-top:32px;">
                <p style="color:rgba(255,255,255,0.55); font-size:10px; text-transform:uppercase; letter-spacing:0.18em; font-style:italic;">
                    Patrimoine & Innovation — Yaoundé
                </p>
            </div>
        </section>

        {{-- RIGHT --}}
        <section class="panel-right">
            <div class="form-inner">

                <div style="margin-bottom:32px;">
                    <h2 class="font-headline" style="font-size:34px; color:#922225; margin:0 0 6px;">Connexion</h2>
                    <p style="color:#8b7d7b; font-size:14px; margin:0;">Bienvenue dans votre espace éditorial personnel.</p>
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
                        <label>Adresse Email</label>
                        <div class="input-wrap">
                            <span class="material-symbols-outlined icon">mail</span>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="nom@exemple.cm" class="input-field"/>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                            <label style="margin:0;">Mot de passe</label>
                            @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               style="font-size:11px; font-weight:700; color:#B33A3A; text-decoration:none; text-transform:uppercase; letter-spacing:0.06em;">
                                Oublié ?
                            </a>
                            @endif
                        </div>
                        <div class="input-wrap">
                            <span class="material-symbols-outlined icon">lock</span>
                            <input type="password" name="password"
                                   placeholder="••••••••" class="input-field"/>
                        </div>
                    </div>

                    {{-- Remember --}}
                    <div style="display:flex; align-items:center; gap:10px;">
                        <input type="checkbox" name="remember" id="remember"
                               style="width:16px; height:16px; accent-color:#B33A3A; cursor:pointer;"/>
                        <label for="remember" style="margin:0; text-transform:none; letter-spacing:normal; font-size:14px; color:#6b7280; font-weight:400; cursor:pointer;">
                            Se souvenir de moi
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-primary">
                        Se connecter
                        <span class="material-symbols-outlined" style="font-size:18px;">arrow_forward</span>
                    </button>
                </form>

                <div class="divider"></div>

                <p style="text-align:center; font-size:14px; color:#8b7d7b; margin:0;">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}"
                       style="color:#B33A3A; font-weight:700; text-decoration:none;">S'inscrire</a>
                </p>

            </div>
        </section>

    </main>

</body>
</html>