<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller
{
	function  __construct() {
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('product');
		$this->load->model('User');
		$this->load->model('couponmgmt');
	}
	
	function index(){
		$data = array();
		//get products data from database
        $data['products'] = $this->product->getRows();
		//pass the products data to view
		$this->load->view('products/index', $data);
	}
	
	function buy($item_id,$name,$user_id){

		echo "<h1>".$user_id."</h1>";

		//echo $x;
		$total=$this->input->post('total');
		//$name=$this->input->post('name');
		echo $quantity=$this->input->post('qty');

		//$id=$this->input->post('product_id');

		$paypalURL = 'https://www.sandb8ox.paypal.com/cgi-bin/webscr'; //test PayPal api url
		$paypalID = 'sumit.desai@wwindia.com'; //business email
		$returnURL = base_url() . 'paypal/success'; //payment success url
		$cancelURL = base_url() . 'paypal/cancel'; //payment cancel url
		$notifyURL = base_url() . 'paypal/ipn'; //ipn url
		//get particular product data
		//$product = $this->product->getRows($z);
		$userID = 1; //current user id
		$logo = base_url() . 'assets/images/codexworld-logo.png';
		//$this->paypal_lib->add_field('quantity', $qty);
		$this->paypal_lib->add_field('business', $paypalID);
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $name);
		$this->paypal_lib->add_field('custom', $user_id);
		$this->paypal_lib->add_field('item_number', $item_id);
		$this->paypal_lib->add_field('amount', $total);
		$this->paypal_lib->image($logo);
		$this->paypal_lib->paypal_auto_form();
	}
	public function product_data()
	{
		$c_id=null;
		$this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');

		$this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		$this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('address_2', 'address_2');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('user/headeruser');
			$this->load->view('user/checkout');
			$this->load->view('user/footer_user');
		} else {
			//inser user data
			$data=array(
				'user_name' => $this->input->post('user_name'),
				'user_lastname' => $this->input->post('user_lastname'),
				'user_email' => $this->input->post('user_email'),
				'user_password' => $this->input->post('user_password')
			);
			//insert user address
			$address_data=array(
				'address_1' => $this->input->post('address_1'),
				'address_2' => $this->input->post('address_2'),
				'zipcode' => $this->input->post('zipcode'),
			);
			//unique mail
			$user_email = $this->input->post('user_email');
			//find usr id
			$user_id=$this->User->checkout_user($data,$address_data,$user_email);
			//$user_id = $this->session->userdata('user_session');
			$i = 1;
			$quantity = "";
			foreach ($this->cart->contents() as $items):

				echo form_hidden($i . '[rowid]', $items['rowid']);

				echo $name = $items['name'];
				echo $id = $items['id'];
				echo $price = $this->cart->format_number($items['price']) . "<br>";
				echo $quantity = $items['qty'] . "<br>";
				echo $total = $this->cart->format_number($items['subtotal']);





				
				$i++;

			endforeach;

			$x = "";
			$name = "";
			foreach ($this->cart->contents() as $items):
				$x .= $items['id'] . ",";
				$name .= $items['name'] . ",";
			endforeach;

			$total_quan=$this->product->check_quantity($x,$quantity);

			//echo 'toal_qun'.$total_quan;
			//check product avaliable in stock or not
			if($total_quan < 0 )
			{
				$user_data['userdata']=$this->User->chekout_data($user_id);
				$user_data['quntity']='Out Of Stock';
				$this->load->view('user/headeruser');
				$this->load->view('user/checkout',$user_data);
				$this->load->view('user/footer_user');
			}
			else {
				$off = $this->input->post('code');
				//find coupon id
				if (!empty($off)) {
					$c_id = $this->couponmgmt->code_id($off);
				}
				else{
					$characters = '0123456789';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < 5; $i++) {
						$randomString .= $characters[rand(1, $charactersLength - 1)];
					}
					echo "C_id".$c_id=$randomString;
				}
				$coupon_data = array(

					'user_id' => $user_id,
					'coupons_id' => $c_id
				);
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);

				if ($coup_used_id == 0)
				{
					$user_data['userdata'] = $this->User->chekout_data($user_id);
					$user_data['msg'] = 'Coupon Already Used';
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout', $user_data);
					$this->load->view('user/footer_user');
				}
				else {
					$data = array(
						'user_id' => $user_id,
						'billing_address_id' => $this->input->post('address_1'),
						'shopping_address_id' => $this->input->post('address_2'),
						'shopping_method' => 'payapl',
						'coupon_id' => $c_id
					);
					$order_id = $this->product->insert_order($data);

					$order_data = array(
						'order_id' => $order_id,
						'product_id' => $x,
						'quantity' => $quantity,
					);
					$this->product->insert_order_details($order_data);

					$this->buy($x, $name, $user_id);
				}
			}
		}
	}
}