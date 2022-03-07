<?php
class testimoni_model extends CI_Model
{
    // Menampilkan semua data testimoni
    public function getTestimoni()
    {
        $this->db->select('*');
        $this->db->from('testimoni');
        $this->db->join('user', 'testimoni.user_id = user.user_id');
        $this->db->join('role', 'role.role_id = user.role_id');
        return $this->db->get()->result_array();
    }

    public function getTestimoniByUser()
    {
        $this->db->select('*');
        $this->db->from('testimoni');
        $this->db->join('user', 'testimoni.user_id = user.user_id');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->where('user.email', $this->session->userdata('email'));
        return $this->db->get()->result_array();
    }

    public function getTestimoniById($id)
    {
        $this->db->select('*');
        $this->db->from('testimoni');
        $this->db->join('user', 'testimoni.user_id = user.user_id');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->where('testimoni_id', $id);
        return $this->db->get()->result_array();
    }

    // Tambah data testimoni
    public function AddTestimoni($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Update data testimoni
    public function updateTestimoni($testimoni_id, $data)
    {
        $this->db->where('testimoni_id', $testimoni_id);
        $this->db->update('testimoni', $data);
    }

    // Delete data testimoni
    public function deleteTestimoni($id)
    {
        return $this->db->delete('testimoni', ['testimoni_id' => $id]);
    }

    public function countAllTestimoni()
    {
        return $this->db->count_all('testimoni');
    }
}
