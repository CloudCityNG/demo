<?php

class Admin_insert extends CI_Model
{
    function insert_admin($data)                    //insert admin
    {
        $this->db->insert('e-commers',$data);

    }
    function update_admin($id,$data)
    {
        $this->db->where('admin_id',$id);
        $this->db->update('e-commers',$data);
    }
    function login()                                //admin login
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
    function verify()                               //verify e-mail
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
    public function list_user()                         //admin_list
    {
        $query = $this->db->get('e-commers');
        $query_result = $query->result_array();
        return $query_result;
    }
    public function list_product()                      //prduct list
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $query = $this->db->get();
        $query_result = $query->result_array();
        return $query_result;
    }

    public function user_delete()                       //delete admin
    {
        $getid=$this->input->get('admin_id');
        $this->db->where('admin_id',$getid);
        $this->db->delete('e-commers');
    }

    public function user_edit()                         //edit admin
    {
        $getid=$this->input->get('admin_id');
        $this->db->select('*');
        $this->db->where('admin_id',$getid);
        $query=$this->db->get('e-commers');
        $query_result=$query->result();
        return $query_result;
    }
    public function product_count()                     //count product
    {
        return $this->db->count_all("product");
    }
    public function record_count()                      //count admin
    {
        return $this->db->count_all("e-commers");
    }
    public function fetch_data($limit, $page)           //pagignation admin
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
    public function record_count_product()                  //product_count
    {
        return $this->db->count_all("product");
    }
    public function fetch_product_data($limit, $page)       //pagignation admin
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
    public function product_insert($data)                   //insert product
    {
        $this->db->insert('product',$data);
        $prod_id= $this->db->insert_id();

    return $prod_id;

    }
    public function upload_img($uploed)                       //insert img
    {
        $this->db->insert('product_images',$uploed);
    }
    public function select_category($category_name)            //select category
    {
        $this->db->insert('category',$category_name);
        $cat_id=$this->db->insert_id();
        return $cat_id;
    }
    public function product_category($pro_cat)                  //insert category
    {
        $this->db->insert('product_category',$pro_cat);
    }
    public function product_delete()                            //delete product
    {
        $getid=$this->input->get('product_id');
        $this->db->where('product_id',$getid);
        $this->db->delete('product');
    }
    public function product_edit()                              //edit product
    {
        $getid=$this->input->get('product_id');
        $this->db->select('*');
        $this->db->where('product_id',$getid);
        $query=$this->db->get('product');
        $query_result=$query->result();
        return $query_result;
    }
    function update($id,$data)                                  //update product
    {
        $this->db->where('id',$id);
        $this->db->update('product',$data);
    }
    public function search($admin_serach)                          //serach admin
    {
        $this->db->like('admin_name',$admin_serach);
        $query = $this->db->get('e-commers');
        $x=$query->result_array();
        return $x;
    }
    public function product_search($product_serach)                //search product
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

    public function select_img()                         //search img
    {
        $query=$this->db->get('product_images');
        $x=$query->result_array();
        return $x;
    }

    public function product_details($id)                //product_detalis
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

    public function product_details_cat($id)            //product category
    {

        //$id = $this->input->get('id', TRUE);
        $this->db->where('category_id',$id);
        $query=$this->db->get('category');
        $x=$query->result_array();
        return $x;
    }
    public function view_banner()                       //banner
    {
        $query=$this->db->get('product_images');
        return $query->result_array();
    }
    public function img_edit()                          //edit img
    {
        $img_id=$this->input->get('img_id');
        $this->db->where('img_id',$img_id);
        $query=$this->db->get('product_images');
        $query_result=$query->result();
        return $query_result;
    }
    public function image_update($data)                  //uppdate img
    {
        $getid=$this->input->get('img_id');
        $this->db->where('img_id',$getid);
        $this->db->update('product_images',$data);

    }
    public function show_image()                         //show img
    {

        $query=$this->db->get('product_images');
        return $query->result_array();
    }
    public function img_delete()                         //delete img
    {
        $getid=$this->input->get('img_id');
        $this->db->where('img_id',$getid);
        $this->db->delete('product_images');
    }
    public function img_detalis()                      //img details
    {
        $img_id=$this->input->get('img_id');
        $this->db->where('img_id',$img_id);
        $query=$this->db->get('product_images');
        $query_result=$query->result();
        return $query_result;
    }
    public function user_query()                        //user query
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $prob=$this->db->get();
        return $prob->result_array();
    }
    public function view_query($user_id)                //view query
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $this->db->where('contact_id',$user_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function replay_admin()                      //replay on query
    {
        $replay['admin_replay']=$this->input->post('replay');
        $con=$this->input->post('con_id');
        $this->db->where('contact_id',$con);
        $this->db->update('contact_us',$replay);
    }

}