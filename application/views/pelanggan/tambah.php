<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pelanggan</h1>
        <a href="<?= site_url('pelanggan') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= site_url('pelanggan/simpan') ?>">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                    <div class="col-sm-10"><input type="text" name="nama_pelanggan" class="form-control" required></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10"><textarea name="alamat" class="form-control" rows="3"></textarea></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10"><input type="text" name="no_telepon" class="form-control"></div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
