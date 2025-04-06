@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $page->title }}</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID Penjualan</dt>
            <dd class="col-sm-9">{{ $detail->penjualan_id }}</dd>

            <dt class="col-sm-3">ID Barang ID</dt>
            <dd class="col-sm-9">{{ $detail->barang_id }}</dd>

            <dt class="col-sm-3">Jumlah</dt>
            <dd class="col-sm-9">{{ $detail->jumlah }}</dd>

            <dt class="col-sm-3">Harga</dt>
            <dd class="col-sm-9">{{ number_format($detail->harga) }}</dd>

            <dt class="col-sm-3">Total</dt>
            <dd class="col-sm-9">{{ number_format($detail->jumlah * $detail->harga) }}</dd>
        </dl>
        <a href="{{ url('penjualan_detail') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
