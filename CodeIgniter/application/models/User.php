<?php

class User extends CI_Model
{
    public function insert_user($data)              //inser user data
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
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1)
        {
            redirect('Userlogin/sendmail');

        } else
        {
            redirect('Userlogin/email_error');
        }
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
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('product','product.product_id=product_category.product_id');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('category_name','Software');
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



}
?>