<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <div class="col-md-6">
            <div class="card text-white bg-primary p-3">
                <h5>Total Jenis Barang</h5>
                <h3>{{ $totalItems }}</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success p-3">
                <h5>Total Seluruh Stok</h5>
                <h3>{{ $totalStok }}</h3>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Hak Akses Role (Admin vs Staff) -->
    @if(Auth::user()->role == 'admin')
        <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">+ Tambah Barang</a>
    @else
        <p class="text-muted">Anda login sebagai Staff (Hanya dapat melihat data inventory).</p>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->stok }}</td>
                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @else
                        <span class="text-muted small">Aksi dibatasi</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>