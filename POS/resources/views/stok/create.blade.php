@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Stok</h3>
        <div class="card-tools">
            <a href="{{ route('stok.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
    </div>

    <form action="{{ route('stok.store') }}" method="POST">
        @csrf
        <div class="card-body">
            {{-- Jumlah --}}
            <div class="form-group">
                <label for="stok_jumlah">Jumlah</label>
                <input type="number" name="stok_jumlah" class="form-control @error('stok_jumlah') is-invalid @enderror" value="{{ old('stok_jumlah') }}" required>
                @error('stok_jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="form-group">
                <label for="stok_tanggal">Tanggal</label>
                <input type="date" name="stok_tanggal" class="form-control @error('stok_tanggal') is-invalid @enderror" value="{{ old('stok_tanggal', date('Y-m-d')) }}" required>

                @error('stok_tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Barang --}}
            <div class="form-group">
                <label for="barang_id">Barang</label>
                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->barang_nama }}
                        </option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Supplier --}}
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror" required>
                    <option value="">Pilih Supplier</option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->supplier_nama }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
