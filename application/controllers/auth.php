<?php

class auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $username= $this->input->post('username');
        $password= $this->input->post('password');

        $user= $this->auth_model->cek_login($username, $password);

        if($user){
            $data=[
                'id_user'=> $user->id,
                'username'=> $user->username,
                'role'=> $user->role,
                'login'=> TRUE
            ];

            $this->session->set_userdata($data);

            $this->auth_model->update_last_login($user->id);
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('error', 'username dan password salah');
            redirect('login');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}