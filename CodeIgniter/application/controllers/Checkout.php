<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->model('cmsadmin');
        $this->load->model('checkoutmodel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');
    }
    public function checkout_new_user()
    {
        $this->load->view('user/headeruser');
        $this->load->view('user/new_user_checkout');
        $this->load->view('user/footer_user');
    }
    public function checkout_login()
    {
        $user_data['id'] = $this->checkoutmodel->user_login();
        $this->load->view('user/empty_checkout', $user_data);
    }
    public function index()                                      //checkout with cart data
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
    public function ids()                      // set sesssion
    {
        $user_data = $this->uri->segment(3);
        echo $user_data;
        $this->session->set_userdata('user_session', $user_data);
        $user_name=$this->User->fetch_name($user_data);
        echo $this->session->set_userdata('user_name', $user_name);
        redirect('checkout');
    }
    public function error()                    // login error
    {
        $data['email'] = "Invalid E-mail ";
        $data['pass'] = "Invalid Password";
        $this->load->view('user/headeruser');
        $this->load->view('user/new_user_checkout', $data);
        $this->load->view('user/footer_user');
    }
    public function checkouts()
    {
        $checkout=$this->input->post('checkout');
        if($checkout == 'guest') {
            $this->load->view('user/headeruser');
            $this->load->view('user/guest_checkout');
            $this->load->view('user/footer_user');
        }
        else
        {
            $this->load->view('user/headeruser');
            $this->load->view('user/register_checkout');
            $this->load->view('user/footer_user');
        }
    }

}