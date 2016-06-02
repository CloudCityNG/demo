<?php

class Couponmgmt extends CI_Model
{

    public function record_count_coupon()                      //count coupons
    {
        return $this->db->count_all("coupon");
    }
    public function fetch_coupon_data($limit, $page)           //pagignation images
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'code';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var,$order);
        $query = $this->db->get("coupon");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return false;
    }
    public function delete_coupon()                         //delete img
    {
        $getid = $this->input->get('coupon_id');
        $this->db->where('coupon_id', $getid);
        $this->db->delete('coupon');
    }
    public function insert($data)
    {
        $this->db->insert('coupon',$data);
    }
    public function discount_off($off)
    {

        $this->db->select('percent_off');
        $this->db->where('code',$off);
        $query=$this->db->get('coupon')->num_rows();
        if($query > 0 )
        {
            $this->db->select('percent_off');
            $this->db->where('code',$off);
            return $this->db->get('coupon')->row()->percent_off;
        }
        else{
            return null;
        }
    }
    public function code_id($off)
    {
        $this->db->select('coupon_id');
        $this->db->where('code',$off);
        $query=$this->db->get('coupon')->num_rows();
        if($query > 0 ) {
            $this->db->select('coupon_id');
            $this->db->where('code', $off);
            return $this->db->get('coupon')->row()->coupon_id;
        }
        else{
            return null;
        }
    }

    public function uses($c_id,$user_id,$coupon_data)
    {
        $this->db->where('coupons_id',$c_id);
        $this->db->where('user_id',$user_id);

        $query=$this->db->get('coupons_used')->num_rows();
        if($query == 0)
        {

            $this->db->insert('coupons_used',$coupon_data);
            return $this->db->insert_id();
        }
        else{
            return 0;
        }
    }
    public function update_used_coupon($order_id,$c_id)
    {
        $this->db->where('coupons_id',$c_id);
        $this->db->update('coupons_used',$order_id);
    }
    public function show_coupon()
    {
        $this->db->select('*');
        $this->db->from('coupons_used');
        $this->db->join('coupon','coupon.coupon_id=coupons_used.coupons_id');
        return $this->db->get()->result_array();
        var_dump($query);
    }
}
