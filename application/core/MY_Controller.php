<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek apakah sudah login
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }

    protected function is_admin()
    {
        return $this->session->userdata('role') === 'admin';
    }

    protected function is_sales()
    {
        return $this->session->userdata('role') === 'sales';
    }

    protected function is_manager()
    {
        return $this->session->userdata('role') === 'manager';
    }

    protected function only_admin()
    {
        if (!$this->is_admin()) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard');
        }
    }

    protected function only_admin_or_manager()
    {
        if ($this->session->userdata('role') === 'sales') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('dashboard');
        }
    }

    protected function render($view, $data = [])
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer', $data);
    }
}
