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
                            <li><a href="<?php echo base_url('welcome/login')?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo base_url('twitter/auth')?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo base_url('home/newsletter')?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="<?php echo base_url('google/google_login')?>"><i class="fa fa-google-plus"></i></a></li>
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
                    <div class=" mainmenu shop-menu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse"><?php $data=$this->session->userdata('user_session')?>
                            <li><a href="<?php if(!empty($data)){echo site_url('Useraccount/account_user/');}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-user"></i> Account</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('Userwishlist/wishlist/');}else{echo site_url('Userlogin/login');}?>"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="<?php if(!empty($data)){echo site_url('checkout/');}else{echo site_url('checkout/checkout_new_user');}?>"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <?php $i[]=""; foreach ($this->cart->contents() as $item) {$i[]=$item['qty'];}$cart_item= array_sum($i);?>
                            <li><a href="<?php echo site_url('cart');?>"><i class="fa fa-shopping-cart"></i>Cart(<?php echo $cart_item;?>)</a></li>
                            <?php if(empty($data)) { ?><li><a href="<?php echo site_url('Userlogin/login')?>"><i class="fa fa-lock"></i> Login</a></li>
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
<!--                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>-->
<!--                                <ul role="menu" class="sub-menu">-->
<!--                                    <li><a href="shop.html">Products</a></li>-->
<!--                                    <li><a href="product-details.html">Product Details</a></li>-->
<!--                                    <li><a href="checkout.html">Checkout</a></li>-->
<!--                                    <li><a href="cart.html">Cart</a></li>-->
<!--                                    <li><a href="login.html">Login</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>-->
<!--                                <ul role="menu" class="sub-menu">-->
<!--                                    <li><a href="blog.html">Blog List</a></li>-->
<!--                                    <li><a href="blog-single.html">Blog Single</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li><a href="404.html">404</a></li>-->
<!--                            <li><a href="--><?php //if(!empty($data)){echo site_url('Useraccount/contact/'.$data);}else{echo site_url('Userlogin/login');}?><!--"><i class="fa fauser"></i> Contact</a></li>                        </ul>-->
                    </div>
                </div>
                <div class="col-sm-0">
<!--                    <div class="search_box pull-right">-->
                    <form action="<?php echo base_url('home/search_all')?>" method="post">
                        <input type="text" placeholder="Search" name="search"/><input style="margin-left: 00px" class="search_box pull-right" type="submit" name="search_button" >
                    </form>
                    <!--                    </div>-->

                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
