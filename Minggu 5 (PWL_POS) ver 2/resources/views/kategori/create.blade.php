@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kodeKategori">Kode Kategori</label>
                <input type="text" name="kodeKategori" id="kodeKategori" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" name="namaKategori" id="namaKategori" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
