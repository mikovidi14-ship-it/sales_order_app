<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Order: <?= $order->no_order ?></h1>
        <a href="<?= site_url('sales_order') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= site_url('sales_order/update/'.$order->id) ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Order</label>
                            <input type="text" class="form-control" value="<?= $order->no_order ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Order</label>
                            <input type="date" name="tanggal_order" class="form-control" value="<?= $order->tanggal_order ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="id_pelanggan" class="form-control" required>
                        <?php foreach ($pelanggan as $p): ?>
                        <option value="<?= $p->id ?>" <?= $p->id == $order->id_pelanggan ? 'selected' : '' ?>><?= $p->nama_pelanggan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2"><?= $order->catatan ?></textarea>
                </div>

                <hr>
                <h5>Detail Produk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tbl-detail">
                        <thead class="thead-light">
                            <tr><th>Produk</th><th width="100">Jumlah</th><th width="150">Harga Satuan</th><th width="150">Subtotal</th><th width="60">Aksi</th></tr>
                        </thead>
                        <tbody id="detail-body">
                            <?php foreach ($detail as $d): ?>
                            <tr class="row-produk">
                                <td>
                                    <select name="id_produk[]" class="form-control produk-select" required>
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($produk as $p): ?>
                                        <option value="<?= $p->id ?>" data-harga="<?= $p->harga ?>" <?= $p->id == $d->id_produk ? 'selected' : '' ?>><?= $p->kode_produk ?> - <?= $p->nama_produk ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="number" name="jumlah[]" class="form-control jumlah-input" min="1" value="<?= $d->jumlah ?>"></td>
                                <td><input type="number" name="harga_satuan[]" class="form-control harga-input" value="<?= $d->harga_satuan ?>" readonly></td>
                                <td><input type="text" class="form-control subtotal-input" value="<?= number_format($d->subtotal, 0, ',', '.') ?>" readonly></td>
                                <td><button type="button" class="btn btn-danger btn-sm hapus-row"><i class="fas fa-times"></i></button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-success btn-sm" id="tambah-row"><i class="fas fa-plus"></i> Tambah Produk</button>

                <div class="text-right mt-3">
                    <h5>Total: Rp <span id="grand-total"><?= number_format($order->total_harga, 0, ',', '.') ?></span></h5>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Order</button>
            </form>
        </div>
    </div>
</div>
<script>
function formatRupiah(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
function hitungSubtotal(row) {
    var harga = parseFloat(row.querySelector('.harga-input').value) || 0;
    var jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
    var subtotal = harga * jumlah;
    row.querySelector('.subtotal-input').value = formatRupiah(subtotal);
    return subtotal;
}
function hitungTotal() {
    var total = 0;
    document.querySelectorAll('.row-produk').forEach(function(row){ total += hitungSubtotal(row); });
    document.getElementById('grand-total').textContent = formatRupiah(total);
}
var produkTemplate = document.querySelector('.row-produk').cloneNode(true);
document.getElementById('detail-body').addEventListener('change', function(e) {
    var row = e.target.closest('.row-produk');
    if (e.target.classList.contains('produk-select')) {
        var opt = e.target.selectedOptions[0];
        row.querySelector('.harga-input').value = opt.dataset.harga || 0;
    }
    hitungTotal();
});
document.getElementById('detail-body').addEventListener('input', function(e) {
    if (e.target.classList.contains('jumlah-input')) hitungTotal();
});
document.getElementById('tambah-row').addEventListener('click', function() {
    var newRow = produkTemplate.cloneNode(true);
    newRow.querySelectorAll('select').forEach(function(s){ s.value=''; });
    newRow.querySelectorAll('input').forEach(function(i){ i.value = i.readOnly ? 0 : 1; });
    document.getElementById('detail-body').appendChild(newRow);
});
document.getElementById('detail-body').addEventListener('click', function(e) {
    if (e.target.closest('.hapus-row')) {
        if (document.querySelectorAll('.row-produk').length > 1) {
            e.target.closest('.row-produk').remove();
            hitungTotal();
        }
    }
});
</script>
