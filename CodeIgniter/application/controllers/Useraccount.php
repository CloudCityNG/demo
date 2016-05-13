<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccount extends CI_Controller
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
    public function account_user()            //user account
    {
        if($this->session->userdata('user_session'))
        {
            $user_id=$this->uri->segment(3);
            $data['user_data'] = $this->User->user_account($user_id);
            $this->load->view('user/account_user', $data);
            $this->load->view('user/footer_user');}
        else{
            redirect('Userlogin/login');
        }
    }

    public function back_form_account()         //back to home
    {
        redirect('home');
    }

    public function address()                   //user address
    {
        $user_id = $this->uri->segment(3);
        $this->load->view('user/headeruser');
        $this->load->view('user/address_user', $user_id);
        $this->load->view('user/footer_user');
    }

    public function address_update()            //update address
    {
        $id_user=$this->uri->segment(3);
        $data['user_address'] = $this->User->update_address($id_user);
        $this->load->view('user/address',$data);
        $this->load->view('user/footer_user');
    }

    public function change_address()            //update user address
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('address_2', 'address_2');
        $this->form_validation->set_rules('city', 'City', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('state', 'State', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('country', 'Country', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('user/address');
            $this->load->view('user/footer_user');
        } else {
            $data=array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zipcode' => $this->input->post('zipcode'),
                'user_id'=>$this->input->post('user_id')
            );
            $user_id=$this->input->post('user_id');
            $this->User->address_user($data,$user_id);
            redirect('Useraccount/account_user/'.$user_id);
        }

    }

    public function update_user()               //update user
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('user_status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/account_user');
            $this->load->view('user/footer_user');
        } else {
            $data = array(

                'user_name' => $this->input->post('user_name'),
                'user_lastname' => $this->input->post('user_lastname'),
                'user_password' => $this->input->post('user_password'),
                'user_email' => $this->input->post('user_email'),
                'user_status' => $this->input->post('user_status'),

            );
            $msg['msg']='Change Successfully Updated';
            $id=$this->session->userdata('user_session');
            $this->User->update_user($data,$id);
            $this->load->view('user/account_user',$msg);
            $this->load->view('user/footer_user');
        }
    }

    public function password_change()               // change Password page
    {
        $this->load->view('user/change_password');
        $this->load->view('user/footer_user');
    }
    public function verify_password()              // verify new password
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^[0-9]{6}$/]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[password]');

        if($this->form_validation->run()==False)
        {
            $this->load->view('user/change_password');
            $this->load->view('user/footer_user');
        }
        else {
            $pass['old_password'] = array(
                'user_password' => $this->input->post('user_password'),
                'user_id' => $this->input->post('user_id'),
            );
            $this->User->password_verify($pass);
            $change_pass['change']="Password Successfully Change";
            $this->load->view('user/change_password',$change_pass);
        }
    }
    public function pass_error()                    //change password error
    {
        $wrong_pass['error']="Wrong Password";
        $this->load->view('user/change_password',$wrong_pass);
    }
    public function contact()                       //contact us
    {
        $user_id=$this->uri->segment(3);
        $data['user_data']=$this->User->user_data($user_id);
        $this->load->view('user/contact_us',$data);
        $this->load->view('user/footer_user');
    }
    public function verify_contact()
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        //$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact_no', 'conatct', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('message', 'Subject', 'required');
        $this->form_validation->set_rules('note_admin', 'Message', 'required');

        if($this->form_validation->run()==False)
        {
            $user_id=$this->input->post('user_id');

            $data['user_data']=$this->User->user_data($user_id);
            $this->load->view('user/contact_us',$data);
            $this->load->view('user/footer_user');
        }
        else{

            $message = $this->input->post('message');
            $note_admin = $this->input->post('note_admin');

            $data=array(

                'user_name'=>$this->input->post('user_name'),
                'user_email'=>$this->input->post('user_email'),
                'contact_no'=>$this->input->post('contact_no'),
                'message' => $this->input->post('message'),
                'note_admin' => $this->input->post('note_admin'),
                'created_by'=>$this->input->post('user_id')
            );
            $this->User->send_query($data);
            $user_id=$this->input->post('user_id');

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
            //$message = 'Welcome';

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('sumit.desai@wwindia.com'); // change it to yours
            $this->email->to('sumit.desai@wwindia.com');// change it to yours
            $this->email->subject($message);
            $this->email->message($note_admin);

            if ($this->email->send()) {
            } else {
                show_error($this->email->print_debugger());
            }
            $data['user_data']=$this->User->user_data($user_id);
            $data['query']="Message Suucessfully Delevierd";
            $this->load->view('user/contact_us',$data);
        }
    }
    public function admin_replay()
    {
        $user_id=$this->uri->segment(3);
        $data['ans']=$this->User->replay_admin($user_id);
        $this->load->view('user/query_ans',$data);
        $this->load->view('user/footer_user');
    }
}