<?php
class Signup extends CI_Controller
{
    public function register()
    {
        $this->load->model('Admin_model');

        $this->form_validation->set_rules('name', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'CPassword', 'trim|required');

        if ($this->form_validation->run() == true) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            if ($password == $cpassword) {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $formArray['name'] = $name;
                $formArray['email'] = $email;
                $formArray['password'] = $hashPassword;
                $formArray['admin_user_flag'] = 1;
                $this->Admin_model->create($formArray);
                $this->session->set_flashdata('success', 'Admin created successfully');
                redirect(base_url() . 'Admin/Login/index');
            } else {
                $this->session->set_flashdata('message', 'Password did not match');
                redirect(base_url() . 'Admin/Signup/register');
            }
        }

        $this->load->view('Admin/Signup');
    }
}
