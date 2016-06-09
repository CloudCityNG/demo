<?php

class Cmsadmin extends CI_Model
{
    /**
     * count total numbers of row in cms table
     * @return mixed
     */
    public function cms_record_count()
    {
        return $this->db->count_all('cms');
    }

    /**
     * display list of cms and details of cms
     * apply both side sorting for cms
     * @param $limit pagination limit of perpage
     * @param $page selected page
     * @return array|bool
     */
    public function fetchcms_data($limit, $page)           //pagignation cms
    {
        //sorting column if selected column den sort by that or default column title
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'title';
        //sorting default order is desc
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var, $order);
        $query = $this->db->get("cms");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    /**
     * insert cms data in database
     * @param $data = cms_image
     *                 title,metadescription
     *                 keywords,content
     */
    public function insert_csm($data)
    {
        $this->db->insert('cms',$data);
    }

    /**
     * go to the cms edit page
     * @param $cms_id-cms data id
     * @return mixed|array
     */
    public function cms_edit($cms_id)
    {
        $this->db->where('cms_id',$cms_id);
        return $this->db->get('cms')->result_array();
    }

    /**
     * update cms data in table from admin end
     * @param $id - selected cms row id
     * @param $data = cms_image
     *                 title,metadescription
     *                 keywords,content
     */
    public function update_csm($id,$data)
    {
        $this->db->where('cms_id',$id);
        $this->db->update('cms',$data);
    }

    /**
     * delete data from table
     * @param $id - selected cms_id fro deletion
     */
    public function cms_delete($id)
    {
        $this->db->where('cms_id',$id);
        $this->db->delete('cms');
    }

    /**
     * set cms data at home page
     * @return mixed
     */
    public function home_cms()
    {
        return $this->db->get('cms')->result_array();
    }

    /**
     * search related data of enter keyword from front end
     * @param $cms_search - enter keyword from front end
     * @return mixed
     */
    public function cms_search($cms_search)
    {
        //sorting column if selected column den sort by that or default column title
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'title';
        //sorting default order is desc
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
