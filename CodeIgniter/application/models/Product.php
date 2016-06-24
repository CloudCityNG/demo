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
	 * @param $data(array)=user_id(int)
	 * 		billing_address_id(int)
	 * 		shopping_address_id(int)
	 * 		shopping_method(string)
	 * 		shopping_charges(float)
	 * 		coupon_id(int)
	 * #controller-products
	 * @return mixed
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	*/
	public function insert_order($data)
	{
		$this->db->insert('user_order',$data);
		return $this->db->insert_id();
	}

	/**
	 * insert data in order_details table
	 * @param $data(array)=order_id(int)
	 * 				product_id(int)
	 * 				quantity(flaot)
	 * #controller-products
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	*/
	public function insert_order_details($data)
	{
		$this->db->insert('order_details',$data);
	}

	/**
	 * find username using user id form user table
	 * @param $id(int) - user_id
	 * @return user_name
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
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
	 * @param $data(array)=name(string)
	 * 		created_by(int)
	 * @controller-paypal
	 * @return user_name(string)
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	*/
	public function payment_data($data)
	{
		$this->db->insert('payment_getway',$data);
		return $this->db->insert_id();
	}

	/**
	 * update data in order_details table
	 * @param  $data(array)=order_id user
	 * 		product_id
	 * 		quantity
	 * @param $o_id(int)-order_id for match data
	 * #controller-products
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	*/
	public function order_data($data,$o_id)
	{
		//update data using user_id
		$this->db->where('order_id',$o_id);
		$this->db->update('user_order',$data);
	}

	/**
	 * check quantity in product table
	 * @param $x(int)=item_id
	 * @param $quantity(float)=quantity
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
	 * @param $id(ing)=item_id fetch data of particular product
	 * #controller-paypal
	 * @return integer
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
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
	 * @param $prod_id(int)=item_id fetch data of particular product
	 * @param $total_quantity=quantity
	 * @return reamming quantity
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
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
	 * @p $quan(float)=quantity
	 * @return reamming quantity
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	*/
	public function update_quantity($qun,$item_id)
	{

		//update quantity after order done..
		$this->db->where('product_id',$item_id);
		$this->db->update('product',$qun);

	}

	/**
	 * delete itms from wishlist
	 * @param $user_id(int)-user_id of that user which have this whishlish
	 * @param $prod_id(int) -product id which percent in wishlsit
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	 */
	public function delete_wishlist($user_id,$prod_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('product_id',$prod_id);
		$query=$this->db->get('user_wish_list')->num_rows();
		if($query > 0)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('product_id',$prod_id);
			$this->db->delete('user_wish_list');
		}
	}

	/**
	 * user cancel the order
	 * then order details about that product is delete
	 * @param $o_id (int) current order id
	 * @package CodeIgniter
	 * @subpackage Model
	 * @author Sumit Desai
	 */
	public function delete_order($o_id)
	{
		$this->db->where('order_id',$o_id);
		$this->db->delete('user_order');
	}
	public function fetch_address($add_id)
	{
		$this->db->where('address_id',$add_id);
		return $this->db->get('user_address')->result_array();
	}
	public function fetch_ship($ship_id)
	{
		$this->db->where('address_id',$ship_id);
		return $this->db->get('user_address')->result_array();
	}
}
