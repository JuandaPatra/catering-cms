<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Catering') }} — Register</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }
        .orb-1 {
            width: 400px; height: 400px;
            background: #667eea;
            top: -100px; left: -100px;
            animation: orbFloat1 8s ease-in-out infinite;
        }
        .orb-2 {
            width: 350px; height: 350px;
            background: #764ba2;
            bottom: -80px; right: -80px;
            animation: orbFloat2 10s ease-in-out infinite;
        }
        .orb-3 {
            width: 250px; height: 250px;
            background: #f093fb;
            top: 50%; left: 60%;
            animation: orbFloat3 12s ease-in-out infinite;
        }

        @keyframes orbFloat1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.1); }
        }
        @keyframes orbFloat2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-50px, -30px) scale(1.15); }
        }
        @keyframes orbFloat3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 50px) scale(0.9); }
        }

        .register-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            padding: 44px 40px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.3);
            animation: cardFadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes cardFadeIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .register-brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .register-brand-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.35);
        }
        .register-brand-icon svg {
            width: 28px; height: 28px; fill: #fff;
        }
        .register-brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .register-brand p {
            font-size: 14px;
            color: rgba(255,255,255,0.55);
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.7);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 18px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            color: #fff;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
        }
        .form-group input::placeholder {
            color: rgba(255,255,255,0.3);
        }
        .form-group input:focus {
            border-color: #667eea;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        .input-error {
            border-color: #e74c3c !important;
        }
        .error-text {
            font-size: 12px;
            color: #ff6b6b;
            margin-top: 6px;
            display: block;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
            letter-spacing: 0.5px;
            margin-top: 8px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.45);
        }
        .btn-register:active {
            transform: translateY(0);
        }

        .register-footer {
            text-align: center;
            margin-top: 24px;
        }
        .register-footer span {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
        }
        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .register-footer a:hover {
            color: #8b9cf7;
        }

        @media (max-width: 480px) {
            .register-card {
                margin: 20px;
                padding: 36px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="register-card">
        <div class="register-brand">
            <div class="register-brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                </svg>
            </div>
            <h1>Catering</h1>
            <p>Create your account</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    class="{{ $errors->has('name') ? 'input-error' : '' }}"
                    required
                    autocomplete="name"
                    autofocus
                >
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}"
                    required
                    autocomplete="email"
                >
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="{{ $errors->has('password') ? 'input-error' : '' }}"
                    required
                    autocomplete="new-password"
                >
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input
                    id="password-confirm"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="btn-register" id="btn-register">
                Create Account
            </button>
        </form>

        <div class="register-footer">
            <span>Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
        </div>
    </div>
</body>
</html>
