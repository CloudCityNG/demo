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
<section id="cart_items">
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
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="Display Name">
                            <input type="text" placeholder="User Name">
                            <input type="password" placeholder="Password">
                            <input type="password" placeholder="Confirm password">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                <input value="<?php if(!empty($userdata)){echo $item['user_name'];}else{echo "";}?>" type="text" placeholder="Company Name">
                                <input value="<?php if(!empty($userdata)){echo $item['user_email'];}else{echo "";}?>" type="text" placeholder="Email*">
<!--                                <input value="--><?php //if(!empty($userdata)){echo $item['meta_title'];}else{echo "";}?><!--" type="text" placeholder="Title">-->
                                <input value="<?php if(!empty($userdata)){echo $item['user_name'];}else{echo "";}?>" type="text" placeholder="First Name *">
<!--                                <input type="text" placeholder="Middle Name">-->
                                <input value="<?php if(!empty($userdata)){echo $item['user_lastname'];}else{echo "";}?>" type="text" placeholder="Last Name *">
                                <input value="<?php if(!empty($userdata)){echo $item['address_1'];}else{echo "";}?>" type="text" placeholder="Address 1 *">
                                <input value="<?php if(!empty($userdata)){echo $item['address_2'];}else{echo "";}?>"type="text" placeholder="Address 2">
                            </form>
                        </div>
                        <div class="form-two">
                            <form>
                                <input value="<?php if(!empty($userdata)){echo $item['zipcode'];}else{echo "";}?>" type="text" placeholder="Zip / Postal Code *">
                                <select>
                                    <option>-- Country --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- State / Province / Region --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <input type="password" placeholder="Confirm password">
                                <input type="text" placeholder="Phone *">
                                <input type="text" placeholder="Mobile Phone">
                                <input type="text" placeholder="Fax">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <form action="<?php echo site_url('home/update_cart')?>" method="post">
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
                                    <img src="<?php echo base_url().'/images/'.$items['name'];?>" style="width: 100px;height: 100px">                    </td>
                                <td class="cart_description">
                                    <?php echo $items['name']; ?>
                                    <p><?php echo $items['id']?></p>
                                </td>
                                <td class="cart_price">
                                    <p><?php echo $this->cart->format_number($items['price']); ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <?php echo form_input(array('name' => 'qty'.$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"><?php echo $this->cart->format_number($items['subtotal']); ?></p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="<?php echo base_url('home/delete_cart/'.$items['rowid'])?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3"> </td>
                            <td class="right"><strong>Total</strong></td>
                            <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                        </tr>

                    </table>
        </div>
        <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
        </div>
    </div>
</section> <!--/#cart_items-->






<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>