<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }
        .app-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        .app-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }
        .form-control {
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: 0.9rem;
            padding: 0.6rem 0.9rem;
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }
        .btn-login {
            width: 100%;
            padding: 0.65rem;
            background: #2563eb;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1 class="app-title">Inventory System</h1>
        <p class="app-subtitle">Masuk untuk mengelola data barang</p>

        @if (session('status'))
            <div class="alert alert-info py-2 mb-3" style="font-size:0.875rem;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="nama@email.com" required autofocus autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">Masuk</button>
        </form>
    </div>
</body>
</html>
