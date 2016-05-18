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

    public function index()                   //home page
    {
        $config = array();
        $config["base_url"] = base_url()."/home/index";
        $total_row = $this->Admin_Insert->record_home_count();
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
        $data['cms']=$this->cmsadmin->home_cms();
        $data['category']=$this->User->home_category();
        $data['banner']=$this->Bannermgmt->home_banner();
        $data['categorys']="";

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }

    public function category()
    {
        $category=$this->uri->segment(3);

//        $config = array();
//        $config["base_url"] = base_url()."/home/index";
//        $total_row = $this->User->record_cat_count($category);
//        $config["total_rows"] = $total_row;
//        $config["per_page"] = 3;
//        $config['use_page_numbers'] = TRUE;
//        $config['num_links'] = $total_row;
//        $config['cur_tag_open'] = '&nbsp;<a class="current">';
//        $config['cur_tag_close'] = '</a>';
//        $config['next_link'] = 'Next';
//        $config['prev_link'] = 'Previous';
//        $this->pagination->initialize($config);
//        if($this->uri->segment(4))
//        {
//            $page = ($this->uri->segment(4));
//        }
//        else
//        {
//            $page = 1;
//        }

        $data['product'] = $this->User->data($category);
        $data['categorys']=$this->User->home_category();
        $data['cms']=$this->cmsadmin->home_cms();
        $data['banner']=$this->Bannermgmt->home_banner();
        $data['category']=$this->User->select_cat($category);

        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }
    public function add_to_cart()
    {
        $prod_id = $this->uri->segment(3);
        $product = $this->User->fetch_data($prod_id);

        foreach($product as $value) {
            $value = (array)$value;
            $name = $value['image_name'];
            $price = $value['price'];

            $data = array(
                'id' => $prod_id,
                'qty' => 1,
                'price' => $price,
                'name' => $name,
            );
            $this->cart->insert($data);

        }
        redirect('home');
    }
    public function user_cart()
    {
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }
    public function update_cart()
    {
        $i = 1;
        foreach ($this->cart->contents() as $item) {

            $this->cart->update(array('rowid'=>$item['rowid'],'qty'=>$_POST[ 'qty'.$i ]));
            $i++;
        }
        $this->load->view('user/headeruser');
        $this->load->view('user/cart_user');
        $this->load->view('user/footer_user');
    }
    public function delete_cart()
    {
        $rowid=$this->uri->segment(3);
        $this->cart->update(array('rowid' => $rowid,'qty' => 0));
        redirect('home/user_cart');
    }
    public function product_view()
    {
        $data['product']=$this->User->view_product();
        $this->load->view('user/headeruser');
        $this->load->view('user/detail_product',$data);
        $this->load->view('user/footer_user');
    }
    public function checkout()
    {
        $id=$this->uri->segment(3);
        if(empty($id)) {
            $this->load->view('user/headeruser');
            $this->load->view('user/checkout');
            $this->load->view('user/footer_user');
        }
        else
        {
            $data['userdata']=$this->User->chekout_data($id);
            $this->load->view('user/headeruser');
            $this->load->view('user/checkout',$data);
            $this->load->view('user/footer_user');

        }
    }
    public function search_all()
    {
        $search=$this->input->post('search');
        $data['product']=$this->User->all_search($search);
        $data['cms']=$this->cmsadmin->home_cms();
        $data['category']=$this->User->home_category();
        $data['banner']=$this->Bannermgmt->home_banner();
        $data['categorys']="";
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }

    public function logout()
    {
        $this->cart->destroy();
        $this->session->unset_userdata('user_session');
        redirect('Userlogin/login');
    }
}
?>