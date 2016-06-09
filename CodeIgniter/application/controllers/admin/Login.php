<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
     * adminuser login page
     */
    public function index()                                          //login page
    {
        $this->load->view('login');
    }

    /**
     * validation on admin form
     */
    function insert()                                               //admin registration
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('admin_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('admin_compass', 'Confirm Password', 'matches[admin_password]');
        $this->form_validation->set_rules('tnc','TNC','required');
        $this->form_validation->set_rules('status','Status','required');
        //if error is occur
        if ($this->form_validation->run() == FALSE){
            //$data['cut']=$this->Admin_Insert->fetch();
            $this->load->view('admin_registration');
        }
        //otherwise insert admin data in table
        else
        {
            $data= array(
                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_password' => md5($this->input->post('admin_password')),
                'admin_email' => $this->input->post('admin_email'),
                'status' => $this->input->post('status')
            );
            $this->Admin_Insert->insert_admin($data);
            redirect('admin/login');
        }
    }

    /**
     * add new admin by super admin
     * validation apply on form
     * display admin list
     * apply pagination on display admin list
     */
    function add()                                      //add new admin
    {
        $perpage_value=$this->input->post('perpage');
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('admin_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('admin_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('admin_compass', 'Confirm Password', 'matches[admin_password]');
        $this->form_validation->set_rules('tnc', 'TNC', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        //if server side validation error occurs
        if ($this->form_validation->run() == FALSE)
        {
            //$data['cut']=$this->Admin_Insert->add_fetch();
            $this->load->view('add_admin');
        }
        //else insert data in database
        else
        {
            $perpage_value=$this->input->post('perpage');
            $data = array(
                'admin_name' => $this->input->post('admin_name'),
                'admin_lastname' => $this->input->post('admin_lastname'),
                'admin_password' => $this->input->post('admin_password'),
                'admin_email' => $this->input->post('admin_email'),
                'status' => $this->input->post('status')
            );
            $this->Admin_Insert->insert_admin($data);


            $config = array();
            $config["base_url"] = base_url()."admin/login/view_user";
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
            $data["customer"] = $this->Admin_Insert->fetch_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_user',$data);
        }
    }

    /**
     * go to forget password page
     */
    function forget()                                           //forget password
    {
        $this->load->view('forget');
    }

    /**
     * go to add admin page
     */
    function add_admin()                                        //new admin add
    {
        //$this->load->view('header');
        $this->load->view('add_admin');
        $this->load->view('footer');
    }

    /**
     * go to the admin_registration page
     */
    function registration()                                     //registraion page view
    {
        $this->load->view('admin_registration');
    }

    /**
     * admin login
     * verify user name and password
     * and send him to respective pages
     */
    function admin_login()                                      //admin login
    {
        $userid=$this->Admin_Insert->login();
        //  echo $userid;
        $username=$this->input->post('admin_name');
        $x=$this->session->set_userdata('id',$userid);
        //  echo $x;
        $this->session->set_userdata('session',$username);
        //if login successfully done
        if($this->session->userdata('session'))
        {
            redirect('admin/dashboard');
        }
        //else redirect to login page with error msg
        else
        {
            $this->load->view('login');
        }
    }

    /**
     * verify email id
     * for forget password
     */
    function verify_email()                                         //email validation
    {
        $data['userdata']=$this->Admin_Insert->verify();
        $this->load->view('login',$data);
    }

    /**
     * if login is unsccuessfull then show this msg
     */
    public function error()                                          //invalid login data
    {
        $data['user']="Invalid Username";
        $data['pass']="Invalid Password";
        $this->load->view('login',$data);
    }

    /**
     * if email is not valid
     */
    public function email_error()                                    //invalid email
    {
        $data['error']="Invalid Email";
        $this->load->view('forget',$data);
    }

    /**
     * if user forget password
     * then send  password using mail
     */

   /* function sendMail()                                                //send password
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.wwindia.com',
            'smtp_port' => 25,
            'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
            'smtp_pass' => 'nb=np2^89mKn', // change it to yours
            'mailtype' => 'html',
            //'charset' => 'iso-8859-1',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

        $message = 'Mail Done';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('sumit.desai@wwindia.com'); // change it to yours
        $this->email->to('sumitdesai80@gmail.com');// change it to yours
        $this->email->subject('Your Password');
        $this->email->message($message);

        if($this->email->send())
        {
            redirect('admin/login');
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }
    */
    //login done successfully redirect to dashboard page
    public function admin_dashboard()                                   //admin_dashboard
    {
        //session is activated
        if($this->session->userdata('session'))
        {
            $this->load->view('footer');
            $this->load->view('header');
            $count['admin_count']=$this->Admin_Insert->record_count();
            $count['product_count']=$this->Admin_Insert->product_count();
            $this->load->view('dashboard',$count);
        }
        else
        {
            redirect('admin/login');
        }
    }
}