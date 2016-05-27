<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Model{
	//get and return product rows
	public function getRows($id){
		$this->db->select('product_id,name,price');
		$this->db->from('product');
		if($id){
			$this->db->where('product_id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
		}
		else
		{
			$this->db->order_by('name','asc');
			$query = $this->db->get();
			$result = $query->result_array();
		}
		return !empty($result)?$result:false;
	}
	//insert transaction data
	public function insertTransaction($data = array()){
		$insert = $this->db->insert('payments',$data);
		return $insert?true:false;
	}
	public function insert_order($data)
	{
		$this->db->insert('user_order',$data);
		return $this->db->insert_id();
	}
	public function insert_order_details($data)
	{
		$this->db->insert('order_details',$data);
	}
	public function find_username($id)
	{
		$this->db->select('user_name');
		$this->db->from('user');
		$this->db->where('user_id',$id);
		return $this->db->get()->row()->user_name;
	}
	public function payment_data($data)
	{
		$this->db->insert('payment_getway',$data);
		return $this->db->insert_id();
	}
	public function order_data($data,$user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->update('user_order',$data);
	}
	public function check_quantity($x,$quantity)
	{
		$this->db->select('quntity');
		$this->db->from('product');
		$this->db->where('product_id',$x);
		$q_no=$this->db->get()->row()->quntity;
		$total_quantity=$q_no-$quantity;
		return $total_quantity;
	}
	public function total_quntity($id)
	{
		$this->db->select('quntity');
		$this->db->from('product');
		$this->db->where('product_id',$id);
		return $this->db->get()->row()->quntity;
	}

	public function find_quntity($prod_id,$total_quantity)
	{
		$this->db->select('quantity');
		$this->db->from('order_details');
		$this->db->where('product_id',$prod_id);
		$purchase_quntity= $this->db->get()->row()->quantity;
		$reamming=$total_quantity - $purchase_quntity;
		return $reamming;
	}
	public function update_quantity($qun,$item_id)
	{
		$this->db->where('product_id',$item_id);
		$this->db->update('product',$qun);
	}

}
