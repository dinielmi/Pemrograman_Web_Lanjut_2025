@extends('layouts.template')

@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kodeKategori">Kode Kategori</label>
                <input type="text" name="kodeKategori" id="kodeKategori" class="form-control" value="{{ $kategori->kategori_kode }}" required>
            </div>
            <div class="form-group">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" name="namaKategori" id="namaKategori" class="form-control" value="{{ $kategori->kategori_nama }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
