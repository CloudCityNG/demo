<?php

class Orderadmin extends CI_Model
{

    /**
     * count total numbers of rows in user_order table
     * @return mixed
     */
    public function order_record_count()                      //count admin
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user','user.user_id=user_order.user_id');
        return $this->db->get()->num_rows();

    }

    /**
     * fetch all data about user order
     * data sort with both side sorting
     * @param $limit = limit of pagination
     * @param $page = selected page number
     * @return array|bool
     */
    public function fetch_order_data($limit, $page)           //pagination admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'order_id';    // sorting using data
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';// sorting type
        //pagination
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

    /**
     * search product on the basis of order_id,user_naem,status,grand_total
     * @param $order_search = keyword enter from front end
     * @return mixed
     */
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

    /**
     * order status change by admin form admin panale
     * if order status changed 1st time data inserted
     * else data update into table
     * @param $o_id = order id used for finding status
     * @param $data = $status- order current status
     *                $comment- admin note on customer status
     *                $modify_date- current date
     */
    public function order_update($o_id,$data)                   //update order status in order_status table
    {
        $this->db->where('order_id',$o_id);
        $x=$this->db->get('order_status')->num_rows();
        //if status already update
        if($x > 0)
        {
            $this->db->where('order_id', $o_id);
            $this->db->update('order_status', $data);
        }
        //if status change 1st time
        else
        {
            $this->db->insert('order_status',$data);
        }
    }

    /**
     * if admin update status that status update in user_order table
     * @param $o_id = order_id- specific order_id
     * @param $status = order status- admin change order status
     */
    public function order_status($o_id,$status)                 //update status in order_table
    {
        $this->db->where('order_id',$o_id);
        $this->db->update('user_order',$status);
    }

    /**
     * retrive information about order status
     * matching order id
     * @param $o_id = order_id
     * @return mixed
     */
    public function status($o_id)                               //retrview order_status
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('order_status')->result_array();
    }

    /**
     * fetch user id on the bases of order_id
     * @param $o_id-order_id
     * @return user_id
     */
    public function u_id($o_id)                                 //fetch user id
    {
        $this->db->select('user_id');
        $this->db->from('user_order');
        $this->db->where('order_id',$o_id);
        return $this->db->get()->row()->user_id;
    }

    /**
     * fetch user whole data personal as well as user address
     * @param $u_id-user_id
     * @return array - array of user personal details and user address
     */
    public function user_data($u_id)                            //fetch user personal data
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id',$u_id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch order data on the bases of order id
     * @param $o_id - order_id
     * @return array order_details
     */
    public function order_data($o_id)                           //fetch order data
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('user_order')->result_array();
    }

    /**
     * fetch user whole data personal as well as user address and user order
     * @param $u_id-user_id
     * @return mixed
     */
    public function shipping_data($u_id)                        //fetch user data adn approriate order data
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_address','user_address.user_id=user.user_id');
        $this->db->join('user_order','user_order.user_id=user.user_id');
        $this->db->where('user.user_id',$u_id);
        $query=$this->db->get()->result_array();
        return $query;
    }

    /**
     * get order details for completeing other payment details
     * @param $o_id=order_id
     * @return array
     */
    public function payment($o_id)                              //fetch order details
    {
        $this->db->select("*");
        $this->db->from('user_order');
        $this->db->where('order_id',$o_id);
        return $this->db->get()->result_array();
    }

    /**
     * fetch of user address from user address table
     * @param $u_id-user_id for matching user_address
     * @return mixed
     */
    public function user_address($u_id)
    {
        $this->db->where('user_id',$u_id);
        return $this->db->get('user_address')->result_array();
    }
}