<?php
class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('Admin/Login');
    }
    public function authenticate()
    {
        $this->load->model('Admin_model');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $admin = $this->Admin_model->getByUserEmail($email);
            if (!empty($admin)) {
                $password = $this->input->post('password');
                if (password_verify($password, $admin['password']) == true) {
                    $adminArray['admin_id'] = $admin['id'];
                    $adminArray['admin_name'] = $admin['name'];
                    $adminArray['admin_email'] = $admin['email'];
                    $this->session->set_userdata('admin', $adminArray);
                    redirect(base_url() . 'Admin/Home/index');
                } else {
                    $this->session->set_flashdata('msg', 'Wrong creds');
                    redirect(base_url() . 'admin/Login/index');
                }
            } else {
                $this->session->set_flashdata('msg', 'Wrong creds');
                redirect(base_url() . 'admin/Login/index');
            }
        } else {
            $this->load->view('Admin/Login');
        }
    }
    public function Logout()
    {
        $this->session->unset_userdata('admin');
        redirect(base_url() . 'Admin/Login/index');
    }
}
