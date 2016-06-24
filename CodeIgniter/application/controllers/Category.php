<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User');
        $this->load->model('Admin_Insert');
        $this->load->model('Bannermgmt');
        $this->load->model('cmsadmin');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');
    }
    /**
     * after select category show specific product of that category
     * and shoe also sub category of selected category
     * get selected category id using url
     * @product data = image,name.price
     * @cms = cms_images,cms_content,cms_title,cms_discribtion
     * @category = category list
     * @banner = banner images
     * @recommend = recently add product
     * #model = user,bannermgmt,category,cmsadmin,
     * @return @data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()
    {
        $category = $this->uri->segment(3);

        $config = array();
        $config["base_url"] = base_url()."/category/index/".$category;
        $total_row = $this->User->record_cat_count($category);
        $config["total_rows"] = $total_row;
        $config["per_page"] = 3;
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
        //redirect('category/sub/'.$config['per_page']."/".$page."/".$category);
        $data['product'] = $this->User->data($config["per_page"], $page, $category);
        $data['categorys'] = $this->User->home_category();              //fetch images and content of cms
        $data['cms'] = $this->cmsadmin->home_cms();                     //fetch list of category
        $data['banner'] = $this->Bannermgmt->home_banner();             //fetch images of banner
        $data['category'] = $this->User->select_cat($category);         //sub category block for show sub-category
        $data['slider'] = "";
        $str_links = $this->pagination->create_links();               //generate link for pagination
        $data["links"] = explode('&nbsp;', $str_links);
        $this->load->view('user/headeruser');
        $this->load->view('user/home', $data);
        $this->load->view('user/footer_user');
    }
}