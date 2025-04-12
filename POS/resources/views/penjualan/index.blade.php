@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info mt-1">Import Data Penjualan</button>
            <a class="btn btn-sm btn-success mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-outline-success mt-1" title="Tambah Ajax">
                <i class="fa fa-plus"></i>
            </button>
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
                    <label for="filter_pembeli" class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <input type="text" name="filter_pembeli" id="filter_pembeli" class="form-control" placeholder="Nama Pembeli">
                        <small class="form-text text-muted">Nama Pembeli</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <table class="table table-bordered table-hover table-sm table-striped" id="table_penjualan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Penjualan</th>
                    <th>Pembeli</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" 
     data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
</div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
         $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
    $(document).ready(function() {
        let table = $('#table_penjualan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('penjualan/list') }}",
                type: 'POST',
                data: function(d) {
                    d.pembeli = $('#filter_pembeli').val();
                }
            },
            columns: [
                { data: 'penjualan_id', name: 'penjualan_id' },
                { data: 'penjualan_kode', name: 'penjualan_kode' },
                { data: 'pembeli', name: 'pembeli' },
                { data: 'penjualan_tanggal', name: 'penjualan_tanggal' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false },
            ]
        });

        $('#filter_pembeli').on('keyup', function() {
            table.ajax.reload();
        });
    });
</script>
@endpush
