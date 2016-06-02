<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Model
{
	//get and return product rows
	public function getRows($id)
	{
		$this->db->select('product_id,name,price');
		$this->db->from('product');
		if($id){
			$this->db->where('product_id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
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

	/**
	 * insert data in user_order table
	 * @param $data=user_id
	 * 		billing_address_id
	 * 		shopping_address_id
	 * 		shopping_method
	 * 		shopping_charges
	 * 		coupon_id
	 * #controller-products
	 * @return mixed
	*/
	public function insert_order($data)
	{
		$this->db->insert('user_order',$data);
		return $this->db->insert_id();
	}

	/**
	 * insert data in order_details table
	 * @param $data=order_id
	 * 		product_id
	 * 		quantity
	 * #controller-products
	*/
	public function insert_order_details($data)
	{
		$this->db->insert('order_details',$data);
	}

	/**
	 * find username using user id form user table
	 * @param $id - user_id
	 * @return user_name
	*/
	public function find_username($id)
	{
		$this->db->select('user_name');
		$this->db->from('user');
		$this->db->where('user_id',$id);
		return $this->db->get()->row()->user_name;
	}

	/**
	 * insert data in user_order table
	 * @param $data=name
	 * 		created_by
	 * @controller-paypal
	 * @return user_name
	*/
	public function payment_data($data)
	{
		$this->db->insert('payment_getway',$data);
		return $this->db->insert_id();
	}

	/**
	 * update data in order_details table
	 * @param  $data=order_id
	 * 		product_id
	 * 		quantity
	 * @param $o_id-order_id
	 * #controller-products
	*/
	public function order_data($data,$o_id)
	{
		//update data using user_id
		$this->db->where('order_id',$o_id);
		$this->db->update('user_order',$data);
	}

	/**
	 * check quantity in product table
	 * @param $x=item_id
	 * @param $quantity=quantity
	 * #controller-products
	 * @return integer
	*/
	public function check_quantity($x,$quantity)
	{
		$this->db->select('quntity');
		$this->db->from('product');
		$this->db->where('product_id',$x);
		$q_no=$this->db->get()->row()->quntity;
		$total_quantity=$q_no-$quantity;
		return $total_quantity;
	}

	/**
	 * find quantity in product table
	 * @param $id=item_id
	 * #controller-paypal
	 * @return integer
	*/
	public function total_quntity($id)
	{
		$this->db->select('quntity');
		$this->db->from('product');
		$this->db->where('product_id',$id);
		return $this->db->get()->row()->quntity;
	}

	/**
	 * check quantity in order_details table
	 * @param $prod_id=item_id
	 * @param $total_quantity=quantity
	 * @return reamming quantity
	*/
	public function find_quntity($prod_id,$total_quantity)
	{
		//find reammming quantity..
		$this->db->select('quantity');
		$this->db->from('order_details');
		$this->db->where('product_id',$prod_id);
		$purchase_quntity= $this->db->get()->row()->quantity;	//get purchase quantity
 		$reamming=$total_quantity - $purchase_quntity;			//find reamming quantity
		return $reamming;
	}

	/**
	 * check quantity in product table
	 * @param $item_id=item_id
	 * @p $quan=quantity
	 * @return reamming quantity
	*/
	public function update_quantity($qun,$item_id)
	{
		//update quantity after order done..
		$this->db->where('product_id',$item_id);
		$this->db->update('product',$qun);
	}
}
