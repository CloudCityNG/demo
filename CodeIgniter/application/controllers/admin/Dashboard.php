<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
            $count['compliant_count'] = $this->Admin_Insert->compliant_count();
            $count['banner_count'] = $this->Bannermgmt->record_count_banner();
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


    public function setting()                                       //setting
    {

        $session_data=$this->session->userdata('session');
        $email=$this->Admin_Insert->session_email();
        $this->session->set_userdata('email',$email);
        $this->session->userdata('email');
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('setting',$session_data,$email);
    }
    public function perpage_change()
    {
         $ses_id=$this->session->userdata('id');
        $page = $this->input->post('page');
        if($page == 'admin') {
            $data = array(
                'conf_key' => $this->input->post('admin_id'),
                'created_by' => $ses_id,
                'perpage' => $this->input->post('perpage'),
            );
            $this->Admin_Insert->change_perpage($data,$ses_id);
        }
        else
        {
            $data = array(
                'conf_key' => $this->input->post('admin_id'),
                'created_by' => $ses_id,
                'perpage_home' => $this->input->post('perpage'),
            );
            $this->Admin_Insert->change_perpage($data,$ses_id);
        }
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
        $replay=$this->input->post('replay');
        $email=$this->input->post('email');
        $username=$this->input->post('username');
        $msg=$this->input->post('message');
        $contact=$this->input->post('contact');
        $this->Admin_Insert->replay_admin();



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
        $message = '


	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>



		<br>
		<div style="margin-left: 50px" >Dear Customer : '.$username.' </div><br>
		<div style="margin-left: 50px" >Plsease check Below Details </div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">Name</td>
					<td>'.$username.'</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>'.$email.'</td>
				</tr>
				<tr>
					<td>Contact No</td>
					<td>'.$contact.'</td>
				</tr>
				<tr>
				<td>Comment</td>
				<td>'.$replay.'</td>
				</tr>
			</table>
		</div><br>

	</div>

	</body>
	</head>
	</html>
        ';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('sumit.desai@wwindia.com'); // change it to yours
        $this->email->to('sumit.desai@wwindia.com');// change it to yours
        $this->email->subject($msg);
        $this->email->message($message);
        if ($this->email->send()) {


        } else {
            show_error($this->email->print_debugger());
        }
        $con=$this->input->post('con_id');
        $this->Admin_Insert->delete_signle($con);
        redirect('admin/dashboard/reply');
    }
    public function logout()                                            //logout
    {
       $this->session->unset_userdata();

            $this->session->sess_destroy();

            redirect('admin/login');
    }
}