
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
      <td style="width: 50%;text-align: left" >
         <b>Order ID &nbsp;&nbsp;&nbsp;&nbsp; </b><?php echo $this->session->userdata('order_session');?><BR>
         <b>Order Date</b> <?php echo date("Y-m-d")?>
      </td>
      <td style="width: 50%;text-align: left">
         <b>Billing Address</b><br>
         <?php echo $address_1;?><br>
         <?php echo $address_2;?><br>
         <?php echo $zipcode;?>
      </td>
      <!--<td style="width: 240px;text-align: left">
         <b>Shipping Adderss</b><br>
<!--         --><?php //if(isset($shipping_data)){echo $address_1;}else{echo $address_1;}?><!--<br>-->
<!--         --><?php //if(isset($shipping_data)){echo $address_2;}else{echo $address_2;}?><!--<br>-->
<!--         --><?php //if(isset($shipping_data)){echo $zipcode;}else{echo $zipcode;}?><!--<br>-->
<!--      </td>-->
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
   <?php $shipcharge = '50' ?>
   <?php $total= $this->cart->format_number($this->cart->total());
   $x_total=str_replace(',', '', $total);
   if($x_total > 50)
   {?>
   <H4 style="margin-left: 550px">Shipping Charges:Rs.<?php echo $shipcharge ?> </H4>
      <H4 style="margin-left: 570px">Grand Total:Rs.<?php echo $x_total+$shipcharge;?> </H4>
   <?php }else{echo "";}?>
   <H4 style="margin-left: 570px">Grand Total:Rs.<?php echo $x_total;?> </H4>
</div>
   <?php $this->cart->destroy();?>
</div>