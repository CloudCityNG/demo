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

    <script src="<?php echo base_url('js/social_regi.js')?>"></script>
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
            </div>
        </div>
    </div><!--/header-middle-->


</header><!--/header-->
<body>
<section id="form" style="margin-top: 00px"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 ">
                <div class="login-form"><!--login form-->

                    <form name="form" onsubmit="return fb_registration()" action="<?php echo site_url('Useraccount/registration')?>" method="post">


                        <input type="hidden" placeholder="token" name="token"value="<?php if(isset($user_profile)){echo $user_profile['id'];}else if(isset($token)){echo $token;}else{echo "";}?>"/>
                        <div id="token" style="display:inline; color: red" >
                            <?php echo form_error('token'); ?>
                        </div><br>
                        <label>Name</label>
                        <input type="text" placeholder="Name" name="user_name" value="<?php if(isset($user_profile)){echo $user_profile['name'];}else if(isset($name)){echo $name;}else{echo "";}?>"/>
                        <div id="first" style="display:inline; color: red" >
                            <?php echo form_error('user_name'); ?>
                        </div><br>
                        <label>Lastname</label>
                        <input type="text" placeholder="Lastname" name="user_lastname"value="<?php if(isset($user_profiles)){echo $user_profile['last'];}else if(isset($last)){echo $last;}else{echo "";}?>"/>
                        <div id="last" style="display:inline; color: red" >
                            <?php echo form_error('user_lastname'); ?>
                        </div><br>
                        <label>Email Address</label>
                        <input type="email" placeholder="Email Address" name="user_email"value="<?php if(isset($user_profile)){echo $user_profile['email'];}else if(isset($email)){echo $email;}else{echo "hello";}?>"/>
                        <div id="email"  style="display:inline; color: red" >
                            <?php echo form_error('user_email'); ?>
                        </div><br>
                        <label>Password</label>
                        <input type="password" placeholder="Password" name="user_password"value="<?php if(isset($user_data)){ echo $value['user_password'];}else{echo set_value('user_email');};?>"/>
                        <div id="pass" style="display:inline; color: red" >
                            <?php echo form_error('user_password'); ?>
                        </div><br>

                        <lable>Address</lable>
                        <input type="text" placeholder="Address_1" name="address_1"value="<?php echo set_value("");?>"/>
                        <div id="add1" style="display:inline; color: red" >
                            <?php echo form_error('address_1'); ?>
                        </div><br>
                        <lable>Address</lable><br>
                        <input type="text" placeholder="Address_2" name="address_2"value="<?php echo set_value("");?>"/>
                        <div id="add2" style="display:inline; color: red" >
                            <?php echo form_error('address_2'); ?>
                        </div><br>
                        <lable>Zipcode</lable><br>
                        <input type="text" placeholder="Zipcode" name="zipcode"value="<?php echo set_value("");?>"/>
                        <div id="zipcode" style="display:inline; color: red" >
                            <?php echo form_error('zipcode'); ?>
                        </div><br>
                        <label>
                            <input type="radio" name="user_status"style="display: inline;width: 20px;height: 10px" value="M" <?php if(isset($user_data)){echo($value['user_status'] == 'M')?'checked':'';}?>>
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

<!--                        <lable>Method</lable><br>-->
                        <input type="hidden" placeholder="Method" name="method"value="<?php if(isset($method)){echo $method;}else{echo "";}?>"/>
                        <div id="method" style="display:inline; color: red" >
                            <?php echo form_error('method'); ?>
                        </div>
                        <a href="<?php echo site_url('')?>" style="display: inline" class="btn btn-default col-sm-4">Back</a>
                        <button type="submit" style="margin-left: 125px;display:inline; margin-top: 00%" class="btn btn-default col-sm-4">Submit</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
</body>
</html>