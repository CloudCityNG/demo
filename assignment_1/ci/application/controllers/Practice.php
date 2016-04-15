<?php

class Practice extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('Datamodel');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['customer']=$this->Datamodel->show_data();
        $this->load->view('exam',$data);
    }
    public function deleteall()
    {
       $data['customer']= $this->Datamodel->deleteall_data();
        $this->load->view('exam',$data);
    }
    public function delete()
    {
        $product_id = $this->input->get('id', TRUE);
        $this->Datamodel->delet($product_id);
        redirect('Practice/index');
    }
    public function search()
    {
        $keyword=$this->input->post('keyword');
        $data['customer']= $this->Datamodel->search_data($keyword);
        $this->load->view('exam',$data);
    }
    public function edit()
    {
        $product_id = $this->input->get('id', TRUE);
        $data['user']=$this->Datamodel->edit($product_id);
        $this->load->view('editform',$data);
    }
    public function update()
    {
        $product_id = $this->input->get('id', TRUE);
        $data= array(
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            'phone_no' => $this->input->post('phone'),
            'office_no' => $this->input->post('office'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'gender' => $this->input->post('gender'),
            'age' => $this->input->post('age'),
            'pincode' => $this->input->post('pincode'),
            'aboutus' => $this->input->post('about')
        );
        $this->Datamodel->update_data($product_id,$data);
        redirect('Practice/index');
    }
    public function entry()
    {
        //$data['first']=[];
        $this->load->view('entryform');
    }
    public function insert()
    {

            $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
            $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
            $this->form_validation->set_rules('compass', 'Confirm Password', 'required');
            $this->form_validation->set_rules('age', 'Age', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'required|regex_match[/^[0-9A-Za-z]{6}$/]');
            $this->form_validation->set_rules('about', 'Aboutus', 'required|min_length[5]|max_length[15]');
        if ($this->form_validation->run() == FALSE) {
            $data['first']=$this->input->post('firstname');
            $this->load->view('entryform',$data);
        } else {
        $data= array(
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            'phone_no' => $this->input->post('phone'),
            'office_no' => $this->input->post('office'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'gender' => $this->input->post('gender'),
            'age' => $this->input->post('age'),
            'pincode' => $this->input->post('pincode'),
            'aboutus' => $this->input->post('about')
        );
        $this->Datamodel->insert_data($data);
        $this->load->view('entryform');
        }
    }
    public function viewall()
    {
        $this->load->view('exam');
    }
    public function sort()
    {
        $var=$this->input->get('sortby');
        $data['customer']=$this->Datamodel->sort_data($var);
        $this->load->view('exam',$data);
    }

    public function contact_info(){
        $config = array();
        $config["base_url"] = base_url()."pagination_controller/contact_info";
        $total_row = $this->Datamodel->record_count();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 1;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }
        else{
            $page = 1;
        }
        $data["results"] = $this->Datamodel->fetch_data($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["customer"] = explode('&nbsp;',$str_links );

// View data according to array.
        $this->load->view("exam", $data);
    }


//    function deleteUser($data)
//    {
//        if ($data) {
//            for ($i = 0; $i <= count($data); $i++)
//            {
//                $this->db->where('id', $data[$i]);
//                $this->db->delete('users');
//            }
//        }




    }