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
    /*
     * display user wishlist
     * $ses_id = user_id
     * $data = array of product details image,name,price
     * #model = user
     * return = @data
     */
    public function wishlist()                                //user wishlist
    {
        $ses_id=$this->session->userdata('user_session');
        $data['wishlist']=$this->User->display_wishlist($ses_id);//fetch data from database
        $this->load->view('user/wishlist',$data);
    }

    /*
     * add product to wishlist from front end
     * @ses_id = loged user user_id
     * @prduct_id = selected product_id
     * @data =  user_id,product_id
     * return = add @data in database
     * #model = user
     */
    public function add_to_wishlist()                         //add to wishlist
    {
        //set user_id
        $ses_id=$this->session->userdata('user_session');
        //get selected product_id
        $product_id= $this->uri->segment(3);
        $data=array(
            'user_id'=>$ses_id,
            'product_id'=>$product_id
        );
        //insert data in database
        $this->User->add_wishlist($data);
        redirect('home');
    }

    /*
     * delete particular product from database
     * @wish_id = wishlist select product_id
     * #model = user
     * return delete single product from database
     */
    public function delete_from_wishlist()                    //delete data from wishlist
    {
        $wish_id=$this->uri->segment(3);                      //fetch id from url
        $this->User->delete_wishlist($wish_id);
        redirect('Userwishlist/wishlist');
    }
}