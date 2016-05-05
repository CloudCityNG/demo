<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
    public function back_dashbord()
    {
        if($this->session->userdata('session')){
            redirect('admin/login/admin_dashboard');}
        else{
            $this->load->view('login');
        }
    }
    public function view_user()
    {
        if($this->session->userdata('session')){


            $data['customer']=$this->Admin_Insert->list_user();

            $config = array();
            $config["base_url"] = base_url()."admin/dashboard/view_user";
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
            if($this->uri->segment(4))
            {
                $page = ($this->uri->segment(4));
            }
            else
            {
                $page = 1;
            }
            $data["customer"] = $this->Admin_Insert->fetch_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_user',$data);
        }
        else{
        redirect('admin/login');
        }

    }
    public function delete_user()
    {
        if($this->session->userdata('session'))
        {
            $this->Admin_Insert->user_delete();
            redirect('admin/dashboard/view_user');
        }
        else
        {
            redirect('admin/login');
        }
    }
    public function edit_user()
    {
        $data['edit_userdata']=$this->Admin_Insert->user_edit();

        $this->load->view('update_admin',$data);
    }
    function update()
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('admin_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('admin_compass', 'Confirm Password', 'matches[admin_password]');
        $this->form_validation->set_rules('tnc','TNC','required');
        $this->form_validation->set_rules('status','Status','required');
        if ($this->form_validation->run() == FALSE){
            //$data['cut']=$this->insert_admin->fetch();
            $this->load->view('admin_registration');
        }
        else
        {
            $id = $this->input->get('admin_id', TRUE);
            $data= array(

                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_password' => $this->input->post('admin_password'),
                'admin_email' => $this->input->post('admin_email'),
                'status' => $this->input->post('status')
            );
            $this->Admin_Insert->update_admin($id,$data);
            redirect('admin/dashboard/view_user');
        }
    }
    public function sort()
    {
        if($this->session->userdata('session')){
            $var=$this->input->get('sortby');
            $data['customer']=$this->Admin_Insert->sort_data($var);
            $config = array();
            $config["base_url"] = base_url()."admin/dashboard/view_user";
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
    public function search_admin()
    {
        $admin_serach=$this->input->post('search');
        $data['customer']=$this->Admin_Insert->search($admin_serach);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_user',$data);
    }
    public function news()
    {
        $data['img']=$this->Admin_Insert->select_img();
        $this->load->view('new_link',$data);
    }
    function add_admin()
    {
        //$this->load->view('header');

        $this->load->view('add_admin');
        $this->load->view('footer');

    }
    public function banner()
    {
        if($this->session->userdata('session')) {

            $data['banner'] = $this->Admin_Insert->view_banner();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('banner_mgmt', $data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function edit_img()
    {
        $data['img']=$this->Admin_Insert->img_edit();
        $this->load->view('update_banner',$data);
    }
    public function updateed_image()
    {
        //$id=$this->input->get();
        $path =$_SERVER['DOCUMENT_ROOT'].'/CodeIgniter/images/'.$_FILES['image_name']['name'];

        if(move_uploaded_file($_FILES['image_name']['tmp_name'], $path )) {
            $uploed = $_FILES['image_name']['name'];
            $img = array(
                'image_name' => $uploed,
                //'product_id'=>$prod
            );
            $this->Admin_Insert->image_update($img);
            redirect('admin/dashboard/banner');
        }
    }
    public function done()
    {
        $data['image']=$this->Admin_Insert->show_image();
        $this->load->view('done_image',$data);
    }
    public function delete_img()
    {
        $this->Admin_Insert->img_delete();
        redirect('admin/dashboard/banner');
    }
    public function view_img_details()
    {
        $data['image']=$this->Admin_Insert->img_detalis();
        $this->load->view('img_details',$data);
    }
    public function setting()
    {
        $this->load->view('setting');
    }
    public function reply()
    {
        if($this->session->userdata('session')) {
            $data['query']=$this->Admin_Insert->user_query();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('user_query',$data);}
        else{
            redirect('admin/login');
        }
    }
    public function replay_user()
    {
        if($this->session->userdata('session')) {
            $user_id = $this->input->get('contact_id', TRUE);
            $data['view']=$this->Admin_Insert->view_query($user_id);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_user_query',$data);
            $this->load->view('add_product');}
        else{
            redirect('admin/login');
        }
    }
    public function admin_replay()
    {

        $this->Admin_Insert->replay_admin();
        redirect('replay_user');
    }
    public function logout()
    {
       $this->session->unset_userdata();

            $this->session->sess_destroy();

            redirect('admin/login');



    }
}