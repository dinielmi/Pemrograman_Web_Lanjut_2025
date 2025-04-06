@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('penjualan_detail/create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="penjualan_kode" class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select id="filter_penjualan" class="form-control">
                            <option value="">- Semua Penjualan -</option>
                            @foreach (\App\Models\PenjualanModel::all() as $item)
                                <option value="{{ $item->penjualan_kode }}">{{ $item->penjualan_kode }}</option>
                            @endforeach
                        </select>
                    <small class="form-text text-muted">Detail Penjualan</small>
            </div>
        </div>

        <table class="table table-bordered table-hover table-sm" id="table_penjualan_detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penjualan ID</th>
                    <th>Barang ID</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->penjualan_id }}</td>
                    <td>{{ $detail->barang_id }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->jumlah * $detail->harga) }}</td>
                    <td>
                        <a href="{{ url('penjualan_detail/' . $detail->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ url('penjualan_detail/' . $detail->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ url('penjualan_detail/' . $detail->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Inisialisasi DataTables
        $('.table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });

        // Autofokus ke input pencarian
        $('input[name="search"]').focus();
    });
</script>
@endpush

