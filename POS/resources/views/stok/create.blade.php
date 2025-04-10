@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Stok</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('stok') }}" class="form-horizontal">
            @csrf

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jumlah</label>
                    <div class="col-10">
                    <input type="number" name="stok_jumlah" class="form-control @error('stok_jumlah') is-invalid @enderror" value="{{ old('stok_jumlah') }}" required>
                    @error('stok_jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tanggal</label>
                    <div class="col-10">
                    <input type="date" name="stok_tanggal" class="form-control @error('stok_tanggal') is-invalid @enderror" value="{{ old('stok_tanggal', '') }}" required>
                    @error('stok_tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Barang</label>
                    <div class="col-10">
                    <select name="barang_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>{{ $b->barang_nama }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Supplier</label>
                <div class="col-10">
                    <select name="supplier_id" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Supplier --</option>
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>{{ $s->supplier_nama }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ route('stok.index') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
