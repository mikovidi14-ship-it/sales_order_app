<?php

class pelanggan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->only_admin();
        $this->load->model('Pelanggan_model');
    }

    public function index()
    {
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $this->render('pelanggan/index', $data);
    }

    public function tambah()
    {
        $this->render('pelanggan/tambah');
    }

    public function simpan()
    {
        $data = [
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'alamat'         => $this->input->post('alamat'),
            'no_telepon'     => $this->input->post('no_telepon'),
        ];
        $this->Pelanggan_model->insert($data);
        $this->session->set_flashdata('success', 'Data pelanggan berhasil ditambahkan.');
        redirect('pelanggan');
    }

    public function edit($id)
    {
        $data['pelanggan'] = $this->Pelanggan_model->get_by_id($id);
        $this->render('pelanggan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'alamat'         => $this->input->post('alamat'),
            'no_telepon'     => $this->input->post('no_telepon'),
        ];
        $this->Pelanggan_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data pelanggan berhasil diperbarui.');
        redirect('pelanggan');
    }

    public function hapus($id)
    {
        $this->Pelanggan_model->delete($id);
        $this->session->set_flashdata('success', 'Data pelanggan berhasil dihapus.');
        redirect('pelanggan');
    }
}
