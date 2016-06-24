<!DOCTYPE html>
<?php $i = 1; ?>
<?php
if(!empty($userdata)){
    foreach($userdata as $item)
        $item=(array)$item;}
else{
    echo "";
}
?>
<?php
if(!empty($address)){
    foreach($address as $value)
        $value=(array)$value;}
else{
    echo "";
}
?>

<script>
    function get_discount()
    {
        alert('hello');
        var code=document.getElementById('discount').value;
        alert(code);
        $.ajax({ url: '<?php echo site_url('admin/coupon/discount');?>',
            data: {code: code},
            type: 'post',
            success: function(output) {
                // alert(output);
                document.getElementById('total').value = output;
            }
        });
    }
</script>

<script>
    function get_discount()
    {

        var code=document.getElementById('discount').value;

        $.ajax({ url: '<?php echo site_url('admin/coupon/discount');?>',
            data: {code: code},
            type: 'post',

            //alert('code');
            success: function(output) {
                document.getElementById('total').value=output;
            }
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("#ship").hide();
        });
        $("#show").click(function(){
            $("#ship").show();
        });
    });
</script>
<link rel="stylesheet" href="<?php echo base_url('css/input.css')?>">

<script src="<?php echo base_url('js/checkout_guest_validation.js')?>"></script>
<section id="cart_items" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">

            <!--                <div class="tab-pane" id="tab-payment">-->
            <div class="row">

                <div class="col-sm-6 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form name="form" onsubmit="return submit_guestform()" action="<?php echo site_url('products/guest_data')?>" method="post">

                                <input name="user_name" value="<?php if(!empty($userdata)){echo $item['user_name'];}else{echo set_value('user_name');}?>" type="text" placeholder="Company Name">
                                <div id="first" style="display:inline; color: red" >
                                    <?php echo form_error('user_name'); ?>
                                </div><br>
                                <input name="user_lastname" value="<?php if(!empty($userdata)){echo $item['user_lastname'];}else{echo set_value('user_lastname');}?>" type="text" placeholder="Last Name *">
                                <div id="last" style="display:inline; color: red" >
                                    <?php echo form_error('user_lastname'); ?>
                                </div><br>
                                <input name="user_email" value="<?php if(!empty($userdata)){echo $item['user_email'];}else{echo set_value('user_email');}?>" type="text" placeholder="Email*">
                                <div id="email" style="display:inline; color: red" >
                                    <?php echo form_error('user_email'); ?>
                                </div><br>

                                <input name="address_1" value="<?php if(!empty($address)){echo $value['address_1'];}else{echo set_value('address_1');}?>" type="text" placeholder="Address 1 *">
                                <div id="add1" style="display:inline; color: red" >
                                    <?php echo form_error('address_1'); ?>
                                </div><br>
                                <input name="address_2" value="<?php if(!empty($address)){echo $value['address_2'];}else{echo set_value('address_2');}?>"type="text" placeholder="Address 2">
                                <div id="add2" style="display:inline; color: red" >
                                    <?php echo form_error('address_2'); ?>
                                </div><br>
                                <input name="zipcode" value="<?php if(!empty($address)){echo $value['zipcode'];}else{echo set_value('zipcode');}?>" type="number" placeholder="Zip / Postal Code *">
                                <div id="zipcode" style="display:inline; color: red" >
                                    <?php echo form_error('zipcode'); ?>
                                </div><br>
                                    <ul class="nav">
                                        <li>
                                            <label> Same Shipping Address &nbsp;&nbsp;<input checked id="hide" type="radio" value="register" name="ship_address"> </label>
                                        </li>
                                        <li>
                                            <label>With Differnt Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="show" type="radio" value="guest" name="ship_address"> </label>
                                        </li>
                                    </ul>
                        </div>
                    </div>
                </div>
                <!--                <div class="col-sm-4">-->
                <!--                    <div class="order-message">-->
                <!--                        <p>Shipping Order</p>-->
                <!--                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>-->
                <!--                        <label><input type="checkbox"> Shipping to bill address</label>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div id="ship">
                <div class="col-sm-6">
                   <!-- <?php
                    if(!empty($address_all))
                    {
                        $i=1;
                        foreach($address_all as $value) {
                            $value = (array)$value;
                            ?>


                            <div class="col-sm-6">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo ">
                                            <center>Address</center>
                                            <table class="table table-bordered">
                                                <tr><td style="width: 250px">City-</td><td style="width: 200px"><?php echo $value['city']?></td></tr>
                                                <tr><td>State</td><td><?php echo $value['state']?></td></tr>
                                                <tr><td>Country</td><td><?php echo $value['country']?></td></tr>
                                                <tr><td>Address</td><td><?php echo $value['address_1']?></td></tr>
                                                <tr><td>Address</td><td><?php echo $value['address_2']?></td></tr>
                                                <tr><td>Zipcode</td><td><?php echo $value['zipcode']?></td></tr>
                                            </table>
                                            <input id="<?php echo $i ?>" value="<?php echo $value['address_id']?>" name="select_address" style="width: 190px;margin-top: -5px;margin-bottom: 10px" type="radio">

                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $i++; }}else {
                        echo "Not Address Updated.. Add New Address..";

                        ?>-->
                        <div class="col-sm-12 clearfix">
                            <div class="bill-to">
                                <p>Shipping Address</p>
                                <div class="form-one">
<!--                                    <form name="form" onsubmit="return submit_form()" action="--><?php //echo site_url('products/product_data')?><!--" method="post"><!--                            <form action="--><?php ////base_url('products/product_data')?><!--<!--" method="post">-->

                                        <input class="check_guest"  name="address_3" value="<?php if(!empty($address)){echo $value['address_1'];}else{echo set_value('address_1');}?>" type="text" placeholder="Address 1 *">
                                        <div id="add3" style="display:inline; color: red" >
                                            <?php echo form_error('address_3'); ?>
                                        </div><br><br>
                                        <input class="check_guest"  name="address_4" value="<?php if(!empty($address)){echo $value['address_2'];}else{echo set_value('address_2');}?>"type="text" placeholder="Address 2">
                                        <div id="add4" style="display:inline; color: red" >
                                            <?php echo form_error('address_4'); ?>
                                        </div><br><br>
                                        <input class="check_guest"  name="zipcode1" value="<?php if(!empty($address)){echo $value['zipcode'];}else{echo set_value('zipcode');}?>" type="number" placeholder="Zip / Postal Code *">
                                        <div id="zipcode1" style="display:inline; color: red" >
                                            <?php echo form_error('zipcode1'); ?>
                                        </div><br>
                                </div>
                            </div>
                        </div>

                    <?php  }  ?><div id="addressship" style="display:inline; color: red" >
                        <?php echo form_error('select_address'); ?>
                    </div>
                </div>
            </div>
        </div>
