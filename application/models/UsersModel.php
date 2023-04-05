<?php

class UsersModel extends CI_Model
{
     

    public function user_registration($a)
    {
        return $this->db->insert('system_user', $a);
    }

    public function save_logins($b)
    {
        return $this->db->insert('user_login', $b);
    }

    public function log_in($a)
    {
        $this->db->select('*');
        $this->db->where('user_email', $a['email']);
        $this->db->where('user_password', $a['password']);
        $this->db->where('active_user', 1);
        $this->db->from('user_login');
        $this->db->limit(1);
        $get = $this->db->get();
        if ($get->num_rows() == 1) {
            return $get->row();
        } else {
            return false;
        }
    }
    public function all_users()
    {
        $users = $this->db->select("a.user_names, a.user_gender, a.user_contact, a.user_email, a.registration_date, b.user_email, b.user_role")
            ->from("system_user as a")
            ->join("user_login as b", "a.user_email = b.user_email")
            ->get()
            ->result();
        return $users;
    }
    public function this_user($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->from('system_user');
        $this->db->limit(1);
        $get = $this->db->get();
        return $get->row();
    }
    public function change_password($a)
    {
        $this->db->set('user_password', $a['newpassword']);
        $this->db->set('password_changed', 1);
        $this->db->where('user_email', $this->session->userdata('user_data')['email']);
        $this->db->where('user_password', $a['oldpassword']);
        if ($this->db->update('user_login')) {
            return true;
        }
    }
    public function user_count($a)
    {
        $this->db->select('*');
        $this->db->where('user_role', $a);
        $this->db->from('user_login');
        return $this->db->count_all_results();
    }
}
