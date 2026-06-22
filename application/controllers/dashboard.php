<?php

class dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SalesOrder_model');
        $this->load->model('Produk_model');
        $this->load->model('Pelanggan_model');
    }

    public function index()
    {
        $id_sales = $this->is_sales() ? $this->session->userdata('id_user') : null;

        $data['total_produk']    = $this->db->count_all('produk');
        $data['total_pelanggan'] = $this->db->count_all('pelanggan');
        $data['total_order']     = count($this->SalesOrder_model->get_all($id_sales));
        $data['total_penjualan'] = $this->SalesOrder_model->total_penjualan_bulan_ini();
        $data['order_draft']     = $this->SalesOrder_model->count_by_status('draft');
        $data['order_dikirim']   = $this->SalesOrder_model->count_by_status('dikirim');
        $data['order_selesai']   = $this->SalesOrder_model->count_by_status('selesai');
        $data['order_batal']     = $this->SalesOrder_model->count_by_status('dibatalkan');
        $data['recent_orders']   = $this->SalesOrder_model->get_all($id_sales);
        // Ambil hanya 5 terbaru
        $data['recent_orders'] = array_slice($data['recent_orders'], 0, 5);

        $this->render('dashboard/index', $data);
    }
}
