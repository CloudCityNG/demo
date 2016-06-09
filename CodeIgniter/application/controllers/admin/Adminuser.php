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
    /**
     * set perpage data for front end
     * apply pagination on table
     * set both side sorting
     * display admin list
     */
    public function index()                                           //view user data
    {
        //check session set or not
        if($this->session->userdata('session'))
        {
            //if set fetch admin_id
            $x = $this->session->userdata('id');
            //fetch perpage setting number
            $perpage = $this->Admin_Insert->fetch_perpage($x);
            //if parpage not set then set same static value
            if (empty($perpage))
            {
                $perpage = 2;
            }
            $data['customer'] = $this->Admin_Insert->list_user();
            //sorting and pagination of admin list table
            $config = array();
            $config["base_url"] = base_url() . "admin/adminuser/index/"; //redirect url
            $total_row = $this->Admin_Insert->record_count();            //total admin count
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
                $page = ($this->uri->segment(4));                       //page number fetching from url
            } else {
                $page = 1;
            }
            //fetch  admin details data from database
            $data["customer"] = $this->Admin_Insert->fetch_data($config["per_page"], $page);
            //genrate pagination links
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);
            //both sorting dyanamicaly generated
            $sortorder = 'DESC';
            //if sort type is DESC change to ASC and vis-versa
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
    /**
     * delete signle adminuser form database
     * getting admin id from url
     */
    public function delete_user()                       //delete admin_user data
    {
        //if session set
        if($this->session->userdata('session'))
        {
            //delete admin from database
            $this->Admin_Insert->user_delete();
            redirect('admin/adminuser/');
        }
        //session not set
        else
        {
            //redirect to login page
            redirect('admin/login');
        }
    }
    /**
     * fetch single admin_user data
     * redirect to update page with admin_user data
     */
    public function edit_user()                             //edit_admin_user data
    {
        //fetch admin_user data
        $data['edit_userdata']=$this->Admin_Insert->user_edit();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_admin',$data);

    }
    /**
     * check validation on update form
     * update admin_user records
     */
    function update()                                        //update admin_user data
    {
        //server side validtion apply on data
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        //if data is empty or not valid
        if ($this->form_validation->run() == FALSE){

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_admin');
        }
        //if data is valid
        else
        {
            //set user id form
            $id = $this->session->userdata('id');
            $data= array(

                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_email' => $this->input->post('admin_email'),
                'modified_by_data'=>$id,
                'modified_by_data'=>date('Y/m/d')
            );
            //fetch admin_user_id
            $a_id=$this->input->post('hidden');
            //update admin data using admin id
            $this->Admin_Insert->update_admin($a_id,$data);
            //redirect to admin list page
            redirect('admin/adminuser');
        }
    }
    /*
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
    */

    /**
     * @admin_ser-keyword enter from front end
     * @admin_search-trim keyword
     * search admin_user related data using keyword
     * apply sorting to table
     */
    public function search_admin()                          //search admin_user data
    {
        //get search keyword
        $admin_ser=$this->input->post('search');
        //trim keyword
        $admin_serach=trim($admin_ser);
        //find data related about search keyword
        $data['customer']=$this->Admin_Insert->search($admin_serach);
        //sort by DESC
        $sortorder = 'DESC';
        //change sorting type
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';
        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        //link generation code
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        //redirect to admin_list page
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_user',$data);
    }

    public function news()                                     //practice img
    {
        $data['img']=$this->Admin_Insert->select_img();
        $this->load->view('new_link',$data);
    }

    /**
     * redirect to add_admin page
     */
    function add_admin()                                        //new admin page
    {
        //redirect to add_admin page
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_admin');
    }

    /**
     * add new admin_user in database
     * validation of inserted data
     * insert validted data in databse
     */
    function add()                                                 //insert new admin
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('admin_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('admin_compass', 'Confirm Password', 'matches[admin_password]');
        //if data is not valid
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_admin');
        }
        else
        {
           // $perpage_value = $this->input->post('perpage');
            $data = array(
                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_password' => md5($this->input->post('admin_password')),
                'admin_email' => $this->input->post('admin_email'),
            );
            //insert admin_user data in e-commers table
            $this->Admin_Insert->insert_admin($data);
            //falsh msg for successfull registration done
            $this->session->set_flashdata('msg','Registration Successfull');
            redirect('admin/adminuser');
        }
    }
}