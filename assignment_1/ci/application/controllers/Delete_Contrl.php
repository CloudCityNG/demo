<?php

class Delete_Contrl extends CI_Model
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('Datamodel');
    }
    public function index()
    {
        $product_id = $this->input->get('id', TRUE);
        $data['customer']=$this->Datamodel->delet($product_id);
        $this->load->view('exam',$data);
    }

}