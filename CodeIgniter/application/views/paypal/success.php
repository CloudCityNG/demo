<!DOCTYPE html>
<div>
    <h2 style="text-align: center; font-family: 'quicksandbold'; font-size:16px; color:#313131; padding-bottom:8px;">Dear Member</h2>
    <h4 style="text-align: center;  color: #646464; ">Your payment was successful, thank you for purchase.</h4><br/>
    <div style="margin-left: 400px">
		<span style="color: #646464;">Cutomer Id
      	<strong style=" margin-left:67px;font:15px Arial,Helvetica,sans-serif;color:black"><?php echo $custom; ?></strong>
  	</span><br/></div>
	<div style="margin-left: 400px">
		<span style="color: #646464;">TXN ID :</span>
		<strong style=" margin-left:85px;font:15px Arial,Helvetica,sans-serif;color:black"><?php echo $txn_id; ?></strong>
		<br/></div>
	<div style="margin-left: 400px">
	<span style="color: #646464;">Amount Paid :
      	<strong style=" margin-left:50px;font:15px Arial,Helvetica,sans-serif;color:black">$<?php echo $payment_gross ?></strong>
  	</span><br/></div>
	<span style="color: #646464;">Amount Paid :
      	<strong style=" margin-left:50px;font:15px Arial,Helvetica,sans-serif;color:black">$<?php echo $mc_shipping ?></strong>
  	</span><br/></div>
	<div style="margin-left: 400px">
	</div>
	</div>
	<div style="text-align: center">
		<table align="center" border="1">
		<tr>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Product Quantity</th>
		</tr>
		<?php foreach ($this->cart->contents() as $items){?>
		<tr style="text-align: center">

			<td>	<?php echo $items['name']?></td>
			<td>	<?php echo 	$items['price']?></td>
			<td>	<?php echo $items['qty']?></td>

		</tr><?php } ?>
	</table>

</div>