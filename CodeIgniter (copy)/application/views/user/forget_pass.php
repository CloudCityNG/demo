<!DOCTYPE html>
<html lang="en">
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
<body >
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
<body >
<section id="form" style="margin-top: 100px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-form"><!--login form-->
                    <h2>Enter E-mail</h2>
                    <form action="<?php echo site_url('Userlogin/forget_user')?>" method="post">
                        <input type="text" placeholder="e-mail" name="user_email"/>
                        <div style="display:inline; color: red" >
                            <?php if(isset($email)){echo "Invalid User Email";}else{echo "";} ?>
                        </div>
                        <button type="submit" class="btn btn-default col-sm-12">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>


        </div>
    </div>
</section><!--/form-->



</body>
</html>