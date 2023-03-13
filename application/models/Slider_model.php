<?php
class Slider_model extends CI_Model
{
    public function create($formArray)
    {
        $this->db->insert('sliders', $formArray);
    }
    public function getSliders($params = [])
    {
        if (!empty($params['queryString'])) {
            $this->db->like('name', $params['queryString']);
        }
        $result = $this->db->get('sliders')->result_array();
        return $result;
    }
    public function getSlider($id)
    {
        $this->db->where('id', $id);
        $slider = $this->db->get('sliders')->row_array();
        return $slider;
    }
    public function update($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('sliders', $formArray);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sliders');
    }
}
