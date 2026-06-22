<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Order: <?= $order->no_order ?></h1>
        <a href="<?= site_url('sales_order') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="font-weight-bold text-primary">Informasi Order</h6></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><th width="150">No. Order</th><td>: <?= $order->no_order ?></td></tr>
                        <tr><th>Tanggal</th><td>: <?= date('d F Y', strtotime($order->tanggal_order)) ?></td></tr>
                        <tr><th>Status</th><td>:
                            <?php $badges = ['draft'=>'secondary','dikirim'=>'info','selesai'=>'success','dibatalkan'=>'danger']; ?>
                            <span class="badge badge-<?= $badges[$order->status] ?>"><?= ucfirst($order->status) ?></span>
                        </td></tr>
                        <tr><th>Sales</th><td>: <?= $order->nama_sales ?></td></tr>
                        <tr><th>Catatan</th><td>: <?= $order->catatan ?: '-' ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="font-weight-bold text-primary">Informasi Pelanggan</h6></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr><th width="150">Nama</th><td>: <?= $order->nama_pelanggan ?></td></tr>
                        <tr><th>Alamat</th><td>: <?= $order->alamat ?></td></tr>
                        <tr><th>Telepon</th><td>: <?= $order->no_telepon ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status (Admin only) -->
    <?php if ($this->session->userdata('role') === 'admin'): ?>
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Update Status Order</h6></div>
        <div class="card-body">
            <form method="post" action="<?= site_url('sales_order/update_status/'.$order->id) ?>" class="form-inline">
                <select name="status" class="form-control mr-2">
                    <option value="draft" <?= $order->status=='draft'?'selected':'' ?>>Draft</option>
                    <option value="dikirim" <?= $order->status=='dikirim'?'selected':'' ?>>Dikirim</option>
                    <option value="selesai" <?= $order->status=='selesai'?'selected':'' ?>>Selesai</option>
                    <option value="dibatalkan" <?= $order->status=='dibatalkan'?'selected':'' ?>>Dibatalkan</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Status</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Detail Produk -->
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Detail Produk</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Kode</th><th>Nama Produk</th><th>Harga Satuan</th><th>Jumlah</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detail as $i => $d): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $d->kode_produk ?></td>
                            <td><?= $d->nama_produk ?></td>
                            <td>Rp <?= number_format($d->harga_satuan, 0, ',', '.') ?></td>
                            <td><?= $d->jumlah ?></td>
                            <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-active font-weight-bold">
                            <td colspan="5" class="text-right">Total Harga:</td>
                            <td>Rp <?= number_format($order->total_harga, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
