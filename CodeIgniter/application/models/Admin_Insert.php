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
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $query = $this->db->get();
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

        echo $limit,$page;
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
        $prod_id= $this->db->insert_id();

    return $prod_id;

    }
    public function upload_img($uploed)
    {
        $this->db->insert('product_images',$uploed);
    }
    public function select_category($category_name)
    {
        $this->db->insert('category',$category_name);
        $cat_id=$this->db->insert_id();
        return $cat_id;
    }
    public function product_category($pro_cat)
    {
        $this->db->insert('product_category',$pro_cat);
    }
    public function product_delete()
    {
        $getid=$this->input->get('product_id');
        $this->db->where('product_id',$getid);
        $this->db->delete('product');
    }
    public function product_edit()
    {
        $getid=$this->input->get('product_id');
        $this->db->select('*');
        $this->db->where('product_id',$getid);
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
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->like('name',$product_serach);
        $query = $this->db->get();


        //$query = $this->db->get('product');
        $x=$query->result_array();
        return $x;
    }

    public function select_img()
    {
        $query=$this->db->get('product_images');
        $x=$query->result_array();
        return $x;
    }

    public function product_details($id)
    {
        $this->db->select('product.*,product_images.*,product_category.*');
        $this->db->from('product');
        $this->db->where('product.product_id',$id);
        $this->db->join('product_images','product_images.product_id = product.product_id');
        $this->db->join('product_category','product_category.product_id = product.product_id');
        $query=$this->db->get();
        $x=$query->result_array();
        return $x;
    }

    public function product_details_cat($id)
    {

        //$id = $this->input->get('id', TRUE);
        $this->db->where('category_id',$id);
        $query=$this->db->get('category');
        $x=$query->result_array();
        return $x;
    }
    public function view_banner()
    {
        $query=$this->db->get('product_images');
        return $query->result_array();
    }
    public function img_edit()
    {
        $img_id=$this->input->get('img_id');
        $this->db->where('img_id',$img_id);
        $query=$this->db->get('product_images');
        $query_result=$query->result();
        return $query_result;
    }
    public function image_update($data)
    {
        $getid=$this->input->get('img_id');
        $this->db->where('img_id',$getid);
        $this->db->update('product_images',$data);

    }
    public function show_image()
    {
        //$this->db->insert_id();

        $query=$this->db->get('product_images');
        return $query->result_array();
    }
    public function img_delete()
    {
        $getid=$this->input->get('img_id');
        $this->db->where('img_id',$getid);
        $this->db->delete('product_images');
    }
    public function img_detalis()
    {
        $img_id=$this->input->get('img_id');
        $this->db->where('img_id',$img_id);
        $query=$this->db->get('product_images');
        $query_result=$query->result();
        return $query_result;
    }

}