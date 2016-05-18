<?php

class User extends CI_Model
{

    public function home_category()
    {
        $p_id=0;
        $this->db->select('*');
        $this->db->where('parent_id',$p_id);
        return $this->db->get('category')->result_array();
    }

    public function record_cat_count($category)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('category','category.category_id=product_category.category_id');
        $this->db->join('product','product.product_id=product_category.product_id');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('category.category_id',$category);
        $x= $this->db->get()->num_rows();

        return $x;
    }
    public function data($category)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('category','category.category_id=product_category.category_id');
        $this->db->join('product','product.product_id=product_category.product_id');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('product_category.category_id',$category);
        $this->db->order_by('product.product_id', "decs");

        $query= $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {


                $data[] = $row;
            }

            return $data;
        }
        else return false;
    }
    public function select_cat($category)
    {
        $this->db->select('*');
        $this->db->where('parent_id',$category);
        return $this->db->get('category')->result_array();
    }
    public function insert_user($data)              //insert user data
    {
        $this->db->insert('user', $data);
    }
    public function update_user($data,$id)
    {
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
    }
    public function address_user($data,$user_id)     //insert/update user address
    {

        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id',$user_id);
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            $this->db->update('user_address',$data);
        }
        else{
            $this->db->insert('user_address',$data);
        }
    }
    public function user_login()                        //verify and login user
    {
        $email = $this->input->post('user_email');
        $password = $this->input->post('user_password');

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            $q = $query->result();
            return $q;
        } else
        {
            redirect('Userlogin/error');
        }
    }
    public function user_forget()                       //email verifiacction
    {
        $email = $this->input->post('user_email');
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1)
        {
            $email = $this->input->post('user_email');
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('user_email', $email);
            $this->db->limit(1);
            $x=$this->db->get()->row()->user_id;
            redirect('Userlogin/sendmail/'.$x);

        } else
        {
            redirect('Userlogin/email_error');
        }
    }
    public function newpassword($data,$id)
    {
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
    }
    public function user_account($user_id)              // get user_id
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$user_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function update_address($id_user)            //update user_address
    {

        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id',$id_user);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function password_verify()                   //update password
    {
        $new_pass['user_password']=$this->input->post('password');
        $user_id=$this->input->post('user_id');
        $user_password=$this->input->post('user_password');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$user_id);
        $this->db->where('user_password',$user_password);
        $query=$this->db->get();
        if($query->num_rows()>0)
        {
            $this->db->where('user_id',$user_id);
            $this->db->update('user',$new_pass);
        }
        else{
            redirect('Useraccount/pass_error');
        }
    }
    public function user_data($user_ids)
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$user_ids);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function send_query($data)
    {
       $this->db->insert('contact_us',$data);
    }
    public function replay_admin($user_id)
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $this->db->where('created_by',$user_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function fetch_data($prod_id)            // fetch product data for cart entry
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('product.product_id',$prod_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function soft()
    {
        $this->db->where('category_name','Software');
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('product','product.product_id=product_category.product_id');
        $this->db->join('product_images','product_images.product_id=product.product_id');

        $query=$this->db->get('category');
        return $query->result_array();
    }
    public function display_wishlist($ses_id)
    {

        $this->db->where('user.user_id',$ses_id);
        $this->db->select('*');
        $this->db->from('user_wish_list');
        $this->db->join('product','product.product_id=user_wish_list.product_id');
        $this->db->join('user','user.user_id=user_wish_list.user_id');
        $this->db->join('product_images','product_images.product_id=user_wish_list.product_id');

        $query=$this->db->get()->result_array();

        return $query;
    }
    public function add_wishlist($data)
    {
        $this->db->insert('user_wish_list',$data);
    }
    public function delete_wishlist ($wish_id)
    {
        echo $wish_id;
        $this->db->where('wishlist_id',$wish_id);
        $this->db->delete('user_wish_list');
    }
    public function view_product()
    {
        $prod_id=$this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('product.product_id',$prod_id);
        return $this->db->get()->result_array();
    }
    public function chekout_data($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_address','user_address.user_id=user.user_id');
        $this->db->where('user.user_id',$id);
        return $this->db->get()->result_array();
    }
    public function all_search($search)
    {
        echo 'df'.$search;

        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->like('product.name',$search);
        $this->db->or_like('product.price',$search);

        return $this->db->get()->result_array();
    }

}
?>