<!DOCTYPE html>
<div>
    <h2 style="text-align: center; font-family: 'quicksandbold'; font-size:16px; color:#313131; padding-bottom:8px;">Dear Member</h2>
    <h4 style="text-align: center;  color: #646464; ">Your payment was successful, thank you for purchase.</h4><br/>
    <div style="margin-left: 400px">
	<span style="color: #646464;">Item Number :

      	<strong style=" margin-left:50px;font:15px Arial,Helvetica,sans-serif;color:black ;"><?php echo $item_number; ?></strong>
  	</span><br/></div>
		<div style="margin-left: 400px">
	<span style="color: #646464;">TXN ID :</span>
      	<strong style=" margin-left:85px;font:15px Arial,Helvetica,sans-serif;color:black"><?php echo $txn_id; ?></strong>
  	<br/></div>
			<div style="margin-left: 400px">
	<span style="color: #646464;">Amount Paid :
      	<strong style=" margin-left:50px;font:15px Arial,Helvetica,sans-serif;color:black">$<?php echo $payment_gross ?></strong>
  	</span><br/></div>
				<div style="margin-left: 400px">
	<span style="color: #646464;">Cutomer Id
      	<strong style=" margin-left:67px;font:15px Arial,Helvetica,sans-serif;color:black"><?php echo $custom; ?></strong>
  	</span><br/></div>
		</div>
</div>