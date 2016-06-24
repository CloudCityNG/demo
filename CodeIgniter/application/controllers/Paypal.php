<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
	 function  __construct(){
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('product');
		$this->load->model('Admin_Insert');
	 }

	 function success()
	 {
		 //get the transaction data
		 $this->load->view('user/headeruser');
		 //array return form paypal
		 $paypalInfo = $this->input->post();

		//putin data variable
		 $data['data'] = $paypalInfo;

		//$data['item_number'] = $paypalInfo['item_number'];
		 $data['txn_id'] = $paypalInfo["txn_id"];
		 $data['payment_gross'] = $paypalInfo["payment_gross"];
		 $data['custom'] = $paypalInfo["custom"];

		//$data['item_name'] = $paypalInfo["item_name"];

		 $user_id = $paypalInfo['custom'];
		 $total = $paypalInfo['payment_gross'];
		 $trans_id = $paypalInfo['txn_id'];
		 if(!empty($paypalInfo['mc_shipping'])){
		 $shipping = $paypalInfo['mc_shipping'];}
		 else{ $shipping = "0";}
		  if(!empty($paypalInfo['discount'])){
		 $discount =$paypalInfo['discount'];}
		 else{}
		 //echo 'i_no' . $item_id = $paypalInfo['item_number'];

		// $user_name = $this->product->find_username($user_id);
		 //insert into payment getway table
		 $payment_id='';
		 $payment_data = array(
			 'name' => $user_id,
			 'created_by' => $user_id
		 );
		 $payment_id = $this->product->payment_data($payment_data);

		//exploer user cart
		 foreach ($this->cart->contents() as $items)
		 {
			  $prod_name = $items['name'] . "<p>";
			  $prod_id = $items['id'] . "<p>";
			  $prod_price = $items['price'] . "<p>";
			  $prod_qty = $items['qty'] . "<p>";

			 //getch payment id
			 //$payment_id = $this->product->payment_data($payment_data);
			 //fetch total quantity of particular product
			 $total_quntity = $this->product->total_quntity($prod_id);
			 //find reamming quantity
			 $reamining_quntity = $this->product->find_quntity($prod_id, $total_quntity);
			 //update quantity
			 $product_update = array(
				 'quntity' => $reamining_quntity
			 );
			 $this->product->update_quantity($product_update, $prod_id);
			 $this->product->delete_wishlist($user_id,$prod_id);
		 }
		 $o_id=$this->session->userdata('order_session');
		 //update uaser order after order completed
		 $order_data = array(
			 'payment_getway_id' => $payment_id,
			 'transaction_id' => $trans_id,
			 'grand_total' => $total,
			 'shipping_charges' => $shipping
		 );
		 $this->product->order_data($order_data,$o_id);		//model product

		 //delete data from wishlist
		 // $this->session->unset_userdata('order_session');
		 // $this->session->unset('order_ssession');
		 // redirect to sccuss page
		if(!empty($discount)){
		 $order_data['discount']=$discount;}
		 else{}
		 $add_id=$this->session->userdata('address_id');

		 $order_data['billadd']=$this->product->fetch_address($add_id);

		 $ship_id=$this->session->userdata('shipping_id');
		 if(!empty($ship_id)) {
			 $order_data['shipadd'] = $this->product->fetch_ship($ship_id);
			 $this->load->view('/paypal/success',$order_data);
			 $this->load->view('user/footer_user');
		 }else {
		 	 $this->load->view('/paypal/success',$order_data);
			 $this->load->view('user/footer_user');
		 }
	 }
	//if payment fail redirect to cancel page
	 function cancel()
	 {
		 $o_id=$this->session->userdata('order_session');
		 $this->product->delete_order($o_id);

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
			<td style="width: 250px;height: 150px; text-align: center"><b><h4>Your Order is Cancel</h4></b>
				Thank
				you again for your visit Us.
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
		<div style="text-align: center"><h3>Your below Order Cancel From Your Side</h3></div><br>
		<div style="text-align: center">Place on Date '.date("Y-m-d").'</div><br>
		<div style="margin-left: 50px"> Order ID :'.$o_id.'</div><br>
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

		</div>


		</div>

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
		 $this->session->unset_userdata('order_session');
		 $this->cart->destroy();
		 $this->load->view('user/headeruser');
		 $this->load->view('/paypal/cancel');
		 $this->load->view('user/footer_user');
	 }

	 function ipn(){
		//paypal return transaction details array
		$paypalInfo	= $this->input->post();
		$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']	= $paypalInfo["item_number"];
		$data['txn_id']	= $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']	= $paypalInfo["payment_status"];

		$paypalURL = $this->paypal_lib->paypal_url;		
		$result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
		//check whether the payment is verified
		if(eregi("VERIFIED",$result))
		{
			//insert the transaction data into the database
			$this->product->insertTransaction($data);
		}
    }
}