<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Receitas') - GCS Receitas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; }
        .env-badge { position: fixed; top: 16px; right: 16px; background: #0ea5e9; color: white; font-size: 0.75rem; font-weight: 700; padding: 6px 14px; border-radius: 999px; text-transform: uppercase; letter-spacing: 1px; z-index: 100; }
        .env-badge.production { background: #dc2626; }
        .env-badge.homolog { background: #d97706; }
        nav { background: #1e293b; border-bottom: 1px solid #334155; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; }
        nav .brand { font-size: 1.25rem; font-weight: 700; color: #38bdf8; }
        nav .user-info { display: flex; align-items: center; gap: 16px; font-size: 0.875rem; color: #94a3b8; }
        nav button { background: #334155; color: #e2e8f0; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 0.875rem; }
        nav button:hover { background: #475569; }
        .container { max-width: 1000px; margin: 32px auto; padding: 0 24px; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; }
        .alert-success { background: #064e3b; color: #6ee7b7; border: 1px solid #047857; }
        .alert-error { background: #450a0a; color: #fca5a5; border: 1px solid #b91c1c; }
        .btn { display: inline-block; background: #0ea5e9; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer; }
        .btn:hover { background: #0284c7; }
        .btn-danger { background: #dc2626; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-secondary { background: #334155; }
        .btn-secondary:hover { background: #475569; }
    </style>
</head>
<body>
    <span class="env-badge {{ config('app.env') }}">{{ config('app.env') }}</span>

    @auth
    <nav>
        <span class="brand">🍳 GCS Receitas</span>
        <div class="user-info">
            <span>Olá, {{ Auth::user()->nome }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </div>
    </nav>
    @endauth

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
