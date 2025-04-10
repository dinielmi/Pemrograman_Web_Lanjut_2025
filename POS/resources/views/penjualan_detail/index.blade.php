@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ url('penjualan_detail/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url('penjualan_detail/create_ajax') }}')" class="btn btn-sm btn-outline-success mt-1" title="Tambah Ajax">
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
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="barang_id" name="barang_id" required>
                            <option value="">- Semua -</option>
                            @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Nama Barang</small>
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_detail">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Penjualan_id</th>
                    <th>Barang_id</th>
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

@push('css') 
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function() {
        dataDetail = $('#table_detail').DataTable({
            ajax: {
                url: "{{ url('penjualan_detail/list') }}",
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d.barang_id = $('#barang_id').val();
                }
            },
            columns: [
                { data: "detail_id" },
                { data: "harga" },
                { data: "jumlah" },
                { data: "total" },
                { data: "penjualan_id" },
                { data: "barang_id" },
                { data: "aksi", orderable: false, searchable: false }
            ]

        });

        $('#barang_id').on('change', function() {
            dataDetail.ajax.reload();
        });
    });
</script> 
@endpush
