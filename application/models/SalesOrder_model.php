<?php

class SalesOrder_model extends CI_Model {

    protected $table = 'sales_order';
    protected $table_detail = 'detail_order';

    // Generate nomor order otomatis: SO-20250001
    public function generate_no_order()
    {
        $year = date('Y');
        $this->db->select_max('id');
        $last = $this->db->get($this->table)->row();
        $next_id = ($last && $last->id) ? $last->id + 1 : 1;
        return 'SO-' . $year . str_pad($next_id, 4, '0', STR_PAD_LEFT);
    }

    // Ambil semua order (admin/manager bisa lihat semua, sales hanya miliknya)
    public function get_all($id_sales = null)
    {
        $this->db->select('sales_order.*, users.nama as nama_sales, pelanggan.nama_pelanggan');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = sales_order.id_sales');
        $this->db->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan');
        if ($id_sales) {
            $this->db->where('sales_order.id_sales', $id_sales);
        }
        $this->db->order_by('sales_order.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('sales_order.*, users.nama as nama_sales, pelanggan.nama_pelanggan, pelanggan.alamat, pelanggan.no_telepon');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = sales_order.id_sales');
        $this->db->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan');
        $this->db->where('sales_order.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // ====== Detail Order ======
    public function get_detail($id_order)
    {
        $this->db->select('detail_order.*, produk.nama_produk, produk.kode_produk');
        $this->db->from($this->table_detail);
        $this->db->join('produk', 'produk.id = detail_order.id_produk');
        $this->db->where('id_order', $id_order);
        return $this->db->get()->result();
    }

    public function insert_detail($data)
    {
        return $this->db->insert($this->table_detail, $data);
    }

    public function delete_detail($id_order)
    {
        return $this->db->delete($this->table_detail, ['id_order' => $id_order]);
    }

    public function hitung_total($id_order)
    {
        $this->db->select_sum('subtotal');
        $this->db->where('id_order', $id_order);
        $result = $this->db->get($this->table_detail)->row();
        return $result ? $result->subtotal : 0;
    }

    // ====== Laporan ======
    public function laporan_per_sales($tgl_mulai = null, $tgl_akhir = null)
    {
        $this->db->select('users.nama as nama_sales, COUNT(sales_order.id) as total_order, SUM(sales_order.total_harga) as total_penjualan');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = sales_order.id_sales');
        $this->db->where('sales_order.status !=', 'dibatalkan');
        if ($tgl_mulai) $this->db->where('tanggal_order >=', $tgl_mulai);
        if ($tgl_akhir) $this->db->where('tanggal_order <=', $tgl_akhir);
        $this->db->group_by('sales_order.id_sales');
        return $this->db->get()->result();
    }

    public function laporan_per_produk($tgl_mulai = null, $tgl_akhir = null)
    {
        $this->db->select('produk.kode_produk, produk.nama_produk, SUM(detail_order.jumlah) as total_terjual, SUM(detail_order.subtotal) as total_pendapatan');
        $this->db->from($this->table_detail);
        $this->db->join('produk', 'produk.id = detail_order.id_produk');
        $this->db->join($this->table, 'sales_order.id = detail_order.id_order');
        $this->db->where('sales_order.status !=', 'dibatalkan');
        if ($tgl_mulai) $this->db->where('tanggal_order >=', $tgl_mulai);
        if ($tgl_akhir) $this->db->where('tanggal_order <=', $tgl_akhir);
        $this->db->group_by('detail_order.id_produk');
        $this->db->order_by('total_terjual', 'DESC');
        return $this->db->get()->result();
    }

    public function laporan_per_periode($tgl_mulai = null, $tgl_akhir = null)
    {
        $this->db->select('sales_order.*, users.nama as nama_sales, pelanggan.nama_pelanggan');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = sales_order.id_sales');
        $this->db->join('pelanggan', 'pelanggan.id = sales_order.id_pelanggan');
        $this->db->where('sales_order.status !=', 'dibatalkan');
        if ($tgl_mulai) $this->db->where('tanggal_order >=', $tgl_mulai);
        if ($tgl_akhir) $this->db->where('tanggal_order <=', $tgl_akhir);
        $this->db->order_by('tanggal_order', 'DESC');
        return $this->db->get()->result();
    }

    // Dashboard counts
    public function count_by_status($status)
    {
        return $this->db->get_where($this->table, ['status' => $status])->num_rows();
    }

    public function total_penjualan_bulan_ini()
    {
        $this->db->select_sum('total_harga');
        $this->db->where('MONTH(tanggal_order)', date('m'));
        $this->db->where('YEAR(tanggal_order)', date('Y'));
        $this->db->where('status !=', 'dibatalkan');
        $result = $this->db->get($this->table)->row();
        return $result ? $result->total_harga : 0;
    }
}
