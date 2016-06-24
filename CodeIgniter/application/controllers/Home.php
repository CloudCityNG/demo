<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->model('cmsadmin');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');

    }

    /**
     * home page of front end
     * with pagination
     * @product data = image,name.price
     * @cms = cms_images,cms_content,cms_title,cms_discribtion
     * @category = category list
     * @banner = banner images
     * @recommend = recently add product
     * #model = user,bannermgmt,category,cmsadmin,
     * @return @data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()                                       //home page
    {
        $config = array();
        $config["base_url"] = base_url()."/home/index";          //set url for pagination
        $total_row = $this->Admin_Insert->record_home_count();   //total product records
        $config["total_rows"] = $total_row;
        $config["per_page"] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        if($this->uri->segment(3))
        {
            $page = ($this->uri->segment(3));
        }
        else
        {
            $page = 1;
        }
        $data['product'] = $this->Admin_Insert->home($config["per_page"], $page);
        $data['cms']=$this->cmsadmin->home_cms();                   //fetch images and content of cms
        $data['category']=$this->User->home_category();             //fetch list of category
        $data['banner']=$this->Bannermgmt->home_banner();           //fetch images of banner
        $data['categorys']="";                                      //empty block for sub category space
        $data['recommend']=$this->Admin_Insert->recommend();        //fetch recently add products

        $str_links = $this->pagination->create_links();             //generate link for pagination
        $data["links"] = explode('&nbsp;',$str_links );

        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * after select category show specific product of that category
     * and shoe also sub category of selected category
     * get selected category id using url
     * @product data = image,name.price
     * @cms = cms_images,cms_content,cms_title,cms_discribtion
     * @category = category list
     * @banner = banner images
     * @recommend = recently add product
     * #model = user,bannermgmt,category,cmsadmin,
     * @return @data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function category()
    {
        $category=$this->uri->segment(3);

        $config = array();
        $config["base_url"] = base_url()."/home/index";
        $total_row = $this->User->record_cat_count($category);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $this->pagination->initialize($config);
        if($this->uri->segment(4))
        {
            $page = ($this->uri->segment(4));
        }
        else
        {
            $page = 1;
        }
        $data['product'] = $this->User->data($config["per_page"], $page,$category);
        $data['categorys']=$this->User->home_category();              //fetch images and content of cms
        $data['cms']=$this->cmsadmin->home_cms();                     //fetch list of category
        $data['banner']=$this->Bannermgmt->home_banner();             //fetch images of banner
        $data['category']=$this->User->select_cat($category);         //sub category block for show sub-category
        $data['slider']="";
        $str_links = $this->pagination->create_links();               //generate link for pagination
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * add product to cart using cart function of codeigniter
     * @prod_id=product_id
     * @product= image_name,name,price
     * #model =  user
     * @return = add data into codeigniter card
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function add_to_cart()                             //add data into cart function
    {
        $i="";
        $prod_id = $this->uri->segment(3);                    //fetch product_id
        $product = $this->User->fetch_data($prod_id);        //fetch all details of particular product_id
        //explore product array
        foreach($product as $value)
        {
            $value = (array)$value;
            $iname = $value['image_name'];
            $name = $value['name'];
            $price = $value['price'];
            $data = array(
                'id' => $prod_id,
                'qty' => 1,
                'price' => $price,
                'name' => $name,
                'image_name' => $iname
            );
            $this->cart->insert($data);
        }

        $this->session->set_flashdata('msg','Product Add In Cart');
//        $this->load->view('user/headeruser',$data);
        redirect(base_url());
    }

    /**
     * call user cart
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function user_cart()
    {
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }

    public function qunty_check()
    {
        $size=$this->input->post('qty');
        $id=$this->input->post('p_id');

        $data=$this->User->check_qty($id,$size);

        if($data <= 0)
        {
            foreach ($this->cart->contents() as $item)
            {
                if($id == $item['id'])
                {
                      echo $item['qty'];
                    break;
                }
            }
        }
        else
        {
            echo $size;
        }
    }

    /**
     * update quantity of cart data from front end
     * @return = update quantity in cart product
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function update_cart()
    {
        $i = 1;
        //explore cart for updation

        foreach ($this->cart->contents() as $item)
        {

            $this->cart->update(array('rowid'=>$item['rowid'],'qty'=>$_POST[ 'qty'.$i ])); //update quantity of cart
            $i++;
        }
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }

    /**
     * delete product from cart
     * fetch product_id using url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function delete_cart()
    {
        //fetch product_id from url
        $rowid=$this->uri->segment(3);
        //if quantity is zero product deleted from cart
        $this->cart->update(array('rowid' => $rowid,'qty' => 0));
        redirect('home/user_cart');
    }

    /**
     * display single product with details
     * @product data = image,name.price
     * @cms = cms_images,cms_content,cms_title,cms_discription
     * @category = category list
     * @banner = banner images
     * @recommend = recently add product
     * #model = user,bannermgmt,category,cmsadmin,
     * @return @data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function product_view()                  //product details
    {
        $data['category']=$this->User->home_category();             //fetch list of category
        $data['banner']=$this->Bannermgmt->home_banner();           //fetch images of banner
        $data['product']=$this->User->view_product();               //fetch image,name,price,description,ect of product
        $x=$this->User->find_recom();
        $data['recommend']=$this->User->select_recom($x);           //fetch data of reommernd items
        $this->load->view('user/headeruser');
        $this->load->view('user/product_details',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * check user is register or not
     * if register registration form is already fill
     * else its complsary to user fill that form and register first
     * @total = total all cart products
     * @id = user_id
     * @userdata = user_name,user_lastname,user_email,user_password
     * @address = address_1,address_2,zipcode
     * #model = user
     * @return fill form or empty form
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function checkout()                                      //checkout with cart data
    {
        //fetch user_id
        $id=$this->session->userdata('user_session');
        //cart product total
        $data['total']=$this->input->post('total');
        //if user is not register
        if(empty($id))
        {

            $this->load->view('user/headeruser');
            $this->load->view('user/checkout',$data);
            $this->load->view('user/footer_user');
        }
        //else user already register with our website
        else
        {
            $data['address_all']=$this->User->fetch_address($id);
            $data['userdata']=$this->User->chekout_data($id);           //user personal data
            $data['address']=$this->User->checkout_address($id);        //user address data
            $this->load->view('user/headeruser');
            $this->load->view('user/checkout',$data);
            $this->load->view('user/footer_user');
        }
    }

    /**
     * search any product form product table
     * search base on name and price
     * @search = keyword enter from front end
     * @product data = image,name.price
     * @cms = cms_images,cms_content,cms_title,cms_discription
     * @category = category list
     * @banner = banner images
     * @recommend = recently add product
     * #model = user,bannermgmt,category,cmsadmin,
     * @return @data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function search_all()
    {
        //get search keyword from front end (method = post)
        $search=$this->input->post('search');
        $data['product']=$this->User->all_search($search);
        $data['cms']=$this->cmsadmin->home_cms();               //fetch images and content of cms
        $data['category']=$this->User->home_category();         //fetch list of category
        $data['banner']=$this->Bannermgmt->home_banner();       //fetch images of banner
        $data['categorys']="";                                  //sub category block for show sub-category
        $str_links = $this->pagination->create_links();         //generate links fro pagination
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * destroy user session after logout
     * destroy try to facebook session
     * destroy cart with destroying user session
     * @return clear cart and destory session
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function logout()                                        //destroy user session
    {
        // destory cart
        $this->cart->destroy();
        // unset user session
        $this->session->unset_userdata('user_session');
        // load facebook library
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        $this->session->sess_destroy();
        redirect('Userlogin/login');
    }

    /**
     * Newsletter
     * load mcapi librabry(Mailchimp lib)
     * check list id and api key is valid or not
     * check number of lists
     * @list = list_name,memeber_count,unsubscribe_count,cleaned_count
     * check user already subscribe or not
     * @return = subscribe user to newsletter
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function newsletter()
    {
        //load Mailchimp lib
        $this->load->library('mcapi');
        //fetch all list using mailchimp app key
        $retval = $this->mcapi->lists();
        //if api key and list id not match display error message
        if ($this->mcapi->errorCode)
        {
            //error meassge come from mailchimp server
            $data['msg'] = "Unable to load lists()!";
            $data['msg'] = "\n\t".$this->mcapi->errorCode;
            $data['msg'] = "\n\t".$this->mcapi->errorMessage."\n";
        }
        //if api key and list id are valid show related data about list id
        else
        {
            //total number of lists
            "Lists that matched:".$retval['total']."\n";
            //size of data avalible in list
            "Lists returned:".sizeof($retval['data'])."\n";
            //explore list data
            foreach ($retval['data'] as $list)
            {
                //list name
                "Id = ".$list['id']." - ".$list['name']."\n";
                //web id of particular lsit
                "Web_id = ".$list['web_id']."\n";
                //total member subscribe to that list
                "\tSub = ".$list['stats']['member_count'];
                //total unsubscribe member count
                "\tUnsub=".$list['stats']['unsubscribe_count'];
                //total cleaned count
                "\tCleaned=".$list['stats']['cleaned_count']."\n";
            }
        }
        $listID = "26cb540ea8"; // obtained by calling lists();
        $emailAddress = "sumit.desai@wwindia.com";
        $retval = $this->mcapi->listSubscribe($listID, $emailAddress);

        //if user already subscribe then show error msg
        if ($this->mcapi->errorCode)
        {
            //error msg comes from server side of mailchimp
            $data['msg']= "Unable to subscribe email using listSubscribe()!";
            $data['msg']= "\n\t".$this->mcapi->errorCode;
            $data['msg']= "\n\t".$this->mcapi->errorMessage."\n";
        }
        //new user added successfully to the mailchimp list
        else
        {
            $this->load->view('user/headeruser');
            $data['msg']= $emailAddress." added successfully\n";
            $this->load->view('user/footer_user');
        }
        $this->load->view('user/headeruser');
        $this->load->view('newsletter',$data);
        $this->load->view('user/footer_user');
    }
}
?>