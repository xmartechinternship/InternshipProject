<?php
class Slider extends CI_Controller
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
        $this->load->model('Slider_model');
        $queryString = $this->input->get('q');
        $params['queryString'] = $queryString;

        $sliders = $this->Slider_model->getSliders($params);
        $data['sliders'] = $sliders;
        $data['queryString'] = $queryString;

        $this->load->view('Admin/Slider/List', $data);
    }
    public function create()
    {
        $this->load->helper('common_helper');

        $config['upload_path'] = 'public/Uploads/Slider/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->load->model('Slider_model');

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $data = $this->upload->data();

                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb/' . $data['file_name'], 300, 270);

                    $formArray['name'] = $this->input->post('name');
                    $formArray['image'] = $data['file_name'];
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y-m-d H:i:s');

                    $this->Slider_model->create($formArray);

                    $this->session->set_flashdata('succcess', 'Slider added successfully');
                    redirect(base_url() . 'Admin/Slider/index');
                } else {
                    $error = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
                    $data['errorImageUpload'] = $error;

                    $this->load->view('Admin/Slider/create', $data);
                }
            } else {
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y-m-d H:i:s');

                $this->Slider_model->create($formArray);

                $this->session->set_flashdata('success', 'Slider added successfully');
                redirect(base_url() . 'Admin/Slider/index');
            }
        } else {
            $this->load->view('Admin/Slider/Create');
        }

        $this->load->view('Admin/Slider/Create');
    }
    public function edit($id)
    {
        $this->load->model('Slider_model');
        $slider = $this->Slider_model->getSlider($id);
        if (empty($slider)) {
            $this->session->set_flashdata('error', 'Slider not found');
            redirect(base_url() . 'Admin/Slider/index');
        }
        $this->load->helper('common_helper');

        $config['upload_path'] = 'public/Uploads/Slider/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback>"', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $data = $this->upload->data();

                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb/' . $data['file_name'], 300, 270);

                    $formArray['name'] = $this->input->post('name');
                    $formArray['image'] = $data['file_name'];
                    $formArray['status'] = $this->input->post('status');
                    $formArray['updated_at'] = date('Y-m-d H:i:s');
                    $this->Slider_model->update($formArray, $id);

                    if (file_exists('./public/Uploads/Slider/' . $slider['image'])) {
                        unlink('./public/Uploads/Slider/' . $slider['image']);
                    }
                    if (file_exists('./public/Uploads/Slider/thumb/' . $slider['image'])) {
                        unlink('./public/Uploads/Slider/thumb/' . $slider['image']);
                    }

                    $this->session->set_flashdata('success', 'Slider updated successfully');
                    redirect(base_url() . 'Admin/Slider/index');
                } else {
                    $error = $this->upload->display_errors("<p class='invalid-feedback'", "</p>");
                    $data['errorImageUpload'] = $error;

                    $this->load->view('Admin/Slider/edit', $data);
                }
            } else {
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Slider_model->update($formArray, $id);

                $this->session->set_flashdata('success', 'Slider updated successfully');
                redirect(base_url() . 'Admin/Slider/index');
            }
        } else {
            $data['slider'] = $slider;
            $this->load->view('Admin/Slider/Edit', $data);
        }
    }
    public function delete($id)
    {
        $this->load->model('Slider_model');
        $slider = $this->Slider_model->getSlider($id);
        if (empty($slider)) {
            $this->session->set_flashdata('error', 'Slider not found');
            redierect(base_url() . 'Admin/Slider/index');
        }
        if (file_exists('./public/Uploads/Slider/' . $slider['image'])) {
            unlink('./public/Uploads/Slider/' . $slider['image']);
        }
        if (file_exists('./public/Uploads/Slider/thumb/' . $slider['image'])) {
            unlink('./public/Uploads/Slider/thumb/' . $slider['image']);
        }
        $this->Slider_model->delete($id);

        $this->session->set_flashdata('success', 'Slider deleted successfully');
        redirect(base_url() . 'Admin/Slider/index');
    }
}
