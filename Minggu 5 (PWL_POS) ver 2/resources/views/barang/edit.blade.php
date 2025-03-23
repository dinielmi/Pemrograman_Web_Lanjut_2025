@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Barang</h1>
    <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="barang_kode" class="form-control" value="{{ $barang->barang_kode }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="barang_nama" class="form-control" value="{{ $barang->barang_nama }}" required>
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
        </div>
        <div class="mb-3">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->kategori_id }}" {{ $barang->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                        {{ $k->kategori_nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
