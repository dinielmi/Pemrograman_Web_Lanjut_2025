@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Stok</h3>
        <div class="card-tools">
            <a href="{{ url('stok') }}" class="btn btn-sm btn-warning">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('stok/' . $stok->stok_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="stok_jumlah">Jumlah</label>
                <input type="number" name="stok_jumlah" class="form-control @error('stok_jumlah') is-invalid @enderror" value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" required>
                @error('stok_jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="stok_tanggal">Tanggal</label>
                <input type="date" name="stok_tanggal" class="form-control @error('stok_tanggal') is-invalid @enderror" value="{{ old('stok_tanggal', date('Y-m-d', strtotime($stok->stok_tanggal))) }}" required>
                @error('stok_tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>            

            <div class="form-group mb-3">
                <label for="barang_id">Barang</label>
                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->barang_id }}" {{ old('barang_id', $stok->barang_id) == $b->barang_id ? 'selected' : '' }}>
                            {{ $b->barang_nama }}
                        </option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->supplier_id }}" {{ old('supplier_id', $stok->supplier_id) == $s->supplier_id ? 'selected' : '' }}>
                            {{ $s->supplier_nama }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
