<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
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
        if($this->session->userdata('session')){


            $x=$this->session->userdata('id');

            $perpage=$this->Admin_Insert->fetch_perpage($x);

            $config = array();
            $config["base_url"] = base_url()."admin/category/index/";
            $total_row = $this->Admin_Insert->category_list();
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
            $data["category"] = $this->Admin_Insert->fetch_data_from_category($config["per_page"], $page);
            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;

            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('category_mgmt',$data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function search_category()
    {
        $category_ser=$this->input->post('search');
        $category_search=trim($category_ser);
        $data['category']=$this->Admin_Insert->category_search($category_search);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';

        $data["sortorder"] = $sortorder;
        $data['sort']='sort';
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('category_mgmt',$data);

    }
    public function add_category()
    {
        if ($this->session->userdata('session')) {

            $data['category'] = $this->Admin_Insert->categoryall();

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_category', $data);
        } else {
            redirect('admin/login');
        }
    }
    public function insert_category()
    {
        $id=$this->session->userdata('id');
        $cat_name=$this->input->post('category');
        if( $cat_name !='not')
        {
            $cat_id=$this->Admin_Insert->cat($cat_name);
        }
        else {

            $cat_id = 0;
        }
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[1]|max_length[15]');
        if ($this->form_validation->run() == FALSE) {

            $data['category'] = $this->Admin_Insert->categoryall();
            $this->load->view('header');
            $this->load->view('footer');

            $this->load->view('add_category',$data);

        } else {

            $data = array(

                'category_name' => $this->input->post('category_name'),
                'parent_id' => $cat_id,
                'created_by'=>$id
            );
            $this->Admin_Insert->category_insert($data);
            redirect('admin/category');
        }
    }

    public function edit_category()
    {
        if ($this->session->userdata('session')) {

            $data['category'] = $this->Admin_Insert->categoryall();
            $id=$this->uri->segment(4);
            $data['categor']=$this->Admin_Insert->category_edit($id);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_category',$data);
        } else {
            redirect('admin/login');
        }
    }
    public function update_category()
    {
        $id=$this->session->userdata('id');
        $cat_name=$this->input->post('category');
        if( $cat_name !='not')
        {
            $cat_id=$this->Admin_Insert->cat($cat_name);
        }
        else {

            $cat_id = 0;
        }

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[1]|max_length[50]');
        if ($this->form_validation->run() == FALSE) {

            $data['category'] = $this->Admin_Insert->categoryall();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_category',$data);

        } else {

            $data = array(

                'category_name' => $this->input->post('category_name'),
                'parent_id' => $cat_id,
                'modify_by'=>$id,
                'modify_date'=>date('Y/m/d')

            );
            $cate_id=$this->input->post('hidden');
            $this->Admin_Insert->category_update($data,$cate_id);


            redirect('admin/category');
        }
    }

}