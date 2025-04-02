@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (isset($penjualan) && $penjualan->isNotEmpty())
            <table class="table table-bordered table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Penjualan</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan as $item)
                    <tr>
                        <td>{{ $item->penjualan_id }}</td>
                        <td>{{ $item->penjualan_kode }}</td>
                        <td>{{ $item->pembeli }}</td>
                        <td>{{ $item->penjualan_tanggal }}</td>
                        <td>
                            <a href="{{ url('penjualan/'.$item->penjualan_id) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ url('penjualan/'.$item->penjualan_id.'/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ url('penjualan/'.$item->penjualan_id) }}" method="POST" style="display:inline;">
                                @csrf
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">Data penjualan tidak tersedia.</div>
        @endif
    </div>
</div>
@endsection
