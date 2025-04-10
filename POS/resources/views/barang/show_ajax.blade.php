@empty($barang)
<div id="modal-master" class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
        <div class="modal-header"> 
            <h5 class="modal-title">Kesalahan</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div> 
        <div class="modal-body"> 
            <div class="alert alert-danger"> 
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5> 
                Data yang Anda cari tidak ditemukan.
            </div> 
            <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a> 
        </div> 
    </div> 
</div> 
@else
<div id="modal-master" class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
        <div class="modal-header"> 
            <h5 class="modal-title">Detail Data Barang</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div> 
        <div class="modal-body"> 
            <div class="form-group"> 
                <label>ID</label> 
                <input type="text" class="form-control" value="{{ $barang->barang_id }}" readonly>
            </div>
            <div class="form-group"> 
                <label>Kode Barang</label> 
                <input type="text" class="form-control" value="{{ $barang->barang_kode }}" readonly>
            </div>
            <div class="form-group"> 
                <label>Nama Barang</label> 
                <input type="text" class="form-control" value="{{ $barang->barang_nama }}" readonly>
            </div>
            <div class="form-group"> 
                <label>Harga Beli</label> 
                <input type="text" class="form-control" value="{{ number_format($barang->harga_beli, 0, ',', '.') }}" readonly>
            </div>
            <div class="form-group"> 
                <label>Harga Jual</label> 
                <input type="text" class="form-control" value="{{ number_format($barang->harga_jual, 0, ',', '.') }}" readonly>
            </div>
            <div class="form-group"> 
                <label>Kategori</label> 
                <input type="text" class="form-control" value="{{ $barang->kategori->kategori_nama ?? '-' }}" readonly>
            </div>
        </div> 
        <div class="modal-footer"> 
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button> 
        </div> 
    </div> 
</div> 
@endempty
