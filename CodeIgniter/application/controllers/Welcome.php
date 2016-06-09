<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
        $this->load->model('User');
	}

	public function login(){

		$this->load->library('facebook'); // Automatically picks appId and secret from config


		$user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,name,email');
                $data['scope'] = array('email');
                $me = $this->facebook->api('/me');
                $f_id=$me['id'];
                $fb_data=array(
                    'scope' => array('email'),
                    'user_name' => $me['name'],
                    'fb_token' => $me['id'],
               );

               // $fb_id=$this->User->insert_fbuser($fb_data,$f_id);
               // redirect('Userlogin/ids/'.$fb_id);

            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {

            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            $data['user_profile'] = $this->facebook->api('/me?fields=id,name,email');
            $data['scope'] = array('email');
            $me = $this->facebook->api('/me?fields=id,name,email');
            $f_id=$me['id'];
            $fb_data=array(
                //'scope' => array('email'),
                'user_name' => $me['name'],
                'fb_token' => $me['id'],
                'user_email' => $me['email'],
            );

            $fb_id=$this->User->insert_fbuser($fb_data,$f_id);
            redirect('Userlogin/ids/'.$fb_id);

            // OR
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('/welcome/login'),
                'scope' => array("email") // permissions here
            ));
        }
        //$this->session->set_userdata('user_session',$fb_id);
        $this->load->view('user/headeruser');
        $this->load->view('fblogin',$data);
        $this->load->view('user/footer_user');
	}
    public function logout()
    {
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        redirect('welcome/login');
    }

}

