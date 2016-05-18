<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->model('cmsadmin');
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
            $config["base_url"] = base_url() . "admin/cms/index/";
            $total_row = $this->cmsadmin->cms_record_count();
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
            $data["cms"] = $this->cmsadmin->fetchcms_data($config["per_page"], $page);

            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('cms_list', $data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function add_cms()
    {
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_cms');
    }
    public function add()
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta-Description', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta-Keyword', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_cms');

        } else {


            $id = $this->session->userdata('id');
            $path = $_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/images/' . $_FILES['banner_name']['name'];
            echo $path;
            if (move_uploaded_file($_FILES['banner_name']['tmp_name'], $path)) {
                $upload = $_FILES['banner_name']['name'];
                $data = array(

                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keyword'),
                    'banner_name' => $upload,
                    'created_by' => $id
                );
                $this->cmsadmin->insert_csm($data);
                $this->session->set_flashdata('msg', 'Chages Successfull Done');
                redirect('admin/cms');
            }
        }
    }
    public function edit_cms()
    {
        $cms_id=$this->uri->segment(4);
        $data['cms']=$this->cmsadmin->cms_edit($cms_id);
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_cms',$data);
    }
    public function update()
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta-Description', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta-Keyword', 'required');

        if ($this->form_validation->run() == FALSE) {
            $c_id=$this->uri->segment(4);
echo $c_id;
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_cms',$c_id);

        } else {
            $x=$_FILES['banner_name']['name'];
            $id = $this->session->userdata('id');
            $path = $_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/images/' . $_FILES['banner_name']['name'];
            if(!empty($x)){
            if (move_uploaded_file($_FILES['banner_name']['tmp_name'], $path)) {
                $upload = $_FILES['banner_name']['name'];

                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keyword'),
                    'banner_name' => $upload,
                    'modify_by' => $id,
                    'modify_date' => date('Y/M/D')
                );
                $id = $this->input->post('id');
                $this->cmsadmin->update_csm($id, $data);
                $this->session->set_flashdata('msg', 'Chages Successfull Done');
                redirect('admin/cms');
            }
            }
            else{

                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keyword'),
                    'modify_by' => $id,
                    'modify_date' => date('Y/M/D')
                );
                $id = $this->input->post('id');
                $this->cmsadmin->update_csm($id, $data);
                $this->session->set_flashdata('msg', 'Chages Successfull Done');
                redirect('admin/cms');
            }
        }
    }
    public function delete_cms()
    {
        $cms_id=$this->uri->segment(4);
        $this->cmsadmin->cms_delete($cms_id);
        redirect('admin/cms');
    }
    public function search_cms()
    {
        $cms_ser=$this->input->post('search');
        $cms_serach=trim($cms_ser);

        $data['cms']=$this->cmsadmin->cms_search($cms_serach);

        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';

        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('cms_list',$data);
    }

}