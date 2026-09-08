<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Dashboard Inventory</h2>
    <hr>

    <!-- Informasi User, Role, & Tombol Logout -->
    <div class="d-flex justify-content-between align-items-center p-3 bg-light border rounded mb-4">
        <div>
            <h5 class="mb-1">Halo, {{ Auth::user()->name }}!</h5>
            <p class="mb-0">Status Login:
                <span class="badge bg-{{ Auth::user()->role == 'admin' ? 'danger' : 'success' }}">
                    {{ strtoupper(Auth::user()->role) }}
                </span>
            </p>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>

    <!-- Ringkasan Dashboard -->
    <div class="row my-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary p-3">
                <h5>Total Jenis Barang</h5>
                <h3>{{ $totalItems }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success p-3">
                <h5>Total Seluruh Stok</h5>
                <h3>{{ $totalStok }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning p-3">
                <h5>Total Nilai Inventory</h5>
                <h3>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✅</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>🔵</strong> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>🗑️</strong> {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Hak Akses Role (Admin vs Staff) -->
    @if(Auth::user()->role == 'admin')
        <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>
    @else
        <p class="text-muted">Anda login sebagai Staff (Hanya dapat melihat data inventory).</p>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
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
            @forelse($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->satuan }}</td>
                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @else
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit Stok</a>
                        <span class="text-muted small d-block">Hapus/Tambah: hanya Admin</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-muted">Belum ada data barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>