<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reply extends CI_Controller
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
     * go to the admin replay page
     * with user query
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()                                          //view all query
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
            $config["base_url"] = base_url() . "admin/reply/index/"; //redirect url
            $total_row = $this->Admin_Insert->record_count_reply();            //total admin count
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
            $data["query"] = $this->Admin_Insert->user_query($config["per_page"], $page);
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
            $this->load->view('user_query',$data);
        }
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * admin can see user query here and give replay to user
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function replay_user()                                   //query details
    {
        if($this->session->userdata('session')) {
            $user_id = $this->uri->segment(4);
            $data['view']=$this->Admin_Insert->view_query($user_id);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_user_query',$data);
        }
        else{
            redirect('admin/login');
        }
    }

    /**
     * admin replay send to respective user
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function admin_replay()                                    //replay query
    {
        $replay=$this->input->post('replay');       //admin replay
        $email=$this->input->post('email');         //user email
        $username=$this->input->post('username');   //user name
        $msg=$this->input->post('message');         //user query
        $contact=$this->input->post('contact');     //contact discription
        $this->Admin_Insert->replay_admin();
        //send email to user

        $msgdata = array(
            'username' => $username,
            'email' => $email,
            'contact' => $contact,
            'replay' => $replay
        );
        $email=$this->Admin_Insert->fetch_email();
        $this->email->initialize($this->config->item('email'));
        $this->email->set_newline("\r\n");
        $this->email->from($email); // change it to yours
        $this->email->to('sumit.desai@wwindia.com');// change it to yours
        $this->email->subject($msg);
        $body = $this->load->view('email/admin_replay',$msgdata,TRUE);
        $this->email->message($body);
        if ($this->email->send())
        {}
        else
        {
            show_error($this->email->print_debugger());
        }
        $con=$this->input->post('con_id');
        //  $this->Admin_Insert->delete_signle($con);
        redirect('admin/reply');
    }
    /**
     * search user query from query list
     * keywods comes from front end
     * search realted data about that keyword in all column
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function search_query()
    {

        //get search keyword
        $ser=$this->input->post('search');
        //trim keyword
        $search=trim($ser);
        //find data related about search keyword
        $data['query']=$this->Admin_Insert->query_search($search);
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
        $this->load->view('user_query',$data);
    }

}