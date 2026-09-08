<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Barang</h2>
    <form action="{{ route('items.update', $item->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
            <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" value="{{ old('kode_barang', $item->kode_barang) }}">
            @error('kode_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $item->nama_barang) }}">
            @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori <span class="text-danger">*</span></label>
            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori', $item->kategori) }}" placeholder="Contoh: ATK, Elektronik, Bahan Baku">
            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $item->stok) }}" min="0">
                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Satuan <span class="text-danger">*</span></label>
                <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', $item->satuan) }}" placeholder="Contoh: Pcs, Box, Rim">
                @error('satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Satuan (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" value="{{ old('harga_satuan', $item->harga_satuan) }}" min="0">
            @error('harga_satuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan <span class="text-muted">(opsional)</span></label>
            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $item->keterangan) }}</textarea>
            @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>