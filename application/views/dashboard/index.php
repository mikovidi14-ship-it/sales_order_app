<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <!-- Stat Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Order</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_order ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-file-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjualan Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_penjualan, 0, ',', '.') ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_produk ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-box fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pelanggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pelanggan ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Order -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-secondary text-center py-3">
                <div class="h4"><?= $order_draft ?></div>
                <div>Draft</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info text-center py-3">
                <div class="h4"><?= $order_dikirim ?></div>
                <div>Dikirim</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success text-center py-3">
                <div class="h4"><?= $order_selesai ?></div>
                <div>Selesai</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger text-center py-3">
                <div class="h4"><?= $order_batal ?></div>
                <div>Dibatalkan</div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Order Terbaru</h6>
            <a href="<?= site_url('sales_order') ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No. Order</th>
                            <th>Pelanggan</th>
                            <th>Sales</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_orders)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada order</td></tr>
                        <?php else: ?>
                        <?php foreach ($recent_orders as $o): ?>
                        <tr>
                            <td><a href="<?= site_url('sales_order/detail/' . $o->id) ?>"><?= $o->no_order ?></a></td>
                            <td><?= $o->nama_pelanggan ?></td>
                            <td><?= $o->nama_sales ?></td>
                            <td><?= date('d/m/Y', strtotime($o->tanggal_order)) ?></td>
                            <td>Rp <?= number_format($o->total_harga, 0, ',', '.') ?></td>
                            <td>
                                <?php
                                $badges = ['draft'=>'secondary','dikirim'=>'info','selesai'=>'success','dibatalkan'=>'danger'];
                                $b = $badges[$o->status] ?? 'secondary';
                                ?>
                                <span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
