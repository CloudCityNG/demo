<?php

class Bannermgmt extends CI_Model
{


    public function record_count_banner()                      //count images
    {
        return $this->db->count_all("banner");
    }

    public function fetch_banner_data($limit, $page)           //pagignation images
    {


        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'banner';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';


        $offset = ($page - 1) * $limit;
        $this->db->where('banner_id !=',7);
        $this->db->limit($limit, $offset);
        $this->db->order_by($var,$order);
        $query = $this->db->get("banner");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }

    public function img_edit()                          //edit img
    {
        $img_id = $this->input->get('banner_id');
        $this->db->where('banner_id', $img_id);
        $query = $this->db->get('banner');
        $query_result = $query->result();
        return $query_result;
    }

    public function image_update($data)                  //update img
    {
        $getid = $this->input->get('banner_id');
        $this->db->where('banner_id', $getid);
        $this->db->update('banner', $data);
    }

    public function img_delete()                         //delete img
    {
        $getid = $this->input->get('banner_id');
        $this->db->where('banner_id', $getid);
        $this->db->delete('banner');
    }

    public function search_image($image_search)
    {

        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'banner';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $this->db->like('banner', $image_search);
        $this->db->order_by($var,$order);
        $query = $this->db->get('banner');
        $x = $query->result_array();
        return $x;
    }

    public function img_detalis()                      //img details
    {
        $img_id = $this->input->get('banner_id');
        $this->db->where('banner_id', $img_id);
        $query = $this->db->get('banner');
        $query_result = $query->result();
        return $query_result;
    }

    public function update_banner($data)                //insert new banner
    {
        $this->db->insert('banner', $data);
    }

    public function home_banner()                       //change home banner
    {
        return $this->db->get('banner')->result_array();
    }

    public function single_banner()
    {
        $id=5;
        $this->db->where('banner_id',$id);
    }

}