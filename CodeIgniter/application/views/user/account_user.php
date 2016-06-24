<!DOCTYPE html>
<?php
if(isset($user_data)){
    foreach($user_data as $value)
{
    $value =(array)$value;}}else{echo "";}
?>
<script>
    function email()
    {
        var code=document.getElementById('mail').value;
        $.ajax({ url: '<?php echo site_url('useraccount/verify_email/');?>',
            data: {code: code},
            type: 'post',
            success: function(output) {
                if(output == '0' ) {
                    document.getElementById('mail').value="";
                    document.getElementById('remail').innerHTML="E-mail Already Exists";
                    return false;
                }
                else {
                    document.getElementById('remail').innerHTML="";
                    return true;
                }
            }
        });
    }
</script>
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
    <script src="<?php echo base_url('js/user_account.js')?>"></script>
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
                        <a href="<?php echo base_url()?>"><img src="<?php echo base_url('images/home/logo.png')?>" alt="" /></a>
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
                            <li><a href="<?php echo base_url()?>" class="active">Home</a></li>
                            <li ><a href="<?php echo site_url('Useraccount/address_update/')?>">Address Book</a>
                                <!--<ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>-->
                            </li>
                            <li><a href="<?php echo site_url('Useraccount/password_change/')?>">Change Password<i></i></a>
                                <!--<ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>-->
                            </li>
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/track_order/');}else{echo site_url('Userlogin/login');}?>">Track Order</a></li>
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




<body >
<section id="form" style="margin-top: 00px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 ">
                <div class="login-form"><!--login form-->

                    <?php if(isset($msg)){
                        echo '<p style="color: #00aa00;">'.$msg.'</p>';
                    }?>
                        <form name="form" onsubmit="return user_valid()" action="<?php echo site_url('Useraccount/update_user')?>" method="post">
                        <h2>Personal Details</h2>
                        <label>Name</label>
                        <input type="text" placeholder="Name" name="user_name" value="<?php if(isset($user_data)){echo $value['user_name'];}else{echo set_value('user_name');};?>"/>
                        <div id="first" style="display:inline; color: red" >
                            <?php echo form_error('user_name'); ?>
                        </div><br>
                        <label>Lastname</label>
                        <input type="text" placeholder="Lastname" name="user_lastname"value="<?php if(isset($user_data)){ echo $value['user_lastname'];}else{echo set_value('user_lastname');};?>"/>
                        <div id="last" style="display:inline; color: red" >
                            <?php echo form_error('user_lastname'); ?>
                        </div><br>
                        <label>Email Address</label>
                        <input onchange="return email()" id="mail" type="email" placeholder="Email Address" name="user_email"value="<?php if(isset($user_data)){echo $value['user_email'];}else{echo set_value('user_email');};?>"/>
                            <div id="remail"  style="display:inline; color: red" ></div><div id="email"  style="display:inline; color: red" >
                            <?php echo form_error('user_email'); ?>
                        </div><br>
<!--                        <label>Password</label>-->
<!--                        <input readonly type="password" placeholder="Password" name="user_password"value="--><?php //if(isset($user_data)){ echo $value['user_password'];}else{echo set_value('user_email');};?><!--"/>-->
<!--                        <div id="pass" style="display:inline; color: red" >-->
<!--                            --><?php //echo form_error('user_password'); ?>
<!--                        </div><br>-->
                        <label>
                            <input type="radio" name="user_status"style="display: inline;width: 20px;height: 10px" value="M" <?php if(isset($user_data)){echo($value['user_status'] == 'M')?'checked':'';}else{ echo 'checked' ;}?>>
                            Male
                        </label>
                        <label>
                            <input type="radio" name="user_status"style="display: inline;width: 20px;height: 10px" value="F" <?php if(isset($user_data)){echo ($value['user_status'] == 'F')?'checked':'';}?>>
                                   Female
                        </label>
                        <div></div>
                        <div id="gender" style="display:inline; color: red" >
                            <?php echo form_error('user_status'); ?>
                        </div><br>

                        <a href="<?php echo site_url('Useraccount/back_form_account')?>" style="display: inline" class="btn btn-default col-sm-4">Back</a>
                        <button type="submit" style="margin-left: 125px;display:inline; margin-top: 00%" class="btn btn-default col-sm-4">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>
<?php  ?>

        </div>
    </div>
</section><!--/form-->
</body>
</html>