<?php
class auth_model extends CI_Model
{
    public function userData()
    {
        return $this->db->select('*')
            ->from('user')
            ->join('role', 'user.role_id = role.role_id')
            ->where('user.email', $this->session->userdata('email'))
            ->get()->row_array();
        // $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function login_user($email, $password)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        if ($query->num_rows() > 0) {
            $data_user = $query->row();
            if (password_verify($password, $data_user->password)) {
                $this->session->set_userdata('user_id', $data_user->user_id);
                $this->session->set_userdata('email', $data_user->email);
                $this->session->set_userdata('role_id', $data_user->role_id);
                $this->session->set_userdata('is_login', TRUE);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // insert data user
    public function insertUser($data, $table)
    {
        return $this->db->insert($table, $data);
    }
}
