<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
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
    public  function index()
    {
        if($this->session->userdata('session'))
        {
            $data['product']=$this->Admin_Insert->list_product();
            $x=$this->session->userdata('id');
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/product/index";
            $total_row = $this->Admin_Insert->record_count_product();
            $config["total_rows"] = $total_row;
            $config["per_page"] = $perpage;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';
            $this->pagination->initialize($config);
            if($this->uri->segment(4))
            {
                $page = ($this->uri->segment(4));
            }
            else
            {
                $page = 1;
            }
            $data['product'] = $this->Admin_Insert->fetch_product_data($config["per_page"], $page);
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('view_product',$data);
        }
        else
        {
            redirect('admin/login');
        }
    }
    public function add_product()                     //new product
    {
        if($this->session->userdata('session')){

            $data['category']=$this->Admin_Insert->categoryall();

            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_product',$data);}
        else{

            redirect('admin/login');
        }
    }
    public function insert_product()                    //insert_product
    {
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('sku', 'SKU', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('short_description', 'Short_Description', 'required');
        $this->form_validation->set_rules('long_description', 'Breif Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('special_price', 'Special Price', 'required');
        $this->form_validation->set_rules('special_price_from', 'special_price_from', 'required');
        $this->form_validation->set_rules('special_price_to', 'special_price_to', 'required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('quntity', 'Quntity', 'required|numeric');
        $this->form_validation->set_rules('meta_title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('meta_description', 'Meta_Description', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta_keywords', 'required');
        $this->form_validation->set_rules('product_status','Status','required');


        if ($this->form_validation->run() == FALSE){

            $this->load->view('header');
            $this->load->view('footer');
            $data['category']=$this->Admin_Insert->categoryall();
            $this->load->view('add_product',$data);
        }
        else
        {
            $id = $this->session->userdata('id');
            $data= array(

                'name' => $this->input->post('name'),
                'sku' => $this->input->post('sku'),
                'short_description' => $this->input->post('short_description'),
                'long_description' => $this->input->post('long_description'),
                'price' => $this->input->post('price'),
                'special_price' => $this->input->post('special_price'),
                'special_price_form' => $this->input->post('special_price_from'),
                'special_price_to' => $this->input->post('special_price_to'),
                'status' => $this->input->post('status'),
                'quntity' => $this->input->post('quntity'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'product_status' => $this->input->post('product_status'),
                'created_by'=>$id

            );
            $prod=$this->Admin_Insert->product_insert($data);

            $category_name=$this->input->post('category');

            $catid=$this->Admin_Insert->cat($category_name);

            $pro_cat=array(
                'category_id'=>$catid,
                'product_id'=>$prod
            );
            $this->Admin_Insert->product_category($pro_cat);


            foreach($_FILES['image_name']['tmp_name'] as $key => $tmp_name ) {
                $file_name = $key . $_FILES['image_name']['name'][$key];
                //  $file_size =$_FILES['files']['size'][$key];
                $file_tmp = $_FILES['image_name']['tmp_name'][$key];
                //   $file_type=$_FILES['files']['type'][$key];

                $path = $_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/images/' . $file_name;


                //  $path =$_SERVER['DOCUMENT_ROOT'].'/CodeIgniter/images/'.$_FILES['image_name']['name'];

                if (move_uploaded_file($file_tmp, $path))
                {

                    $uploed = $file_name;
                    $img = array(
                        'image_name' => $uploed,
                        'product_id' => $prod
                    );
                    $this->Admin_Insert->upload_img($img);

                    $this->session->set_flashdata('msg', 'New Product Added Successfully');

                }
                else{
                    echo "Error";
                }
            }redirect('admin/product/');
        }
    }
    public function delete_product()                    //delet product
    {
        $this->Admin_Insert->product_delete();
        redirect('admin/product/');
    }
    public function edit_product()                        //edit_product
    {
        $data['edit_productdata']=$this->Admin_Insert->product_edit();
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_product',$data);
    }
    public function product_update()                        //update product
    {

        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Firstname', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('sku', 'SKU', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('short_description', 'Short_Description', 'required');
        $this->form_validation->set_rules('long_description', 'Breif Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('special_price', 'Special Price', 'required');
        $this->form_validation->set_rules('special_price_form', 'special_price_from', 'required');
        $this->form_validation->set_rules('special_price_to', 'special_price_to', 'required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('quntity', 'Quntity', 'required|numeric');
        $this->form_validation->set_rules('meta_title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('meta_description', 'Meta_Description', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta_keywords', 'required');
        $this->form_validation->set_rules('product_status','Status','required');

        if ($this->form_validation->run() == FALSE){
            //$data['cut']=$this->insert_admin->fetch();

            $p_id=$this->uri->segment(3);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_product',$p_id);
        }
        else
        {
            $id = $this->session->userdata('id');
            $prod_id=$this->input->post('prod_id');
            $data= array(

                'name' => $this->input->post('name'),
                'sku' => $this->input->post('sku'),
                'short_description' => $this->input->post('short_description'),
                'long_description' => $this->input->post('long_description'),
                'price' => $this->input->post('price'),
                'special_price' => $this->input->post('special_price'),
                'special_price_form' => $this->input->post('special_price_from'),
                'special_price_to' => $this->input->post('special_price_to'),
                'status' => $this->input->post('status'),
                'quntity' => $this->input->post('quntity'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('meta_description'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'product_status' => $this->input->post('product_status'),
                'modified_date'=>date('Y/m/d'),
                'modified_by'=>$id
            );
            $this->Admin_Insert->update($prod_id,$data);

            $path =$_SERVER['DOCUMENT_ROOT'].'/CodeIgniter/images/'.$_FILES['image_name']['name'];

            if(move_uploaded_file($_FILES['image_name']['tmp_name'], $path )) {
                $upload = $_FILES['image_name']['name'];
                echo "asdasd".$path;
                $img = array(
                    'image_name' => $upload,
                    'modify_date'=>date('Y/m/d'),
                    'modify_by'=>$id
                );
                var_dump($img);
                $this->Admin_Insert->from_image_update($prod_id,$img);
                redirect('admin/product/');
             }
        }
    }
    public function search_product()                        //serach product
    {
        $product_ser=$this->input->post('search');
        $product_serach=trim($product_ser);
        $data['product']=$this->Admin_Insert->product_search($product_serach);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('view_product',$data);
    }
    public function view_product_details()                  //product_details
    {
        $id=$this->uri->segment(4);
        $data['details']=$this->Admin_Insert->product_details($id);
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('product_details',$data);
    }

}