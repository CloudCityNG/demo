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
        $this->db->select('admin_id');
        $this->db->from('e-commers');
        $this->db->where('admin_name',$username);
        $this->db->where('admin_password',$password);
        $this->db->limit(1);
        $search=$this->db->get();
        $se=$search->row()->admin_id;
        if($search->num_rows() == 1)
        {
            return $se;
        }
        else
        {
            redirect('admin/login/error');
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

            redirect('admin/login/sendMail');
        }
        else{
            redirect('admin/login/email_error');
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
        $getid=$this->uri->segment(4);
        $this->db->where('admin_id',$getid);
        $this->db->delete('e-commers');
    }
    public function user_edit()                         //edit admin
    {
        $getid=$this->uri->segment(4);
        $this->db->select('*');
        $this->db->where('admin_id',$getid);
        $query=$this->db->get('e-commers');
        $query_result=$query->result();
        return $query_result;
    }
    function sort_data($var)                            //sort admin
    {
        $this->db->from('e-commers');
        $this->db->order_by($var,"decs");
        $query=$this->db->get();
        $q=$query->result_array();
        return $q;
    }
    public function fetch()
    {
        $data['admin_name']=$this->input->post('admin_name');
        $data['admin_lastname']=$this->input->post('admin_name');
        $data['admin_password']=$this->input->post('admin_name');
        $data['admin_compass']=$this->input->post('admin_compass');
        $data['admin_email']=$this->input->post('admin_name');
        return $data;
    }
    public function add_fetch()
    {
        $data['admin_name']=$this->input->post('admin_name');
        $data['admin_lastname']=$this->input->post('admin_name');
        $data['admin_password']=$this->input->post('admin_name');
        $data['admin_compass']=$this->input->post('admin_compass');
        $data['admin_email']=$this->input->post('admin_name');
        return $data;
    }
    public function record_count()                      //count admin
    {
        return $this->db->count_all("e-commers");
    }
    public function fetch_data($limit, $page)           //pagignation admin
    {
        $var=$this->input->get('sortby');

        if(empty($var))
        {
            $var='admin_name';

            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var, "decs");
            $query = $this->db->get("e-commers");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

                return $data;
            }
            return false;}
        else {
            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var, "decs");
            $query = $this->db->get("e-commers");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

                return $data;
            }
            return false;
        }
    }

                                     //PRODUCT

    public function product_count()                            //count product
    {
        return $this->db->count_all("product");
    }
    public function record_count_product()                     //product_count
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product.product_id=product_images.product_id');
        $this->db->group_by('product_images.product_id');
        return $this->db->get()->num_rows();
    }
    public function fetch_product_data($limit, $page)           //pagignation product
    {

        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product.product_id=product_images.product_id');
        $this->db->group_by('product_images.product_id');

        $query = $this->db->get()->result_array();

        if (count($query)> 0)
        {
            foreach ($query as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function product_insert($data)                    //insert product
    {
        $this->db->insert('product',$data);
        $prod_id= $this->db->insert_id();

    return $prod_id;

    }


    public function upload_img($uploed)                      //insert img
    {
        $this->db->insert('product_images',$uploed);
    }


            //CATEGORY

    public function select_category($category_name)          //select category
    {
        $this->db->insert('category',$category_name);
        $cat_id=$this->db->insert_id();
        return $cat_id;
    }

    public function product_category($pro_cat)              //insert category
    {
        $this->db->insert('product_category',$pro_cat);
    }
    public function update_product_category($prod_id,$data)
    {
        $this->db->where('category_id',$prod_id);
        $this->db->update('category',$data);
    }
    public function category_list()
    {
        return $this->db->count_all('category');
    }
    public function fetch_data_from_category($limit,$page)
    {

            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by('category_name', "decs");
            $query = $this->db->get("category");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

                return $data;
            }
           else return false;
    }
    public function cat($category_name)
    {
        $this->db->select('category_id');
        $this->db->from('category');
        $this->db->where('category_name',$category_name);
        return $this->db->get()->row()->category_id;

    }
    public function category_edit($id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id',$id);
        return $this->db->get()->result_array();
    }
    public function categoryall()
    {
        $query=$this->db->get('category')->result_array();
        return $query;
    }
    public function category_search($category_search)
    {
        $this->db->like('category_name',$category_search);
        $query = $this->db->get('category');
        $x=$query->result_array();
        return $x;
    }
    public function category_insert($data)
    {
        $this->db->insert('category',$data);
    }
    public function category_update($data,$cate_id)
    {
        $this->db->where('category_id',$cate_id);
        $this->db->update('category',$data);
    }





    public function product_delete()                         //delete product
    {
        $getid=$this->uri->segment(4);
        $this->db->where('product_id',$getid);
        $this->db->delete('product');
    }
    public function product_edit()                          //edit product
    {
        $getid=$this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('product.product_id',$getid);
        $query=$this->db->get();
        $query_result=$query->result();
        return $query_result;
    }
    function update($id,$data)                             //update product
    {
        $this->db->where('product_id',$id);
        $this->db->update('product',$data);
    }
    public function search($admin_serach)                 //serach admin
    {
        $this->db->like('admin_name',$admin_serach);
        $this->db->or_like('admin_email',$admin_serach);
        $this->db->or_like('admin_lastname',$admin_serach);
        $query = $this->db->get('e-commers');
        $x=$query->result_array();
        return $x;
    }
    public function search_image($image_search)
    {
        $this->db->like('image_name',$image_search);
        $query = $this->db->get('product_images');
        $x=$query->result_array();
        return $x;
    }
    public function product_search($product_serach)        //search product
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->like('name',$product_serach);
        $this->db->or_like('price',$product_serach);
        $this->db->or_like('quntity',$product_serach);
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
    public function home()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->group_by('product_images.product_id');
        $query = $this->db->get();
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


    public function from_image_update($prod_id,$data)                  //uppdate img
    {

        $this->db->where('product_id',$prod_id);
        $this->db->update('product_images',$data);

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
    public function record_count_banner()                      //count images
    {
        return $this->db->count_all("product_images");
    }
    public function fetch_banner_data($limit, $page)           //pagignation images
    {

        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $query = $this->db->get("product_images");
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
    public function delete_signle($con)
    {
        $this->db->where('contact_id',$con);
        $this->db->delete('contact_us');
    }
    public function change_perpage($number,$ses_id)
    {
      //  $data=$this->input->post('perpage');
        $this->db->select('*');
        $this->db->from('configration');
        $this->db->where('created_by',$ses_id);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            $this->db->where('created_by',$ses_id);
            $this->db->update('configration',$number);
        }
        else{
            $this->db->insert('configration',$number);
        }
    }
    public function fetch_perpage($id)
    {

        $this->db->select('perpage');
        $this->db->from('configration');
        $this->db->where('created_by',$id);

        $query=@$this->db->get()->row()->perpage;


        if(!empty($query))
        {
            return $query;
        }
        else{
            $per=2;
            return $per;
        }

    }
    public function session_id()
    {
        $hidden=$this->input->post('hidden');
        echo $hidden;
        $this->db->select('admin_id');
        $this->db->from('e-commers');
        $this->db->where('admin_name',$hidden);
        return $this->db->get()->row()->admin_id;

    }
    public function fetch_setting($session_id)
    {
        $this->db->select('*');
        $this->db->from('e-commers');
    //    $this->db->join('configration','e-commers.admin_id=configration.created_by');
        $this->db->where('admin_name',$session_id);
        $query=$this->db->get();
        $x=$query->result_array();
        return $x;
    }

    public function session_email()
    {
        $id=$this->session->userdata('id');
        $this->db->select('admin_email');
        $this->db->from('e-commers');
        $this->db->where('admin_id',$id);
        $search=$this->db->get();
        $se=$search->row()->admin_email;
            return $se;
    }
    public function upadate_email($data,$id)
    {

        $this->db->where('admin_name',$id);
        $this->db->update('e-commers',$data);
    }
    public function record_count_user()                      //count images
    {
        return $this->db->count_all("user");
    }
    public function fetch_user_data($limit, $page)           //pagignation user
    {

        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $query = $this->db->get("user");
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
    public function userlist_delete()                         //delete userlist data
    {
        $getid=$this->uri->segment(4);
        $this->db->where('user_id',$getid);
        $this->db->delete('user');
    }
    public function userlist_data()                         //delete userlist data
    {
        $getid=$this->uri->segment(4);
        $this->db->where('user.user_id',$getid);
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_address','user_address.user_id=user.user_id');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function compliant_count()
    {
        return $this->db->count_all("contact_us");
    }
}