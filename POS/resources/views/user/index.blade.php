@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
   <div class="card-header">
       <h3 class="card-title">{{ $page->title }}</h3>
       <div class="card-tools">
        <button onclick="modalAction('{{ url('/user/import') }}')" class="btn btn-sm btn-info mt-1">Import</button>
        <a href="{{ url('/user/export_excel') }}" class="btn btn-primary btn-sm py-1 px-2 mt-1"><i class="fa fa-fileexcel"></i> Export</a>
        <a href="{{ url('/user/export_pdf') }}" class="btn btn-warning btn-sm py-1 px-2 mt-1"><i class="fa fa-file pdf"></i> pdf</a> 
        <a class="btn btn-sm btn-success mt-1" href="{{ url('user/create') }}">Tambah</a>
        <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-outline-success mt-1" title="Tambah Ajax">
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
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Semua -</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
        </div>        
       <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Username</th>
                   <th>Nama</th>
                   <th>Level Pengguna</th>
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
    dataUser = $('#table_user').DataTable({
        ajax: {
            url: "{{ url('user/list') }}",
            dataType: "json",
            type: "POST",
            data: function(d) {
                d.level_id = $('#level_id').val();
            }
        },
        columns: [
            {
                data: "DT_RowIndex",
                className: "text-center", 
                orderable: false, 
                searchable: false
            },
            {
                data: "username", 
                orderable: true,
                searchable: true
            },
            {
                data: "nama",
                orderable: true, 
                searchable: true
            },
            {
                data: "level.level_nama",
                orderable: false, 
                searchable: false
            },
            {
                data: "aksi",
                orderable: false, 
                searchable: false
            },
        ]
    });

    $('#level_id').on('change', function() {
        dataUser.ajax.reload();
    });
});
</script> 
@endpush
