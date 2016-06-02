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