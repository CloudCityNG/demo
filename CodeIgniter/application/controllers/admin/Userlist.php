<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlist extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        //$this->load->helper('form');
        //$this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('session')) {


            //$data['user'] = $this->Admin_Insert->list_product();
            $x = $this->session->userdata('id');
            $perpage = $this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url() . "admin/userlist/index";
            $total_row = $this->Admin_Insert->record_count_user();
            $config["total_rows"] = $total_row;
            $config["per_page"] = $perpage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            if ($this->uri->segment(4)) {
                $page = ($this->uri->segment(4));
            } else {
                $page = 1;
            }
            $data['user'] = $this->Admin_Insert->fetch_user_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);
            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('user_list', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function delete_userlist_data()                                   //delete img
    {
        $this->Admin_Insert->userlist_delete();
        redirect('admin/userlist');
    }

    public function view_user_data()
    {
        $data['user'] = $this->Admin_Insert->userlist_data();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('user_details', $data);
    }

    public function search_user()
    {
        $user_ser=$this->input->post('search');
        $user_serach=trim($user_ser);
        $data['user']=$this->Admin_Insert->user_search($user_serach);
        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';
        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('user_list',$data);
    }
}