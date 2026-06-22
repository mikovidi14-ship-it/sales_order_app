<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        <a href="<?= site_url('produk') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= site_url('produk/simpan') ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Produk</label>
                    <div class="col-sm-10"><input type="text" name="kode_produk" class="form-control" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10"><input type="text" name="nama_produk" class="form-control" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10"><input type="number" name="harga" class="form-control" min="0" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10"><input type="number" name="stok" class="form-control" min="0" required></div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
