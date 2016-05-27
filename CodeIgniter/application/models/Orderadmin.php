<?php

class Orderadmin extends CI_Model
{

    public function order_record_count()                      //count admin
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user','user.user_id=user_order.user_id');
        return $this->db->get()->num_rows();

    }
    public function fetch_order_data($limit, $page)           //pagignation admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'order_id';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $offset = ($page - 1) * $limit;
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user','user.user_id=user_order.user_id');
        $this->db->limit($limit, $offset);
        $this->db->order_by($var, $order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function order_search($order_search)
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'order_id';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user','user.user_id=user_order.user_id');
        $this->db->like('order_id',$order_search);
        $this->db->or_like('user_name',$order_search);
        $this->db->or_like('status',$order_search);
        $this->db->or_like('grand_total',$order_search);
        $this->db->order_by($var, $order);
        $query = $this->db->get();
        $x=$query->result_array();
        return $x;
    }
    public function order_update($o_id,$data)
    {
        $this->db->where('order_id',$o_id);
        $x=$this->db->get('order_status')->num_rows();
        if($x > 0) {
            $this->db->where('order_id', $o_id);
            $this->db->update('order_status', $data);
        }else{
            $this->db->insert('order_status',$data);
        }
    }
    public function order_status($o_id,$status)
    {
        $this->db->where('order_id',$o_id);
        $this->db->update('user_order',$status);
    }
    public function status($o_id)
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('order_status')->result_array();
    }
    public function u_id($o_id)
    {
        $this->db->select('user_id');
        $this->db->from('user_order');
        $this->db->where('order_id',$o_id);
        return $this->db->get()->row()->user_id;
    }
    public function user_data($u_id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_address','user_address.user_id=user.user_id');
        $this->db->where('user.user_id',$u_id);
        return $this->db->get()->result_array();
    }
    public function order_data($o_id)
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('user_order')->result_array();

    }

}