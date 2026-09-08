<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventory System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #FDFAF7;
            --white:     #FFFFFF;
            --brown-900: #2C1810;
            --brown-700: #7C4F2A;
            --brown-500: #C68B59;
            --brown-200: #E8D9CC;
            --brown-100: #F5EDE5;
            --amber:     #D4A853;
            --text:      #1C0F0A;
            --text-muted:#8B6E5A;
            --radius:    10px;
            --shadow:    0 4px 20px rgba(44,24,16,.08);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--brown-200);
            border-radius: 16px;
            padding: 2.5rem 2.25rem;
            width: 100%;
            max-width: 400px;
            box-shadow: var(--shadow);
            animation: fadeUp .4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* brand */
        .brand { text-align: center; margin-bottom: 2rem; }
        .brand-dot {
            display: inline-block;
            width: 48px; height: 48px;
            background: var(--brown-700);
            border-radius: 12px;
            margin-bottom: .85rem;
            position: relative;
        }
        .brand-dot::after {
            content: '📦';
            font-size: 22px;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%,-50%);
        }
        .brand h1 { font-size: 1.4rem; font-weight: 800; color: var(--brown-900); }
        .brand p  { font-size: .82rem; color: var(--text-muted); margin-top: .2rem; }

        label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .4rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: .65rem .9rem;
            border: 1.5px solid var(--brown-200);
            border-radius: var(--radius);
            font-family: inherit;
            font-size: .9rem;
            color: var(--text);
            background: var(--bg);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        input:focus {
            border-color: var(--brown-500);
            box-shadow: 0 0 0 3px rgba(198,139,89,.18);
        }
        .field { margin-bottom: 1.1rem; }
        .invalid { border-color: #e05252 !important; }
        .err-msg { color: #c94444; font-size: .76rem; margin-top: .3rem; }

        .btn {
            display: block;
            width: 100%;
            padding: .72rem;
            background: var(--brown-700);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: .93rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            margin-top: 1.5rem;
            letter-spacing: .02em;
        }
        .btn:hover {
            background: var(--brown-900);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(44,24,16,.22);
        }
        .btn:active { transform: translateY(0); }

        .alert {
            padding: .65rem .9rem;
            border-radius: var(--radius);
            font-size: .84rem;
            margin-bottom: 1rem;
            background: #fef9f0;
            border: 1px solid var(--amber);
            color: #7a5a00;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand">
            <div class="brand-dot"></div>
            <h1>Inventory System</h1>
            <p>Sistem Manajemen Gudang & Stok Barang</p>
        </div>

        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'invalid' : '' }}"
                       placeholder="nama@email.com" required autofocus autocomplete="username">
                @error('email')<div class="err-msg">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                       class="{{ $errors->has('password') ? 'invalid' : '' }}"
                       placeholder="••••••••" required autocomplete="current-password">
                @error('password')<div class="err-msg">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>
</body>
</html>
