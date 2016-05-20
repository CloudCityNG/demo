<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->model('orderadmin');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));

    }
    public function index()                                 //view user data
    {
        if($this->session->userdata('session')) {

            $x = $this->session->userdata('id');

            $perpage = $this->Admin_Insert->fetch_perpage($x);

            if (empty($perpage)) {
                $perpage = 2;
            }
            $config = array();
            $config["base_url"] = base_url() . "admin/orders/index/";
            $total_row = $this->orderadmin->order_record_count();
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
                $page = ($this->uri->segment(4));
            } else {
                $page = 1;
            }
            $data["order"] = $this->orderadmin->fetch_order_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);

            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('orders', $data);
        }
        else{
            redirect('admin/login');
        }

    }
    public function search_order()                          //search admin_user data
    {
        $order_ser=$this->input->post('search');
        $order_search=trim($order_ser);
        $data['order']=$this->orderadmin->order_search($order_search);

        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';

        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('orders',$data);
    }
    public function view_order()
    {
        $o_id=$this->uri->segment(4);
        $data['id']=$o_id;
        $data['status']=$this->orderadmin->status($o_id);
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_orders', $data);
    }
    public function update_order()
    {
        $o_id=$this->input->post('hidden');
        $comment= $this->input->post('comment');

        $status=array(
            'status' => $this->input->post('order_status'),
        );

        $this->orderadmin->order_status($o_id,$status);

        $data=array(
            'status' => $this->input->post('order_status'),
            'comment'=> $this->input->post('comment'),
            'order_id' =>$this->input->post('hidden'),
            'modify_date'=> date('y/m/d')
        );

        $this->orderadmin->order_update($o_id,$data);


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
        $message = $comment;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('sumit.desai@wwindia.com'); // change it to yours
        $this->email->to('sumit.desai@wwindia.com');// change it to yours
        $this->email->subject('About Product Status');
        $this->email->message($message);
        if ($this->email->send()) {
            redirect('admin/orders');

        } else {
            show_error($this->email->print_debugger());
        }
    }
    public function edit_order()
    {
        $u_id=$this->session->userdata('user_session');
        $o_id=$this->uri->segment(4);

        $data['customer']=$this->orderadmin->user_data($u_id);
        $data['order']=$this->orderadmin->order_data($o_id);


        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_orderdetails', $data);
    }

}