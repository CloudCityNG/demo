<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/prettyPhoto.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/price-range.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/animate.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/main.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/responsive.css')?>" rel="stylesheet">
    <!--[if lt IE 9]-->
    <script src="<?php echo base_url('js/html5shiv.js')?>"></script>
    <script src="<?php echo base_url('js/respond.min.js')?>"></script>
    <!--[endif]-->
    <link rel="shortcut icon" href="<?php echo base_url('images/ico/favicon.ico')?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('images/ico/apple-touch-icon-144-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('images/ico/apple-touch-icon-114-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('images/ico/apple-touch-icon-72-precomposed.png')?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('images/ico/apple-touch-icon-57-precomposed.png')?>">
</head><!--/head-->
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="<?php echo base_url('images/home/logo.png')?>" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav"><?php $data=$this->session->userdata('user_session')?>
                            <!--                            <li><a href="--><?php //echo site_url('Useraccount/account_user/'.$data)?><!--"><i class="fa fa-user"></i> Account</a></li>-->
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            <li><a href="<?php echo site_url('UserControl/logout')?>"><i class="fa fa-lock"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="<?php echo base_url('UserControl')?>" >Home</a></li>
                            <li ><a href="<?php echo site_url('Useraccount/address_update/'.$data)?>"class="active">Address Book</a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo site_url('Useraccount/password_change/'.$data)?>">Chnage Password<i></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/contact/'.$data);}else{echo site_url('Userlogin/login');}?>"> Contact</a></li>                        </ul>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<?php
if(!empty($user_address))
{
foreach($user_address as $value) {
    $value = (array)$value;
}}else{echo "";}?>
<body>
<section id="form" style="margin-top: 00px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 ">
                <div class="login-form"><!--login form-->

                    <form action="<?php echo site_url('Useraccount/change_address')?>" method="post">

                        <h2>Your Address</h2>
                        <input type="hidden" name="user_id" value="<?php echo $data?>">
                        <input type="text" placeholder="Address_1" name="address_1"value="<?php if(isset($user_address)){echo $value['address_1'];}else{echo set_value('address_1');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('address_1'); ?>
                        </div>
                        <input type="text" placeholder="Address_2" name="address_2"value="<?php if(isset($user_address)){echo $value['address_2'];}else{echo set_value('address_2');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('address_2'); ?>
                        </div>
                        <input type="text" placeholder="City" name="city"value="<?php if(isset($user_address)){echo $value['city'];}else{echo set_value('city');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('city'); ?>
                        </div>
                        <input type="text" placeholder="State" name="state"value="<?php if(isset($user_address)){echo $value['state'];}else{echo set_value('state');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('state'); ?>
                        </div>
                        <input type="text" placeholder="Country" name="country"value="<?php if(isset($user_address)){echo $value['country'];}else{echo set_value('country');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('country'); ?>
                        </div>
                        <input type="text" placeholder="Zipcode" name="zipcode"value="<?php if(isset($user_address)){echo $value['zipcode'];}else{echo set_value('zipcode');}?>"/>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('zipcode'); ?>
                        </div>

                        <a href="<?php echo site_url('UserControl/back_form_account')?>" style="display: inline" class="btn btn-default col-sm-4">Back</a>
                        <button type="submit" style="margin-left: 125px;display:inline; margin-top: 00%" class="btn btn-default col-sm-4">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->



</body>
</html>