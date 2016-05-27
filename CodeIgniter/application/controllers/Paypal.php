<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
	 function  __construct(){
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('product');
	 }

	 function success(){
	    //get the transaction data
		 $this->load->view('user/headeruser');

		 $paypalInfo = $this->input->post();


		$data['item_number'] = $paypalInfo['item_number'];
		$data['txn_id'] = $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['custom'] = $paypalInfo["custom"];
		$data['item_name'] = $paypalInfo["item_name"];


		 echo 'id'.$user_id = $paypalInfo['custom'];
		 echo 'total'.$total = $paypalInfo['payment_gross'];
		 echo 't_id'.$trans_id = $paypalInfo['txn_id'];
		 echo 'i_no'.$item_id = $paypalInfo['item_number'];

		 $user_name=$this->product->find_username($user_id);

		 $payment_data=array(
			 'name' => $user_name,
		 	'created_by' => $user_id
		 );
		 $payment_id=$this->product->payment_data($payment_data);

		 $total_quntity=$this->product->total_quntity($item_id);

		 $reamining_quntity=$this->product->find_quntity($item_id,$total_quntity);

		 $product_update=array(
			 'quntity' => $reamining_quntity
		 );
		 $this->product->update_quantity($product_update,$item_id);

		 $order_data=array(

			 'payment_getway_id' => $payment_id,
			 'transaction_id' => $trans_id,
			 'grand_total' => $total,
		 );
		$this->product->order_data($order_data,$user_id);


		//pass the transaction data to view
		$this->load->view('/paypal/success',$data);
		 $this->load->view('user/footer_user');
	 }
	 
	 function cancel(){
        $this->load->view('paypal/cancel');
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