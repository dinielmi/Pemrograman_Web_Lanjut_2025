@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $page->title }}</h4>
    </div>
    <div class="card-body">
        <form method="
        POST" action="{{ url('penjualan_detail') }}">
            @csrf

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">ID Penjualan</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="penjualan_kode" value="{{ old('penjualan_kode') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Barang ID</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="pembeli" value="{{ old('pembeli') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="pembeli" value="{{ old('pembeli') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Harga</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="pembeli" value="{{ old('pembeli') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ url('penjualan_detail') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
