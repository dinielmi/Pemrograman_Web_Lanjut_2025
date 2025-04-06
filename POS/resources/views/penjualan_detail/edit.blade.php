@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">{{ $page->title }}</h1>
    <ol class="breadcrumb mb-4">
        @foreach ($breadcrumb->list as $item)
            <li class="breadcrumb-item">{{ $item }}</li>
        @endforeach
        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">Form Edit Penjualan</div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan/' . $penjualan->penjualan_id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="pembeli">Nama Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control"
                        value="{{ old('pembeli', $penjualan->pembeli) }}">
                    @error('pembeli')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="penjualan_tanggal">Tanggal Penjualan</label>
                    <input type="date" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control"
                        value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}">
                    @error('penjualan_tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url('penjualan') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
