@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Filter Barang --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterBarang" class="form-label">Filter Barang</label>
                <select id="filterBarang" class="form-control">
                    <option value="">-- Nama Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>    

        {{-- Tabel --}}
        <table class="table table-bordered table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Barang ID</th>
                    <th>Supplier ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        let table = $('#table_stok').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('stok.list') }}",
                type: 'GET',
                data: function (d) {
                    d.barang = $('#filter_barang').val(); // fix ID di sini
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'stok_jumlah', name: 'stok_jumlah' },
                { data: 'stok_tanggal', name: 'stok_tanggal' },
                { data: 'barang_id', name: 'barang_id' },
                { data: 'supplier_id', name: 'supplier_id' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });

        // Debounce biar nggak reload terus-terusan
        let delayTimer;
        $('#filterBarang').on('change', function () {
            let val = $(this).val();
            if (val) {
                table.column(3).search('^' + val + '$', true, false).draw();
            } else {
                table.column(3).search('').draw();
            }
        });
    });
</script>
@endpush
