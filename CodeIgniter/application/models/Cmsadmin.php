<?php

class Cmsadmin extends CI_Model
{
    public function cms_record_count()
    {
        return $this->db->count_all('cms');
    }
    public function fetchcms_data($limit, $page)           //pagignation admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'title';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var, $order);
            $query = $this->db->get("cms");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }

                return $data;
            }
            return false;

    }
    public function insert_csm($data)
    {
        $this->db->insert('cms',$data);
    }
    public function cms_edit($cms_id)
    {
        $this->db->where('cms_id',$cms_id);
        return $this->db->get('cms')->result_array();
    }
    public function update_csm($id,$data)
    {
        $this->db->where('cms_id',$id);
        $this->db->update('cms',$data);
    }
    public function cms_delete($id)
    {
        $this->db->where('cms_id',$id);
        $this->db->delete('cms');
    }
    public function home_cms()
    {
        return $this->db->get('cms')->result_array();

    }
    public function cms_search($cms_search)
    {
        echo $cms_search;
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'title';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('title',$cms_search);
        $this->db->or_like('content',$cms_search);
        $this->db->or_like('meta_description',$cms_search);
        $this->db->or_like('meta_keywords',$cms_search);
        $this->db->order_by($var, $order);
        $query = $this->db->get('cms');
        $x=$query->result_array();
        return $x;
    }

}
