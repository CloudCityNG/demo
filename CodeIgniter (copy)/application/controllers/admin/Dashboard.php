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
    public function index()
    {
        if ($this->session->userdata('session')) {
            $this->load->view('footer');
            $this->load->view('header');
            $count['admin_count'] = $this->Admin_Insert->record_count();
            $count['product_count'] = $this->Admin_Insert->product_count();
            $this->load->view('dashboard', $count);
        } else {
            redirect('admin/login');
        }
    }
    public function back_dashbord()                         //back link
    {
        if($this->session->userdata('session')){
            redirect('admin/dashboard');}
        else{
            $this->load->view('login');
        }
    }

    public function banner()                                    //banner table
    {
        if($this->session->userdata('session')) {

            $data['banner'] = $this->Admin_Insert->view_banner();
            $x=$this->session->userdata('id');
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/dashboard/banner";
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
            redirect('admin/dashboard/banner');
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
        redirect('admin/dashboard/banner');
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
    public function setting()                                       //setting
    {
        $session_data=$this->session->userdata('session');

        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('setting',$session_data);
    }
    public function perpage_change()
    {
         $ses_id=$this->session->userdata('id');
            $data=array(
                'conf_key'=>$this->input->post('admin_id'),
                'created_by'=>$ses_id,
                'perpage'=>$this->input->post('perpage'),
            );
        $this->Admin_Insert->change_perpage($data,$ses_id);

        $msg['msg']='Chnage Successsfully Done';
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('setting',$msg);
    }
    public function change_email()
    {
        $id=$this->session->userdata('id');
        $data=array(
            'admin_id'=>$this->input->post('admin_id'),
            'admin_email'=>$this->input->post('admin_email')
        );
        $this->Admin_Insert->upadate_email($data,$id);

    }
    public function reply()                                          //view all query
    {
        if($this->session->userdata('session')) {
            $data['query']=$this->Admin_Insert->user_query();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('user_query',$data);}
        else
        {
            redirect('admin/login');
        }
    }
    public function replay_user()                                   //query details
    {
        if($this->session->userdata('session')) {
            $user_id = $this->input->get('contact_id', TRUE);
            $data['view']=$this->Admin_Insert->view_query($user_id);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_user_query',$data);
            }
        else{
            redirect('admin/login');
        }
    }

    public function admin_replay()                                    //replay query
    {

        $this->Admin_Insert->replay_admin();
        redirect('replay_user');
    }
    public function logout()                                            //logout
    {
       $this->session->unset_userdata();

            $this->session->sess_destroy();

            redirect('admin/login');
    }
}