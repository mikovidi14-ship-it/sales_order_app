<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sales Order</h1>
        <?php if ($this->session->userdata('role') !== 'manager'): ?>
        <a href="<?= site_url('sales_order/tambah') ?>" class="btn btn-primary btn-sm shadow">
            <i class="fas fa-plus fa-sm"></i> Buat Order Baru
        </a>
        <?php endif; ?>
    </div>
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="thead-light">
                        <tr><th>#</th><th>No. Order</th><th>Pelanggan</th><th>Sales</th><th>Tanggal</th><th>Total Harga</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                        <tr><td colspan="8" class="text-center">Belum ada order</td></tr>
                        <?php else: ?>
                        <?php foreach ($orders as $i => $o): ?>
                        <?php
                            $badges = ['draft'=>'secondary','dikirim'=>'info','selesai'=>'success','dibatalkan'=>'danger'];
                            $b = $badges[$o->status] ?? 'secondary';
                        ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $o->no_order ?></td>
                            <td><?= $o->nama_pelanggan ?></td>
                            <td><?= $o->nama_sales ?></td>
                            <td><?= date('d/m/Y', strtotime($o->tanggal_order)) ?></td>
                            <td>Rp <?= number_format($o->total_harga, 0, ',', '.') ?></td>
                            <td><span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span></td>
                            <td>
                                <a href="<?= site_url('sales_order/detail/'.$o->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <?php if ($o->status == 'draft' && $this->session->userdata('role') !== 'manager'): ?>
                                <a href="<?= site_url('sales_order/edit/'.$o->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('role') === 'admin'): ?>
                                <a href="<?= site_url('sales_order/hapus/'.$o->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus order ini?')"><i class="fas fa-trash"></i></a>
                                <?php endif; ?>
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
