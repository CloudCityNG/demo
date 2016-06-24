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

    <script src="<?php echo base_url('js/user_address.js')?>"></script>
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
                        <a href="<?php echo base_url('')?>"><img src="<?php echo base_url('images/home/logo.png')?>" alt="" /></a>
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
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/account_user/');}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('Userwishlist/wishlist/');}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('checkout/');}else{echo site_url('checkout/checkout_new_user');}?>"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <?php $i[]=""; foreach ($this->cart->contents() as $item) {$i[]=$item['qty'];}$cart_item= array_sum($i);?>
                            <li><a href="<?php echo site_url('cart');?>"><i class="fa fa-shopping-cart"></i>Cart(<?php echo $cart_item;?>)</a></li>                            <?php if(empty($data)) { ?><li><a href="<?php echo site_url('Userlogin/login')?>"><i class="fa fa-lock"></i> Login</a></li>
                            <?php }else{?><li><a href=""><i class="fa fa-user"></i> <?php echo $this->session->userdata('user_name')?></a>
                                <ul role="" class="sub-menu" style="background-color: white">
                                    <li><a href="<?php echo site_url('home/logout')?>" style="color: black">Logout</a></li>
                                </ul></li>
                            <?php }?>
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
                            <li><a href="<?php echo base_url('')?>" >Home</a></li>
                            <li ><a href="<?php echo site_url('Useraccount/address_update/')?>"class="active">Address Book</a>

                            </li>
                            <li><a href="<?php echo site_url('Useraccount/password_change/')?>">Change Password<i></i></a>

                            </li>
<!--                            <li><a href="404.html">404</a></li>-->
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/contact/');}else{echo site_url('Userlogin/login');}?>"> Contact</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/allorders/');}else{echo site_url('Userlogin/login');}?>"> My Orders</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-0">
                    <form action="<?php echo base_url('home/search_all')?>" method="post">
                        <input type="text" placeholder="Search" name="search"/><input style="margin-left: 00px" class="search_box pull-right" type="submit" name="search_button" >
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<?php
if(!empty($up_address))
{
foreach($up_address as $value) {
    $value = (array)$value;
}?>
<body>
<section id="form" style="margin-top: 00px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 ">
                <div class="login-form"><!--login form-->

                    <form name="form" onsubmit="return user_address_valid()" action="<?php echo site_url('Useraccount/update_address')?>" method="post">

                        <h2>Your Address</h2>
                        <input type="hidden" name="address_id" value="<?php if(isset($up_address)){echo $value['address_id'];}else{echo '';}?>">

                        <input type="hidden" name="user_id" value="<?php if(isset($up_address)){echo $value['user_id'];}else{echo '';}?>">
                        <lable>Address</lable>
                        <input type="text" placeholder="Address_1" name="address_1"value="<?php if(isset($up_address)){echo $value['address_1'];}else{echo '';}?>"/>
                        <div id="add1" style="display:inline; color: red" >
                            <?php echo form_error('address_1'); ?>
                        </div>
                        <lable>Address</lable><br>
                        <input type="text" placeholder="Address_2" name="address_2"value="<?php if(isset($up_address)){echo $value['address_2'];}else{echo set_value('address_2');}?>"/>
                        <div id="add2" style="display:inline; color: red" >
                            <?php echo form_error('address_2'); ?>
                        </div>
                        <lable>City</lable><br>
                        <input type="text" placeholder="City" name="city"value="<?php if(isset($up_address)){echo $value['city'];}else{echo set_value('city');}?>"/>
                        <div id="city" style="display:inline; color: red" >
                            <?php echo form_error('city'); ?>
                        </div>
                        <lable>State</lable><br>
                        <input type="text" placeholder="State" name="state"value="<?php if(isset($up_address)){echo $value['state'];}else{echo set_value('state');}?>"/>
                        <div id="state" style="display:inline; color: red" >
                            <?php echo form_error('state'); ?>
                        </div>
                        <lable>Country</lable><br>
                        <input type="text" placeholder="Country" name="country"value="<?php if(isset($up_address)){echo $value['country'];}else{echo set_value('country');}?>"/>
                        <div id="country" style="display:inline; color: red" >
                            <?php echo form_error('country'); ?>
                        </div>
                        <lable>Zipcode</lable><br>
                        <input type="text" placeholder="Zipcode" name="zipcode"value="<?php if(isset($up_address)){echo $value['zipcode'];}else{echo set_value('zipcode');}?>"/>
                        <div id="zipcode" style="display:inline; color: red" >
                            <?php echo form_error('zipcode'); ?>
                        </div>

                        <a href="<?php echo site_url('home')?>" style="display: inline" class="btn btn-default col-sm-4">Back</a>
                        <button type="submit" style="margin-left: 125px;display:inline; margin-top: 00%" class="btn btn-default col-sm-4">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
<?php
}else{?>
    <section id="form" style="margin-top: 00px"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 ">
                    <div class="login-form"><!--login form-->

                        <form action="<?php echo site_url('Useraccount/onther_address')?>" method="post">

                            <h2>Your Address</h2>
                            <input type="hidden" name="user_id" value="<?php echo $data?>">
                            <input type="text" placeholder="Address_1" name="address_1"/>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('address_1'); ?>
                            </div>
                            <input type="text" placeholder="Address_2" name="address_2"/>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('address_2'); ?>
                            </div>
                            <input type="text" placeholder="City" name="city"/>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('city'); ?>
                            </div>
                            <input type="text" placeholder="State" name="state"/>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('state'); ?>
                            </div>
                            <input type="text" placeholder="Country" name="country"/>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('country'); ?>
                            </div>
                            <input type="text" placeholder="Zipcode" name="zipcode">
                            <div style="display:inline; color: red" >
                                <?php echo form_error('zipcode'); ?>
                            </div>

                            <a href="<?php echo site_url('home')?>" style="display: inline" class="btn btn-default col-sm-4">Back</a>
                            <button type="submit" style="margin-left: 125px;display:inline; margin-top: 00%" class="btn btn-default col-sm-4">Submit</button>
                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
<?php } ?>

</body>
</html>