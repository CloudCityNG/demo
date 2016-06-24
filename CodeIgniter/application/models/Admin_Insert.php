<?php

class Admin_insert extends CI_Model
{


    /**
     * insert new admin_data in database
     * @param $data = admin_name,admin_lastname,admin_id
     *                admin_email,admin_password
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function insert_admin($data)                    //insert admin
    {
        $this->db->insert('e-commers',$data);
    }

    /**
     * update admin personal information
     * @param $id = admin_id use for match data
     * @param $data = admin_name,admin_lastname,admin_id
     *                admin_email,admin_password
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function update_admin($id,$data)
    {
        $this->db->where('admin_id',$id);
        $this->db->update('e-commers',$data);
    }

    /**
     * verify admin admin name adn respective password
     * for login admin
     * @return mixed | admin_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function login()                                //admin login
    {
       // $query['count']=$this->db->count_all("e-commers");
        $username=$this->input->post('admin_name');
        $password=md5($this->input->post('admin_password'));
        $this->db->select('admin_id');
        $this->db->from('e-commers');
        $this->db->where('admin_name',$username);
        $this->db->where ('admin_password',$password);
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

    /**
     * verify data for login and get respective action on that
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function verify()                               //verify e-mail
    {
        $email=$this->input->get('admin_email');
        $this->db->select('*');
        $this->db->from('e-commers');
        $this->db->where('admin_email',$email);
        $this->db->limit(1);
        $verify=$this->db->get();
        //if verificaition is sccussfull send mail to admin
        if($verify->num_rows()==1)
        {
            /*
            $this->db->select('admin_password');
            $this->db->from('e-commers');
            $this->db->where('admin_email',$email);
            $pass=$this->db->get()->row()->admin_password;
            */

