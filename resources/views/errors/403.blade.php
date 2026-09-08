<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak</title>
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
        .error-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 3rem 2.5rem;
            text-align: center;
            max-width: 420px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }
        .error-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            background: #fef2f2;
            border-radius: 50%;
            margin-bottom: 1.25rem;
            font-size: 2rem;
        }
        .error-code {
            font-size: 3rem;
            font-weight: 800;
            color: #ef4444;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .error-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }
        .error-msg {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-badge">🚫</div>
        <div class="error-code">403</div>
        <div class="error-title">Akses Ditolak</div>
        <p class="error-msg">
            Anda tidak memiliki izin untuk mengakses halaman ini.<br>
            Fitur ini hanya tersedia untuk <strong>Admin</strong>.
        </p>
        <a href="{{ route('items.index') }}" class="btn btn-primary px-4" style="border-radius:8px;">
            ← Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
