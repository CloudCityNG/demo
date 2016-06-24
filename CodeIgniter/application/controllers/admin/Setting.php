<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
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
     * admin setting
     * admin set perpage of list of table from admin side
     * each admin can set differnt perpage
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()                                       //setting
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
        $msg['msg']='Change Successsfully Done';
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
    public function change_email()
    {
        //  $id=$this->session->userdata('id');
        $data=array(
            'setting_email'=>$this->input->post('admin_email')
        );
        $this->Admin_Insert->set_mail($data);
        $msg['msg']='E-mail Successsfully Change';
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('setting',$msg);
    }

}
