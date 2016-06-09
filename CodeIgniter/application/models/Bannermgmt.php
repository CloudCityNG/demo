<?php

class Bannermgmt extends CI_Model
{

    /**
     * count total numbers of row in banner table
     * @return mixed
     */
    public function record_count_banner()                      //count images
    {
        return $this->db->count_all("banner");
    }

    /**
     * display list of banners and details of banner
     * apply both side sorting for banner
     * @param $limit pagination limit og perpage
     * @param $page selected page
     * @return array|bool
     */
    public function fetch_banner_data($limit, $page)           //pagignation images
    {
        //sorting column if selected column den sort by that or default column banner
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'banner';
        //sorting default order is desc
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->where('banner_id !=',7);
        $this->db->limit($limit, $offset);
        $this->db->order_by($var,$order);
        $query = $this->db->get("banner");
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
     * fetch data of selected image whitch select for updatetion
     * @return mixed|array
     */
    public function img_edit()                          //edit img
    {
        //fetch iimage id for matching
        $img_id = $this->input->get('banner_id');
        $this->db->where('banner_id', $img_id);
        $query = $this->db->get('banner');
        $query_result = $query->result();
        return $query_result;
    }

    /**
     * update new image in databse
     * @param $data = banner_id
     */
    public function image_update($data)                  //update img
    {
        $getid = $this->input->get('banner_id');
        $this->db->where('banner_id', $getid);
        $this->db->update('banner', $data);
    }

    /**
     * delete image from database
     * selected image id get from front end
     * by get method
     */
    public function img_delete()                         //delete img
    {
        $getid = $this->input->get('banner_id');
        $this->db->where('banner_id', $getid);
        $this->db->delete('banner');
    }

    /**
     * search related data from table
     * @param $image_search = keyword comes from front end
     * @return mixed|array
     */
    public function search_image($image_search)
    {
        //sorting column if selected column den sort by that or default column banner
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'banner';
        //sorting default order is desc
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $this->db->like('banner', $image_search);
        $this->db->order_by($var,$order);
        $query = $this->db->get('banner');
        $x = $query->result_array();
        return $x;
    }

    /**
     * show image details to admin
     * @return mixed|array
     */
    public function img_detalis()                      //img details
    {
        $img_id = $this->input->get('banner_id');
        $this->db->where('banner_id', $img_id);
        $query = $this->db->get('banner');
        $query_result = $query->result();
        return $query_result;
    }

    /**
     * insert new banner data in table
     * @param $data=banner_images
     *              banner_id
     */
    public function update_banner($data)                //insert new banner
    {
        $this->db->insert('banner', $data);
    }

    /**
     * fetch banners for display on home page
     * not a slider banner
     * @return mixed|array
     */
    public function home_banner()                       //change home banner
    {
        return $this->db->get('banner')->result_array();
    }

    /**
     * show signle banner which id is 5
     */
    public function single_banner()
    {
        $id=5;
        $this->db->where('banner_id',$id);
    }

}