<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
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
     * apply pagination on category lisr
     * apply sorting on category list
     * display category date
     * $category = category_name
     *             category_id
     *             category_parent_is
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()                                 //view category list
    {
        //check sesion is set or not
        if($this->session->userdata('session'))
        {
            //get admin_id using session
            $x=$this->session->userdata('id');
            //fetch paerpage set by respective admin
            $perpage=$this->Admin_Insert->fetch_perpage($x);
            $config = array();
            $config["base_url"] = base_url()."admin/category/index/";//set url for pagination
            $total_row = $this->Admin_Insert->category_list();
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
            $data["category"] = $this->Admin_Insert->fetch_data_from_category($config["per_page"], $page);
            $sortorder = 'DESC';                                       //set default sorting tying
            if($this->input->get('sortorder') == 'DESC')               //change sorting order
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;                            //set chaneg sorting order
            $str_links = $this->pagination->create_links();             //generate link
            $data["links"] = explode('&nbsp;',$str_links );
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('category_mgmt',$data);
        }
        //if session is not set
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * search category on the bases of category_id,parent_id,category_name
     * apply sorting on searched data
     * $category = category_name
     *             category_id
     *             parent_id
     * $category_ser = search is a keywords enter from front end
     * $category_search = trim search data
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function search_category()                                   //search category data
    {
        $category_ser=$this->input->post('search');
        $category_search=trim($category_ser);
        $data['category']=$this->Admin_Insert->category_search($category_search);
        $str_links = $this->pagination->create_links();                  //generate link
        $data["links"] = explode('&nbsp;',$str_links );

        $sortorder = 'DESC';                                             //set default sorting tying
        if($this->input->get('sortorder') == 'DESC')                     //change sorting order
            $sortorder = 'ASC';                                          //set change sorting order

        $data["sortorder"] = $sortorder;
        $data['sort']='sort';
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('category_mgmt',$data);

    }

    /**
     * go to add category page
     * $category = all category list
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function add_category()
    {
        if ($this->session->userdata('session'))
        {
            $data['category'] = $this->Admin_Insert->categoryall();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_category', $data);
        }
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * add category in category list
     * $id = admin_id from user session
     * $cat_name = category name form available category list
     * if cat_name = not then new category is parent category
     * if any category id present added new category is subcategory of that appropriate selected parent category
     * validation of new category
     * $data = category_name new category_name
     *         parent id if category is sub category of any categpry then apply parent_id of that category
     *         created_by = admin_id who create new category
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function insert_category()
    {
        //admin_id get from session
        $id=$this->session->userdata('id');
        //selected category from category list
        $cat_name=$this->input->post('category');
        //check new category follow any parent category or not
        //if yes then apply parent id to new created category
        if( $cat_name !='not')
        {
            $cat_id=$this->Admin_Insert->cat($cat_name);
        }
        //else set parent id = 0
        else
        {
            $cat_id = 0;
        }
        //validation on new enter category name
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[1]|max_length[15]');
        //if any error then display appropriate error message
        if ($this->form_validation->run() == FALSE)
        {
            $data['category'] = $this->Admin_Insert->categoryall();
            $this->load->view('header');$this->load->view('footer');

            $this->load->view('add_category',$data);
        }
        //else insert data in database
        else
        {
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'parent_id' => $cat_id,
                'created_by'=>$id
            );
            $this->Admin_Insert->category_insert($data);
            redirect('admin/category');
        }
    }

    /**
     * go to the edit category data page
     * $category = category_name
     *             parent category
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function edit_category()
    {
        //check session is set or not
        if ($this->session->userdata('session'))
        {
            $data['category'] = $this->Admin_Insert->categoryall();
            $id=$this->uri->segment(4);
            $data['categor']=$this->Admin_Insert->category_edit($id);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_category',$data);
        }
        //if not set redirect to login page
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * update category from database
     * $id = admin_id
     * $cat_name = category name form available category list
     * if cat_name = not then new category is parent category
     * if any category id present added new category is subcategory of that appropriate selected parent category
     * validation of new category
     * $data = category_name new category_name
     *         parent id if category is sub category of any categpry then apply parent_id of that category
     *         created_by = admin_id who create new category
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function update_category()
    {
        //admin_id get from session
        $id=$this->session->userdata('id');
        //selected category from category list
        $cat_name=$this->input->post('category');
        //check new category follow any parent category or not
        //if yes then apply parent id to new created category
        if( $cat_name !='not')
        {
            $cat_id=$this->Admin_Insert->cat($cat_name);
        }
        //else set parent id = 0
        else
        {

            $cat_id = 0;
        }
        //validation on new enter category name
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[1]|max_length[50]');
        //if any error then display appropriate error message
        if ($this->form_validation->run() == FALSE)
        {
            $data['category'] = $this->Admin_Insert->categoryall();
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_category',$data);
        }
        //else insert data in database
        else
        {
            $data = array(
                'category_name' => $this->input->post('category_name'),
                'parent_id' => $cat_id,
                'modify_by'=>$id,
                'modify_date'=>date('Y/m/d')
            );
            $cate_id=$this->input->post('hidden');
            $this->Admin_Insert->category_update($data,$cate_id);
            redirect('admin/category');
        }
    }

}