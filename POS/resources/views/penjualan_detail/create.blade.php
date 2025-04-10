@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan_detail') }}">
            @csrf

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Penjualan ID</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="penjualan_id" value="{{ old('penjualan_id') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Barang</label>
                <div class="col-10">
                    <select class="form-control" name="barang_id" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach ($barangs as $item)
                            <option value="{{ $item->barang_id }}" {{ old('barang_id') == $item->barang_id ? 'selected' : '' }}>
                                {{ $item->barang_id }} - {{ $item->barang_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Harga</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('penjualan_detail') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
