<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            redirect(base_url() . 'Admin/Login/index');
        }
    }
    public function index()
    {
        $admin = $this->session->userdata('admin');
        $this->load->view('Admin/Dashboard');
    }
}
