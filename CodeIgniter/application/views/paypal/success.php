
<div style="margin-left: 120px">

	<a style="margin-bottom:10px; display: inline" href="<?php echo base_url()?>"><img src="<?php echo base_url('images/home/logo.png')?>" alt="" /></a>
	<h6 style=" margin-left: 500px; font-weight: normal; margin-top: -40px"><b>Call Us:
			<a style="color: blue">+91 - 22 -40500699</a><br>
			Email:</b>
		<br>
		<notbold >
			info@shoppingcompany.com
		</notbold>
	</h6>
	<div style="margin-left: 50px;width:600px">To log in when visiting our site just click Login at the top of every page, and then enter your email address and password.</div>
	<table style="width:720px;text-align: center" class="table ">
		<tr style="border-collapse: collapse;border-bottom: thick" >
			<td style="width: 240px;text-align: left" >
				<b>Order ID &nbsp;&nbsp;&nbsp;&nbsp; </b><?php echo $this->session->userdata('order_session');?><BR>
				<b>Order Date</b> <?php echo date("Y-m-d")?><br>
				<b>Payment ID</b> <?php echo $payment_getway_id?><br>
				<b>Transaction ID</b> <?php echo $transaction_id?><br>

			</td>
			<td style="width: 150px;text-align: left">
				<b>Billing Address</b><br>
				<?PHP foreach($billadd as $value){$value=(array)$value;?>
				<?php echo $value['address_1'];?><br>
				<?php echo $value['address_2'];?><br>
				<?php echo $value['zipcode'];}?>
			</td>
<!--			<td style="width: 300px;text-align: left">-->
<!--				<b>Shipping Adderss</b><br>-->
<!--				--><?php //if(isset($shipadd)){foreach($shipadd as $item){$item=(array)$item;?>
<!--				--><?php //echo $item['address_1'];?><!--<br>-->
<!--				--><?php //echo $item['address_2'];?><!--<br>-->
<!--				--><?php //echo $item['zipcode'];?><!--<br>-->
<!--				--><?php //}}else{ foreach($billadd as $value){$value=(array)$value;?>
<!--					--><?php //echo $value['address_1'];?><!--<br>-->
<!--					--><?php //echo $value['address_2'];?><!--<br>-->
<!--					--><?php //echo $value['zipcode'];}}?>
<!--			</td>-->
		</tr>
	</table>
	<table style="width:720px;text-align: center" class="table table-bordered">
		<tr>
			<th style=" width: 150px;text-align: center">Product</th>
			<th style=" width: 150px;text-align: center">Quantity</th>
			<th style=" width: 150px;text-align: center">Price</th>
		</tr>
		<?php foreach ($this->cart->contents() as $items){?>
			<tr style="text-align: center">
			<td>	<?php echo $items['name']?></td>
			<td>	<?php echo "Rs.".$items['price']?></td>
			<td>	<?php echo $items['qty']?></td>
			</tr><?php }?>
	</table>
<!--	--><?php //if(isset($discount)){?>
	<h4 style="margin-left: 520px">Discount:- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if(isset($discount)){echo $discount;}else{echo "";}?></h4>
	<h4 style="margin-left: 520px">Shipping Charges:- <?php if(isset($shipping_charges)){echo $shipping_charges;}else{echo "";}?></h4>
	<H4 style="margin-left: 520px">Grand Total:-  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo $grand_total ?> </H4>
</div>
<?php $this->cart->destroy();?>