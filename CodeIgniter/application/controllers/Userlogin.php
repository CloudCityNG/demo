<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogin extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');

    }
    public function login()                 // login and registration
    {

        $this->load->view('user/login_user');
        $this->load->view('user/footer_user');
    }
    function registration()                 //user registration
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('user_status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            //$this->load->view('user/headeruser');
            $this->load->view('user/login_user');
            $this->load->view('user/footer_user');
        } else {
            $data = array(

                'user_name' => $this->input->post('user_name'),
                'user_lastname' => $this->input->post('user_lastname'),
                'user_password' => $this->input->post('user_password'),
                'user_email' => $this->input->post('user_email'),
                'user_status' => $this->input->post('user_status')
            );
            $this->User->insert_user($data);
            $email=$this->input->post('user_email');
            $pass=$this->input->post('user_password');

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

<img src="logo.jpg" style="height: 50px;margin-left: 40px">
<br>
	<div style="margin-left: 220px">
		<h2> <b> Welcome to Shopping Cart</b></h2></div><notbold>
<div style="margin-left: 50px;width:600px">To log in when visiting our site just click Login at the top of every page, and then enter your email address and password.</div>
<br><div style="margin-left: 50px;width:600px; background-color: grey">
	Use the following values when prompted to log in:
	<br>
	E-mail:'.$email.'<br>
	Password:'.$pass.'<br>
	</div>
<div style="margin-left: 50px;width:600px">
	<ul>
		<li>
			Proceed through checkout faster when making a purchase.
		</li>
		<li>
			Check the status of orders.
		</li>
		<li>
			View past orders
		</li>
		<li>
			Make changes to your account information
		</li>
		<li>
			Change your password.
		</li>
		<li>
			Store alternative addresses (for shipping to multiple family member
			s and friends!)
			</li>
	</ul>
		<div>If you have any questions, please feel free to contact us at inf
			o@shoppingcompany.com or
			by phone at
			+91
			22
			-
			40500699

	</div>
</div>
</notbold></h5>


</body>
</head>
</html>';

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('sumit.desai@wwindia.com'); // change it to yours
            $this->email->to('sumit.desai@wwindia.com');// change it to yours
            $this->email->subject('Welcome to E-Shopping');
            $this->email->message($message);
            if ($this->email->send()) {


            } else {
                show_error($this->email->print_debugger());
            }

            $message = '

<html>
<head>
<body>
<br><br>
<div style="margin-left: 120px">
	<img src="logo.jpg" style="height: 50px;margin-left: 40px">
	<br>
	<div style="margin-left: 220px">
		<h2> <b> Welcome to Shopping Cart</b></h2></div><notbold>
	<div style="margin-left: 50px;width:600px">To log in when visiting our site just click
		Login
		or
		My Account
		at the top of every page, and
		then enter your email address and password.</div>
	<br><div style="margin-left: 50px;width:600px; background-color: grey">
	Use the following values when prompted to log in:
	<br>E-mail:'.$email.'<br>
</div>
	<div style="margin-left: 50px;width:600px">
		When you log in to your account, you will be able to do the followi
		ng:
		<ul>
			<li>
				Proceed through checkout faster when making a purchase.
			</li>
			<li>
				Check the status of orders.
			</li>
			<li>
				View past orders
			</li>
			<li>
				Make changes to your account information
			</li>
			<li>
				Change your password.
			</li>
			<li>
				Store alternative addresses (for shipping to multiple family member
				s and friends!)
			</li>
		</ul>
	</div>
</notbold></h5>
</div>


</body>
</head>
</html>





            ';

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('sumit.desai@wwindia.com'); // change it to yours
            $this->email->to('sumit.desai@wwindia.com');// change it to yours
            $this->email->subject('New User Add');
            $this->email->message($message);
            if ($this->email->send()) {


            } else {
                show_error($this->email->print_debugger());
            }
            redirect('Userlogin/login');
        }
    }

    public function login_user()               // get id
    {
        $user_data['id'] = $this->User->user_login();
        $this->load->view('user/empty', $user_data);

    }

    public function ids()                      // set sesssion
    {
        $user_data = $this->uri->segment(3);
        $this->session->set_userdata('user_session', $user_data);
        redirect('home');
    }

    public function error()                    // login error
    {
        $data['email'] = "Invalid E-mail ";
        $data['pass'] = "Invalid Password";
        $this->load->view('user/login_user', $data);
        $this->load->view('user/footer_user');
    }

    public function forget()                     //forgot e-mail
    {

        $this->load->view('user/forget_pass');
        $this->load->view('user/footer_user');
    }

    public function forget_user()                 // e-mail validation
    {
        $this->User->user_forget();
    }

    public function email_error()                  //e-mail error
    {
        $data['email'] = 'Invalid E-mail';

        $this->load->view('user/forget_pass', $data);
        $this->load->view('user/footer_user');
    }

    public function sendmail($id)                  //send mail to user e-mail id
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(1,$charactersLength-1)];
        }
        $newpass = $randomString;

        $data=array(
            'user_password' => $newpass
        );

        $this->User->newpassword($data,$id);

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
        $message = $randomString;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('sumit.desai@wwindia.com'); // change it to yours
        $this->email->to('sumitdesai80@gmail.com');// change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if ($this->email->send()) {
            $data['verify_email'] = 'Mail Successfully send on Your Respect E-mail Id';
            //$this->load->view('user/headeruser');
            $this->load->view('user/login_user', $data);
            $this->load->view('user/footer_user');

        } else {
            show_error($this->email->print_debugger());
        }
    }
}