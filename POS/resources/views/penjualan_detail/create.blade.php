@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $page->title }}</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan_detail') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="penjualan_id">Penjualan</label>
                <select name="penjualan_id" id="penjualan_id" class="form-control">
                    <option value="">-- Pilih Penjualan --</option>
                    @foreach ($penjualans as $p)
                        <option value="{{ $p->penjualan_id }}">{{ $p->penjualan_kode }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group mb-3">
                <label for="barang_id">Barang</label>
                <select name="barang_id" id="barang_id" class="form-control">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $b)
                        <option value="{{ $b->barang_id }}">{{ $b->nama }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group mb-3">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah">
            </div>
        
            <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga satuan">
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        
    </div>
</div>
@endsection
