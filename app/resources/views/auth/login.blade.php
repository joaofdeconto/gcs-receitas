<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GCS Receitas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .env-badge { position: fixed; top: 16px; right: 16px; background: #0ea5e9; color: white; font-size: 0.75rem; font-weight: 700; padding: 6px 14px; border-radius: 999px; text-transform: uppercase; letter-spacing: 1px; }
        .env-badge.production { background: #dc2626; }
        .env-badge.homolog { background: #d97706; }
        .card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 40px; width: 100%; max-width: 400px; }
        h1 { font-size: 1.75rem; color: #38bdf8; margin-bottom: 8px; text-align: center; }
        p.subtitle { color: #94a3b8; text-align: center; margin-bottom: 28px; font-size: 0.875rem; }
        label { display: block; font-size: 0.875rem; color: #94a3b8; margin-bottom: 6px; }
        input { width: 100%; padding: 10px 14px; background: #0f172a; border: 1px solid #334155; border-radius: 8px; color: #e2e8f0; font-size: 0.95rem; margin-bottom: 18px; }
        input:focus { outline: none; border-color: #0ea5e9; }
        button { width: 100%; background: #0ea5e9; color: white; padding: 12px; border: none; border-radius: 8px; font-size: 0.95rem; font-weight: 600; cursor: pointer; }
        button:hover { background: #0284c7; }
        .alert-error { background: #450a0a; color: #fca5a5; border: 1px solid #b91c1c; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 0.875rem; }
        .hint { margin-top: 20px; text-align: center; font-size: 0.75rem; color: #64748b; }
    </style>
</head>
<body>
    <span class="env-badge {{ config('app.env') }}">{{ config('app.env') }}</span>

    <div class="card">
        <h1>🍳 GCS Receitas</h1>
        <p class="subtitle">Entre com suas credenciais</p>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <label for="login">Login</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <p class="hint">Usuário padrão: admin / senha123</p>
    </div>
</body>
</html>
