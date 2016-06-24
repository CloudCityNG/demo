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
        $this->load->model('Admin_Insert');

    }

    /**
     * go to the account user page
     * with respective user id
     * whitch comes form url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function account_user()            //user account
    {
        //if session is set
        if($this->session->userdata('user_session'))
        {
            //  $user_id=$this->uri->segment(3);
            $user_id=$this->session->userdata('user_session');
            $data['user_data'] = $this->User->user_account($user_id);
            $this->load->view('user/account_user', $data);
            $this->load->view('user/footer_user');
        }
        //session not set
        else
        {
            redirect('Userlogin/login');
        }
    }

    /**
     * redirect to home page
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function back_form_account()         //redirect to home page
    {
        redirect('home');
    }

    /**
     * go to the account user page
     * with respective user id
     * whitch comes form url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function address()                   //user address
    {
        // $user_id = $this->uri->segment(3);
        $user_id =$this->session->userdata('user_session');

        $this->load->view('user/headeruser');
        $this->load->view('user/address_user', $user_id);
        $this->load->view('user/footer_user');
    }

    /**
     * update user data if user change in personal data
     * with respective user id
     * whitch comes form url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function address_update()            //update address
    {
        // $id_user=$this->uri->segment(3);
        $id_user = $this->session->userdata('user_session');
        $data['address_all']=$this->User->fetch_address($id_user);
        $data['user_address'] = $this->User->update_address($id_user);
        $this->load->view('user/address',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * update or insert user address from address form
     * server side validation is perform on from
     * insert or update respected data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function change_address()            //update user address
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('address_2', 'address_2');
        $this->form_validation->set_rules('city', 'City', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('state', 'State', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('country', 'Country', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');
        //if error occurs
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/address');
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
            $data=array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zipcode' => $this->input->post('zipcode'),
                'user_id'=>$this->input->post('user_id')
            );
            //fetch user id
            $user_id=$this->input->post('user_id');
            $this->User->address_user($data,$user_id);
            redirect('Useraccount/account_user/'.$user_id);
        }
    }

    /**
     * update user personal data from account form
     * server side validation is perform on from
     * update respected data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function update_user()               //update user
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('user_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('user_status', 'Status', 'required');
        //if error occurs
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/account_user');
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
//            echo $x = $this->input->post('user_status');
            $data = array(
                'user_name' => $this->input->post('user_name'),
                'user_lastname' => $this->input->post('user_lastname'),
//                'user_password' => $this->input->post('user_password'),
                'user_email' => $this->input->post('user_email'),
                'user_status' => $this->input->post('user_status'),
            );
            //success msg
            $msg['msg']='Change Successfully Updated';
            $id=$this->session->userdata('user_session');
            $this->User->update_user($data,$id);
            $this->load->view('user/account_user',$msg);
            $this->load->view('user/footer_user');
        }
    }

    /**
     * go to password page
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function password_change()               // change Password page
    {
        $this->load->view('user/change_password');
        $this->load->view('user/footer_user');
    }

    /**
     * verify old password
     * validation apply on password form
     * change ol password and save change in database
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function verify_password()              // verify new password
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^[0-9]{6}$/]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[password]');
        //if error occurs
        if($this->form_validation->run()==False)
        {
            $this->load->view('user/change_password');
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
            $pass['old_password'] = array(
                'user_password' => $this->input->post('user_password'),
                'user_id' => $this->input->post('user_id'),
                );
            $this->User->password_verify($pass);
            $change_pass['change']="Password Successfully Change";
            $this->load->view('user/change_password',$change_pass);
        }
    }

    /**
     * if error occur between change password process
     * show appropriate msg
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function pass_error()                    //change password error
    {
        $wrong_pass['error']="Wrong Password";
        $this->load->view('user/change_password',$wrong_pass);
    }

    /**
     * go to contact page
     * where user enter query abut anything to admin
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function contact()                       //contact us
    {
        //$user_id=$this->uri->segment(3);
        $user_id = $this->session->userdata('user_session');
        $data['user_data']=$this->User->user_data($user_id);
        $this->load->view('user/contact_us',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * validated contact from ehicth filed by user
     * and send mail to respective admin
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function verify_contact()
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        //$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact_no', 'conatct', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('message', 'Subject', 'required');
        $this->form_validation->set_rules('note_admin', 'Message', 'required');
        //if error occurs
        if($this->form_validation->run()==False)
        {
            $user_id=$this->input->post('user_id');
            $data['user_data']=$this->User->user_data($user_id);
            $this->load->view('user/contact_us',$data);
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
            $msg = $this->input->post('message');
            $note_admin = $this->input->post('note_admin');
            $user = $this->input->post('user_name');
            $email= $this->input->post('user_email');
            $contact = $this->input->post('contact_no');
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
            //send mail to admin
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
            $msgdata = array(
                    'user' => $user,
                    'email' => $email,
                    'contact' => $contact,
                    'note_admin' => $note_admin
            );

    /*        $message = '


	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>



		<br>
		<div style="margin-left: 50px" >Dear Adminstrator :</div><br>
		<div style="margin-left: 50px" >Plsease check Below Details :</div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">Name</td>
					<td>'.$user.'</td>
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
				<td>'.$note_admin.'</td>
				</tr>
			</table>
		</div><br>

	</div>

	</body>
	</head>
	</html>
            ';
*/
            $email=$this->Admin_Insert->fetch_email();
            $this->email->initialize($this->config->item('email'));
            $this->email->set_newline("\r\n");
            $this->email->from($email); // change it to yours
            $this->email->to('sumit.desai@wwindia.com');// change it to yours
            $this->email->subject($msg);
            //call email template
            $body = $this->load->view('email/user_query',$msgdata,TRUE);
            $this->email->message($body);
            if ($this->email->send())
            {
            } else {
                show_error($this->email->print_debugger());
            }
            $data['user_data']=$this->User->user_data($user_id);
            //show success message to user
            $data['query']="Message Suucessfully Delevierd";
            $this->load->view('user/contact_us',$data);
        }
    }

    /**
     * go to admin replay page with admin answer
     * show user query and admin answer
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function admin_replay()
    {
        //user id fetch from url
        //$user_id=$this->uri->segment(3);
        $user_id = $this->session->userdata('user_session');
        //admin answer array
        $data['ans']=$this->User->replay_admin($user_id);
        $this->load->view('user/query_ans',$data);
        $this->load->view('user/footer_user');
    }

    /**
     * login user to show order status
     * login with user id and order id
     * and check status of product
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function login_order()
    {
        $email=$this->input->post('user_email');
        $id=$this->input->post('order_id');
        $status=$this->User->verify_order_id($email,$id);
        if($status == 1) {
            $data['status'] = $this->User->fetch_status($id);
            $this->load->view('user/login_order', $data);
            $this->load->view('user/footer_user');
        }else{
            $data['email']="";
            $data['pass']="";
            $this->load->view('user/track_order',$data);
            $this->load->view('user/footer_user');
        }
    }

    /**
     * show the status of order to user
     * whitch admin updated from admin end
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function track_order()
    {
        $id=$this->session->userdata('user_session');
        $data['status']=$this->User->fetch_status($id);
        $this->load->view('user/track_order',$data);
        $this->load->view('user/footer_user');
    }
    public function allorders()
    {
        $id=$this->session->userdata('user_session');
        $data['order_id']=$this->User->fetch_orderid($id);
        $this->load->view('user/my_orders',$data);
    }
    public function details()
    {
        $o_id=$this->uri->segment(3);
        $data['order_data']=$this->User->fetch_orderdata($o_id);
        $this->load->view('user/order_details',$data);
    }
    public function registration()
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
        $this->form_validation->set_rules('user_status', 'Status', 'required');
        $this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('address_2', 'address_2');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');

        //if error occurs
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/registration_form');
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
           $method=$this->input->post('method');
            if($method == 'fb') {
                $data = array(
                    'fb_token' => $this->input->post('token'),
                    'user_name' => $this->input->post('user_name'),
                    'user_lastname' => $this->input->post('user_lastname'),
                    'user_password' => $this->input->post('user_password'),
                    'user_email' => $this->input->post('user_email'),
                    'user_status' => $this->input->post('user_status'),
                    'registration_method' => $this->input->post('method')
                );

            }
            else{
                $data = array(
                    'google_token' => $this->input->post('token'),
                    'user_name' => $this->input->post('user_name'),
                    'user_lastname' => $this->input->post('user_lastname'),
                    'user_password' => $this->input->post('user_password'),
                    'user_email' => $this->input->post('user_email'),
                    'user_status' => $this->input->post('user_status'),
                    'registration_method' => $this->input->post('method')
                );
            }
            //success msg
            $msg['msg']='Change Successfully Updated';
            $user_id=$this->User->social_user_personaldata($data);

            $address=array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'zipcode' => $this->input->post('zipcode'),
                'user_id'=>$user_id
            );
            $this->User->social_user_addressdata($address,$user_id);
            $this->session->set_userdata('user_session', $user_id);
            $this->session->set_flashdata('msg3','Registration Successfull');
            redirect('home');
        }
    }
    public function new_address()
    {
        $user_id=$this->uri->segment(3);
        $this->load->view('user/new_address',$user_id);
        $this->load->view('user/footer_user');
    }
    public function update_newaddress()
    {
        $address_id=$this->uri->segment(3);
        $data['up_address']=$this->User->fetch_address_data($address_id);
        $this->load->view('user/new_address',$data);
        $this->load->view('user/footer_user');
    }
    public function delete_newaddress()
    {
        $address_id=$this->uri->segment(3);
        $this->User->delete_address($address_id);
        $user_id=$this->input->post('user_id');
        redirect('Useraccount/account_user/'.$user_id);
    }
    public function onther_address()
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('address_2', 'address_2');
        $this->form_validation->set_rules('city', 'City', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('state', 'State', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('country', 'Country', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');
        //if error occurs
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/new_address');
            $this->load->view('user/footer_user');
        }
        //if validation is successfull
        else
        {
            $data = array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zipcode' => $this->input->post('zipcode'),
                'user_id' => $this->input->post('user_id')
                );
            $this->User->add_newaddress($data);
            $user_id=$this->input->post('user_id');
            redirect('Useraccount/account_user/'.$user_id);
        }
    }
    public function update_address()
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('address_2', 'address_2');
        $this->form_validation->set_rules('city', 'City', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('state', 'State', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('country', 'Country', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');
        //if error occurs
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('user/new_address');
            $this->load->view('user/footer_user');
        }
        else
        {
            $address_id = $this->input->post('address_id');
            $data = array(
                'address_1' => $this->input->post('address_1'),
                'address_2' => $this->input->post('address_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zipcode' => $this->input->post('zipcode'),
                'user_id' => $this->input->post('user_id'),
            );
            $this->User->update_address_with_id($data,$address_id);
            $user_id=$this->input->post('user_id');
            redirect('Useraccount/account_user/'.$user_id);
        }
    }
    public function sales_report()
    {
            $data['year_graph'] = $this->User->get_data();
            $this->load->view('pract_chart',$data);
    }
    public function verify_email()
    {
        $u_id=$this->session->userdata('user_session');
        $email=$this->input->post('code');
        $verify=$this->User->email_verify($email,$u_id);
        if($verify == '1')
        {
            echo $verify;
            return true;
        }
        else{
            echo $verify;
        }
    }
}