            //generate different password
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 6; $i++) {
                $randomString .= $characters[rand(1,$charactersLength-1)];
            }
            //updte new password in respective userid
            $data = array(
                'admin_password' => md5($randomString)
            );
            $this->db->where('admin_email',$email);
            $this->db->update('e-commers',$data);

            //send mail to user with new regenrated password
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.wwindia.com',
                'smtp_port' => 25,
                'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
                'smtp_pass' => 'nb=np2^89mKn', // change it to yours
                'mailtype' => 'html',
                //'charset' => 'iso-8859-1',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );

            $message = 'Your Password ='.$randomString;
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('sumit.desai@wwindia.com'); // change it to yours
            $this->email->to('sumit.desai@wwindia.com');// change it to yours
            $this->email->subject('Your Password');
            $this->email->message($message);

            if($this->email->send())
            {
                $data['newemail']="Please Check E-mail";
                $this->load->view('login',$data);
            }
            else
            {
                show_error($this->email->print_debugger());
            }
        }
        //else display error msg
        else
        {
            redirect('admin/login/email_error');
        }
    }

    /**
     * display list of user admin
     * @return mixed |array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function list_user()                         //admin_list
    {
        $query = $this->db->get('e-commers');
        $query_result = $query->result_array();
        return $query_result;
    }

    /**
     * display list of total product with product images
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function list_product()                      //prduct list
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $query = $this->db->get();
        $query_result = $query->result_array();
        return $query_result;
    }

    /**
     * delete adminuser from database
     * get admin_id by url
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_delete()                       //delete admin
    {
        $getid=$this->uri->segment(4);
        $this->db->where('admin_id',$getid);
        $this->db->delete('e-commers');
    }

    /**
     * go to the edit page with perticular user information
     * @return mixed | array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_edit()                         //edit admin
    {
        $getid=$this->uri->segment(4);
        $this->db->select('*');
        $this->db->where('admin_id',$getid);
        $query=$this->db->get('e-commers');
        $query_result=$query->result();
        return $query_result;
    }

    /**
     * sort user list
     * @param $var = order by recommented column
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function sort_data($var)                            //sort admin
    {
        $this->db->from('e-commers');
        $this->db->order_by($var,"decs");
        $query=$this->db->get();
        $q=$query->result_array();
        return $q;
    }

    /**
     * fetch data of user fro validation
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function fetch()
    {
        $data['admin_name']=$this->input->post('admin_name');
        $data['admin_lastname']=$this->input->post('admin_name');
        $data['admin_password']=$this->input->post('admin_name');
        $data['admin_compass']=$this->input->post('admin_compass');
        $data['admin_email']=$this->input->post('admin_name');
        return $data;
    }

    /**
     * fetch data of user fro validation
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function add_fetch()
    {
        $data['admin_name']=$this->input->post('admin_name');
        $data['admin_lastname']=$this->input->post('admin_name');
        $data['admin_password']=$this->input->post('admin_name');
        $data['admin_compass']=$this->input->post('admin_compass');
        $data['admin_email']=$this->input->post('admin_name');
        return $data;
    }

    /**
     * count total admin user in table
     * @return mixed|numbers of row
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function record_count()                      //count admin
    {
        return $this->db->count_all("e-commers");
    }

    /**
     * @param $limit = limit of pagination
     * @param $page = selecterd page
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function fetch_data($limit, $page)           //pagination admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'admin_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var, $order);
        $query = $this->db->get("e-commers");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //PRODUCT
    /**
     * count total product in database
     * @return mixed|numbers of tatol product
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_count()                            //count product
    {
        return $this->db->count_all("product");
    }

    /**
     * count total product in database from both tables image and products
     * @return mixed|numbers of tatol product
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function record_count_product()                     //product_count
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product.product_id=product_images.product_id');
        $this->db->group_by('product_images.product_id');
        return $this->db->get()->num_rows();
    }

    /**
     * @param $limit = limit of data perpage
     * @param $page = selected page
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function fetch_product_data($limit, $page)           //pagignation product
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product.product_id=product_images.product_id');
        $this->db->group_by('product_images.product_id');
        $this->db->order_by('product.'.$var, $order);
        $query = $this->db->get()->result_array();
        //if count is more than zero
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

    /**
     * insert product data in database
     * @param $data = name,meta_description,keywords,title,images,ect;
     * @return mixed|product_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_insert($data)                    //insert product
    {
        $this->db->insert('product',$data);
        $prod_id= $this->db->insert_id();
        return $prod_id;
    }

    /**
     * insert img in database
     * @param $uploed=image_name
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function upload_img($uploed)                      //insert img
    {
        $this->db->insert('product_images',$uploed);
    }
    //CATEGORY
    /**
     * seelect category name and return category id to user
     * @param $category_name = selectd category name
     * @return mixed|category_id
     */
    public function select_category($category_name)          //select category
    {
        $this->db->insert('category',$category_name);
        $cat_id=$this->db->insert_id();
        return $cat_id;
    }

    /**
     * @param $pro_cat =category id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_category($pro_cat)              //insert category
    {
        $this->db->insert('product_category',$pro_cat);
    }

    /**
     * update product_id in database
     * @param $prod_id = product_id
     * @param $data =  name,meta_description,keywords,title,images,ect;
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function update_product_category($prod_id,$data)
    {
        $this->db->where('category_id',$prod_id);
        $this->db->update('category',$data);
    }

    /**
     * count numbers of category in database
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function category_list()
    {
        return $this->db->count_all('category');
    }

    /**
     * @param $limit = limit of perpage data
     * @param $page = selected paeg
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function fetch_data_from_category($limit,$page)
    {

        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'category_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var, $order);
            $query = $this->db->get("category");
        //if data is avalaibale
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
                return $data;
        }
        else return false;
    }

    /**
     * search category id
     * @param $category_name search id using category name
     * @return mixed|category_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function cat($category_name)
    {
        $this->db->select('category_id');
        $this->db->from('category');
        $this->db->where('category_name',$category_name);
        return $this->db->get()->row()->category_id;
    }

    /**
     * select category related data matching category id
     * @param $id=category_id
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function category_edit($id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id',$id);
        return $this->db->get()->result_array();
    }

    /**
     * get catagory table details
     * @return mixed|array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function categoryall()
    {
        $query=$this->db->get('category')->result_array();
        return $query;
    }

    /**
     * @param $category_search(string) search keywaord
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function category_search($category_search)
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'category_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('category_name',$category_search);
        $this->db->or_like('parent_id',$category_search);
        $this->db->order_by($var, $order);
        $query = $this->db->get('category');
        $x=$query->result_array();
        return $x;
    }

    /**
     * insert data in category table
     * @param $data = category_id(int)
     *                parent_id(int),category_name(string)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function category_insert($data)
    {
        $this->db->insert('category',$data);
    }

    /**
     * update incategory table
     * @param $data = category_id(int)
     *                parent_id(int),category_name(string)
     * @param $cate_id(int) category id for match id in database
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function category_update($data,$cate_id)
    {
        $this->db->where('category_id',$cate_id);
        $this->db->update('category',$data);
    }

    /**
     * delete product from product table
     * base on selected product_id
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_delete()                         //delete product
    {
        $getid=$this->uri->segment(4);
        $this->db->where('product_id',$getid);
        $this->db->delete('product');
    }

    /**
     * go to product edit page
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
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

    /**
     * @param $id - product id fro match selectd id percent in data bse or not
     * @param $data = product_id(int),product_name(string)
     *                title(string),metadata(string),keywords(string)
     *                quantity(int),price(float)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    function update($id,$data)                             //update product
    {
        $this->db->where('product_id',$id);
        $this->db->update('product',$data);
    }

    /**
     * search data in table
     * @param $admin_serach(string) = searach admin in admin list using relative data in all columns
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function search($admin_serach)                 //serach admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'admin_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('admin_name',$admin_serach);
        $this->db->or_like('admin_email',$admin_serach);
        $this->db->or_like('admin_lastname',$admin_serach);
        $this->db->order_by($var,$order);
        $query = $this->db->get('e-commers');
        $x=$query->result_array();
        return $x;
    }

    /**
     * search data in table
     * @param $admin_serach(string) = searach admin in product list using relative data in all columns
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_search($product_serach)        //search product
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->like('name',$product_serach);
        $this->db->or_like('price',$product_serach);
        $this->db->or_like('quntity',$product_serach);
        $this->db->order_by($var,$order);
        $this->db->group_by('name');
        $query = $this->db->get();
        $x=$query->result_array();
        return $x;
    }

    /**
     * select images from product iamge table
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function select_img()                         //search img
    {
        $query=$this->db->get('product_images');
        $x=$query->result_array();
        return $x;
    }

    /**
     * count all product precent in database
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function record_home_count()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->group_by('product_images.product_id');
        return $this->db->get()->num_rows();
    }

    /**
     * display product data on home page
     * @param $limit limit of data precent in perpage
     * @param $page selected page
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function home($limit,$page)
    {
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('quntity !=','0');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->group_by('product_images.product_id');
        $this->db->order_by('product.product_id', "decs");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        else return false;
    }

    /**
     * show recommened items on recommred section on home page
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function recommend()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('product_images','product_images.product_id=product.product_id');
        $this->db->group_by('product_images.product_id');
        $this->db->limit(3);
        $this->db->order_by('product.product_id', "decs");
        return $this->db->get()->result_array();
    }

    /**
     * display product details
     * @param $id - product_id
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
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

    /**
     * fetch product category data
     * @param $id(int) product category id
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function product_details_cat($id)            //product category
    {
        //$id = $this->input->get('id', TRUE);
        $this->db->where('category_id',$id);
        $query=$this->db->get('category');
        $x=$query->result_array();
        return $x;
    }

    /**
     * show banner details to user
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function view_banner()                       //banner
    {
        $query=$this->db->get('product_images');
        return $query->result_array();
    }

    /**
     * update product image
     * @param $prod_id - product_id
     * @param $data image(img)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function from_image_update($prod_id,$data)                  //uppdate img
    {
        $this->db->where('product_id',$prod_id);
        $this->db->update('product_images',$data);
    }

    /**
     * show product image to admin
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function show_image()                         //show img
    {
        $query=$this->db->get('product_images');
        return $query->result_array();
    }

    /**
     * show all user query to admin on admin panel
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_query($limit,$page)                        //user query
    {

        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'user_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var, $order);
        $query = $this->db->get("contact_us");
        //if data is avalaibale
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        else return false;

    }


                        //banner

//    public function record_count_banner()                      //count images
//    {
//        return $this->db->count_all("product_images");
//    }
//      public function fetch_banner_data($limit, $page)           //pagignation images
//    {
//
//        $offset = ($page - 1) * $limit;
//        $this->db->limit($limit, $offset);
//        $query = $this->db->get("product_images");
//        if ($query->num_rows() > 0)
//        {
//            foreach ($query->result() as $row)
//            {
//                $data[] = $row;
//            }
//
//            return $data;
//        }
//        return false;
//    }
//    public function img_edit()                          //edit img
//    {
//        $img_id=$this->input->get('img_id');
//        $this->db->where('img_id',$img_id);
//        $query=$this->db->get('product_images');
//        $query_result=$query->result();
//        return $query_result;
//    }
//    public function image_update($data)                  //uppdate img
//    {
//        $getid=$this->input->get('img_id');
//        $this->db->where('img_id',$getid);
//        $this->db->update('product_images',$data);
//
//    }
//    public function img_delete()                         //delete img
//    {
//        $getid=$this->input->get('img_id');
//        $this->db->where('img_id',$getid);
//        $this->db->delete('product_images');
//    }
//    public function search_image($image_search)
//    {
//        $this->db->like('image_name',$image_search);
//        $query = $this->db->get('product_images');
//        $x=$query->result_array();
//        return $x;
//    }
//
//    public function img_detalis()                      //img details
//    {
//        $img_id=$this->input->get('img_id');
//        $this->db->where('img_id',$img_id);
//        $query=$this->db->get('product_images');
//        $query_result=$query->result();
//        return $query_result;
//    }

    /**
     * count numbers of query from send by user in database
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function record_count_reply()
    {
        return $this->db->count_all('contact_us');
    }
    /**
     * fetch query of user data to display on admin panel
     * @param $user_id(int) admin-id
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function view_query($user_id)                //view query
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $this->db->where('contact_id',$user_id);
        $query=$this->db->get();
        return $query->result_array();
    }

    /**
     * give repaly to user query
     * all data save in database
     * and show on user accounts
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function replay_admin()                      //replay on query
    {
        $replay['admin_replay']=$this->input->post('replay');
        $con=$this->input->post('con_id');
        $this->db->where('contact_id',$con);
        $this->db->update('contact_us',$replay);
    }

    /**
     * delete replay data from databse
     * @param $con delete replay data from database
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function delete_signle($con)
    {
        $this->db->where('contact_id',$con);
        $this->db->delete('contact_us');
    }
    public function change_perpage($number,$ses_id)
    {
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
    public function change_home_perpage($number,$ses_id)
    {
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
    public function fetch_home_perpage($id)
    {

        $this->db->select('perpage_home');
        $this->db->from('configration');
        $this->db->where('created_by',$id);

        $query=@$this->db->get()->row()->perpage_home;


        if(!empty($query))
        {
            return $query;
        }
        else{
            $per=12;
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

   /* public function upadate_email($data,$id)
    {

        $this->db->where('admin_name',$id);
        $this->db->update('e-commers',$data);
    }*/
    public function set_mail($data)
    {
        $this->db->where('e_id','1');
        $this->db->update('admin_email',$data);
    }
    public function fetch_email()
    {
        $this->db->select('setting_email');
        $this->db->where('e_id','1');
        return $this->db->get('admin_email')->row()->setting_email;
    }

    public function record_count_user()                      //count images
    {
        return $this->db->count_all("user");
    }
    public function fetch_user_data($limit, $page)           //pagignation user
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'user_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var,$order);
        $query = $this->db->get("user");
        //if data is avalible in databse
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

    /**
     * delete user from user list
     * using select id
     */
    public function userlist_delete()                         //delete userlist data
    {
        $getid=$this->uri->segment(4);
        $this->db->where('user_id',$getid);
        $this->db->delete('user');
    }

    /**
     * fetch user personal data from table
     * @return mixed
     */
    public function userlist_data()                         //delete userlist data
    {
        $getid=$this->uri->segment(4);
        $this->db->where('user_id',$getid);
        return $this->db->get('user')->result_array();
    }

    /**
     * fetch user address data from table
     * @return mixed
     */
    public function useraddress_data()
    {
        $getid=$this->uri->segment(4);
        $this->db->where('user_id',$getid);
        return $this->db->get('user_address')->result_array();
    }


    /**
     * search userd query in query list
     * @param $user_search(string) keyword which enter from front end
     * @return mixed
     */
    public function user_search($user_search)
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'user_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('user_name',$user_search);
        $this->db->or_like('user_email',$user_search);
        $this->db->or_like('user_lastname',$user_search);
        $this->db->order_by($var,$order);
        $query = $this->db->get('user');
        $x=$query->result_array();
        return $x;
    }

    /**
     * user compliant count from databse
     * @return mixed
     */
    public function compliant_count()
    {
        return $this->db->count_all("contact_us");
    }

    /**
     * search userd query in query list
     * @param $search keyword which enter from front end
     * @return mixed
     */
    public function query_search($search)
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'user_name';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('user_name',$search);
        $this->db->or_like('user_email',$search);
        $this->db->or_like('message',$search);
        $this->db->order_by($var,$order);
        $query = $this->db->get('contact_us');
        $x=$query->result_array();
        return $x;
    }
    public function admin_email_check($email)
    {
        $this->db->where('admin_email',$email);
        $query=$this->db->get('e-commers')->num_rows();
        if($query > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function admin_email_verify($email,$id)
    {
        $this->db->where('admin_email',$email);
        //$this->db->where('user_id',$id);
        $query=$this->db->get('e-commers')->num_rows();
        if($query > 0 )
        {
            $this->db->where('admin_email',$email);
            $this->db->where('admin_id',$id);
            $query=$this->db->get('e-commers')->num_rows();
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