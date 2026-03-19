<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{asset('graduation-cap-solid.svg')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap');

        :root {
            --accent: #00d2ff; /* Vert émeraude (succès/nouveau) */
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);

            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: #e2e8f0;
        }

        .reg-card {
            background: var(--glass);
            padding: 35px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        h2 { text-align: center; margin-bottom: 25px; color: var(--accent); }

        .grid-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .full-width { grid-column: span 2; }

        .input-box { position: relative; margin-bottom: 15px; }

        input, select {
            width: 100%;
            padding: 12px 12px 12px 40px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            outline: none;
            font-size: 0.9rem;
        }

        select option { background: #1e293b; }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            opacity: 0.7;
        }

        .btn-reg {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-reg:hover {
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
            filter: brightness(1.1);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
        }

        .footer a { color: var(--accent); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="reg-card">
        <h2>Créer Un Compte</h2>

        <form id="regForm" method="post" action="/inscription_traitement">
            @csrf
            <div class="grid-inputs">
                <div class="input-box full-width">
                    @error('name')
                        <span>{{$message}}</span>
                    @enderror
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nom complet" name="name" value="{{ old('name')}}" required>
                </div>
                <div class="input-box full-width">
                    @error('email')
                        <span>{{$message}}</span>
                    @enderror
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" value="{{old('email')}}" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="p1" placeholder="Mot de passe" name="password" required>
                </div>
                <div class="input-box">
                    @error('password')
                        <span>{{$message}}</span>
                    @enderror
                    <i class="fas fa-check-circle"></i>
                    <input type="password" id="p2" placeholder="Confirmer" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn-reg">Créer mon espace</button>
        </form>

        <div class="footer">
            <p>Déjà un compte ? <a href="{{route('login')}}">Se connecter</a></p>
        </div>
    </div>

</body>
</html>
