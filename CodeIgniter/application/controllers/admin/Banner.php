<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));

    }
    /*
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
*/


/*
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
*/
    public function done()                                         // practice img
    {
        $data['image']=$this->Admin_Insert->show_image();
        $this->load->view('done_image',$data);
    }
    /*
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
    */



    /*
     * pagination for banner page
     * apply sorting both side
     * $banner = banner_image
     *
     */
    public function index()                                    //banner table
    {
        if($this->session->userdata('session'))
        {

            $x=$this->session->userdata('id');
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/banner/index";
            $total_row = $this->Bannermgmt->record_count_banner();
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
            $data['banner'] = $this->Bannermgmt->fetch_banner_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );

            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('banner_control', $data);
        }
        else{
            redirect('admin/login');
        }
    }

    /**
     * change banner image
     *
     */
    public function edit_banner()                                        //edit banner-imiage
    {
        $data['banner']=$this->Bannermgmt->img_edit();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('banner_update',$data);
    }

    /**
     * update banner image
     * check image updaloaded or not
     * if uploaded then upload image in database
     * else print error msg
     * $x = file name
     * $id = admin_id
     * $path = image path
     */
    public function updated_banner()                                   //update banner_image
    {

        $x=$_FILES['banner']['name'];
        $id=$this->session->userdata('id');
        $path =$_SERVER['DOCUMENT_ROOT'].'/CodeIgniter/images/'.$_FILES['banner']['name'];
        //check image is uplaoded or not
        if(!empty($x)){
            if(move_uploaded_file($_FILES['banner']['tmp_name'], $path )) {
            $uploed = $_FILES['banner']['name'];
            $img = array(
                'banner' => $uploed,
                'modify_by' => $id,
                'modify_date' => date('Y/M/D')
            );
            $this->Bannermgmt->image_update($img);

            redirect('admin/banner');
            }
        }
        //else print appropriate msg
        else{
            $data['banner']=$this->Bannermgmt->img_edit();
            $data['msg']="Please Select Image";
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('banner_update',$data);
        }
    }

    /**
     * delete image from banner
     * select id using url
     */
    public function delete_banner()                                   //delete img
    {
        $this->Bannermgmt->img_delete();
        redirect('admin/banner');
    }

    /**
     * search banner image from database
     * based on image name,banner_id
     * apply both side sorting fro searching relevant data
     */
    public function search_banner()                                  //serach img
    {
        $image_serach=$this->input->post('search');
        $data['banner']=$this->Bannermgmt->search_image($image_serach);
        $sortorder = 'DESC';                                        //default sorting type
        if($this->input->get('sortorder') == 'DESC')                //chaneg sorting type vis-versa
            $sortorder = 'ASC';
        $data['sort']="sort";                                       //save soting type
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();             //generate pagination link
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('banner_control',$data);
    }

    /**
     * view signle banner deatails
     * $image=banner_image
     *        image_name
     */
    public function view_banner_details()                              //view img
    {
        $data['image']=$this->Bannermgmt->img_detalis();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('banner_details',$data);
    }

    /**
     * go to add new banner
     */
    public function add_banner()
    {
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_banner');
    }

    /**
     * add new banner in database
     * check file selected or not
     * $x = image name
     * $id=user_id
     * $path = image path
     */
    public function add()
    {
        //filename
        $x=$_FILES['banner']['name'];
        //admin_id
        $id=$this->session->userdata('id');
        //image path
        $path =$_SERVER['DOCUMENT_ROOT'].'/CodeIgniter/images/'.$_FILES['banner']['name'];
        //check image selected or not
        if(!empty($x))
        {
            if (move_uploaded_file($_FILES['banner']['tmp_name'], $path))
            {
                $upload = $_FILES['banner']['name'];
                $img = array(
                    'banner' => $upload,
                    'created_by' => $id
                );
                $this->Bannermgmt->update_banner($img);
                $this->session->set_flashdata('msg', 'New Banner Added Successfully');
                redirect('admin/banner/');
            }
        }
        //esle show appropriate massage
        else
        {
            $data['msg']="Please Select Image";
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_banner',$data);

        }
    }
}