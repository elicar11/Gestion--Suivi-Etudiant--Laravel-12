<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('graduation-cap-solid.svg') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap');

        :root {
            --primary: #00d2ff;
            /* Bleu académique moderne */
            --bg-dark: #0f172a;
            /* Bleu nuit profond */
            --glass: rgba(255, 255, 255, 0.03);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            background-image:
                radial-gradient(at 0% 0%, rgba(0, 210, 255, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 210, 255, 0.1) 0px, transparent 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #e2e8f0;
        }

        .login-card {
            background: var(--glass);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .logo-area i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 15px;
            filter: drop-shadow(0 0 10px var(--primary));
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            font-weight: 700;
        }

        p.subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 210, 255, 0.1);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            left: auto !important;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: #0f172a;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px var(--primary);
            filter: brightness(1.1);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .footer-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-area"><i class="fas fa-key"></i></div>
        <h1>Récupération</h1>
        <p class="subtitle">Entrez votre email pour recevoir un lien de réinitialisation</p>

        @if (session('status'))
            <div style="color: #00ffcc; margin-bottom: 15px; font-size: 0.9rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required autofocus>
            </div>
            @error('email')
                <p style="color: #ff4d4d; font-size: 0.8rem; margin-bottom: 10px;">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn-login">Envoyer le lien</button>
        </form>

        <div class="footer-links">
            <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Retour à la connexion</a>
        </div>
    </div>
</body>
</html>
