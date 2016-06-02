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
    public function insert_fbuser($data,$f_id)
    {
        $this->db->where('fb_token',$f_id);
        $query=$this->db->get('user')->num_rows();

        if($query == 0) {

            $this->db->insert('user', $data);
          $id=$this->db->insert_id();
            return $id;
        }
        else{
            $this->db->select('user_id');
            $this->db->where('fb_token',$f_id);
           return $this->db->get('user')->row()->user_id;
        }
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
    public function google_search_id($g_id)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('google_token',$g_id);
        return $this->db->get()->row()->user_id;
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

    /**
     * display wishilist to cutomer
     * @ses_id=user_id
     * #controller=userwishlist
     * @return = array of product details image,name,price
     */
    public function display_wishlist($ses_id)                //displayt wishlist to customer
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

    /**
     * add product into wishlist
     * @data=user_id,product_id
     * #controller=userwishlist
     * @return = insert @data in database
     */
    public function add_wishlist($data)                     //add product in wishlist
    {
        $this->db->insert('user_wish_list',$data);
    }

    /**
     * delete product from wishlist
     * using wishlist_id
     * @wish_id=wishlist_id
     * #controller=userwishlist
     * @return = delete product from wishlist
     */
    public function delete_wishlist ($wish_id)              //delete product from wishlist
    {
        $this->db->where('wishlist_id',$wish_id);
        $this->db->delete('user_wish_list');
    }

    /**
     * fetch product data to display single product specification
     * using product id
     * @prod_id=product_id
     * #controller=home
     * @return = array of single product details image,name,price,quantity,ect
     */
    public function view_product()                          //view product details
    {
        $prod_id=$this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('product.product_id',$prod_id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch data of specific category
     * using category_id
     * fetch data from prodcut_category,product,category,product_images
     * $x=category_id
     * #controller=category
     * @return specific category data
     */
    public function select_recom($x)                        //display in recommeded section
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('product','product.product_id=product_category.product_id');
        $this->db->join('category','category.category_id=product_category.category_id');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->where('category.category_id',$x);
        return $this->db->get()->result_array();
    }

    /**
     * fetch category_id of appropriate section
     * using product_id
     * @prod_id=product_id
     * #controller=category
     * @return category_id
     */
    public function find_recom()                            //find category id for recommend section
    {
        $prod_id=$this->uri->segment(3);
        $this->db->select('category_id');
        $this->db->from('product_category');
        $this->db->where('product_id',$prod_id);
        return $this->db->get()->row()->category_id;
    }

    /**
    * fetch user data for checkout page
    * from user table
    * using user_id
    * @id=user_id
    * #controller=home
    * @return user naming details
    */
    public function chekout_data($id)                       //fetch user data
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch user address for checkout
     * from user_address table
     * using user_id
     * @id=user_id
     * #controller=home
     * @return- user_address details
     */
    public function checkout_address($id)                     //fetch user address
    {
        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id',$id);
        return $this->db->get()->result_array();
    }

    /**
     * search any product of any category
     * search useing name as well as price
     * @search=keyword enter from front end
     * #controller=home
     * @return= all relevant product data
     */
    public function all_search($search)                         //search any product
    {
        //search product data
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->like('product.name',$search);
        $this->db->or_like('product.price',$search);
        return $this->db->get()->result_array();
    }

    /**
     * verify order_id for track order requirement
     * verify order_id as well as email then show order status
     * @email=user_eamil
     * @id=order_id
     * @return= array,check order_id is valid or not
     * #controller=useraccount
     */
    public function verify_order_id($email,$id)                    //verify order_id and show status
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_order','user_order.user_id=user.user_id');
        $this->db->where('user_email', $email);
        $this->db->where('order_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        //if order_id is correct show the result
        if ($query->num_rows() == 1)
        {
            $q = $query->result();
            return $q;
        }
        //else redirect to track order page with appropriate error msg
        else
        {
            redirect('Useraccount/track_order');
        }
    }

    /**
     * fetch product status from user_order table
     * @id=user_id
     * @return=status of product
     * #controller=useraccount
     */
    public function fetch_status($id)
    {
        //fetch order status
        $this->db->where('order_id',$id);
        return $this->db->get('user_order')->result_array();
    }

    /**
     * for login with gmail user
     * fetch user_id using google token
     * @google_id=google_token
     * #controller=google
     * @return=user_id
     */
    public function google_id($google_id)                               //fetch user_id using google_token
    {
        //fetch user_id using google_token
        $this->db->select('user_id');
        $this->db->where('google_token',$google_id);
        $query=$this->db->get('user')->row()->user_id;
        return $query;
    }

    /**
     * check user already register or no
     * check using user_email(unique)
     * if user register then fetch user_id and return
     * else insert new user then return user id
     * @address_data -address_1,address_2,zipcode
     * @user_email -user email
     * @data - user_name,user_lastname,user_email,user_password
     * @return=user_id
     */
    public function checkout_user($data,$user_email)      //check and insert new user
    {
        //match email_id
        $this->db->where('user_email',$user_email);
        $query=$this->db->get('user')->num_rows();

        //if user not register insert new user data in database
        if($query == 0)
        {
        //$this->db->insert('user_address',$address_data);
            $this->db->insert('user',$data);
            //return insert_id
            return $this->db->insert_id();
        }

        //user already register
        else
        {
            //return user_id
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('user_email',$user_email);
            return $this->db->get()->row()->user_id;
        }
    }
    public function chechkout_user_address($address_data,$user_id)
    {
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('user_address')->num_rows();

        //if user not register insert new user data in database
        if($query == 0)
        {
            $this->db->insert('user_address',$address_data);
        }
        else
        {
            $this->db->where('user_id',$user_id);
            $this->db->update('user_address',$address_data);
        }

    }
}
?>