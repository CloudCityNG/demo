<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
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
    public function index()                                    //banner table
    {
        if($this->session->userdata('session')) {

            $data['banner'] = $this->Admin_Insert->view_banner();
            $x=$this->session->userdata('id');
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/banner/index";
            $total_row = $this->Admin_Insert->record_count_banner();
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
            $data['banner'] = $this->Admin_Insert->fetch_banner_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('banner_mgmt', $data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function edit_img()                                        //edit banner-imiage
    {
        $data['img']=$this->Admin_Insert->img_edit();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_banner',$data);
    }
    public function updateed_image()                                   //update banner_image
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
            redirect('admin/banner');
        }
    }
    public function done()                                         // practice img
    {
        $data['image']=$this->Admin_Insert->show_image();
        $this->load->view('done_image',$data);
    }
    public function delete_img()                                   //delete img
    {
        $this->Admin_Insert->img_delete();
        redirect('admin/banner');
    }
    public function search_image()                                  //serach img
    {
        $image_serach=$this->input->post('search');
        $data['banner']=$this->Admin_Insert->search_image($image_serach);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('banner_mgmt',$data);
    }
    public function view_img_details()                              //view img
    {
        $data['image']=$this->Admin_Insert->img_detalis();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('img_details',$data);
    }
}