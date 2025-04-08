@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan_detail/' . $detail->penjualan_detail_id) }}">
            @csrf
            {!! method_field('PUT') !!}

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">ID Penjualan</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="penjualan_id" value="{{ $detail->penjualan_id }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">ID Barang</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="barang_id" value="{{ $detail->barang_id }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="jumlah" value="{{ $detail->jumlah }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Harga</label>
                <div class="col-10">
                    <input type="number" class="form-control" name="harga" value="{{ $detail->harga }}" required autocomplete="off">
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
