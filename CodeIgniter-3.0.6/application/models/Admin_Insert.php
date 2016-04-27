<?php

class Admin_insert extends CI_Model
{
    function insert_admin($data)
    {
        $this->db->insert('e-commers',$data);

    }
    function update_admin($id,$data)
    {
        $this->db->where('admin_id',$id);
        $this->db->update('e-commers',$data);
    }
    function login()
    {
       // $query['count']=$this->db->count_all("e-commers");
        $username=$this->input->post('admin_name');
        $password=$this->input->post('admin_password');
        $this->db->select('*');
        $this->db->from('e-commers');
        $this->db->where('admin_name',$username);
        $this->db->where('admin_password',$password);
        $this->db->limit(1);
        $search=$this->db->get();
        if($search->num_rows() == 1)
        {
            $query = $search->result();

            return $query;
        }
        else
        {
            redirect('welcome/error');
        }
    }
    function verify()
    {
        $email=$this->input->get('admin_email');
        $this->db->select('*');
        $this->db->from('e-commers');
        $this->db->where('admin_email',$email);
        $this->db->limit(1);
        $verify=$this->db->get();
        if($verify->num_rows()==1)
        {

            redirect('welcome/sendMail');
        }
        else{
            redirect('welcome/email_error');
        }
    }
    public function list_user()
    {
        $query = $this->db->get('e-commers');
        $query_result = $query->result_array();
        return $query_result;
    }
    public function list_product()
    {
        $query = $this->db->get('product');
        $query_result = $query->result_array();
        return $query_result;
    }
    public function user_delete()
    {
        $getid=$this->input->get('admin_id');
        $this->db->where('admin_id',$getid);
        $this->db->delete('e-commers');
    }

    public function user_edit()
    {
        $getid=$this->input->get('admin_id');
        $this->db->select('*');
        $this->db->where('admin_id',$getid);
        $query=$this->db->get('e-commers');
        $query_result=$query->result();
        return $query_result;
    }
    public function product_count()
    {
        return $this->db->count_all("product");
    }
    public function record_count()
    {
        return $this->db->count_all("e-commers");
    }
    public function fetch_data($limit, $page)
    {
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $query = $this->db->get("e-commers");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }
    public function record_count_product()
    {
        return $this->db->count_all("product");
    }
    public function fetch_product_data($limit, $page)
    {
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $query = $this->db->get("product");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }
    public function product_insert($data)
    {
        $this->db->insert('product',$data);
    }
    public function product_delete()
    {
        $getid=$this->input->get('id');
        $this->db->where('id',$getid);
        $this->db->delete('product');
    }
    public function product_edit()
    {
        $getid=$this->input->get('id');
        $this->db->select('*');
        $this->db->where('id',$getid);
        $query=$this->db->get('product');
        $query_result=$query->result();
        return $query_result;
    }
    function update($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('product',$data);
    }
    public function search($admin_serach)
    {
        $this->db->like('admin_name',$admin_serach);
        $query = $this->db->get('e-commers');
        $x=$query->result_array();
        return $x;
    }
    public function product_search($product_serach)
    {
        $this->db->like('name',$product_serach);
        $query = $this->db->get('product');
        $x=$query->result_array();
        return $x;
    }
    public function upload_img($uploed)
    {
        $this->db->insert('product_images',$uploed);
    }


}