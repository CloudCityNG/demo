<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminuser extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));

    }
    public function index()                                 //view user data
    {
        if($this->session->userdata('session')) {

            $x = $this->session->userdata('id');

            $perpage = $this->Admin_Insert->fetch_perpage($x);

            if (empty($perpage)) {
                $perpage = 2;
            }

                $data['customer'] = $this->Admin_Insert->list_user();

                $config = array();
                $config["base_url"] = base_url() . "admin/adminuser/index/";
                $total_row = $this->Admin_Insert->record_count();
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
                $data["customer"] = $this->Admin_Insert->fetch_data($config["per_page"], $page);
                $str_links = $this->pagination->create_links();
                $data["links"] = explode('&nbsp;', $str_links);

                $sortorder = 'DESC';
                if($this->input->get('sortorder') == 'DESC')
                    $sortorder = 'ASC';

                $data["sortorder"] = $sortorder;
                $this->load->view('header');
                $this->load->view('footer');
                $this->load->view('view_user', $data);
            }
        else{
                redirect('admin/login');
            }

    }
    public function delete_user()                       //delete admin_user data
    {
        if($this->session->userdata('session'))
        {
            $this->Admin_Insert->user_delete();
            redirect('admin/adminuser/');
        }
        else
        {
            redirect('admin/login');
        }
    }
    public function edit_user()                             //edit_admin_user data
    {
        $data['edit_userdata']=$this->Admin_Insert->user_edit();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_admin',$data);

    }
    function update()                                        //update admin_user data
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE){

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_admin');
        }
        else
        {

            $id = $this->session->userdata('id');
            $data= array(

                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_email' => $this->input->post('admin_email'),
                'modified_by_data'=>$id,
                'modified_by_data'=>date('Y/m/d')
            );
            var_dump($data);
            $a_id=$this->input->post('hidden');

            $this->Admin_Insert->update_admin($a_id,$data);

            redirect('admin/adminuser');
        }
    }
    public function sort()                                      //sort admin-user data
    {
        if($this->session->userdata('session')){

            $var=$this->input->get('sortby');
            $data['customer']=$this->Admin_Insert->sort_data($var);
            $config = array();
            $config["base_url"] = base_url()."admin/adminuser/index/";
            $total_row = $this->Admin_Insert->record_count();
            $config["total_rows"] = $total_row;
            $config["per_page"] = 2;
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
            //$data['customer'] = $this->Admin_Insert->fetch_product_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            //	$data['product']=$this->Admin_Insert->list_product();
            $this->load->view('view_user',$data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function search_admin()                          //search admin_user data
    {
        $admin_ser=$this->input->post('search');
        $admin_serach=trim($admin_ser);
        $data['customer']=$this->Admin_Insert->search($admin_serach);

        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';

        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_user',$data);
    }
    public function news()                                     //practice img
    {
        $data['img']=$this->Admin_Insert->select_img();
        $this->load->view('new_link',$data);
    }
    function add_admin()                                        //insert admin
    {

        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_admin');
    }
    function add()
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('admin_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('admin_compass', 'Confirm Password', 'matches[admin_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_admin');

        } else {
           // $perpage_value = $this->input->post('perpage');
            $data = array(

                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_password' => $this->input->post('admin_password'),
                'admin_email' => $this->input->post('admin_email'),

            );
            $this->Admin_Insert->insert_admin($data);
            $this->session->set_flashdata('msg','Registration Successfull');
            redirect('admin/adminuser');
        }
    }
}