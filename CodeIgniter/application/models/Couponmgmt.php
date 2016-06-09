<?php

class Couponmgmt extends CI_Model
{

    /**
     * count total numbers of row in coupons table
     * @return mixed
     */
    public function record_count_coupon()                               //count coupons
    {
        return $this->db->count_all("coupon");
    }

    /**
     * display list of coupons and details of coupons
     * apply both side sorting for coupons
     * @param $limit pagination limit of perpage
     * @param $page selected page
     * @return array|bool
     */
    public function fetch_coupon_data($limit, $page)                    //pagination on coupons
    {
        //sorting column if selected column den sort by that or default column code
        $var = $this->input->get('sortby') ? $this->input->get('sortby') : 'code';
        //sorting default order is desc
        $order = $this->input->get('sortorder') ? $this->input->get('sortorder') : 'DESC';
        $offset = ($page - 1) * $limit;
        $this->db->limit($limit, $offset);
        $this->db->order_by($var,$order);
        $query = $this->db->get("coupon");
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
     * delete data from table
     * selected coupons_id for deletion
     */
    public function delete_coupon()                                     //delete coupons
    {
        $getid = $this->input->get('coupon_id');
        $this->db->where('coupon_id', $getid);
        $this->db->delete('coupon');
    }

    /**
     * insert cms data in database
     * @param $data = code
     *                 percent off,coupon_id
     */
    public function insert($data)                                       //insert coupons
    {
        $this->db->insert('coupon',$data);
    }

    /**
     * give discount on coupon code
     * @param $off(string) selected coupon
     * @return null|double
     */
    public function discount_off($off)                                  //calculate discount
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
        else
        {
            return null;
        }
    }

    /**
     * select coupon id onthe basis of coupon code
     * @param $off(string)- code eter from front end
     * @return null|coupon_id(int)
     */
    public function code_id($off)                                       //find code id
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

    /**
     * used coupon by all users list
     * @param $c_id(int) coupon id
     * @param $user_id(int) which user used that coupon
     * @param $coupon_data(string) code
     * @return int
     */
    public function uses($c_id,$user_id,$coupon_data)                   //find used coupons
    {
        $this->db->where('coupons_id',$c_id);
        $this->db->where('user_id',$user_id);
        $query=$this->db->get('coupons_used')->num_rows();
        //if cupon not used den insert dataand return coupon_id
        if($query == 0)
        {
            $this->db->insert('coupons_used',$coupon_data);
            return $this->db->insert_id();
        }
        elseif($c_id == null)
        {
            return 5;
        }
        else
        {
            return 0;
        }
    }

    /**
     * udpaet table of used of coupons
     * @param $order_id - order id  in whictch coupon code is used
     * @param $c_id- which coupon code is used
     */
    public function update_used_coupon($order_id,$c_id)                 //update used coupon data
    {
        $this->db->where('coupons_id',$c_id);
        $this->db->update('coupons_used',$order_id);
    }
    /**
     * search related data of enter keyword from front end
     * @param $search(string) - enter keyword from front end
     * @return mixed
     */
    public function coupon_search($search)                              //search coupons from table
    {
        $this->db->select('*');
        $this->db->from('coupon');
        $this->db->like('code',$search);
        $this->db->or_like('percent_off',$search);
        return $this->db->get()->result_array();
    }

    /**
     * show all coupons to admin
     * @return mixed
     */
    public function show_coupon()                                       //display coupons
    {
        $this->db->select('*');
        $this->db->from('coupons_used');
        $this->db->join('coupon','coupon.coupon_id=coupons_used.coupons_id');
        return $this->db->get()->result_array();
        var_dump($query);
    }
}
