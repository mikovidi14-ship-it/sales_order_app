<?php

class laporan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->only_admin_or_manager();
        $this->load->model('SalesOrder_model');
    }

    public function index()
    {
        redirect('laporan/penjualan');
    }

    public function penjualan()
    {
        $tgl_mulai = $this->input->get('tgl_mulai') ?: date('Y-m-01');
        $tgl_akhir = $this->input->get('tgl_akhir') ?: date('Y-m-d');

        $data['per_sales']   = $this->SalesOrder_model->laporan_per_sales($tgl_mulai, $tgl_akhir);
        $data['per_produk']  = $this->SalesOrder_model->laporan_per_produk($tgl_mulai, $tgl_akhir);
        $data['per_periode'] = $this->SalesOrder_model->laporan_per_periode($tgl_mulai, $tgl_akhir);
        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_akhir']   = $tgl_akhir;

        $this->render('laporan/penjualan', $data);
    }

    public function cetak_pdf()
    {
        $tgl_mulai = $this->input->get('tgl_mulai') ?: date('Y-m-01');
        $tgl_akhir = $this->input->get('tgl_akhir') ?: date('Y-m-d');

        $data['per_sales']   = $this->SalesOrder_model->laporan_per_sales($tgl_mulai, $tgl_akhir);
        $data['per_produk']  = $this->SalesOrder_model->laporan_per_produk($tgl_mulai, $tgl_akhir);
        $data['per_periode'] = $this->SalesOrder_model->laporan_per_periode($tgl_mulai, $tgl_akhir);
        $data['tgl_mulai']   = $tgl_mulai;
        $data['tgl_akhir']   = $tgl_akhir;

        // Load mPDF atau gunakan print CSS
        $this->load->view('laporan/cetak_pdf', $data);
    }
}
