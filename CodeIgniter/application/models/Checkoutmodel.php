<?php

class Checkoutmodel extends CI_Model
{
    public function user_login()                     //verify and login user
    {
        $email = $this->input->post('user_email');
        $password = $this->input->post('user_password');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $q = $query->result();
            return $q;
        } //else redirect to login page
        else {
            redirect('checkout/error');
        }
    }
}