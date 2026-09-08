<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang — Inventory System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:#FDFAF7; --white:#FFFFFF; --brown-900:#2C1810; --brown-800:#4A2C1A;
            --brown-700:#7C4F2A; --brown-500:#C68B59; --brown-200:#E8D9CC; --brown-100:#F5EDE5;
            --amber:#D4A853; --amber-bg:#FEF6E4; --text:#1C0F0A; --text-muted:#8B6E5A;
            --radius:10px; --shadow:0 4px 20px rgba(44,24,16,.09);
        }
        body { font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }

        /* topbar */
        .topbar {
            background:var(--brown-900); padding:0 2rem; height:60px;
            display:flex; align-items:center; justify-content:space-between;
            box-shadow:0 2px 12px rgba(0,0,0,.18);
        }
        .topbar-brand { display:flex; align-items:center; gap:.6rem; text-decoration:none; }
        .topbar-icon { width:34px;height:34px;background:var(--brown-700);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px; }
        .topbar-brand span { font-size:1rem;font-weight:800;color:#fff; }
        .btn-back {
            display:inline-flex;align-items:center;gap:.4rem;
            padding:.35rem .85rem; background:transparent; border:1px solid rgba(255,255,255,.18);
            border-radius:8px; color:rgba(255,255,255,.75); font-family:inherit;
            font-size:.78rem; font-weight:600; text-decoration:none;
            transition:all .2s;
        }
        .btn-back:hover { background:rgba(255,255,255,.08);color:#fff;border-color:rgba(255,255,255,.35); }

        /* main */
        .main { padding:2rem; max-width:680px; margin:0 auto; }

        .form-card {
            background:var(--white);
            border:1px solid var(--brown-200);
            border-radius:16px;
            padding:2rem 2.25rem;
            box-shadow:var(--shadow);
            animation:fadeUp .35s ease both;
        }
        @keyframes fadeUp {
            from{opacity:0;transform:translateY(16px);}
            to{opacity:1;transform:translateY(0);}
        }
        .form-header { margin-bottom:1.75rem; padding-bottom:1rem; border-bottom:1px solid var(--brown-100); }
        .form-title { font-size:1.2rem; font-weight:800; color:var(--brown-900); }
        .form-sub { font-size:.8rem; color:var(--text-muted); margin-top:.2rem; }

        .field { margin-bottom:1.1rem; }
        .row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

        label {
            display:block; font-size:.76rem; font-weight:700;
            color:var(--text-muted); text-transform:uppercase;
            letter-spacing:.05em; margin-bottom:.4rem;
        }
        label .req { color:#c94444; margin-left:2px; }
        label .opt { font-weight:400; text-transform:none; letter-spacing:0; color:#bba99a; margin-left:4px; }

        input[type="text"], input[type="number"], textarea {
            width:100%; padding:.65rem .9rem;
            border:1.5px solid var(--brown-200); border-radius:var(--radius);
            font-family:inherit; font-size:.88rem; color:var(--text);
            background:var(--bg); outline:none;
            transition:border-color .2s, box-shadow .2s;
        }
        input:focus, textarea:focus {
            border-color:var(--brown-500);
            box-shadow:0 0 0 3px rgba(198,139,89,.18);
        }
        input.is-invalid, textarea.is-invalid { border-color:#e05252; }
        .err { color:#c94444; font-size:.75rem; margin-top:.3rem; }
        textarea { resize:vertical; min-height:80px; }

        .form-footer {
            display:flex; gap:.75rem; margin-top:1.75rem;
            padding-top:1.25rem; border-top:1px solid var(--brown-100);
        }
        .btn-submit {
            flex:1; padding:.7rem; background:var(--brown-700); color:#fff;
            border:none; border-radius:var(--radius); font-family:inherit;
            font-size:.9rem; font-weight:700; cursor:pointer;
            transition:background .2s, transform .15s, box-shadow .2s;
        }
        .btn-submit:hover { background:var(--brown-900); transform:translateY(-1px); box-shadow:0 4px 14px rgba(44,24,16,.22); }
        .btn-cancel {
            padding:.7rem 1.25rem; background:var(--brown-100); color:var(--brown-700);
            border:1.5px solid var(--brown-200); border-radius:var(--radius);
            font-family:inherit; font-size:.9rem; font-weight:600;
            text-decoration:none; display:inline-flex; align-items:center;
            transition:background .2s;
        }
        .btn-cancel:hover { background:var(--brown-200); color:var(--brown-900); }
    </style>
</head>
<body>
<header class="topbar">
    <a href="{{ route('items.index') }}" class="topbar-brand">
        <div class="topbar-icon">📦</div>
        <span>Inventory System</span>
    </a>
    <a href="{{ route('items.index') }}" class="btn-back">← Kembali</a>
</header>

<main class="main">
    <div class="form-card">
        <div class="form-header">
            <div class="form-title">Tambah Barang Baru</div>
            <div class="form-sub">Isi semua field yang wajib diisi (<span style="color:#c94444">*</span>)</div>
        </div>

        <form action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="field">
                <label>Kode Barang <span class="req">*</span></label>
                <input type="text" name="kode_barang"
                       class="{{ $errors->has('kode_barang') ? 'is-invalid' : '' }}"
                       value="{{ old('kode_barang') }}" placeholder="Contoh: BRG-001">
                @error('kode_barang')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Nama Barang <span class="req">*</span></label>
                <input type="text" name="nama_barang"
                       class="{{ $errors->has('nama_barang') ? 'is-invalid' : '' }}"
                       value="{{ old('nama_barang') }}" placeholder="Nama lengkap barang">
                @error('nama_barang')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Kategori <span class="req">*</span></label>
                <input type="text" name="kategori"
                       class="{{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                       value="{{ old('kategori') }}" placeholder="Contoh: ATK, Elektronik, Bahan Baku">
                @error('kategori')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="field">
                    <label>Stok <span class="req">*</span></label>
                    <input type="number" name="stok" min="0"
                           class="{{ $errors->has('stok') ? 'is-invalid' : '' }}"
                           value="{{ old('stok', 0) }}">
                    @error('stok')<div class="err">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label>Satuan <span class="req">*</span></label>
                    <input type="text" name="satuan"
                           class="{{ $errors->has('satuan') ? 'is-invalid' : '' }}"
                           value="{{ old('satuan') }}" placeholder="Pcs, Box, Rim ...">
                    @error('satuan')<div class="err">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="field">
                <label>Harga Satuan (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_satuan" min="0"
                       class="{{ $errors->has('harga_satuan') ? 'is-invalid' : '' }}"
                       value="{{ old('harga_satuan', 0) }}">
                @error('harga_satuan')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Keterangan <span class="opt">(opsional)</span></label>
                <textarea name="keterangan"
                          class="{{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                          placeholder="Catatan tambahan mengenai barang...">{{ old('keterangan') }}</textarea>
                @error('keterangan')<div class="err">{{ $message }}</div>@enderror
            </div>

            <div class="form-footer">
                <a href="{{ route('items.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Simpan Barang</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>