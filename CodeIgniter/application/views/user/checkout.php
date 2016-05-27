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




<script src="<?php echo base_url('js/checkout_validation.js')?>"></script>
<section id="cart_items" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>


                    <label><input onclick="return register()" type="radio" name="checkout"> Register Account</label>
                </li>
                <li>

                    <label><input type="radio" name="checkout"> Guest Checkout</label>
                </li>
                <li>
                    <a href="<?php echo site_url('home')?>"><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">

<!--                <div class="tab-pane" id="tab-payment">-->
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form action="<?php echo site_url('admin/coupon/discount')?>" method="post">
                            <input type="text" placeholder="Discount" name="percent_off">
                        <input type="submit" class="btn btn-primary" value="Continue" >
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form name="form" onsubmit="return submit_form()" action="<?php echo site_url('products/product_data')?>" method="post"><!--                            <form action="--><?php //base_url('products/product_data')?><!--" method="post">-->

                                <input name="user_name" value="<?php if(!empty($userdata)){echo $item['user_name'];}else{echo "";}?>" type="text" placeholder="Company Name">
                                <div id="first" style="display:inline; color: red" >
                                <?php echo form_error('user_name'); ?>
                                </div><br>
                                <input name="user_lastname" value="<?php if(!empty($userdata)){echo $item['user_lastname'];}else{echo "";}?>" type="text" placeholder="Last Name *">
                                <div id="last" style="display:inline; color: red" >
                                    <?php echo form_error('user_lastname'); ?>
                                </div><br>
                                <input name="user_email" value="<?php if(!empty($userdata)){echo $item['user_email'];}else{echo "";}?>" type="text" placeholder="Email*">
                                <div id="email" style="display:inline; color: red" >
                                    <?php echo form_error('user_email'); ?>
                                </div><br>
                                <input name="user_password" value="<?php if(!empty($userdata)){echo $item['user_password'];}else{echo "";}?>" type="password" placeholder="Password">
                                <div id="pass" style="display:inline; color: red" >
                                    <?php echo form_error('user_password'); ?>
                                </div><br>

                                <input name="address_1" value="<?php if(!empty($userdata)){echo $item['address_1'];}else{echo "";}?>" type="text" placeholder="Address 1 *">
                                <div id="add1" style="display:inline; color: red" >
                                    <?php echo form_error('address_1'); ?>
                                </div><br>
                                <input name="address_2" value="<?php if(!empty($userdata)){echo $item['address_2'];}else{echo "";}?>"type="text" placeholder="Address 2">
                                <div id="add2" style="display:inline; color: red" >
                                    <?php echo form_error('address_2'); ?>
                                </div><br>
                                <input name="zipcode" value="<?php if(!empty($userdata)){echo $item['zipcode'];}else{echo "";}?>" type="text" placeholder="Zip / Postal Code *">
                                <div id="zipcode" style="display:inline; color: red" >
                                    <?php echo form_error('zipcode'); ?>
                                </div><br>
                        </div>

<!--                        <div class="form-two">-->
<!---->
<!--                                <input value="--><?php //if(!empty($userdata)){echo $item['zipcode'];}else{echo "";}?><!--" type="text" placeholder="Zip / Postal Code *">-->
<!--                                <select>-->
<!--                                    <option>-- Country --</option>-->
<!--                                    <option>United States</option>-->
<!--                                    <option>Bangladesh</option>-->
<!--                                    <option>UK</option>-->
<!--                                    <option>India</option>-->
<!--                                    <option>Pakistan</option>-->
<!--                                    <option>Ucrane</option>-->
<!--                                    <option>Canada</option>-->
<!--                                    <option>Dubai</option>-->
<!--                                </select>-->
<!--                                <select>-->
<!--                                    <option>-- State / Province / Region --</option>-->
<!--                                    <option>United States</option>-->
<!--                                    <option>Bangladesh</option>-->
<!--                                    <option>UK</option>-->
<!--                                    <option>India</option>-->
<!--                                    <option>Pakistan</option>-->
<!--                                    <option>Ucrane</option>-->
<!--                                    <option>Canada</option>-->
<!--                                    <option>Dubai</option>-->
<!--                                </select>-->
<!--                                <input type="password" placeholder="Confirm password">-->
<!--                                <input type="text" placeholder="Phone *">-->
<!--                                <input type="text" placeholder="Mobile Phone">-->
<!--                                <input type="text" placeholder="Fax">-->
<!---->
<!--                        </div>-->
                    </div>
                </div>
<!--                <div class="col-sm-4">-->
<!--                    <div class="order-message">-->
<!--                        <p>Shipping Order</p>-->
<!--                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>-->
<!--                        <label><input type="checkbox"> Shipping to bill address</label>-->
<!--                    </div>-->
<!--                </div>-->
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
                                        <?php echo form_input(array( 'name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5',));?>
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
                            <td class="right"><strong>Coupon Code</strong> <?php if(isset($msg)){echo "<p style='color: red'>".$msg."</p>";}else{echo "";}?></td>

                            <td class="right"><input onblur="get_discount()" name="code" id="discount"  value="<?php echo set_value('code'); ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"> </td>
                            <td class="right"><strong>Total</strong></td>
                            <td class="right">$<input id="total" name="total" style="border: 0px" readonly value="<?php echo $this->cart->format_number($this->cart->total());?>"></td>
                        </tr>

                    </table>

<!--        </div>-->
<!--        <div class="payment-options">-->
                </div>
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="submit" value="submit"> Paypal</label>
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