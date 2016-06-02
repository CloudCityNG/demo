<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller
{
	function  __construct() {
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->library('paypal');
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

	/*
	 * set appropriat URLS
	 * set filed to send to paypal server
	 * find discount
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
		else{

			$discount = 0;
		}
		//set cart for send data to paypal
		foreach ($carted as $val) {
			$this->paypal->add_field('item_number_' . $i, $i);
			$this->paypal->add_field('item_name_' . $i, $val['name']);
			$this->paypal->add_field('amount_' . $i, ($val['price']-$discount));
			$this->paypal->add_field('quantity_' . $i, $val['qty']);
			$i++;
		}
		$this->paypal->add_field('custom', $user_id);
		$this->paypal->add_field('business', $paypalID);
		$this->paypal->add_field('notify_url', base_url() . $notifyURL);
		$this->paypal->add_field('cancel_return', base_url() . $cancelURL);
		$this->paypal->add_field('return',$returnURL);

		$this->paypal->submit_paypal_post();

	}

	/*
	 * user data validation
	 * insert new user data
	 * validation of items avalible in stock or not
	 * check coupon code valid or not
	 * check coupon code reuse or not
	 * payment method paypal or cash on delivery
	 * insert data in appropriat tables @order,order_details,coupon_used
	 * update data in appropriat tables @product,order_details,coupons_used
	 * calculate shipping charges
	 */
	public function product_data()
	{
		//fetch total amount form fornt end
		$total = $this->input->post('total');
		//shipping charge
		if($total >100)
		{
			$shipping=50;			//if total price is greater than 100,apply shipping charge
		}
		else
		{
			$shipping=0;			//else shipping is free
		}

		$grand_total=$total+$shipping;//grand total

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
			$this->load->view('user/headeruser');
			$this->load->view('user/checkout');
			$this->load->view('user/footer_user');
		}
		else
		{
			//if cutomer pay payment using paypal
			if ($this->input->post('payment_type') == 'paypal') {
				//insert user data
				$data = array(
					'user_name' => $this->input->post('user_name'),
					'user_lastname' => $this->input->post('user_lastname'),
					'user_email' => $this->input->post('user_email'),
					'user_password' => $this->input->post('user_password')
				);
				//insert user address
				$address_data = array(
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'zipcode' => $this->input->post('zipcode'),
				);
				//unique mail
				$user_email = $this->input->post('user_email');
				//find user id
				$user_id = $this->User->checkout_user($data, $address_data, $user_email);
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
					if (!empty($val))
					{
						//get total quantity of particular item
						$total_quan = $this->product->check_quantity($val, $quantity);

						//check product avaliable in stock or not
						if ($total_quan < 0)
						{
							//redirect to checkout page with error msg
							$user_data['userdata'] = $this->User->chekout_data($user_id);
							$user_data['quntity'] = 'Out Of Stock';
							$this->load->view('user/headeruser');
							$this->load->view('user/checkout', $user_data);
							$this->load->view('user/footer_user');
						}
						$c_id = "";

						//get coupon code form front end
						$off = $this->input->post('code');

						//if customer enters coupon code
						if (!empty($off))
						{
							$c_id = $this->couponmgmt->code_id($off);
							$id = $c_id;

							//if enter invalid coupon code
							if ($c_id == null)
							{
								//redirect to checkout page with error msg
								$user_data['userdata'] = $this->User->chekout_data($user_id);
								$user_data['invalid'] = 'Invalid Coupon';
								$this->load->view('user/headeruser');
								$this->load->view('user/checkout', $user_data);
								$this->load->view('user/footer_user');
							}
							else
							{
								$c_id = $id;
							}
						}
						//if customer dont used coupons
						else
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
					}
				//check coupon already used or not
				//fetch coupon id..
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);

				//if customer try to re-use coupon code
				if ($coup_used_id == 0) {

					//redirect to checkout page with error msg
					$user_data['userdata'] = $this->User->chekout_data($user_id);
					$user_data['msg'] = 'Coupon Already Used';
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout', $user_data);
					$this->load->view('user/footer_user');
				}
				else
				{
					//order data
					$data = array(
						'user_id' => $user_id,
						'billing_address_id' => $this->input->post('address_1'),
						'shopping_address_id' => $this->input->post('address_2'),
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
					foreach ($this->cart->contents() as $items)
					{
						//insert order details into  order_details table
						$order_data = array(
							'order_id' => $order_id,
							'product_id' => $items['id'],
							'quantity' => $items['qty'],
						);
						$this->product->insert_order_details($order_data);
					}

					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'mail.wwindia.com',
						'smtp_port' => 25,
						'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
						'smtp_pass' => 'nb=np2^89mKn', // change it to yours
						'mailtype' => 'html',
						//'charset' => 'iso-8859-1',
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					);

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
			<td style="display:inline;width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px; display: inline;width: 50px">
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
		<div style="text-align: center">Place on Date</div><br>
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
		<div style="margin-left: 50px">Payment Method: Paypal</div>
	</div>

	</body>
	</head>
	</html>

';
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('sumit.desai@wwindia.com'); // change it to yours
					$this->email->to('sumit.desai@wwindia.com');// change it to yours
					$this->email->cc('sumit.desai@wwindia.com');// change it to yours
					$this->email->subject('Customer Order');
					$this->email->message($message);
					if ($this->email->send())
					{
					} else
					{
						show_error($this->email->print_debugger());
					}

					//redirect to paypal method buy..
					$this->buy($val, $name, $user_id);
				}//end else if valid coupon is used
			}//end if payment type is paypal

			//if payment type is cash on delivery
			else
			{
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
				$this->User->chechkout_user_address($address_data,$user_id);
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
				foreach ($y as $val)
					if(!empty($val))
					{
						$total_quan = $this->product->check_quantity($val, $quantity);

						//check product avaliable in stock or not
						if ($total_quan <= 0)
						{
							echo "error";
							$user_data['userdata'] = $this->User->chekout_data($user_id);
							$user_data['quntity'] = 'Out Of Stock';
							$this->load->view('user/headeruser');
							$this->load->view('user/checkout', $user_data);
							$this->load->view('user/footer_user');
							break;
						}
						//update quantity after order submit
						$product_update = array(
							'quntity' => $total_quan
						);
						$this->product->update_quantity($product_update, $val);

						//user use coupon code
						$off = $this->input->post('code');
						$c_id = "";
						//check coupon code is valid or not
						if (!empty($off))
						{
							$c_id = $this->couponmgmt->code_id($off);
							$id = $c_id;

							//if enter invalid coupon code
							if ($c_id == null)
							{
								////redirect to previous page with apporiate error msg
								$user_data['userdata'] = $this->User->chekout_data($user_id);
								$user_data['invalid'] = 'Invalid Coupon';
								$this->load->view('user/headeruser');
								$this->load->view('user/checkout', $user_data);
								$this->load->view('user/footer_user');

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
					}//end if user_id loop is end
				$coup_used_id = $this->couponmgmt->uses($c_id, $user_id, $coupon_data);

				//check coupon already used used or not
				if ($coup_used_id <= 0)
				{
					//redirect to previous page with apporiate error msg
					$user_data['userdata'] = $this->User->chekout_data($user_id);
					$user_data['msg'] = 'Coupon Already Used';
					$this->load->view('user/headeruser');
					$this->load->view('user/checkout', $user_data);
					$this->load->view('user/footer_user');
				}
				else
				{
					//insert order data into order table
					$data = array(
						'user_id' => $user_id,
						'billing_address_id' => $this->input->post('address_1'),
						'shopping_address_id' => $this->input->post('address_2'),
						'shopping_method' => 'COD',
						'shipping_charges' => $shipping,
						'coupon_id' => $c_id,
						'grand_total' => $grand_total
					);
					$order_id = $this->product->insert_order($data);

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
					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'mail.wwindia.com',
						'smtp_port' => 25,
						'smtp_user' => 'sumit.desai@wwindia.com', // change it to yours
						'smtp_pass' => 'nb=np2^89mKn', // change it to yours
						'mailtype' => 'html',
						//'charset' => 'iso-8859-1',
						'charset' => 'utf-8',
						'wordwrap' => TRUE
					);

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
			<td style="display:inline;width: 250px;height: 150px; text-align: center"><b><h4>THANK YOU FOR YOUR ORDER
				FROM MY SHOPPING CAR</h4></b>
				Once your package ships we will send
				an email with a link to track your order.
				Your order summary is below. Thank
				you again for your business.
			</td>
			<td  style="margin-left: 10px; display: inline;width: 50px">
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
		<div style="text-align: center">Place on Date</div><br>
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
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from('sumit.desai@wwindia.com'); // change it to yours
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

				}//end else if coupon is valid or not used coupon
			}//end else if payment using cash on delivery
		}//end else if customer data is valid
		//redirect to success page
		$this->load->view('user/headeruser');
		$this->load->view('paypal/cash_success');
		$this->load->view('user/footer_user');
	}
}