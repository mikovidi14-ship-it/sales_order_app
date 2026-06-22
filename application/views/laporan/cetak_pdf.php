<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 5px 8px; }
        th { background: #f0f0f0; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .grand-total { font-weight: bold; background: #e0e0e0; }
        @media print { button { display: none; } }
    </style>
</head>
<body>
    <h2>LAPORAN PENJUALAN</h2>
    <h3>PT MAJU JAYA</h3>
    <p class="text-center">Periode: <?= date('d/m/Y', strtotime($tgl_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></p>
    <p class="text-center">Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>

    <button onclick="window.print()" style="margin: 10px auto; display: block; padding: 8px 20px; background: #007bff; color: #fff; border: none; cursor: pointer; border-radius: 4px;">
        Cetak / Simpan PDF
    </button>

    <h4>1. Penjualan per Sales</h4>
    <table>
        <thead><tr><th>#</th><th>Nama Sales</th><th>Jumlah Order</th><th class="text-right">Total Penjualan</th></tr></thead>
        <tbody>
            <?php $total_all = 0; foreach ($per_sales as $i => $s): $total_all += $s->total_penjualan; ?>
            <tr>
                <td class="text-center"><?= $i+1 ?></td>
                <td><?= $s->nama_sales ?></td>
                <td class="text-center"><?= $s->total_order ?></td>
                <td class="text-right">Rp <?= number_format($s->total_penjualan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="grand-total">
                <td colspan="3" class="text-right">Grand Total:</td>
                <td class="text-right">Rp <?= number_format($total_all, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <h4>2. Penjualan per Produk</h4>
    <table>
        <thead><tr><th>#</th><th>Kode</th><th>Nama Produk</th><th class="text-right">Terjual</th><th class="text-right">Pendapatan</th></tr></thead>
        <tbody>
            <?php foreach ($per_produk as $i => $p): ?>
            <tr>
                <td class="text-center"><?= $i+1 ?></td>
                <td><?= $p->kode_produk ?></td>
                <td><?= $p->nama_produk ?></td>
                <td class="text-center"><?= $p->total_terjual ?> unit</td>
                <td class="text-right">Rp <?= number_format($p->total_pendapatan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4>3. Semua Transaksi</h4>
    <table>
        <thead><tr><th>#</th><th>No. Order</th><th>Tanggal</th><th>Pelanggan</th><th>Sales</th><th class="text-right">Total</th><th>Status</th></tr></thead>
        <tbody>
            <?php foreach ($per_periode as $i => $t): ?>
            <tr>
                <td class="text-center"><?= $i+1 ?></td>
                <td><?= $t->no_order ?></td>
                <td><?= date('d/m/Y', strtotime($t->tanggal_order)) ?></td>
                <td><?= $t->nama_pelanggan ?></td>
                <td><?= $t->nama_sales ?></td>
                <td class="text-right">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                <td class="text-center"><?= ucfirst($t->status) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
