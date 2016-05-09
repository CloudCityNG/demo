<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserControl extends CI_Controller
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


        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');
    }
    public function category()
    {
        $data['product']=$this->User->soft();
        $this->load->view('user/headeruser');
        $this->load->view('user/home',$data);
        $this->load->view('user/footer_user');

    }
//    public function add_in_cart()
//    {
//        $prod_id = $this->uri->segment(3);
//        $this->db->where('product_id',$prod_id);
//        $this->db->delete('user_wish_list');
//        redirect('UserControl/add_to_cart/'.$prod_id);
//    }
    public function add_to_cart()
    {
        $prod_id = $this->uri->segment(3);
        $product = $this->User->fetch_data($prod_id);
        foreach($product as $value)
        $value =(array)$value;
        $name=$value['image_name'];
        $price=$value['price'];

            $data = array(
                'id'      => $prod_id,
                'qty'     => 1,
                'price'   => $price,
                'name'    => $name,
            );

            $this->cart->insert($data);
         redirect('UserControl');
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
        redirect('UserControl/user_cart');
    }

    public function logout()
    {
        $this->cart->destroy();
        $this->session->unset_userdata('user_session');
        redirect('Userlogin/login');
    }


}
?>