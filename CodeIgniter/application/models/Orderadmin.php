<?php

class Orderadmin extends CI_Model
{

    /**
     * count total numbers of rows in user_order table
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function order_record_count()                      //count admin
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user_address','user_address.address_id=user_order.billing_address_id');
        return $this->db->get()->num_rows();

    }

    /**
     * fetch all data about user order
     * data sort with both side sorting
     * @param $limit(int) = limit of pagination
     * @param $page (int)= selected page number
     * @return array|bool
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    /*public function fetch_order_data($limit, $page)           //pagination admin
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
    */

    public function fetch_order_data($limit, $page)           //pagination admin
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'order_id';    // sorting using data
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';// sorting type
        //pagination
        $offset = ($page - 1) * $limit;
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user_address','user_address.address_id=user_order.billing_address_id');
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
     * @param $order_search(string) = keyword enter from front end
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function order_search($order_search)
    {
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'order_id';
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';

        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user_address','user_address.address_id=user_order.billing_address_id');
        $this->db->like('order_id',$order_search);
        $this->db->or_like('address_1',$order_search);
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
     * @param $o_id(int) = order id used for finding status
     * @param $data = $status(ENUM)- order current status
     *                $comment(string)- admin note on customer status
     *                $modify_date(date)- current date
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
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
     * @param $o_id(int) = order_id- specific order_id
     * @param $status(ENUM) = order status- admin change order status
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function order_status($o_id,$status)                 //update status in order_table
    {
        $this->db->where('order_id',$o_id);
        $this->db->update('user_order',$status);
    }

    /**
     * retrive information about order status
     * matching order id
     * @param $o_id(int) = order_id
     * @return mixed(array)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function status($o_id)                               //retrview order_status
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('order_status')->result_array();
    }

    /**
     * fetch user id on the bases of order_id
     * @param $o_id (int)-order_id fro find user id
     * @return user_id(int)
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
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
     * @param $u_id (int)-user_id serach fro user data
     * @return array - array of user personal details and user address
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
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
     * @param $o_id(int) - order_id search  particular order data
     * @return array order_details
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function order_data($o_id)                           //fetch order data
    {
        $this->db->where('order_id',$o_id);
        return $this->db->get('user_order')->result_array();
    }

    /**
     * fetch user whole data personal as well as user address and user order
     * @param $u_id(int)-user_id search user data
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function shipping_data($o_id)                        //fetch user data adn approriate order data
    {
        $this->db->select('*');
        $this->db->from('user_order');
        $this->db->join('user_address','user_address.address_id=user_order.shopping_address_id');
        //$this->db->join('user_order','user_order.user_id=user.user_id');
        $this->db->where('user_order.order_id',$o_id);
        return $this->db->get()->result_array();
    }

    /**
     * get order details for completeing other payment details
     * @param $o_id (int)=order_id search order data
     * @return array
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
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
     * @param $u_id(int) -user_id for matching user_address
     * @return mixed
     * @package CodeIgniter
     * @subpackage Model
     * @author Sumit Desai
     */
    public function user_address($u_id)
    {
        $this->db->where('user_id',$u_id);
        return $this->db->get('user_address')->result_array();
    }
    public function fetch_date_may()
    {
        $first_date='2016-05-01 00:00:00';
        $second_date='2016-05-31 00:00:00';
        $this->db->select('grand_total');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        $this->db->where('shopping_method','PAYPAL');
        return $this->db->get()->result_array();
    }
    public function fetch_date_may_cod()
    {
        $first_date='2016-05-01 00:00:00';
        $second_date='2016-05-31 00:00:00';
        $this->db->select('grand_total');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        $this->db->where('shopping_method','COD');
        $this->db->where('status','Complete');
        return $this->db->get()->result_array();
    }

    public function fetch_date_jun()
    {
        $first_date='2016-06-01 00:00:00';
        $second_date='2016-06-31 00:00:00';
        $this->db->select('grand_total');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        $this->db->where('shopping_method','PAYPAL');
        return $this->db->get()->result_array();
    }
    public function fetch_date_jun_cod()
    {
        $first_date='2016-06-01 00:00:00';
        $second_date='2016-06-31 00:00:00';
        $this->db->select('grand_total');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        $this->db->where('shopping_method','COD');
        $this->db->where('status','Complete');
        return $this->db->get()->result_array();
    }
    public function fetch_date_may_order()
    {
        $first_date='2016-05-01 00:00:00';
        $second_date='2016-05-31 00:00:00';
        $this->db->select('count(*) as order_id');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        return $this->db->get()->result();
    }
    public function fetch_date_jun_order()
    {
        $first_date='2016-06-01 00:00:00';
        $second_date='2016-06-31 00:00:00';
        $this->db->select('count(*) as order_id');
        $this->db->from('user_order');
        $this->db->where('created_date >=', $first_date);
        $this->db->where('created_date <=', $second_date);
        return $this->db->get()->result();
    }

}