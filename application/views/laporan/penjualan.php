<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Penjualan</h1>
        <a href="<?= site_url('laporan/cetak_pdf?tgl_mulai='.$tgl_mulai.'&tgl_akhir='.$tgl_akhir) ?>" class="btn btn-danger btn-sm" target="_blank">
            <i class="fas fa-file-pdf"></i> Cetak PDF
        </a>
    </div>

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Filter Periode</h6></div>
        <div class="card-body">
            <form method="get" class="form-inline">
                <div class="form-group mr-2">
                    <label class="mr-2">Dari:</label>
                    <input type="date" name="tgl_mulai" class="form-control" value="<?= $tgl_mulai ?>">
                </div>
                <div class="form-group mr-2">
                    <label class="mr-2">Sampai:</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="<?= $tgl_akhir ?>">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
            </form>
        </div>
    </div>

    <!-- Laporan per Sales -->
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Penjualan per Sales</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Nama Sales</th><th>Jumlah Order</th><th>Total Penjualan</th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($per_sales)): ?>
                        <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                        <?php $total_all = 0; ?>
                        <?php foreach ($per_sales as $i => $s): $total_all += $s->total_penjualan; ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $s->nama_sales ?></td>
                            <td><?= $s->total_order ?></td>
                            <td>Rp <?= number_format($s->total_penjualan, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="table-active font-weight-bold">
                            <td colspan="3" class="text-right">Grand Total:</td>
                            <td>Rp <?= number_format($total_all, 0, ',', '.') ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Laporan per Produk -->
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Penjualan per Produk</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr><th>#</th><th>Kode</th><th>Nama Produk</th><th>Total Terjual</th><th>Total Pendapatan</th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($per_produk)): ?>
                        <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                        <?php foreach ($per_produk as $i => $p): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $p->kode_produk ?></td>
                            <td><?= $p->nama_produk ?></td>
                            <td><?= $p->total_terjual ?> unit</td>
                            <td>Rp <?= number_format($p->total_pendapatan, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Laporan per Periode -->
    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="font-weight-bold text-primary">Semua Transaksi Periode <?= date('d/m/Y', strtotime($tgl_mulai)) ?> - <?= date('d/m/Y', strtotime($tgl_akhir)) ?></h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr><th>#</th><th>No. Order</th><th>Tanggal</th><th>Pelanggan</th><th>Sales</th><th>Total</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($per_periode)): ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data</td></tr>
                        <?php else: ?>
                        <?php $badges = ['draft'=>'secondary','dikirim'=>'info','selesai'=>'success','dibatalkan'=>'danger']; ?>
                        <?php foreach ($per_periode as $i => $t): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><a href="<?= site_url('sales_order/detail/'.$t->id) ?>"><?= $t->no_order ?></a></td>
                            <td><?= date('d/m/Y', strtotime($t->tanggal_order)) ?></td>
                            <td><?= $t->nama_pelanggan ?></td>
                            <td><?= $t->nama_sales ?></td>
                            <td>Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                            <td><span class="badge badge-<?= $badges[$t->status] ?>"><?= ucfirst($t->status) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
