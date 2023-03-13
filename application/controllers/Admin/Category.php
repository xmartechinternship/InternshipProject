<?php
class Category extends CI_Controller
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
        $this->load->model('Category_model');
        $queryString = $this->input->get('q');
        $params['queryString'] = $queryString;

        $categories = $this->Category_model->getCategories($params);
        $data['categories'] = $categories;
        $data['queryString'] = $queryString;
        $this->load->view('Admin/Category/list', $data);
    }
    public function create()
    {
        $this->load->helper('common_helper');

        $config['upload_path'] = 'public/Uploads/Category/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->load->model('Category_model');

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

                    $this->Category_model->create($formArray);

                    $this->session->set_flashdata('succcess', 'Category added successfully');
                    redirect(base_url() . 'Admin/Category/index');
                } else {
                    $error = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
                    $data['errorImageUpload'] = $error;

                    $this->load->view('Admin/Category/create', $data);
                }
            } else {
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y-m-d H:i:s');

                $this->session->set_flashdata('success', 'Category added successfully');
                redirect(base_url() . 'Admin/Category/index');
            }
        } else {
            $this->load->view('Admin/Category/create');
        }

        $this->load->view('Admin/Category/create');
    }
    public function edit($id)
    {
        $this->load->model('Category_model');

        $category = $this->Category_model->getCategory($id);
        if (empty($category)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url() . 'Admin/Category/index');
        }
        $this->load->helper('common_helper');

        $config['upload_path'] = 'public/Uploads/Category/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;

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
                    $this->Category_model->update($formArray, $id);

                    if (file_exists('./public/Uploads/Category/' . $category['image'])) {
                        unlink('./public/Uploads/Category/' . $category['image']);
                    }
                    if (file_exists('./public/Uploads/Category/thumb/' . $category['image'])) {
                        unlink('./public/Uploads/Category/thumb/' . $category['image']);
                    }

                    $this->session->set_flashData('success', 'Category updated successfully');
                    redirect(base_url() . 'Admin/Category/index');
                } else {
                    $error = $this->upload->display_errors('<p class="invalid-feedback>"', '</p>');
                    $data['errorImageUpload'] = $error;

                    $this->load->view('Admin/Category/Edit', $data);
                }
            } else {
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Category_model->update($formArray, $id);

                $this->session->set_flashdata('success', 'Category updated successfully');
                redirect(base_url() . 'Admin/Category/index');
            }
        } else {
            $data['category'] = $category;
            $this->load->view('Admin/Category/Edit', $data);
        }
    }
    public function delete($id)
    {
        $this->load->model('Category_model');
        $category = $this->Category_model->getCategory($id);
        if (empty($category)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url() . 'Admin/Category/index');
        }
        if (file_exists('./public/Uploads/Category/' . $category['image'])) {
            unlink('./public/Uploads/Category/' . $category['image']);
        }
        if (file_exists('./public/Uploads/Category/thumb/' . $category['image'])) {
            unlink('./public/Uploads/Category/thumb/' . $category['image']);
        }
        $this->Category_model->delete($id);
        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect(base_url() . 'Admin/Category/index');
    }
}
