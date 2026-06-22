<?php

class produk extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->only_admin();
        $this->load->model('Produk_model');
    }

    public function index()
    {
        $data['produk'] = $this->Produk_model->get_all();
        $this->render('produk/index', $data);
    }

    public function tambah()
    {
        $this->render('produk/tambah');
    }

    public function simpan()
    {
        $data = [
            'kode_produk'  => $this->input->post('kode_produk'),
            'nama_produk'  => $this->input->post('nama_produk'),
            'harga'        => $this->input->post('harga'),
            'stok'         => $this->input->post('stok'),
        ];
        $this->Produk_model->insert($data);
        $this->session->set_flashdata('success', 'Data produk berhasil ditambahkan.');
        redirect('produk');
    }

    public function edit($id)
    {
        $data['produk'] = $this->Produk_model->get_by_id($id);
        $this->render('produk/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode_produk'  => $this->input->post('kode_produk'),
            'nama_produk'  => $this->input->post('nama_produk'),
            'harga'        => $this->input->post('harga'),
            'stok'         => $this->input->post('stok'),
        ];
        $this->Produk_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data produk berhasil diperbarui.');
        redirect('produk');
    }

    public function hapus($id)
    {
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Data produk berhasil dihapus.');
        redirect('produk');
    }
}
