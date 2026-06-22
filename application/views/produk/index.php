<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Produk</h1>
        <a href="<?= site_url('produk/tambah') ?>" class="btn btn-primary btn-sm shadow">
            <i class="fas fa-plus fa-sm"></i> Tambah Produk
        </a>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Kode</th><th>Nama Produk</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $i => $p): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $p->kode_produk ?></td>
                            <td><?= $p->nama_produk ?></td>
                            <td>Rp <?= number_format($p->harga, 0, ',', '.') ?></td>
                            <td><?= $p->stok ?></td>
                            <td>
                                <a href="<?= site_url('produk/edit/'.$p->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="<?= site_url('produk/hapus/'.$p->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
