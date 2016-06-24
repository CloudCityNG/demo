<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Admin_Insert');
        $this->load->model('cmsadmin');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }


    /**
     * display all register user list to admin
     * apply pagination on table data
     * apply both side sorting on columns
     * @data = content
     *         description
     *         title
     *         banner_image
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function index()                                 //view user data
    {
        //cehck session is set or not
        if($this->session->userdata('session')) {
            //fetch seeion id
            $x = $this->session->userdata('id');
            //fetch perpage set by admin
            $perpage = $this->Admin_Insert->fetch_perpage($x);
            //if not then set static 2 perpage
            if (empty($perpage))
            {
                $perpage = 2;
            }
            $data['customer'] = $this->Admin_Insert->list_user();
            $config = array();
            $config["base_url"] = base_url() . "admin/cms/index/";
            $total_row = $this->cmsadmin->cms_record_count();
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
            $data["cms"] = $this->cmsadmin->fetchcms_data($config["per_page"], $page);

            //both side sorting fro all columns
            $sortorder = 'DESC';
            if($this->input->get('sortorder') == 'DESC')
                $sortorder = 'ASC';

            $data["sortorder"] = $sortorder;
            $str_links = $this->pagination->create_links();
            $data["links"] = explode('&nbsp;', $str_links);         //generate links fro pagination
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('cms_list', $data);
        }
        //if session not set
        else
        {
            redirect('admin/login');
        }
    }
    /**
     * go to add cms page for new addition
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function add_cms()
    {
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('add_cms');
    }

    /**
     * add new cms data in table
     * server side validation is perfome on form
     * insert image add respective table
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function add()
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta-Description', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta-Keyword', 'required');
        //if error occurs
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('add_cms');
        }
        else
        {
            $file = $_FILES["banner_name"]["name"];
            $array = explode('.', $file);
            $fileName=$array[0];
            $fileExt=$array[1];
            $newfile=$fileName."_".time().".".$fileExt;

            //fetch session id
            $id = $this->session->userdata('id');
            //set image path
            $path = $_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/images/' . $newfile;
            //if image is persent insert in table
            if (move_uploaded_file($_FILES['banner_name']['tmp_name'], $path))
            {

                $upload = $newfile;
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keyword'),
                    'banner_name' => $upload,
                    'created_by' => $id
                );
                $this->cmsadmin->insert_csm($data);
                $this->session->set_flashdata('msg', 'Chages Successfull Done');
                redirect('admin/cms');
            }//end if - if data is persent
        }//end else
    }

    /**
     * go to edit cms page
     * with respective id comes form url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function edit_cms()
    {
        $cms_id=$this->uri->segment(4);
        $data['cms']=$this->cmsadmin->cms_edit($cms_id);
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('update_cms',$data);
    }

    /**
     * update cms data in databse
     * server side validation in perform here
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function update()
    {
        //server side validation
        $this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta-Description', 'required');
        $this->form_validation->set_rules('meta_keyword', 'Meta-Keyword', 'required');

        //if error is occurs
        if ($this->form_validation->run() == FALSE)
        {
            $c_id=$this->uri->segment(4);
            $this->load->view('header');
            $this->load->view('footer');
            $this->load->view('update_cms',$c_id);

        }
        else
        {
            $xi= $_FILES["banner_name"]["name"];
            $file= $_FILES["banner_name"]["name"];
            $array = explode('.', $file);
            $fileName=$array[0];
            $fileExt=$array[1];
            $newfile=$fileName."_".time().".".$fileExt;

            $x=$newfile;
            $id = $this->session->userdata('id');
            $path = $_SERVER['DOCUMENT_ROOT'] . '/CodeIgniter/images/' . $newfile;
            if(!empty($xi))
            {
                if (move_uploaded_file($_FILES['banner_name']['tmp_name'], $path))
                {
                   $upload = $newfile;
                    $data = array(
                        'title' => $this->input->post('title'),
                        'content' => $this->input->post('content'),
                        'meta_description' => $this->input->post('meta_description'),
                        'meta_keywords' => $this->input->post('meta_keyword'),
                        'banner_name' => $upload,
                        'modify_by' => $id,
                        'modify_date' => date('Y/M/D')
                    );
                    $ids = $this->input->post('id');
                   // echo $ids;
                    $this->cmsadmin->update_csm($ids, $data);
                    $this->session->set_flashdata('msg', 'Chages Successfull Done');
                    redirect('admin/cms');
                }
            }
            else{

                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keyword'),
                    'modify_by' => $id,
                    'modify_date' => date('Y/M/D')
                );
                $id = $this->input->post('id');
                $this->cmsadmin->update_csm($id, $data);
                $this->session->set_flashdata('msg', 'Chages Successfull Done');
                redirect('admin/cms');
            }
        }
    }

    /**
     * delete cms data
     * with respective id comes form url
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function delete_cms()
    {
        $cms_id=$this->uri->segment(4);
        $this->cmsadmin->cms_delete($cms_id);
        redirect('admin/cms');
    }

    /**
     * search user from user list
     * using search keyword witch come from front end
     * match keyword with all columns
     * apply sorting ojn all columns
     * @package CodeIgniter
     * @subpackage Controller
     * @author Sumit Desai
     */
    public function search_cms()
    {
        $cms_ser=$this->input->post('search');
        $cms_serach=trim($cms_ser);

        $data['cms']=$this->cmsadmin->cms_search($cms_serach);

        $sortorder = 'DESC';
        if($this->input->get('sortorder') == 'DESC')
            $sortorder = 'ASC';

        $data['sort']="sort";
        $data["sortorder"] = $sortorder;
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );
        $this->load->view('header');
        $this->load->view('footer');
        $this->load->view('cms_list',$data);
    }

}