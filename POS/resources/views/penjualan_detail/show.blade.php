@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $page->title }}</h4>
    </div>
    <div class="card-body">
        @empty($detail)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm mb-0">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">ID Penjualan</th>
                            <td>{{ $detail->penjualan_id }}</td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td>{{ $detail->barang->barang_nama ?? $detail->barang_id }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ number_format($detail->harga) }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ number_format($detail->jumlah * $detail->harga) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endempty
        <a href="{{ url('penjualan_detail') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