</div>



        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <!--            <form action="--><?php //echo site_url('home/update_cart')?><!--" method="post">-->
            <!--            <form onsubmit="return submit_form()" action="--><?php //echo site_url('products/product_data')?><!--" method="post">-->
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->cart->contents() as $items):?>

                        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                        <tr>
                            <td class="cart_product">
                                <img src="<?php echo base_url().'/images/'.$items['image_name'];?>" style="width: 100px;height: 100px">                    </td>
                            <td class="cart_description">
                                <input name="product_name" readonly type="text" style="border: 0px" value="<?php echo $items['name'];?>">
                                <p> <input name="product_id" readonly type="hidden" style="border: 0px" value="<?php echo $items['id']?>"></p>
                            </td>
                            <td class="cart_price">
                                <p> <input type="text" style="border: 0px" readonly name="product_price"  value="<?php echo $this->cart->format_number($items['price']);?>"></p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <?php echo form_input(array( 'name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'readonly' => 'readonly'));?>
                                    <?php if(isset($quantity)){echo "<p style='color: red'>".$quantity."</p>";}else{echo "";}?>
                                </div>
                                <?php if(isset($quantity)){echo "<p style='color: red'>".$quantity."</p>";}else{echo "";}?>

                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price"><?php echo $this->cart->format_number($items['subtotal']); ?></p>
                            </td>
                            <!--                                <td class="cart_delete">-->
                            <!--                                    <a class="cart_quantity_delete" href="--><?php //echo base_url('home/delete_cart/'.$items['rowid'])?><!--"><i class="fa fa-times"></i></a>-->
                            <!--                                </td>-->
                        </tr>
                        <?php $i++; ?>

                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"> </td>
                        <td class="right"><strong>Total</strong></td>

                        <td class="right">$<input id="total" name="total" style="border: 0px" readonly value="<?php echo $this->cart->format_number($this->cart->total());?>"><?php if(isset($amount_total)){echo "<p style='color: red'>".$amount_total."</p>";}else{echo "";}?></td>
                    </tr>
                </table>

                <!--        </div>-->
                <!--        <div class="payment-options">-->
            </div>
					<span style="margin-left: 400px;display: inline">
						<label><input type="radio" name="payment_type" value="paypal"> Paypal Payment</label>
					</span>
					<span style="margin-left: 50px;display: inline">
						<label><input type="radio" name="payment_type" value="cash_payment" > Cash Payment</label>
					</span><br>
					<span style="margin-left: 525px">
						<input type="submit" value="submit">
					</span>
            </form>
        </div>
</section> <!--/#cart_items-->






<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>