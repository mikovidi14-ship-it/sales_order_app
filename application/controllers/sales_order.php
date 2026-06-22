<?php

class sales_order extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SalesOrder_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Produk_model');
    }

    public function index()
    {
        // Sales hanya lihat ordernya sendiri
        $id_sales = $this->is_sales() ? $this->session->userdata('id_user') : null;
        $data['orders'] = $this->SalesOrder_model->get_all($id_sales);
        $this->render('sales_order/index', $data);
    }

    public function tambah()
    {
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $data['produk']    = $this->Produk_model->get_all();
        $data['no_order']  = $this->SalesOrder_model->generate_no_order();
        $this->render('sales_order/tambah', $data);
    }

    public function simpan()
    {
        $id_sales = $this->session->userdata('id_user');

        // Simpan header order
        $order_data = [
            'no_order'       => $this->input->post('no_order'),
            'id_pelanggan'   => $this->input->post('id_pelanggan'),
            'id_sales'       => $id_sales,
            'tanggal_order'  => $this->input->post('tanggal_order'),
            'status'         => 'draft',
            'catatan'        => $this->input->post('catatan'),
            'total_harga'    => 0,
        ];

        $id_order = $this->SalesOrder_model->insert($order_data);

        // Simpan detail order
        $id_produk   = $this->input->post('id_produk');
        $jumlah      = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');

        $total = 0;
        if ($id_produk) {
            foreach ($id_produk as $key => $pid) {
                if (empty($pid)) continue;
                $qty      = (int)$jumlah[$key];
                $harga    = (float)$harga_satuan[$key];
                $subtotal = $qty * $harga;
                $total   += $subtotal;

                $this->SalesOrder_model->insert_detail([
                    'id_order'    => $id_order,
                    'id_produk'   => $pid,
                    'jumlah'      => $qty,
                    'harga_satuan'=> $harga,
                    'subtotal'    => $subtotal,
                ]);
            }
        }

        // Update total
        $this->SalesOrder_model->update($id_order, ['total_harga' => $total]);

        $this->session->set_flashdata('success', 'Sales Order berhasil dibuat.');
        redirect('sales_order');
    }

    public function detail($id)
    {
        // Validasi akses sales
        $order = $this->SalesOrder_model->get_by_id($id);
        if (!$order) redirect('sales_order');
        if ($this->is_sales() && $order->id_sales != $this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Anda tidak berhak mengakses order ini.');
            redirect('sales_order');
        }

        $data['order']  = $order;
        $data['detail'] = $this->SalesOrder_model->get_detail($id);
        $this->render('sales_order/detail', $data);
    }

    public function edit($id)
    {
        $order = $this->SalesOrder_model->get_by_id($id);
        if (!$order || $order->status != 'draft') {
            $this->session->set_flashdata('error', 'Order tidak dapat diedit.');
            redirect('sales_order');
        }
        if ($this->is_sales() && $order->id_sales != $this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Anda tidak berhak mengedit order ini.');
            redirect('sales_order');
        }

        $data['order']     = $order;
        $data['detail']    = $this->SalesOrder_model->get_detail($id);
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $data['produk']    = $this->Produk_model->get_all();
        $this->render('sales_order/edit', $data);
    }

    public function update($id)
    {
        // Hapus detail lama, simpan ulang
        $this->SalesOrder_model->delete_detail($id);

        $order_data = [
            'id_pelanggan'  => $this->input->post('id_pelanggan'),
            'tanggal_order' => $this->input->post('tanggal_order'),
            'catatan'       => $this->input->post('catatan'),
        ];

        $id_produk    = $this->input->post('id_produk');
        $jumlah       = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');

        $total = 0;
        if ($id_produk) {
            foreach ($id_produk as $key => $pid) {
                if (empty($pid)) continue;
                $qty      = (int)$jumlah[$key];
                $harga    = (float)$harga_satuan[$key];
                $subtotal = $qty * $harga;
                $total   += $subtotal;

                $this->SalesOrder_model->insert_detail([
                    'id_order'     => $id,
                    'id_produk'    => $pid,
                    'jumlah'       => $qty,
                    'harga_satuan' => $harga,
                    'subtotal'     => $subtotal,
                ]);
            }
        }

        $order_data['total_harga'] = $total;
        $this->SalesOrder_model->update($id, $order_data);
        $this->session->set_flashdata('success', 'Sales Order berhasil diperbarui.');
        redirect('sales_order');
    }

    public function update_status($id)
    {
        $this->only_admin();
        $status = $this->input->post('status');
        $this->SalesOrder_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status order berhasil diperbarui.');
        redirect('sales_order/detail/' . $id);
    }

    public function hapus($id)
    {
        $this->only_admin();
        $this->SalesOrder_model->delete($id);
        $this->session->set_flashdata('success', 'Sales Order berhasil dihapus.');
        redirect('sales_order');
    }

    // AJAX: ambil harga produk
    public function get_harga($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
        echo json_encode(['harga' => $produk ? $produk->harga : 0]);
    }
}
