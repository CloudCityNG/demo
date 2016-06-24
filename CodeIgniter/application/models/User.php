<?php

class User extends CI_Model
{

    /**
     * display major category list
     * each major category have parent id = 0
     * @return array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function home_category()
    {
        $p_id = 0;
        $this->db->select('*');
        $this->db->where('parent_id', $p_id);
        return $this->db->get('category')->result_array();
    }
    public function fetch_category_id($c_name)
    {
        $this->db->select('category_id');
        $this->db->where('category_name',$c_name);
        return $this->db->get('category')->row()->category_id;
    }

    /**
     * fetch total numbers of rows of selected category data
     * @param $category (string) = category_id this category related product rows counted
     * @return mixed | number
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function record_cat_count($category)
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('category', 'category.category_id=product_category.category_id');
        $this->db->join('product', 'product.product_id=product_category.product_id');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->where('category.category_id', $category);
        $x = $this->db->get()->num_rows();
        return $x;
    }

    /**
     * display only selected category data
     * @param $category (string) = category_id only this category related product display
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function data($limit,$page,$category)
    {
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('category', 'category.category_id=product_category.category_id');
        $this->db->join('product', 'product.product_id=product_category.product_id');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->where('product_category.category_id', $category);
        $this->db->order_by('product.product_id', "decs");
        $query = $this->db->get();
        //if data is persent in array
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else return false;
    }

    /**
     * select related sub category of this categpry id
     * @param $category (string) category_id select related sub category of this category id
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function select_cat($category)
    {
        $this->db->select('*');
        $this->db->where('parent_id', $category);
        return $this->db->get('category')->result_array();
    }

    /**
     * insert new user data in user table
     * @param $data (array) =user_id(int)
     *               user_name(string)
     *               user_lastname(string)
     *               user_email(string)
     *               user_password(string)
     *               gender(Enum)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function insert_user($data)              //insert user data
    {
        $this->db->insert('user', $data);
    }

    /**
     * new user register with facebook user
     * @param $data (array) = user_id(int)
     *                user_name(string)
     *                user_email(string)
     *                gender(Enum)
     * @param $f_id (string) = fb_token
     * @return mixed | last inserted user id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function insert_fbuser($data, $f_id)
    {
        $this->db->where('fb_token', $f_id);
        $query = $this->db->get('user')->num_rows();
        //if new user then insert data and return user_id
        if ($query == 0) {
            $this->db->insert('user', $data);
            $id = $this->db->insert_id();
            return $id;
        } //if user already iunserted then fetch user  id
        else {
            $this->db->select('user_id');
            $this->db->where('fb_token', $f_id);
            return $this->db->get('user')->row()->user_id;
        }
    }

    /**
     * update user data in database
     * @param $data (array) = user_name(string)
     *                user_lastname(string)
     *                user_email(string)
     *                user_password(string)
     *                gender(ENUM)
     * @param $id (int) = user_id update data of this id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function update_user($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
    }

    /**
     * insert user address
     * @param $data (array) = address_1(string) manditory filed
     *                address_2(string) not complasary
     *                city(string)
     *                country(string)
     *                state(string)
     *                zipcode(int)
     * @param $user_id (int) = user_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function address_user($data, $user_id)     //insert/update user address
    {
        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        //for updata data
        if ($query->num_rows() > 0) {
            $this->db->update('user_address', $data);
        } //for insert new data
        else {
            $this->db->insert('user_address', $data);
        }
    }

    /**
     * verify user data when user come fro login
     * verify using email and password
     * @return mixed | array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_login()                     //verify and login user
    {
        $email = $this->input->post('login_email');
        $password = $this->input->post('login_password');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        //if data is match
        if ($query->num_rows() == 1) {
            $q = $query->result();
            return $q;
        } //else redirect to login page
        else {
            redirect('Userlogin/error');
        }
    }

    /**
     * find user id which is already login
     * @param $g_id (int) = google token use for find user_id
     * @return mixed | number
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function google_search_id($g_id)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('google_token', $g_id);
        return $this->db->get()->row()->user_id;
    }

    /**
     * if user forget user password
     * find password with the help of user email
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_forget()                       //email verification
    {
        $email = $this->input->post('user_email');
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        //if email id is match with data
        if ($query->num_rows() == 1) {
            $email = $this->input->post('user_email');
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('user_email', $email);
            $this->db->limit(1);
            $x = $this->db->get()->row()->user_id;
            redirect('Userlogin/sendmail/' . $x);

        }//elseredirect to login page
        else {
            redirect('Userlogin/email_error');
        }
    }

    /**
     * auto creatd new password update in datebase
     * @param $data (array) = auto created new password
     * @param $id (int) =  user_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function newpassword($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
    }

    /**
     * fetch user account details with comparing user id
     * @param $user_id (int) = user_id fetch data of particular user id
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_account($user_id)              // get user_id
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * update user address
     * @param $id_user (int)-user id fetch data of particular user
     * @return mixed |array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function update_address($id_user)            //update user_address
    {
        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id', $id_user);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * password verification
     * if user want to change password then he/she can change password
     * match old password and then chaneg new password
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function password_verify()                   //update password
    {
        $new_pass['user_password'] = $this->input->post('password');
        $user_id = $this->input->post('user_id');
        $user_password = $this->input->post('user_password');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $this->db->where('user_password', $user_password);
        $query = $this->db->get();
        //if old password match
        if ($query->num_rows() > 0) {
            $this->db->where('user_id', $user_id);
            $this->db->update('user', $new_pass);
        } //else dispaly error msg
        else {
            redirect('Useraccount/pass_error');
        }
    }

    /**
     * fetch user data
     * @param $user_ids = user_id
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_data($user_ids)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_ids);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * @param $data (array) = user query data
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function send_query($data)
    {
        $this->db->insert('contact_us', $data);
    }

    public function replay_admin($user_id)
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $this->db->where('created_by', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function fetch_data($prod_id)            // fetch product data for cart entry
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->where('product.product_id', $prod_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function soft()
    {
        $this->db->where('category_name', 'Software');
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('product', 'product.product_id=product_category.product_id');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $query = $this->db->get('category');
        return $query->result_array();
    }

    /**
     * display wishilist to cutomer
     * @param $ses_id = user_id fetch data of particular user
     * #controller=userwishlist
     * @return mixed array of product details image,name,price
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function display_wishlist($ses_id)                //displayt wishlist to customer
    {
        $this->db->where('user.user_id', $ses_id);
        $this->db->select('*');
        $this->db->from('user_wish_list');
        $this->db->join('product', 'product.product_id=user_wish_list.product_id');
        $this->db->join('user', 'user.user_id=user_wish_list.user_id');
        $this->db->join('product_images', 'product_images.product_id=user_wish_list.product_id');
        $query = $this->db->get()->result_array();
        return $query;
    }

    /**
     * add product into wishlist
     * @parm data=user_id,product_id
     * #controller=userwishlist
     * @return = insert @data in database
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function add_wishlist($data)                     //add product in wishlist
    {
        $this->db->insert('user_wish_list', $data);
    }

    /**
     * delete product from wishlist
     * using wishlist_id
     * @param $wish_id =wishlist_id
     * #controller=userwishlist
     * delete product from wishlist
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function delete_wishlist($wish_id)              //delete product from wishlist
    {
        $this->db->where('wishlist_id', $wish_id);
        $this->db->delete('user_wish_list');
    }

    /**
     * fetch product data to display single product specification
     * using product id
     * @param $prod_id =product_id
     * #controller=home
     * @return mixed array of single product details image,name,price,quantity,ect
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function view_product()                          //view product details
    {
        $prod_id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->where('product.product_id', $prod_id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch data of specific category
     * using category_id
     * fetch data from prodcut_category,product,category,product_images
     * @param $x =category_id
     * #controller=category
     * @return specific category data
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function select_recom($x)                        //display in recommeded section
    {
        $this->db->select('*');
        $this->db->from('product_category');
        $this->db->join('product', 'product.product_id=product_category.product_id');
        $this->db->join('category', 'category.category_id=product_category.category_id');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->where('category.category_id', $x);
        return $this->db->get()->result_array();
    }

    /**
     * fetch category_id of appropriate section
     * using product_id
     * @param $prod_id =product_id
     * #controller=category
     * @return category_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function find_recom()                            //find category id for recommend section
    {
        $prod_id = $this->uri->segment(3);
        $this->db->select('category_id');
        $this->db->from('product_category');
        $this->db->where('product_id', $prod_id);
        return $this->db->get()->row()->category_id;
    }

    /**
     * fetch user data for checkout page
     *  from user table
     * using user_id
     * @param $id =user_id
     * #controller=home
     * @return mixed user naming details
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function chekout_data($id)                       //fetch user data
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch user address for checkout
     * from user_address table
     * using user_id
     * @param $id =user_id
     * #controller=home
     * @return array user_address details
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function checkout_address($id)                     //fetch user address
    {
        $this->db->select('*');
        $this->db->from('user_address');
        $this->db->where('user_id', $id);
        return $this->db->get()->result_array();
    }

    /**
     * search any product of any category
     * search useing name as well as price
     * @param $search =keyword enter from front end
     * #controller=home
     * @return array all relevant product data
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function all_search($search)                         //search any product
    {
        //search product data
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images', 'product_images.product_id=product.product_id');
        $this->db->like('product.name', $search);
        $this->db->or_like('product.price', $search);
        return $this->db->get()->result_array();
    }

    /**
     * verify order_id for track order requirement
     * verify order_id as well as email then show order status
     * @param $email =user_eamil
     * @id=order_id
     * @return= array,check order_id is valid or not
     * #controller=useraccount
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function verify_order_id($email, $id)                    //verify order_id and show status
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_order', 'user_order.user_id=user.user_id');
        $this->db->where('user_email', $email);
        $this->db->where('order_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        //if order_id is correct show the result
        if ($query->num_rows() == 1) {
            $q = 1;
            return $q;
        } //else redirect to track order page with appropriate error msg
        else {
            $q = 0;
            return $q;
        }
    }

    /**
     * fetch product status from user_order table
     * @param $id =user_id
     * @return=status of product
     * #controller=useraccount.
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function fetch_status($id)
    {
        //fetch order status
        $this->db->where('order_id', $id);
        return $this->db->get('user_order')->result_array();
    }

    /**
     * for login with gmail user
     * fetch user_id using google token
     * @param $google_id (int)=google_token
     * #controller=google
     * @return=user_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function google_id($google_id)                               //fetch user_id using google_token
    {
        //fetch user_id using google_token
        $this->db->select('user_id');
        $this->db->where('google_token', $google_id);
        $query = $this->db->get('user')->row()->user_id;
        return $query;
    }

    /**
     * check user already register or no
     * check using user_email(unique)
     * if user register then fetch user_id and return
     * else insert new user then return user id
     * @param $address_data (array) -address_1,address_2,zipcode
     * @param $user_email (string) -user email
     * @param $data (array)- user_name,user_lastname,user_email,user_password
     * @return mixed user_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function checkout_user($data, $user_email)      //check and insert new user
    {
        //match email_id
        $this->db->where('user_email', $user_email);
        $query = $this->db->get('user')->num_rows();

        //if user not register insert new user data in database
        if ($query == 0) {
            //$this->db->insert('user_address',$address_data);
            $this->db->insert('user', $data);
            //return insert_id
            return $this->db->insert_id();
        } //user already register
        else {
            //return user_id
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('user_email', $user_email);
            return $this->db->get()->row()->user_id;
        }
    }

    public function checkout_user_guest($data,$user_email)
    {
        $this->db->where('user_email', $user_email);
        $query = $this->db->get('user')->num_rows();

        //if user not register insert new user data in database
        if ($query == 0) {
            //$this->db->insert('user_address',$address_data);
            $this->db->insert('user', $data);
            //return insert_id
            return $this->db->insert_id();
        } //user already register
        else {
            //return user_id
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('user_email', $user_email);
            return $this->db->get()->row()->user_id;
        }
    }

    /**
     * user not register insert new user data in database
     * else update user data
     * @param $address_data (array) user address data
     * @param $user_id (int)user_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function chechkout_user_address($address_data, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_address')->num_rows();
        //if user not register insert new user data in database
        if ($query == 0) {
            $this->db->insert('user_address', $address_data);
            return $this->db->insert_id();
        } else {
            $this->db->where('user_id', $user_id);
            $this->db->update('user_address', $address_data);

            $this->db->select('address_id');
            $this->db->where('user_id', $user_id);
            $this->db->from('user_address');
           return $this->db->get()->row()->address_id;
        }
    }

    /**
     * calculated quantity
     * @param $p_id (int) product qunatity
     * @param $quant (flaot) quantity which user purchase
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function check_qty($p_id, $quant)
    {
        $this->db->select('quntity');
        $this->db->from('product');
        $this->db->where('product_id', $p_id);
        $total_qty = $this->db->get()->row()->quntity;
        $reming = $total_qty - $quant;
        return $reming;
    }

    /**
     * insert user data inside table
     * @param $data = user_name
     * @param $token = twitter token
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function twitter($data, $token)
    {
        $this->db->where('twitter_token', $token);
        $query = $this->db->get('user')->num_rows();
        if ($query == 0) {
            $this->db->insert('user', $data);
            return $this->db->insert_id();
        } else {
            $this->db->select('user_id');
            $this->db->from('user');
            $this->db->where('twitter_token', $token);
            return $this->db->get()->row()->user_id;
        }
    }

    public function fetch_orderid($id)
    {
        $this->db->select('order_id');
        $this->db->where('user_id', $id);
        $query = $this->db->get('user_order')->result_array();
        return $query;
    }
    public function fetch_orderdata($o_id)
    {
        $this->db->select('*');
        $this->db->from('order_details');
        $this->db->join('product','product.product_id=order_details.product_id');
        $this->db->join('user_order','user_order.order_id=order_details.order_id');
        $this->db->where('order_details.order_id',$o_id);
        return $this->db->get()->result_array();
    }
    public function social_user_personaldata($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }
    public function social_user_addressdata($address,$id)
    {
        $this->db->where('user_id',$id);
        $this->db->insert('user_address',$address);
    }
    public function add_newaddress($data)
    {
        $this->db->insert('user_address',$data);
    }
    public function fetch_address($u_id)
    {
        $this->db->where('user_id',$u_id);
        return $this->db->get('user_address')->result_array();
    }
    public function fetch_address_data($add_id)
    {
        $this->db->where('address_id',$add_id);
        return $this->db->get('user_address')->result_array();
    }
    public function update_address_with_id($data,$address_id)
    {
        $this->db->where('address_id',$address_id);
        $this->db->update('user_address',$data);
    }
    public function delete_address($a_id)
    {
        $this->db->where('address_id', $a_id);
        $this->db->delete('user_address');
    }
    public function insert_shipping_address($data)
    {
        $this->db->insert('user_address',$data);
        return $this->db->insert_id();
    }
    public function chechkout_guestuser_address($data)
    {
        $this->db->insert('user_address',$data);
        return $this->db->insert_id();
    }
    public function fetch_name($id)
    {
        $this->db->select('user_name');
        $this->db->from('user');
        $this->db->where('user_id',$id);
        return $this->db->get()->row()->user_name;
    }
    function get_data()
    {
        $this->db->select();
        $query = $this->db->get('products')->num_rows();

        if ($query > 0)
        {
            return $this->db->get('products')->result();
        }
        else {
            return FALSE;
        }
    }
    public function email_check($email)
    {
        $this->db->where('user_email',$email);
        $query=$this->db->get('user')->num_rows();
        if($query > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function email_verify($email,$id)
    {
        $this->db->where('user_email',$email);
        //$this->db->where('user_id',$id);
        $query=$this->db->get('user')->num_rows();
        if($query > 0 )
        {
            $this->db->where('user_email',$email);
            $this->db->where('user_id',$id);
            $query=$this->db->get('user')->num_rows();
            if($query == 1)
            {
                return 1;
            }
            else{
                return 0;
            }
        }
        else
        {
            return 1;
        }
    }
}
?>