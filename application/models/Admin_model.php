<?php
class Admin_model extends CI_Model
{
    public function create($formArray)
    {
        $this->db->insert('admin_user', $formArray);
    }
    public function getByUserEmail($email)
    {
        $this->db->where('email', $email);
        $admin = $this->db->get('admin_user')->row_array();
        return $admin;
    }
}
