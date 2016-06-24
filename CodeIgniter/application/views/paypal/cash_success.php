<div style="text-align: center">
   <h2 style="text-align: center; font-family: 'quicksandbold'; font-size:16px; color:#313131; padding-bottom:8px;">Dear Member</h2>
   <h4 style="text-align: center;  color: #646464; ">Thank you for purchase</h4><br/>

   <p style="text-align: center">Your Product Details are below:</p>

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

         </tr><?php }?>
   </table>
</div>