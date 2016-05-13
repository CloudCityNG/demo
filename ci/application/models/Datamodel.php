<?php

class Datamodel extends CI_Model
{
    function show_data()
    {

        $query = $this->db->get('customer');
        $query_result = $query->result_array();
        return $query_result;
    }
    function insert_data($data)
    {
        $this->db->insert('customer',$data);

    }
    function update_data($product_id,$data)
    {
        $this->db->where('id',$product_id);
        $this->db->update('customer',$data);

    }
    function delet($product_id)
    {
        echo $product_id;
        $this->db->where('id',$product_id);
        $this->db->delete('customer');
    }
    function edit($prduct_id)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id',$prduct_id);
        $query=$this->db->get();
        $query_result=$query->result();
        return $query_result;
    }
    function search_data($keyword)
    {
        $this->db->like('first_name',$keyword);
        $this->db->or_like('phone_no',$keyword);
        $this->db->or_like('email',$keyword);
        $query =  $this->db->get('customer');
        $x=$query->result_array();
        return $x;
    }
    function sort_data($var)
    {
        $this->db->from('customer');
        $this->db->order_by($var,"decs");
        $query=$this->db->get();
        $q=$query->result_array();
        return $q;
    }

    public function record_count()
    {
        return $this->db->count_all("customer");
    }


    public function fetch_data($limit, $page)
    {
        $var=$this->input->get('sortby');

        if(empty($var))
        {
            $var='id';
            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var,"desc");
            $query = $this->db->get("customer");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row)
                {
                    $data[] = $row;
                }
            return $data;
        }
        return false;}
        else {
            echo "<p style='color: red'> " . "fsdfsdf" . $var . "</p>";

            $offset = ($page - 1) * $limit;
            $this->db->limit($limit, $offset);
            $this->db->order_by($var,"desc");
            $query = $this->db->get("customer");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row)
                {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        }
    }
    public function deleteall_data($data)
    {
            if (!empty($data)) {
                $this->db->where_in('id', $data);
                $this->db->delete('customer');
            }
    }
    public function fetch()
    {
        $data['first']=$this->input->post('firstname');
        $data['last']=$this->input->post('lastname');
        $data['phone']=$this->input->post('phone');
        $data['office']=$this->input->post('office');
        $data['email']=$this->input->post('email');
        $data['password']=$this->input->post('password');
        $data['compass']=$this->input->post('compass');
        $data['age']=$this->input->post('age');
        $data['pincode']=$this->input->post('pincode');
        $data['about']=$this->input->post('about');
        $data['month']=$this->input->post('month');
        $data['day']=$this->input->post('day');
        $data['year']=$this->input->post('year');
        return $data;
    }
}