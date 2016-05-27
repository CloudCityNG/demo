<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->model('couponmgmt');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }
    public function index()                                    //banner table
    {
        if($this->session->userdata('session')) {

            //  $data['banner'] = $this->Bannermgmt->banner_list();
            $x=$this->session->userdata('id');
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/banner/index";
            $total_row = $this->couponmgmt->record_count_coupon();
            $config["total_rows"] = $total_row;
            $config["per_page"] = $perpage;
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
            $data['coupon'] = $this->couponmgmt->fetch_coupon_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );

            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('coupon_mgmt', $data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function delete_coupon()                                   //delete img
    {
        $this->couponmgmt->img_delete();
        redirect('admin/coupon');
    }
    public function add_coupon()
    {
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_coupon');
    }
    public function add()
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('percent_off', 'Discount', 'required');
        if ($this->form_validation->run() == FALSE){

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_coupon');
        }
        else
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(1, $charactersLength - 1)];
            }
            $admin_id=$this->session->userdata('id');
            $data= array(

                'code' => $randomString,
                'percent_off' => $this->input->post('percent_off'),
                'created_by' => $admin_id
            );
            $this->couponmgmt->insert($data);
            redirect('admin/coupon');
        }
    }
    public function discount()
    {
        $off=$this->input->post('code');

        $disc=$this->couponmgmt->discount_off($off);

        $x="";
         foreach ($this->cart->contents() as $items):
            endforeach;
          $x=$this->cart->format_number($this->cart->total());
        echo $z=$x-$disc;
    }

}