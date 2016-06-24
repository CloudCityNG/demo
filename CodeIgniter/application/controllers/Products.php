<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller
{
	function  __construct() {
		parent::__construct();

		$this->load->model('Bannermgmt');
		$this->load->model('cmsadmin');
		$this->load->model('User');
		$this->load->model('product');
		$this->load->model('couponmgmt');
		$this->load->model('Admin_Insert');
		$this->load->library('paypal_lib');
		$this->load->library('paypal');
		$this->load->library('email');
		$this->load->library('upload');
		$this->load->library('cart');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('form');
	}
	function index()
	{
		$data = array();
		//get products data from database
        $data['products'] = $this->product->getRows();
		//pass the products data to view
		$this->load->view('products/index', $data);
	}

	/**
	 * set appropriat URLS
	 * set filed to send to paypal server
	 * find discount
	 * @param $user_id - user id how purchses products
	 * @discount- discount depends on coupon code
	 * @shipping - shipping changres depends on total
	 * @package CodeIgniter
	 * @subpackage Controller
	 * @author Sumit Desai
	 */
	function buy($item_id,$name,$user_id)
	{
		//set appropriat URLS
		$total=$this->input->post('total');
		$paypalURL = 'https://www.sandb8ox.paypal.com/cgi-bin/webscr'; //test PayPal api url
		$paypalID = 'sumit.desai@wwindia.com'; //business email
		$returnURL = base_url() . 'paypal/success'; //payment success url
		$cancelURL = base_url() . 'paypal/cancel'; //payment cancel url
		$notifyURL = base_url() . 'paypal/ipn'; //ipn url
		//get particular product data
		//$logo = base_url() . 'assets/images/codexworld-logo.png';
		$this->paypal->add_field('rm', 2);
		$this->paypal->add_field('no_note', 0);
		$this->paypal->add_field('cmd', '_cart');
		$this->paypal->add_field('upload', '1');
		$carted = $this->cart->contents();

		$i=1;

		//get coupon code from user end
		$off=$this->input->post('code');

		//find discount form database
		$disc=$this->couponmgmt->discount_off($off);
		//set discount value
		if($disc != null) {
			$discount=$disc;
		}
		else
		{
			$discount = 0;
		}
		//add shipping changes in for offer
		foreach ($this->cart->contents() as $items)
		{
			$total_grand_amount=$this->cart->format_number($this->cart->total());
		}
		if($total_grand_amount >50)
		{
			$ship = 50;
		}
		else{
			$ship = 0;
		}
		//set cart for send data to paypal
		foreach ($carted as $val) {
			$this->paypal->add_field('item_number_' . $i, $i);
			$this->paypal->add_field('item_name_' . $i, $val['name']);
			$this->paypal->add_field('amount_' . $i, ($val['price']));
			$this->paypal->add_field('quantity_' . $i, $val['qty']);
			$i++;
		}
		$this->paypal->add_field('shipping_1',$ship);
		$this->paypal->add_field('discount_amount_cart', $discount);

		// $this->paypal->add_field('shipping_' . $i, $ship);
		$this->paypal->add_field('custom', $user_id);
		$this->paypal->add_field('business', $paypalID);
		$this->paypal->add_field('notify_url', base_url() . $notifyURL);
		$this->paypal->add_field('cancel_return', $cancelURL);
		$this->paypal->add_field('return',$returnURL);
		$this->paypal->submit_paypal_post();
	}

	/**
	 * user data validation
	 * insert new user data
	 * validation of items avalible in stock or not
	 * check coupon code valid or not
	 * check coupon code reuse or not
	 * payment method paypal or cash on delivery
	 * insert data in appropriat tables @order,order_details,coupon_used
	 * update data in appropriat tables @product,order_details,coupons_used
	 * calculate shipping charges
	 * @package CodeIgniter
	 * @subpackage Controller
	 * @author Sumit Desai
	 */
	public function product_data()
	{
		//fetch total amount form fornt end
		$shiped_id="";

		$total = $this->input->post('total');

		$x_total=str_replace(',', '', $total);
		//shipping charge
		if($x_total >100)
		{
			$shipping=50.00;			//if total price is greater than 100,apply shipping charge
		}
		else
		{
			$shipping=0.00;				//else shipping is free
		}

			$grand_total=$x_total+$shipping;//grand total
		$c_id = null;

		//server side validation of user form
		$this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
		$this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		$this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('address_2', 'address_2');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');

		//if data is invalid or empty
		if ($this->form_validation->run() == FALSE)
		{
			$user_data['error']="error";
			$id=$this->session->userdata('user_session');
			$data['address_all']=$this->User->fetch_address($id);
			$this->load->view('user/headeruser');
			$this->load->view('user/checkout',$data);
			$this->load->view('user/footer_user');
		}
		else {
			//if customer pay payment using paypal
			if ($this->input->post('payment_type') == 'paypal') {

				//insert user data
				$data = array(
					'user_name' => $this->input->post('user_name'),
					'user_lastname' => $this->input->post('user_lastname'),
					'user_email' => $this->input->post('user_email'),
					'user_password' => $this->input->post('user_password')
				);
				//unique mail
				$user_email = $this->input->post('user_email');
				//find user id
				$user_id = $this->User->checkout_user($data, $user_email);
				//insert user address
				$address_data = array(
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'zipcode' => $this->input->post('zipcode'),
					'user_id' => $user_id
				);

				$address_id = $this->User->chechkout_user_address($address_data, $user_id);
				$this->session->set_userdata('address_id',$address_id);

				//$user_id = $this->session->userdata('user_session');
				$i = 1;
				$quantity = "";
				// exploer cart items
				foreach ($this->cart->contents() as $items):
					$name = $items['name'];
					$id = $items['id'];
					$price = $this->cart->format_number($items['price']) . "<br>";
					$quantity = $items['qty'] . "<br>";
					$total = $this->cart->format_number($items['subtotal']);
					$i++;
				endforeach;

				foreach ($this->cart->contents() as $items) {
					$total_amount = $this->cart->format_number($this->cart->total());
				}
				//if selected than redirect to error page
				if ($total_amount <= 0) {
					redirect('products/checkout_error/' . $user_id);
				}


				//@empty variables x,name
				$x = "";
				$name = "";

				//get all items id form cart
				foreach ($this->cart->contents() as $items):
					$x .= $items['id'] . ",";
					$name .= $items['name'] . ",";
				endforeach;

				//explode items id array
				$y = explode(',', $x);

				//validation of all items which are persent in cart
				foreach ($y as $val)
					if (!empty($val)) {
						//get total quantity of particular item
						$total_quan = $this->product->check_quantity($val, $quantity);

						//check product avaliable in stock or not
						if ($total_quan < 0) {
							//redirect to checkout page with error msg
							$user_data['userdata'] = $this->User->chekout_data($user_id);
							$user_data['address'] = $this->User->checkout_address($id);
							$user_data['quntity'] = 'Out Of Stock';
							$this->load->view('user/headeruser');
							$this->load->view('user/checkout', $user_data);
							$this->load->view('user/footer_user');
						}
						$c_id = "";

						//get coupon code form front end
						$off = $this->input->post('code');

						//if customer enters coupon code
						if (!empty($off)) {
							$c_id = $this->couponmgmt->code_id($off);
							$id = $c_id;

							//if enter invalid coupon code
							if ($c_id == null) {
								//redirect to checkout page with error msg
								//$user_data['userdata'] = $this->User->chekout_data($user_id);
								//$user_data['address']=$this->User->checkout_address($id);
								$user_data['invalid'] = 'Invalid Coupon';
								//$this->load->view('user/headeruser');
								//$this->load->view('user/checkout', $user_data);
								//$this->load->view('user/footer_user');
							} else {
								$c_id = $id;
							}
						} //if customer dont used coupons
						else {
							//genrate temporary coupon id
							$characters = '0123456789';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < 5; $i++) {
								$randomString .= $characters[rand(1, $charactersLength - 1)];
							}
							$c_id = $randomString;
						}
						//insert coupon data in coupons_used table
						$coupon_data = array(
							'user_id' => $user_id,
							'coupons_id' => $c_id
						);
					}
				//check coupon already used or not
				//fetch coupon id..
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);
				$ship_address = $this->input->post('ship_address');
				if ($ship_address == "register") {
					$shiped_id = $address_id;
					echo "if";
				} elseif ($ship_address == "guest") {
					$shipping_data = array(
						'address_1' => $this->input->post('address_3'),
						'address_2' => $this->input->post('address_4'),
						'zipcode' => $this->input->post('zipcode1'),
						'user_id' => $user_id
					);
					$shipping_id = $this->User->insert_shipping_address($shipping_data);

					$shiped_id = $shipping_id;
					echo "hello".$shiped_id;
				} else {
					$addres_data = $this->input->post('select_address');
					$shipping_id = $addres_data;
					$shiped_id = $shipping_id;
					echo "else";
				}

				$this->session->set_userdata('shipping_id',$shiped_id);
				//if customer try to re-use coupon code
				if ($coup_used_id == 0) {

					//redirect to checkout page with error msg
					//$user_data['userdata'] = $this->User->chekout_data($user_id);
					//$user_data['address']=$this->User->checkout_address($id);
					$user_data['msg'] = 'Coupon Already Used';
					//$this->load->view('user/headeruser');
					//$this->load->view('user/checkout', $user_data);
					//$this->load->view('user/footer_user');
				} else {
					//order data
					$data = array(
						'user_id' => $user_id,
						'billing_address_id' => $address_id,
						'shopping_address_id' => $shiped_id,
						'shopping_method' => 'PAYPAL',
						'shipping_charges' => $shipping,
						'coupon_id' => $c_id
					);

					//insert order data in order table
					$order_id = $this->product->insert_order($data);
					$this->session->set_userdata('order_session', $order_id);

					//update coupon_used table @order_id
					$update_coupon = array(
						'order_id' => $order_id
					);
					$this->couponmgmt->update_used_coupon($update_coupon, $c_id);

					//fetch id form cart
					foreach ($this->cart->contents() as $items) {
						//insert order details into  order_details table
						$order_data = array(
							'order_id' => $order_id,
							'product_id' => $items['id'],
							'quantity' => $items['qty'],
						);
						$this->product->insert_order_details($order_data);
					}

					$this->config->item('email');
					/* $config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'mail.wwindia.com',
						'smtp_port' => 25,
						'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
						'smtp_pass' => 'nb=np2^89mKn', // change it to yours
						'mailtype' => 'html',
						//'charset' => 'iso-8859-1',
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					); */

					$add_1 = $this->input->post('address_1');
					$add_2 = $this->input->post('address_2');
					$message = '

<!--order Details-->
	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>

		<table style="margin-left: 50px;width:600px; background-color: skyblue;">
		<tr>
			<td style="width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px;width: 50px">
				<h6 style=" font-weight: normal; margin-top: -40px">
					<b>Call Us:
						<a style="color: blue">+91 - 22 -40500699</a>
						<br>
						Email:
					</b>
						<br>
					<notbold>
						info@shoppingcompany.com
					</notbold>
				</h6>
			</td>
			</tr>
			</table>

		<div style="text-align: center"><h3>Your Order</h3></div><br>
		<div style="text-align: center">Placed Date ' . date("Y-m-d") . '</div><br>
		<div style="margin-left: 50px"> Order ID :' . $order_id . '</div><br>
		<div style="margin-left: 50px"> Track_order :<a href="http://localhost/CodeIgniter/Useraccount/track_order">http://localhost/CodeIgniter/Useraccount/track_order</a></div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr style="text-align: center;  width: 50px;height: 50px">
					<td>Product Name</td>
					<td>Quantity</td>
					<td>Unit Price</td>
					<td>Total</td>
				</tr>';

					foreach ($this->cart->contents() as $items) {
						$message .= '<tr style="text-align: center;width: 50px;height: 50px">
						<td>' . $items['name'] . '</td>
						<td>' . $items['qty'] . '</td>
						<td>' . $items['price'] . '</td>
						<td>' . $items['price'] * $items['qty'] . '</td>
						</tr>';
					}
					$message .= '</table>
			<div style="margin-left: 540px">Total</div>
		</div>
		<br>
		<div style="margin-left: 50px">Bill To :</div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">User Adderss</td>
					<td>' . $add_1 . '</td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td>' . $add_2 . '</td>
				</tr>
			</table>
		</div><br>
		<div style="margin-left: 50px">Payment Method: Paypal</div>
	</div>

	</body>
	</head>
	</html>

';

					$email = $this->Admin_Insert->fetch_email();
					$this->email->initialize($this->config->item('email'));
					$this->email->set_newline("\r\n");
					$this->email->from($email); // change it to yours
					$this->email->to('sumit.desai@wwindia.com');// change it to yours
					$this->email->cc('sumit.desai@wwindia.com');// change it to yours
					$this->email->subject('Customer Order');
					$this->email->message($message);
					if ($this->email->send()) {
					} else {
						show_error($this->email->print_debugger());
					}

					//redirect to paypal method buy..

				}//end else if valid coupon is used

				if (empty($user_data)) {
					$this->buy($val, $name, $user_id);
				} //else show error
				else {
					$user_data['address_all']=$this->User->fetch_address($user_id);
					$user_data['userdata'] = $this->User->chekout_data($user_id);
					$user_data['address'] = $this->User->checkout_address($user_id);
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout', $user_data);
					$this->load->view('user/footer_user');
					$this->load->view('user/footer_user');
				}//end else of error present

			}//end if payment type is paypal
			//if payment type is cash on delivery
			else {
				//insert user data
				$data = array(
					'user_name' => $this->input->post('user_name'),
					'user_lastname' => $this->input->post('user_lastname'),
					'user_email' => $this->input->post('user_email'),
					'user_password' => $this->input->post('user_password')
				);


				//insert user address

				//unique mail
				$user_email = $this->input->post('user_email');
				//find usr id
				$user_id = $this->User->checkout_user($data, $user_email);
				//$user_id = $this->session->userdata('user_session');
				$address_data = array(
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'zipcode' => $this->input->post('zipcode'),
					'user_id' => $user_id
				);
				$address_id = $this->User->chechkout_user_address($address_data, $user_id);

//				$addres_data=$this->input->post('select_address');
//				$shipping_id=$addres_data;

				$i = 1;
				$quantity = "";
				foreach ($this->cart->contents() as $items):
					form_hidden($i . '[rowid]', $items['rowid']);
					$name = $items['name'];
					$id = $items['id'];
					$price = $this->cart->format_number($items['price']) . "<br>";
					$quantity = $items['qty'] . "<br>";
					$total = $this->cart->format_number($items['subtotal']);
					$i++;
				endforeach;

				//check products are selected in cart or not
				foreach ($this->cart->contents() as $items) {
					$total_amount = $this->cart->format_number($this->cart->total());
				}
				//if selected than redirect to error page
				if ($total_amount <= 0) {
					redirect('products/checkout_error/' . $user_id);
				}

				$x = "";
				//fetch id of cart items
				foreach ($this->cart->contents() as $items):
					if (!empty($items['id'])) {
						$x .= $items['id'] . ",";
					} else {

					}
				endforeach;

				//explode array of cart ids
				$y = explode(',', $x);

				$i = "";
				//validation of
				//				foreach ($y as $val)
				//					if(!empty($val))
				//					{
				//						$total_quan = $this->product->check_quantity($val, $quantity);

				//check product avaliable in stock or not
				//						if ($total_quan <= 0)
				//						{
				//	$user_data['userdata'] = $this->User->chekout_data($user_id);
				//							$user_data['quntity'] = 'Out Of Stock';
				//						}
				//update quantity after order submit

				//						$product_update = array(
				//							'quntity' => $total_quan
				//						);
				// update below
				//$this->product->update_quantity($product_update, $val);

				//user use coupon code
				$off = $this->input->post('code');
				$c_id = "";
				//check coupon code is valid or not
				if (!empty($off)) {
					$c_id = $this->couponmgmt->code_id($off);
					$id = $c_id;

					//if enter invalid coupon code
					if ($c_id == null) {
						$user_data['invalid'] = 'Invalid Coupon';

					} else {
						$c_id = $id;
					}
				} else {
					//generate temporary coupon id
					$characters = '0123456789';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < 5; $i++) {
						$randomString .= $characters[rand(1, $charactersLength - 1)];
					}
					$c_id = $randomString;
				}
				//insert coupon data in coupon_used table
				$coupon_data = array(
					'user_id' => $user_id,
					'coupons_id' => $c_id
				);
//					}//end if user_id loop is end
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);


				$ship_address = $this->input->post('ship_address');
				if ($ship_address == "register") {
					$shiped_id = $address_id;
				} elseif ($ship_address == "guest") {
					$shipping_data = array(
						'address_1' => $this->input->post('address_3'),
						'address_2' => $this->input->post('address_4'),
						'zipcode' => $this->input->post('zipcode1'),
						'user_id' => $user_id
					);
					$shipping_id = $this->User->insert_shipping_address($shipping_data);
					$shiped_id = $shipping_id;
				} else {
					$addres_data = $this->input->post('select_address');
					$shipping_id = $addres_data;
					$shiped_id = $shipping_id;
				}

				//check coupon already used used or not
				if ($coup_used_id == 0) {
					$user_data['msg'] = 'Coupon Already Used';
				} else {
					//insert order data into order table
					$data = array(
						'user_id' => $user_id,
						'billing_address_id' => $address_id,
						'shopping_address_id' => $shiped_id,
						'shopping_method' => 'COD',
						'shipping_charges' => $shipping,
						'coupon_id' => $c_id,
						'grand_total' => $grand_total
					);
					$order_id = $this->product->insert_order($data);

					//update coupon_used @order_id
					$update_coupon = array(
						'order_id' => $order_id
					);
					$this->couponmgmt->update_used_coupon($update_coupon, $c_id);

					//exploer cart items
					foreach ($this->cart->contents() as $items) {
						//insert order_details
						$order_data = array(
							'order_id' => $order_id,
							'product_id' => $items['id'],
							'quantity' => $items['qty'],
						);
						$this->product->insert_order_details($order_data);
					}//end foreach
					$this->session->set_userdata('order_session', $order_id);
					//send mail to customer and admin about order
					$this->config->item('email');
					/*$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'mail.wwindia.com',
						'smtp_port' => 25,
						'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
						'smtp_pass' => 'nb=np2^89mKn', // change it to yours
						'mailtype' => 'html',
						//'charset' => 'iso-8859-1',
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					);*/

					$add_1 = $this->input->post('address_1');
					$add_2 = $this->input->post('address_2');
					$message = '

<!--order Details-->
	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>

		<table style="margin-left: 50px;width:600px; background-color: skyblue;">
		<tr>
			<td style="width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px; width: 50px">
				<h6 style=" font-weight: normal; margin-top: -40px">
					<b>Call Us:
						<a style="color: blue">+91 - 22 -40500699</a>
						<br>
						Email:
					</b>
						<br>
					<notbold>
						info@shoppingcompany.com
					</notbold>
				</h6>
			</td>
			</tr>
			</table>
		<div style="text-align: center"><h3>Your Order</h3></div><br>
		<div style="text-align: center">Place on Date ' . date("Y-m-d") . '</div><br>
		<div style="margin-left: 50px"> Order ID :' . $order_id . '</div><br>
		<div style="margin-left: 50px"> Track_order :<a href="http://localhost/CodeIgniter/Useraccount/track_order">http://localhost/CodeIgniter/Useraccount/track_order</a></div><br>

		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr style="text-align: center;  width: 50px;height: 50px">
					<td>Product Name</td>
					<td>Quantity</td>
					<td>Unit Price</td>
					<td>Total</td>
				</tr>';

					foreach ($this->cart->contents() as $items) {
						$message .= '<tr style="text-align: center;width: 50px;height: 50px">
						<td>' . $items['name'] . '</td>
						<td>' . $items['qty'] . '</td>
						<td>' . $items['price'] . '</td>
						<td>' . $items['price'] * $items['qty'] . '</td>
						</tr>';
					}
					$message .= '</table>
			<div style="margin-left: 540px">Total</div>
		</div>
		<br>
		<div style="margin-left: 50px">Bill To :</div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">User Adderss</td>
					<td>' . $add_1 . '</td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td>' . $add_2 . '</td>
				</tr>
			</table>
		</div><br>
		<div style="margin-left: 50px">Payment Method: Cash on Deilivery</div>
	</div>
	</body>
	</head>
	</html>
';

					$email = $this->Admin_Insert->fetch_email();
					$this->email->initialize($this->config->item('email'));
					$this->email->set_newline("\r\n");
					$this->email->from($email); // change it to yours
					$this->email->to('sumit.desai@wwindia.com');// change it to yours
					$this->email->cc('sumit.desai@wwindia.com');// change it to yours
					$this->email->subject('Customer Order');
					$this->email->message($message);
					if ($this->email->send()) {
					} else {
						show_error($this->email->print_debugger());
					}
				}//end else if coupon is valid or not used coupon


				//redirect to success page

				//if no any error occure go to sccusse page
				if (empty($user_data)) {
					//delete data from wishlist
					foreach ($this->cart->contents() as $items) {
						$product_id = $items['id'];
						$this->product->delete_wishlist($user_id, $product_id);
					}//end foreach
					//update quantity in database
					foreach ($this->cart->contents() as $items) {
						$item_ids = $items['id'];
						$del_qunty = $items['qty'];
						//reammaing quantity after user purchse product
						$total_quan = $this->product->check_quantity($item_ids, $del_qunty);
						$product_update = array(
							'quntity' => $total_quan
						);
						//update that in database
						$this->product->update_quantity($product_update, $item_ids);
					}

				if ($ship_address == "guest") {
					$this->load->view('user/headeruser');
					$this->load->view('user/cash_success', $address_data, $shipping_data);
					$this->load->view('user/footer_user');
				}
					else{
						$this->load->view('user/headeruser');
						$this->load->view('user/cash_success', $address_data);
						$this->load->view('user/footer_user');
					}
				} //else show error
				else {
					$user_data['address_all']=$this->User->fetch_address($user_id);
					$user_data['userdata'] = $this->User->chekout_data($user_id);
					$user_data['address'] = $this->User->checkout_address($user_id);
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout', $user_data);
					$this->load->view('user/footer_user');
					$this->load->view('user/footer_user');
				}//end else of error present
			}//end else if payment using cash on delivery
		}	//end else if customer data is valid
	}//end function


	public function checkout_error()
	{
		$user_id=$this->uri->segment(3);
		$user_data['amount_total'] = 'Please Select Items';
		//	$user_id=$this->session->userdata('user_session');
		$user_data['address_all']=$this->User->fetch_address($user_id);
		$user_data['userdata'] = $this->User->chekout_data($user_id);
		$user_data['address']=$this->User->checkout_address($user_id);
		$this->load->view('user/headeruser');
		$this->load->view('user/checkout', $user_data);
		$this->load->view('user/footer_user');
		$this->load->view('user/footer_user');
	}




	/**
	 * user data validation
	 * insert new user data
	 * validation of items avalible in stock or not
	 * check coupon code valid or not
	 * check coupon code reuse or not
	 * payment method paypal or cash on delivery
	 * insert data in appropriat tables @order,order_details,coupon_used
	 * update data in appropriat tables @product,order_details,coupons_used
	 * calculate shipping charges
	 * @package CodeIgniter
	 * @subpackage Controller
	 * @author Sumit Desai
	 */
	public function guest_data()
	{
		//fetch total amount form fornt end
		$shiped_id="";

		$total = $this->input->post('total');

		$x_total=str_replace(',', '', $total);
		//shipping charge
		if($x_total >100)
		{
			$shipping=50.00;			//if total price is greater than 100,apply shipping charge
		}
		else
		{
			$shipping=0.00;				//else shipping is free
		}

		$grand_total=$x_total+$shipping;//grand total

		$c_id = null;

		//server side validation of user form
		$this->form_validation->set_error_delimiters('<div style="display: inline" class="error">', '</div>');
		$this->form_validation->set_rules('user_name', 'Firstname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		//	$this->form_validation->set_rules('user_password', 'Password', 'required');
		$this->form_validation->set_rules('address_1', 'address_1', 'required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('address_2', 'address_2');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'required|regex_match[/^[0-9]{6}$/]');

		//if data is invalid or empty
		if ($this->form_validation->run() == FALSE)
		{
			$user_data['error']="error";
			$id=$this->session->userdata('user_session');
			echo $id;
			$data['address_all']=$this->User->fetch_address($id);
			//	$this->load->view('user/headeruser');
			//	$this->load->view('user/guest_checkout',$data);
			//	$this->load->view('user/footer_user');
		}
		else
		{
			//if customer pay payment using paypal
			if ($this->input->post('payment_type') == 'paypal')
			{
				//insert user data
				$data = array(
					//'user_name' => $this->input->post('user_name'),
					//'user_lastname' => $this->input->post('user_lastname'),
					'user_email' => $this->input->post('user_email'),
					//'user_password' => $this->input->post('user_password')
				);
				//unique mail
				$user_email = $this->input->post('user_email');
				//find user id
				$user_id = $this->User->checkout_user_guest($data, $user_email);


				//insert user address
				$address_data = array(
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'zipcode' => $this->input->post('zipcode'),
					'user_id' => $user_id
				);

				$address_id=$this->User->chechkout_guestuser_address($address_data);



				//$user_id = $this->session->userdata('user_session');
				$i = 1;
				$quantity = "";
				// exploer cart items
				foreach ($this->cart->contents() as $items):
					$name = $items['name'];
					$id = $items['id'];
					$price = $this->cart->format_number($items['price']) . "<br>";
					$quantity = $items['qty'] . "<br>";
					$total = $this->cart->format_number($items['subtotal']);
					$i++;
				endforeach;

				foreach ($this->cart->contents() as $items)
				{
					$total_amount=$this->cart->format_number($this->cart->total());
				}
				//if selected than redirect to error page
				if($total_amount <= 0 )
				{
					redirect('products/guest_checkout_error/');
				}


				//@empty variables x,name
				$x = "";
				$name = "";

				//get all items id form cart
				foreach ($this->cart->contents() as $items):
					$x .= $items['id'] . ",";
					$name .= $items['name'] . ",";
				endforeach;

				//explode items id array
				$y = explode(',', $x);

				//validation of all items which are persent in cart
				foreach ($y as $val)
					if (!empty($val)) {}
						//get total quantity of particular item
						//$total_quan = $this->product->check_quantity($val, $quantity);

						//check product avaliable in stock or not
						/*if ($total_quan < 0)
						{
							//redirect to checkout page with error msg
							$user_data['userdata'] = $this->User->chekout_data($user_id);
							$user_data['address']=$this->User->checkout_address($id);
							$user_data['quntity'] = 'Out Of Stock';
							$this->load->view('user/headeruser');
							$this->load->view('user/checkout', $user_data);
							$this->load->view('user/footer_user');
						}*/
//						$c_id = "";

						//get coupon code form front end
//						$off = $this->input->post('code');

						//if customer enters coupon code
						/*if (!empty($off))
						{
							$c_id = $this->couponmgmt->code_id($off);
							$id = $c_id;

							//if enter invalid coupon code
							if ($c_id == null)
							{
								//redirect to checkout page with error msg
								//$user_data['userdata'] = $this->User->chekout_data($user_id);
								//$user_data['address']=$this->User->checkout_address($id);
								$user_data['invalid'] = 'Invalid Coupon';
								//$this->load->view('user/headeruser');
								//$this->load->view('user/checkout', $user_data);
								//$this->load->view('user/footer_user');
							}
							else
							{
								$c_id = $id;
							}
						}*/
						//if customer dont used coupons
						/*else
						{
							//genrate temporary coupon id
							$characters = '0123456789';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < 5; $i++) {
								$randomString .= $characters[rand(1, $charactersLength - 1)];
							}
							$c_id = $randomString;
						}
						//insert coupon data in coupons_used table
						$coupon_data = array(
							'user_id' => $user_id,
							'coupons_id' => $c_id
						);
					}*/
						//check coupon already used or not
						//fetch coupon id..
//				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);

						$ship_address = $this->input->post('ship_address');
						if ($ship_address == "register") {
							$shiped_id = $address_id;
						} elseif ($ship_address == "guest") {
							$shipping_data = array(
								'address_1' => $this->input->post('address_3'),
								'address_2' => $this->input->post('address_4'),
								'zipcode' => $this->input->post('zipcode1'),
								'user_id' => $user_id
							);
							$shipping_id = $this->User->insert_shipping_address($shipping_data);
							$shiped_id = $shipping_id;
						} else {
							$addres_data = $this->input->post('select_address');
							$shipping_id = $addres_data;
							$shiped_id = $shipping_id;
						}
						$this->session->set_userdata('shipping_id',$shiped_id);

						//if customer try to re-use coupon code
						/*if ($coup_used_id == 0) {

                            //redirect to checkout page with error msg
                            //$user_data['userdata'] = $this->User->chekout_data($user_id);
                            //$user_data['address']=$this->User->checkout_address($id);
                            $user_data['msg'] = 'Coupon Already Used';
                            //$this->load->view('user/headeruser');
                            //$this->load->view('user/checkout', $user_data);
                            //$this->load->view('user/footer_user');
                        }*/

						//order data
						$data = array(

							'user_id' => $user_id,
							'billing_address_id' => $address_id,
							'shopping_address_id' => $shiped_id,
							'shopping_method' => 'PAYPAL',
							'shipping_charges' => $shipping,

						);

						//insert order data in order table
						$order_id = $this->product->insert_order($data);
							$this->session->set_userdata('order_session', $order_id);

						//update coupon_used table @order_id
						$update_coupon = array(
							'order_id' => $order_id
						);
						$this->couponmgmt->update_used_coupon($update_coupon, $c_id);

						//fetch id form cart
						foreach ($this->cart->contents() as $items) {
							//insert order details into  order_details table
							$order_data = array(
								'order_id' => $order_id,
								'product_id' => $items['id'],
								'quantity' => $items['qty'],
							);
							$this->product->insert_order_details($order_data);
						}

						$this->config->item('email');
						/* $config = Array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'mail.wwindia.com',
                            'smtp_port' => 25,
                            'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
                            'smtp_pass' => 'nb=np2^89mKn', // change it to yours
                            'mailtype' => 'html',
                            //'charset' => 'iso-8859-1',
                            'charset' => 'utf-8',
                            'wordwrap' => TRUE
                        ); */

						$add_1 = $this->input->post('address_1');
						$add_2 = $this->input->post('address_2');
						$message = '

<!--order Details-->
	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>

		<table style="margin-left: 50px;width:600px; background-color: skyblue;">
		<tr>
			<td style="width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px;width: 50px">
				<h6 style=" font-weight: normal; margin-top: -40px">
					<b>Call Us:
						<a style="color: blue">+91 - 22 -40500699</a>
						<br>
						Email:
					</b>
						<br>
					<notbold>
						info@shoppingcompany.com
					</notbold>
				</h6>
			</td>
			</tr>
			</table>

		<div style="text-align: center"><h3>Your Order</h3></div><br>
		<div style="text-align: center">Placed Date ' . date("Y-m-d") . '</div><br>
		<div style="margin-left: 50px"> Order ID :' . $order_id . '</div><br>
		<div style="margin-left: 50px"> Track_order :<a href="http://localhost/CodeIgniter/Useraccount/track_order">http://localhost/CodeIgniter/Useraccount/track_order</a></div><br>

		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr style="text-align: center;  width: 50px;height: 50px">
					<td>Product Name</td>
					<td>Quantity</td>
					<td>Unit Price</td>
					<td>Total</td>
				</tr>';

						foreach ($this->cart->contents() as $items) {
							$message .= '<tr style="text-align: center;width: 50px;height: 50px">
						<td>' . $items['name'] . '</td>
						<td>' . $items['qty'] . '</td>
						<td>' . $items['price'] . '</td>
						<td>' . $items['price'] * $items['qty'] . '</td>
						</tr>';
						}
						$message .= '</table>
			<div style="margin-left: 540px">Total</div>
		</div>
		<br>
		<div style="margin-left: 50px">Bill To :</div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">User Adderss</td>
					<td>' . $add_1 . '</td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td>' . $add_2 . '</td>
				</tr>
			</table>
		</div><br>
		<div style="margin-left: 50px">Payment Method: Paypal</div>
	</div>

	</body>
	</head>
	</html>

';

						$email = $this->Admin_Insert->fetch_email();
						$this->email->initialize($this->config->item('email'));
						$this->email->set_newline("\r\n");
						$this->email->from($email); // change it to yours
						$this->email->to('sumit.desai@wwindia.com');// change it to yours
						$this->email->cc('sumit.desai@wwindia.com');// change it to yours
						$this->email->subject('Customer Order');
						$this->email->message($message);
						if ($this->email->send()) {
						} else {
							show_error($this->email->print_debugger());
						}

						//redirect to paypal method buy..

					//end else if valid coupon is used

						$id="Guest";
				if(empty($user_data)) {
					$this->buy($val, $name, $id);
				}
				//else show error
				else
				{
//					$user_data['userdata'] = $this->User->chekout_data($user_id);
//					$user_data['address']=$this->User->checkout_address($user_id);
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout');
					$this->load->view('user/footer_user');
					$this->load->view('user/footer_user');
				}//end else of error present

			}//end if payment type is paypal

			//if payment type is cash on delivery
			else
			{
				//insert user data
				$data = array(
//					'user_name' => $this->input->post('user_name'),
//					'user_lastname' => $this->input->post('user_lastname'),
					'user_email' => $this->input->post('user_email'),
//					'user_password' => $this->input->post('user_password')
				);


				//insert user address

				//unique mail
				$user_email = $this->input->post('user_email');
				//find user id
				$user_id = $this->User->checkout_user_guest($data, $user_email);

				//$user_id = $this->session->userdata('user_session');
				$address_data = array(
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'zipcode' => $this->input->post('zipcode'),
					'user_id' => $user_id

				);
				$address_id=$this->User->chechkout_guestuser_address($address_data);

				//				$addres_data=$this->input->post('select_address');
				//				$shipping_id=$addres_data;

				$i = 1;
				$quantity = "";
				foreach ($this->cart->contents() as $items):
					form_hidden($i . '[rowid]', $items['rowid']);
					$name = $items['name'];
					$id = $items['id'];
					$price = $this->cart->format_number($items['price']) . "<br>";
					$quantity = $items['qty'] . "<br>";
					$total = $this->cart->format_number($items['subtotal']);
					$i++;
				endforeach;

				//check products are selected in cart or not
				foreach ($this->cart->contents() as $items)
				{
					$total_amount=$this->cart->format_number($this->cart->total());
				}
				//if selected than redirect to error page
				if($total_amount <= 0 )
				{
					redirect('products/guest_checkout_error/');
				}

				$x = "";
				//fetch id of cart items
				foreach ($this->cart->contents() as $items):
					if(!empty($items['id']))
					{
						$x .= $items['id'] . ",";
					}
					else
					{

					}
				endforeach;

				//explode array of cart ids
				$y = explode(',', $x);

				$i="";
				//validation of
//				foreach ($y as $val)
//					if(!empty($val))
//					{
//						$total_quan = $this->product->check_quantity($val, $quantity);

				//check product avaliable in stock or not
				//						if ($total_quan <= 0)
				//						{
				//	$user_data['userdata'] = $this->User->chekout_data($user_id);
				//							$user_data['quntity'] = 'Out Of Stock';
				//						}
				//update quantity after order submit

				//						$product_update = array(
				//							'quntity' => $total_quan
				//						);
				// update below
				//$this->product->update_quantity($product_update, $val);

				//user use coupon code
//				$off = $this->input->post('code');
				$c_id = "";
				//check coupon code is valid or not
				/*if (!empty($off))
				{
					$c_id = $this->couponmgmt->code_id($off);
					$id = $c_id;

					//if enter invalid coupon code
					if ($c_id == null)
					{
						$user_data['invalid'] = 'Invalid Coupon';

					} else
					{
						$c_id = $id;
					}
				}
				else
				{
					//generate temporary coupon id
					$characters = '0123456789';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < 5; $i++)
					{
						$randomString .= $characters[rand(1, $charactersLength - 1)];
					}
					$c_id = $randomString;
				}
				//insert coupon data in coupon_used table
				$coupon_data = array(
					'user_id' => $user_id,
					'coupons_id' => $c_id
				);
				//					}//end if user_id loop is end
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);

*/

				$ship_address = $this->input->post('ship_address');
				if($ship_address == "register")
				{
					$shiped_id=$address_id;
				}
				elseif($ship_address == "guest")
				{
					$shipping_data = array(
						'address_1' => $this->input->post('address_3'),
						'address_2' => $this->input->post('address_4'),
						'zipcode' => $this->input->post('zipcode1'),
						'user_id' => $user_id
					);
					$shipping_id=$this->User->insert_shipping_address($shipping_data);
					$shiped_id = $shipping_id;
				}
				else
				{
					$addres_data = $this->input->post('select_address');
					$shipping_id = $addres_data;
					$shiped_id = $shipping_id;
				}

				//check coupon already used used or not
				/*if ($coup_used_id == 0)
				{
					$user_data['msg'] = 'Coupon Already Used';
				}*/

					//insert order data into order table
					$data = array(

						'user_id' =>$user_id,
						'billing_address_id' => $address_id,
						'shopping_address_id' => $shiped_id,
						'shopping_method' => 'COD',
						'shipping_charges' => $shipping,
						'coupon_id' => $c_id,
						'grand_total' => $grand_total
					);
				$order_id = $this->product->insert_order($data);
				$this->session->set_userdata('order_session', $order_id);
					//update coupon_used @order_id
					$update_coupon=array(
						'order_id' => $order_id
					);
					$this->couponmgmt->update_used_coupon($update_coupon,$c_id);

					//exploer cart items
					foreach ($this->cart->contents() as $items)
					{
						//insert order_details
						$order_data = array(
							'order_id' => $order_id,
							'product_id' => $items['id'],
							'quantity' => $items['qty'],

						);
						$this->product->insert_order_details($order_data);
					}//end foreach

					//send mail to customer and admin about order
					$this->config->item('email');
					/*$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'mail.wwindia.com',
						'smtp_port' => 25,
						'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
						'smtp_pass' => 'nb=np2^89mKn', // change it to yours
						'mailtype' => 'html',
						//'charset' => 'iso-8859-1',
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					);*/

					$add_1 = $this->input->post('address_1');
					$add_2 = $this->input->post('address_2');
					$message = '

<!--order Details-->
	<html>
	<head>
	<body>
	<br><br>
	<div style="margin-left: 120px">
		<img src="logo.jpg" style="height: 50px;margin-left: 40px">
		<br>

		<table style="margin-left: 50px;width:600px; background-color: skyblue;">
		<tr>
			<td style="width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px; width: 50px">
				<h6 style=" font-weight: normal; margin-top: -40px">
					<b>Call Us:
						<a style="color: blue">+91 - 22 -40500699</a>
						<br>
						Email:
					</b>
						<br>
					<notbold>
						info@shoppingcompany.com
					</notbold>
				</h6>
			</td>
			</tr>
			</table>
		<div style="text-align: center"><h3>Your Order</h3></div><br>
		<div style="text-align: center">Place on Date '.date("Y-m-d").'</div><br>
		<div style="margin-left: 50px"> Order ID :'.$order_id.'</div><br>
		<div style="margin-left: 50px"> Track_order :<a href="http://localhost/CodeIgniter/Useraccount/track_order">http://localhost/CodeIgniter/Useraccount/track_order</a></div><br>

		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr style="text-align: center;  width: 50px;height: 50px">
					<td>Product Name</td>
					<td>Quantity</td>
					<td>Unit Price</td>
					<td>Total</td>
				</tr>';

					foreach ($this->cart->contents() as $items)
					{
						$message.='<tr style="text-align: center;width: 50px;height: 50px">
						<td>'.$items['name'].'</td>
						<td>'.$items['qty'].'</td>
						<td>'.$items['price'].'</td>
						<td>'.$items['price'] * $items['qty'].'</td>
						</tr>';
					}
					$message.='</table>
			<div style="margin-left: 540px">Total</div>
		</div>
		<br>
		<div style="margin-left: 50px">Bill To :</div><br>
		<div>
			<table border="1" style="margin-left: 50px;;width:600px;">
				<tr>
					<td style="width: 50%">User Adderss</td>
					<td>'.$add_1.'</td>
				</tr>
				<tr>
					<td>Billing Address</td>
					<td>'.$add_2.'</td>
				</tr>
			</table>
		</div><br>
		<div style="margin-left: 50px">Payment Method: Cash on Deilivery</div>
	</div>
	</body>
	</head>
	</html>
';

					$email=$this->Admin_Insert->fetch_email();
					$this->email->initialize($this->config->item('email'));
					$this->email->set_newline("\r\n");
					$this->email->from($email); // change it to yours
					$this->email->to('sumit.desai@wwindia.com');// change it to yours
					$this->email->cc('sumit.desai@wwindia.com');// change it to yours
					$this->email->subject('Customer Order');
					$this->email->message($message);
					if ($this->email->send())
					{
					}
					else
					{
						show_error($this->email->print_debugger());
					}

		//end else if customer data is valid
		//redirect to success page

		//if no any error occure go to sccusse page
		if(empty($user_data))
		{
			//delete data from wishlist
			//			foreach ($this->cart->contents() as $items)
			//			{
			//				$product_id = $items['id'];
			//				$this->product->delete_wishlist($user_id,$product_id);
			//			}//end foreach
			//update quantity in database
			foreach ($this->cart->contents() as $items)
			{
				$item_ids = $items['id'];
				$del_qunty = $items['qty'];
				//reammaing quantity after user purchse product
				$total_quan = $this->product->check_quantity($item_ids, $del_qunty);
				$product_update = array(
					'quntity' => $total_quan
				);
				//update that in database
				$this->product->update_quantity($product_update, $item_ids);
			}
			if ($ship_address == "guest") {
				$this->load->view('user/headeruser');
				$this->load->view('user/cash_success', $address_data, $shipping_data);
				$this->load->view('user/footer_user');
			}
			else{
				$this->load->view('user/headeruser');
				$this->load->view('user/cash_success', $address_data);
				$this->load->view('user/footer_user');
			}
		}
		//else show error
		else
		{
        // $user_data['userdata'] = $this->User->chekout_data($user_id);
        // $user_data['address']=$this->User->checkout_address($user_id);

			$this->load->view('user/headeruser');
			$this->load->view('user/guest_checkout', $user_data);
			$this->load->view('user/footer_user');

		}//end else of error present
			}//end else if coupon is valid or not used coupon
		}//end else if payment using cash on delivery
	}//end function


	public function guest_checkout_error()
	{
		$user_id=$this->uri->segment(3);
		$user_data['amount_total'] = 'Plseae Select Items';
		//	$user_id=$this->session->userdata('user_session');
		$user_data['userdata'] = $this->User->chekout_data($user_id);
		$user_data['address']=$this->User->checkout_address($user_id);
		$this->load->view('user/headeruser');
		$this->load->view('user/guest_checkout', $user_data);
		$this->load->view('user/footer_user');
	}
	/**
	 * display single product with details
	 * @product data = image,name.price
	 * @cms = cms_images,cms_content,cms_title,cms_discription
	 * @category = category list
	 * @banner = banner images
	 * @recommend = recently add product
	 * #model = user,bannermgmt,category,cmsadmin,
	 * @return @data
	 * @package CodeIgniter
	 * @subpackage Controller
	 * @author Sumit Desai
	 */
	public function product_view()                  //product details
	{
		$data['category']=$this->User->home_category();             //fetch list of category
		$data['banner']=$this->Bannermgmt->home_banner();           //fetch images of banner
		$data['product']=$this->User->view_product();               //fetch image,name,price,description,ect of product
		$x=$this->User->find_recom();
		$data['recommend']=$this->User->select_recom($x);           //fetch data of reommernd items
		$this->load->view('user/headeruser');
		$this->load->view('user/product_details',$data);
		$this->load->view('user/footer_user');
	}

}//end class