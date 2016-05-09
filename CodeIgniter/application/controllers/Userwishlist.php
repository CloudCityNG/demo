<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userwishlist extends CI_Controller
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
    public function wishlist()
    {
        $ses_id=$this->session->userdata('user_session');
        $data['wishlist']=$this->User->display_wishlist($ses_id);
        $this->load->view('user/wishlist',$data);
    }
    public function add_to_wishlist()
    {
        $ses_id=$this->session->userdata('user_session');

        $product_id= $this->uri->segment(3);

        $data=array(
            'user_id'=>$ses_id,
            'product_id'=>$product_id
        );
        $this->User->add_wishlist($data);
        redirect('UserControl');
    }
    public function delete_from_wishlist()
    {
        $wish_id=$this->uri->segment(3);
        $this->User->delete_wishlist($wish_id);
        redirect('Userwishlist/wishlist');

    }
}