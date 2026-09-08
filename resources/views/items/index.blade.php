<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #FDFAF7;
            --white:     #FFFFFF;
            --brown-900: #2C1810;
            --brown-800: #4A2C1A;
            --brown-700: #7C4F2A;
            --brown-500: #C68B59;
            --brown-300: #D4A87A;
            --brown-200: #E8D9CC;
            --brown-100: #F5EDE5;
            --amber:     #D4A853;
            --amber-bg:  #FEF6E4;
            --text:      #1C0F0A;
            --text-muted:#8B6E5A;
            --success:   #2D7A4F;
            --success-bg:#EAF7F0;
            --danger:    #B33A3A;
            --danger-bg: #FDEAEA;
            --info:      #1A5C99;
            --info-bg:   #E8F2FC;
            --radius:    10px;
            --shadow-sm: 0 1px 4px rgba(44,24,16,.06);
            --shadow:    0 4px 20px rgba(44,24,16,.09);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: var(--brown-900);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.18);
        }
        .topbar-brand {
            display: flex;
            align-items: center;
            gap: .65rem;
            text-decoration: none;
        }
        .topbar-icon {
            width: 34px; height: 34px;
            background: var(--brown-700);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .topbar-brand span {
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.3px;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .user-pill {
            display: flex;
            align-items: center;
            gap: .55rem;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 999px;
            padding: .3rem .75rem .3rem .4rem;
        }
        .user-avatar {
            width: 26px; height: 26px;
            background: var(--brown-700);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
        }
        .user-name { font-size: .8rem; font-weight: 600; color: #e8d9cc; }
        .role-badge {
            font-size: .68rem;
            font-weight: 700;
            padding: .2rem .5rem;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .role-badge.admin  { background: rgba(212,168,83,.2); color: var(--amber); }
        .role-badge.staff  { background: rgba(45,122,79,.2); color: #5bcc8e; }

        form.logout-form { margin: 0; }
        .btn-logout {
            padding: .35rem .85rem;
            background: transparent;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 8px;
            color: rgba(255,255,255,.7);
            font-family: inherit;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
            border-color: rgba(255,255,255,.35);
        }

        /* ── Main ── */
        .main { padding: 2rem; max-width: 1200px; margin: 0 auto; }

        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            animation: fadeUp .35s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-title { font-size: 1.45rem; font-weight: 800; color: var(--brown-900); }
        .page-sub   { font-size: .8rem; color: var(--text-muted); margin-top: .15rem; }

        /* ── Stat cards ── */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeUp .4s .05s ease both;
        }
        .stat-card {
            background: var(--white);
            border: 1px solid var(--brown-200);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .stat-icon.brown { background: var(--brown-100); }
        .stat-icon.amber { background: var(--amber-bg); }
        .stat-icon.green { background: var(--success-bg); }
        .stat-label { font-size: .78rem; color: var(--text-muted); font-weight: 500; }
        .stat-value { font-size: 1.6rem; font-weight: 800; color: var(--brown-900); line-height: 1.1; }

        /* ── Alerts ── */
        .alert {
            padding: .75rem 1rem;
            border-radius: var(--radius);
            font-size: .865rem;
            font-weight: 500;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: .6rem;
            animation: slideIn .3s ease both;
            position: relative;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-8px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .alert.success { background: var(--success-bg); border: 1px solid #a3d4bb; color: var(--success); }
        .alert.info    { background: var(--info-bg);    border: 1px solid #90bce8; color: var(--info); }
        .alert.danger  { background: var(--danger-bg);  border: 1px solid #e8a3a3; color: var(--danger); }
        .alert-close {
            position: absolute; right: .8rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            font-size: 1rem; color: inherit; opacity: .6; line-height: 1;
        }
        .alert-close:hover { opacity: 1; }

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            animation: fadeUp .4s .1s ease both;
        }
        .section-title { font-size: .95rem; font-weight: 700; color: var(--brown-800); }
        .staff-note { font-size: .8rem; color: var(--text-muted); font-style: italic; }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .55rem 1.1rem;
            background: var(--brown-700);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-family: inherit;
            font-size: .85rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
        }
        .btn-primary:hover {
            background: var(--brown-900);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(44,24,16,.22);
            color: #fff;
        }

        /* ── Table ── */
        .table-wrap {
            background: var(--white);
            border: 1px solid var(--brown-200);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            animation: fadeUp .4s .15s ease both;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: var(--brown-100); }
        thead th {
            padding: .85rem 1rem;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--brown-700);
            text-align: left;
            border-bottom: 1px solid var(--brown-200);
        }
        tbody tr {
            border-bottom: 1px solid var(--brown-100);
            transition: background .18s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--brown-100); }
        td {
            padding: .85rem 1rem;
            font-size: .855rem;
            color: var(--text);
            vertical-align: middle;
        }
        .kode-badge {
            display: inline-block;
            background: var(--brown-100);
            border: 1px solid var(--brown-200);
            color: var(--brown-700);
            font-size: .72rem;
            font-weight: 700;
            padding: .2rem .55rem;
            border-radius: 6px;
            letter-spacing: .04em;
        }
        .kat-tag {
            display: inline-block;
            background: var(--amber-bg);
            color: #7a5200;
            font-size: .7rem;
            font-weight: 600;
            padding: .18rem .5rem;
            border-radius: 6px;
        }
        .stok-val { font-weight: 700; color: var(--brown-800); }
        .text-muted-sm { font-size: .78rem; color: var(--text-muted); }
        .empty-row td { text-align: center; padding: 3rem; color: var(--text-muted); font-size: .9rem; }

        /* action buttons */
        .action-group { display: flex; gap: .4rem; align-items: center; }
        .btn-edit, .btn-del {
            padding: .32rem .7rem;
            border-radius: 7px;
            font-family: inherit;
            font-size: .77rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: background .18s, transform .15s;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
        }
        .btn-edit { background: var(--amber-bg); color: #7a5200; }
        .btn-edit:hover { background: #fce8a6; transform: translateY(-1px); color: #5a3c00; }
        .btn-del  { background: var(--danger-bg); color: var(--danger); }
        .btn-del:hover  { background: #f7c5c5; transform: translateY(-1px); }
        .restricted { font-size: .75rem; color: var(--text-muted); }
    </style>
</head>
<body>

<!-- Topbar -->
<header class="topbar">
    <a href="{{ route('items.index') }}" class="topbar-brand">
        <div class="topbar-icon">📦</div>
        <span>Inventory System</span>
    </a>
    <div class="topbar-right">
        <div class="user-pill">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span class="user-name">{{ Auth::user()->name }}</span>
            <span class="role-badge {{ Auth::user()->role }}">{{ Auth::user()->role }}</span>
        </div>
        <form class="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</header>

<main class="main">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <div class="page-title">Dashboard Inventory</div>
            <div class="page-sub">Pengelolaan stok & data barang gudang</div>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon brown">🗂️</div>
            <div>
                <div class="stat-label">Total Jenis Barang</div>
                <div class="stat-value">{{ $totalItems }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon amber">📊</div>
            <div>
                <div class="stat-label">Total Seluruh Stok</div>
                <div class="stat-value">{{ number_format($totalStok) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">💰</div>
            <div>
                <div class="stat-label">Total Nilai Inventory</div>
                <div class="stat-value" style="font-size:1.1rem;">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert success">✅ {{ session('success') }} <button class="alert-close" onclick="this.parentElement.remove()">✕</button></div>
    @endif
    @if(session('info'))
        <div class="alert info">🔵 {{ session('info') }} <button class="alert-close" onclick="this.parentElement.remove()">✕</button></div>
    @endif
    @if(session('danger'))
        <div class="alert danger">🗑️ {{ session('danger') }} <button class="alert-close" onclick="this.parentElement.remove()">✕</button></div>
    @endif

    <!-- Toolbar -->
    <div class="toolbar">
        <span class="section-title">Daftar Barang</span>
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('items.create') }}" class="btn-primary">＋ Tambah Barang</a>
        @else
            <span class="staff-note">Login sebagai Staff — hanya dapat melihat & update stok</span>
        @endif
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $i => $item)
                <tr>
                    <td class="text-muted-sm">{{ $i + 1 }}</td>
                    <td><span class="kode-badge">{{ $item->kode_barang }}</span></td>
                    <td style="font-weight:600;">{{ $item->nama_barang }}</td>
                    <td><span class="kat-tag">{{ $item->kategori }}</span></td>
                    <td><span class="stok-val">{{ number_format($item->stok) }}</span></td>
                    <td class="text-muted-sm">{{ $item->satuan }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-muted-sm">{{ $item->keterangan ?? '—' }}</td>
                    <td>
                        <div class="action-group">
                            @if(Auth::user()->role == 'admin')
                                <a href="{{ route('items.edit', $item->id) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-del">🗑</button>
                                </form>
                            @else
                                <a href="{{ route('items.edit', $item->id) }}" class="btn-edit">✏️ Edit Stok</a>
                                <span class="restricted">Hapus: Admin only</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="9">Belum ada data barang. <a href="{{ route('items.create') }}" style="color:var(--brown-700)">Tambah sekarang →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
</body>
</html>