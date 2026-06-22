<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
        <a href="<?= site_url('produk') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= site_url('produk/update/'.$produk->id) ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Produk</label>
                    <div class="col-sm-10"><input type="text" name="kode_produk" class="form-control" value="<?= $produk->kode_produk ?>" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10"><input type="text" name="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10"><input type="number" name="harga" class="form-control" value="<?= $produk->harga ?>" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10"><input type="number" name="stok" class="form-control" value="<?= $produk->stok ?>" required></div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>
</div>
