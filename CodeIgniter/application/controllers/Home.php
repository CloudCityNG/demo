<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->model('Admin_Insert');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');

    }

    public function index()                   //home page
    {

        $data['product']=$this->Admin_Insert->home();

        $data['category']=$this->User->home_category();

        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }
    public function category()
    {
        $category=$this->uri->segment(3);
        $data['product']=$this->User->data($category);
        $data['category']=$this->User->select_cat($category);
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
//            $this->load->view('user/headeruser');
//            $this->load->view('user/cart_user');
//            $this->load->view('user/footer_user');

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

    public function logout()
    {
        $this->cart->destroy();
        $this->session->unset_userdata('user_session');
        redirect('Userlogin/login');
    }


}
?>