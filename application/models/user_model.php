<?php
class user_model extends CI_Model
{
    // Menampilkan semua data user
    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.role_id');
        return $this->db->get();
    }

    public function getUserByUserId($id)
    {
        return $this->db->select('*')
            ->from('user')
            ->join('role', 'user.role_id = role.role_id')
            ->where('user.user_id', $id)
            ->get()->result_array();
    }

    // insert data user
    public function insertUser($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Update data user
    public function updateUser($userId, $data)
    {
        $this->db->where('user_id', $userId);
        $this->db->update('user', $data);
    }

    // Delete data user
    public function deleteUser($user_id)
    {
        return $this->db->delete('user', ['user_id' => $user_id]);
    }

    // hitung seluruh data User
    public function countAllUser()
    {
        return $this->db->count_all('user');
    }

    // hitung jumlah active dan nonaktif User
    public function countAllStatusUser()
    {
        $query = "SELECT 
		COUNT(name) as total,
		COUNT(IF(is_active = 1, is_active, NULL)) as active,
		COUNT(IF(is_active != 1, is_active, NULL)) as nonactive FROM user";
        $result = $this->db->query($query);
        return $result->row_array();
    }

    public function countRoleUser()
    {
        $query = "SELECT 
        COUNT(name) as total, COUNT(IF(role_name = 'admin', role_name, NULL)) as admin, 
        COUNT(IF(role_name != 'admin', role_name, NULL)) as pelanggan 
        FROM user INNER JOIN role on user.role_id = role.role_id";
        $result = $this->db->query($query);
        return $result->row_array();
    }

    // Menampilkan semua data role  
    public function getRole()
    {
        return $this->db->get('role')->result_array();
    }

    // insert data role
    public function insertRole($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Update data role
    public function updateRole($roleId, $data)
    {
        $this->db->where('role_id', $roleId);
        $this->db->update('role', $data);
    }

    // Delete data role
    public function deleteRole($id)
    {
        return $this->db->delete('role', ['role_id' => $id]);
    }

    // hitung seluruh data role
    function countAllRole()
    {
        return $this->db->count_all('role');
    }
}
