@empty($level)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">Data tidak ditemukan.</div>
        </div>
    </div>
</div>
@else
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Data Level</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>ID</label>
                <input type="text" class="form-control" value="{{ $level->level_id }}" readonly>
            </div>
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" class="form-control" value="{{ $level->level_kode }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Level</label>
                <input type="text" class="form-control" value="{{ $level->level_nama }}" readonly>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        </div>
    </div>
</div>
@endempty
