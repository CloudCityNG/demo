<!DOCTYPE html>

    <style>
    /*@import url('http://fonts.googleapis.com/css?family=Open+Sans:400,600,700');*/

    *, *:before, *:after {margin: 0; padding: 0; box-sizing: border-box;}
    body {background: #2F2556; color: #B9B5C7; font: 14px 'Open Sans', sans-serif;}

    h1 {padding: 100px 0; font-weight: 400; text-align: center;}
    p {margin: 0 0 20px; line-height: 1.5;}

    .main {margin: 0 auto; min-width: 320px; max-width: 800px;}
    .content {background: #fff; color: #373737;}
    .content > div {display: none; padding: 20px 25px 5px;}

    input {display: none;}
    label {display: inline-block; padding: 15px 25px; font-weight: 600; text-align: center;}
    label:hover {color: #0099FF; cursor: pointer;}
    input:checked + label {background: #0c91e5; color: #fff;}

    #tab1:checked ~ .content #content1,
    #tab2:checked ~ .content #content2,
    #tab3:checked ~ .content #content3,
    #tab4:checked ~ .content #content4 {
        display: block;
    }

    @media screen and (max-width: 400px) { label {padding: 15px 10px;} }
</style>



<!--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">-->
<!--<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>-->
<!--<link href="--><?php //echo base_url('css/bootstrap.min.css')?><!--" rel="stylesheet">-->
<!--<script src="--><?php //echo base_url('js/bootstrap.min.js')?><!--"></script>-->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar nav-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">
            <li>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone"></div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search">
                    <div class="input-box">
                        <a href="<?php echo base_url('javascript:;')?>" class="remove"></a>
                        <input type="text" placeholder="Search..." />
                        <input type="button" class="submit" value=" " />
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start active ">
                <a href="<?php echo base_url('index.html')?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <!--      List of Admin      -->
            <li >
                <a href="<?php echo site_url('admin/adminuser/')?>">
                    Admin Management</a>
            </li>
            <!--      List of Product      -->
            <li >
                <a href="<?php echo site_url('admin/product/')?>">
                    Product Management</a>
            </li>
            <!--      List of Banner      -->
            <li >
                <a href="<?php echo site_url('admin/banner')?>">
                    Banner Management</a>
            </li>
            <!--      List of Category      -->
            <li >
                <a href="<?php echo site_url('admin/category')?>">
                    Category Management</a>
            </li>
            <!--      List of Users      -->
            <li >
                <a href="<?php echo site_url('admin/userlist')?>">
                    User List</a>
            </li>
            <!--      List of Orders      -->
            <li >
                <a href="<?php echo site_url('admin/orders')?>">
                    Orders</a>
            </li>
            <!--      List of Coupons      -->
            <li >
                <a href="<?php echo site_url('admin/coupon')?>">
                    Coupon Management</a>
            </li>
            <!--      List of Complints      -->
            <li >
                <a href="<?php echo site_url('admin/reply')?>">
                    Complaint Book</a>
            </li>
            <!--      CMS Details      -->
            <li >
                <a href="<?php echo site_url('admin/cms')?>">
                    CMS</a>
            </li>
            <!--      Admin setting      -->
            <li >
                <a href="<?php echo site_url('admin/setting')?>">
                    Setting</a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
<!-- BEGIN PAGE -->
<div style="color: black" class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>portlet Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here will be a configuration form</p>
        </div>
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div style="color: black" class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER -->
                <div class="color-panel hidden-phone">
                    <div class="color-mode-icons icon-color"></div>
                    <div class="color-mode-icons icon-color-close"></div>
                    <div class="color-mode">
                        <p>THEME COLOR</p>
                        <ul class="inline">
                            <li class="color-black current color-default" data-style="default"></li>
                            <li class="color-blue" data-style="blue"></li>
                            <li class="color-brown" data-style="brown"></li>
                            <li class="color-purple" data-style="purple"></li>
                            <li class="color-grey" data-style="grey"></li>
                            <li class="color-white color-light" data-style="light"></li>
                        </ul>
                        <label>
                            <span>Layout</span>
                            <select class="layout-option m-wrap small">
                                <option value="fluid" selected>Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </label>
                        <label>
                            <span>Header</span>
                            <select class="header-option m-wrap small">
                                <option value="fixed" selected>Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Sidebar</span>
                            <select class="sidebar-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                        <label>
                            <span>Footer</span>
                            <select class="footer-option m-wrap small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected>Default</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- END BEGIN STYLE CUSTOMIZER -->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Order Status <small>Order Status</small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo site_url('admin/dashboard')?>">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/orders')?>">Order List</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Order Status</a></li>
                </ul>

                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-edit"></i>Order Status</div>
                        <!--                            <div class="tools">-->
                        <!--                                <a href="--><?php //echo base_url('#portlet-config')?><!--" class="collapse"></a>-->
                        <!--                                <a href="--><?php //echo base_url('#portlet-config')?><!--" data-toggle="modal" class="config"></a>-->
                        <!--                                <a href="--><?php //echo base_url('javascript:;')?><!--" class="reload"></a>-->
                        <!--                                <a href="--><?php //echo base_url('javascript:;')?><!--" class="remove"></a>-->
                        <!--                            </div>-->
                    </div>
                    <div class="portlet-body">

                        <div class="main">

                            <input id="tab1" type="radio" name="tabs" checked>
                            <label for="tab1">Customer Details</label>

                            <input id="tab2" type="radio" name="tabs">
                            <label for="tab2">Order Details</label>

                            <input id="tab3" type="radio" name="tabs">
                            <label for="tab3">Shipping Details</label>

                            <input id="tab4" type="radio" name="tabs">
                            <label for="tab4">Payment Getway</label>

                            <div style="color: black" class="content">
                                <div style="color: black" id="content1">
                                    <div class="tab-pane" id="tab-payment">
                                        <table style="color: black" class="table table-bordered">
                                            <tbody>
                                            <?php foreach($customer as $cust)
                                            $cust=(array)$cust;?>
                                            <tr>
                                                <td>First Name:</td>
                                                <td><?php if(!empty($customer)){echo $cust['user_name'];}else{echo "";}?></td>
                                            </tr>
                                            <tr>
                                                <td>Last Name:</td>
                                                <td><?php if(!empty($customer)){echo $cust['user_lastname'];}else{echo "";}?></td>
                                            </tr>
                                            <?php foreach($address as $add)
                                                $add=(array)$add;?>
                                            <tr>
                                                <td>Address 1:</td>
                                                <td><?php if(!empty($address)){echo $add['address_1'];}else{echo "";}?></td>
                                            </tr>
                                            <tr>
                                                <td>City:</td>
                                                <td><?php if(!empty($address)){echo $add['city'];}else{echo "";}?></td>
                                            </tr>
                                            <tr>
                                                <td>State</td>
                                                <td><?php if(!empty($address)){echo $add['state'];}else{echo "";}?></td>
                                            </tr>
                                            <tr>
                                                <td>Zipcode</td>
                                                <td><?php if(!empty($address)){echo $add['zipcode'];}else{echo "";}?></td>
                                            </tr>
                                            <tr>
                                                <td>Country:</td>
                                                <td><?php if(!empty($address)){echo $add['country'];}else{echo "";}?></td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>

                                <div id="content2">
                                    <div class="tab-pane active" id="tab-order">
                                        <table style="color: black" class="table table-bordered">
                                            <tbody>
                                            <?php foreach($order as $ord)

                                            $ord=(array)$ord;?><tr>
                                                <td>Order ID:</td>
                                                <td><?php echo $ord['order_id']?></td>
                                            </tr>

                                            <tr>
                                                <td>Billing Address ID</td>
                                                <td><?php echo $ord['billing_address_id']?></td>
                                            </tr>
                                            <tr>
                                                <td>Shopping Address Id</td>
                                                <td><?php echo $ord['shopping_address_id']?></td>
                                            </tr>
                                            <tr>
                                                <td>Customer ID:</td>
                                                <td><?php echo $ord['user_id']?></a></td>
                                            </tr>

                                            <tr>
                                                <td>Total:</td>
                                                <td><?php echo $ord['grand_total']?></td>
                                            </tr>

                                            <tr>
                                                <td>Order Status:</td>
                                                <td ><?php echo $ord['status']?></td>
                                            </tr>

                                            <tr>
                                                <td>Date Added:</td>
                                                <td><?php echo $ord['created_date']?></td>
                                            </tr>

                                            </tbody></table>
                                    </div>
                                    </div>

                                <div id="content3">
                                    <div class="tab-pane" id="tab-payment">
                                        <table style="color: black" class="table table-bordered">
                                            <tbody>
                                            <?php foreach($shipping as $ship)
                                                $ship=(array)$ship;?>

                                            <tr>
                                                <td>Address 1:</td>
                                                <td><?php echo $ship['address_1']?></td>
                                            </tr>
                                            <tr>
                                                <td>Address :</td>
                                                <td><?php echo $ship['address_2']?></td>
                                            </tr>
                                            <tr>
                                                <td>Postcode:</td>
                                                <td><?php echo $ship['zipcode']?></td>
                                            </tr>
                                            <tr>
                                                <td>Payment Method:</td>
                                                <td><?php echo $ship['shopping_method']?></td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>

                                <div id="content4">
                                    <div class="tab-pane" id="tab-payment">
                                        <table style="color: black" class="table table-bordered">
                                            <tbody><?php foreach($payment as $pay)
                                                $pay=(array)$pay;?>
                                            <tr>
                                                <td>Payment Method</td>
                                                <td><?php echo $pay['shopping_method']?></td>
                                            </tr>
                                            <tr>
                                                <td>Payment getway Id</td>
                                                <td><?php echo $pay['payment_getway_id']?></td>
                                            </tr>
                                            <tr>
                                                <td>Transcation Id</td>
                                                <td><?php echo $pay['transaction_id']?></td>
                                            </tr>
                                            <tr>
                                                <td>Created Data</td>
                                                <td><?php echo $pay['created_date']?></td>
                                            </tr>
                                            <tr>
                                                <td>Grand Total:</td>
                                                <td><?php echo $pay['grand_total']?></td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
    </div>
</div>

<!--<script>-->
<!--    jQuery(document).ready(function() {-->
<!--        App.init();-->
<!--        TableEditable.init();-->
<!--    });-->
<!--</script>-->
</body>
<!-- END BODY -->
</html>

