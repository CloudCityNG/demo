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

    /**
     * admin dashboard
     * display admin,product,compliant,banner counts,
     * with all management tables
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()
    {
        //check session is set or not
        //if session is set
        if ($this->session->userdata('session'))
        {
            $this->load->view('footer');
            $this->load->view('header');
            $count['admin_count'] = $this->Admin_Insert->record_count();
            $count['product_count'] = $this->Admin_Insert->product_count();
            $count['compliant_count'] = $this->Admin_Insert->compliant_count();
            $count['banner_count'] = $this->Bannermgmt->record_count_banner();
            $this->load->view('dashboard', $count);
        }
        //else session not set
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * redirect to dashboard page
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function back_dashbord()                         //back link
    {
        if($this->session->userdata('session')){
            redirect('admin/dashboard');}
        else{
            $this->load->view('login');
        }
    }

    /**
     * admin setting
     * admin set perpage of list of table from admin side
     * each admin can set differnt perpage
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
   /*
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

    /**
     * change perpage of admin panels table
     * insert perpage data of suer in setting table with admin id
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
   /* public function perpage_change()
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

    /**
     * change admin email id from admin setting
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    /*public function change_email()
    {
        //  $id=$this->session->userdata('id');
        $data=array(
            'setting_email'=>$this->input->post('admin_email')
        );
        //  $this->Admin_Insert->upadate_email($data,$id);
        $this->Admin_Insert->set_mail($data);
    }
    */
    /**
     * go to the admin replay page
     * with user query
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    /*public function reply()                                          //view all query
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
    }*/

    /**
     * admin can see user query here and give replay to user
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    /*public function replay_user()                                   //query details
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
    }*/

    /**
     * admin replay send to respective user
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
  /*  public function admin_replay()                                    //replay query
    {
        $replay=$this->input->post('replay');       //admin replay
        $email=$this->input->post('email');         //user email
        $username=$this->input->post('username');   //user name
        $msg=$this->input->post('message');         //user query
        $contact=$this->input->post('contact');     //contact discription
        $this->Admin_Insert->replay_admin();*/
        //send email to user
       /* $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.wwindia.com',
            'smtp_port' => 25,
            'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
            'smtp_pass' => 'nb=np2^89mKn', // change it to yours
            'mailtype' => 'html',
            //'charset' => 'iso-8859-1',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );*/

        /*$msgdata = array(
            'username' => $username,
            'email' => $email,
            'contact' => $contact,
            'replay' => $replay
        );*/
        /*
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
*/
        /*$email=$this->Admin_Insert->fetch_email();
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
        redirect('admin/dashboard/reply');
    }*/

    /**
     * on logout click
     * unset admin session
     * redirect to admin login
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function logout()                                            //logout
    {
            $this->session->unset_userdata();
            //   $this->session->sess_destroy();
            redirect('admin/login');
    }

    /**
     * search user query from query list
     * keywods comes from front end
     * search realted data about that keyword in all column
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    /*public function search_query()
    {
        $ser=$this->input->post('search');
        $search=trim($ser);
        $data['query']=$this->Admin_Insert->query_search($search);
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('user_query',$data);

    }*/
}