<!DOCTYPE html>
<?php //echo form_open('path/to/controller/update/function'); ?>
<?php $i = 1; ?>
<html lang="en">
<body>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>

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
                        <img src="<?php echo base_url().'/images/'.$items['image_name'];?>" style="width: 100px;height: 100px">                    </td>
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

            <p>
                <input type="submit" value="Update your Cart">
                </form>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <?php $totals=$this->cart->format_number($this->cart->total());
//                        echo $totals;
//                        $x=500;
//                        echo $total += ($totals + $x);
//                        $items += $val['qty']
                        $x=explode(',',$totals);
//                        var_dump($x);
                        $total="";
                        foreach($x as $value)
                        {
                            $total.=$value;
//                            $value;
//                            array_push($total,$value);
                        }
                        echo $total;

                        //$grand_total=$totals+$eco?>
                        <li>Cart Sub Total <span><?php echo $this->cart->format_number($this->cart->total());?></span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <?php if($total > 500){
                            $shipping_charge = 50;
                        }else{
                            $shipping_charge = 0;
                        }
                        ?>
                        <li>Shipping Cost <span><?php echo "$".$shipping_charge;?></span></li>

                        <li>Total <span ><?php echo $total_with_charge=$total+$shipping_charge;?></span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="<?php echo site_url('home/checkout')?>">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->




<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>