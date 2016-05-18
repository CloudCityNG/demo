<!DOCTYPE html>

        <!-- END PAGE LEVEL STYLES -->

<!--<script>-->
<!--    function add()-->
<!--    {-->
<!--        var input=document.createElement('input');-->
<!--        input.type="file";-->
<!--        input.name='image_name';-->
<!--        document.getElementById('new').appendChild(input);-->
<!--    }-->
<!---->
<!--</script>-->
<script src="<?php echo base_url('js/update_validation.js');?>"></script>
    <!-- BEGIN PAGE LEVEL STYLES -->
<!--    <link href="--><?php //echo base_url('assets/css/pages/login.css"')?><!-- rel="stylesheet" type="text/css"/>-->
    <!-- END PAGE LEVEL STYLES -->
<!--    <link rel="shortcut icon" href="--><?php //echo base_url('favicon.ico')?><!--" />-->

</head>

<!-- END HEAD -->
 BEGIN BODY
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top" ">
<!-- BEGIN TOP NAVIGATION BAR -->
<div class="navbar-inner"  style="margin-left: 0px>
        <div class="container-fluid">
<!-- BEGIN LOGO -->
<a class="brand" href="index.html">
    <img src="<?php echo base_url('assets/img/logo.png')?>" alt="logo" />
</a>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="<?php echo base_url('javascript:;')?>" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
    <img src="<?php echo base_url('assets/img/menu-toggler.png')?>" alt="" />
</a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN TOP NAVIGATION MENU -->
<ul class="nav pull-right">
    <!-- BEGIN NOTIFICATION DROPDOWN -->
    <!--    <li class="dropdown" id="header_notification_bar">-->
    <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
    <!--            <i class="icon-warning-sign"></i>-->
    <!--            <span class="badge">6</span>-->
    <!--        </a>-->
    <ul class="dropdown-menu extended notification">
        <!--            <li>-->
        <!--                <p>You have 14 new notifications</p>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-success"><i class="icon-plus"></i></span>-->
        <!--                    New user registered.-->
        <!--                    <span class="time">Just now</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-important"><i class="icon-bolt"></i></span>-->
        <!--                    Server #12 overloaded.-->
        <!--                    <span class="time">15 mins</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-warning"><i class="icon-bell"></i></span>-->
        <!--                    Server #2 not respoding.-->
        <!--                    <span class="time">22 mins</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-info"><i class="icon-bullhorn"></i></span>-->
        <!--                    Application error.-->
        <!--                    <span class="time">40 mins</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-important"><i class="icon-bolt"></i></span>-->
        <!--                    Database overloaded 68%.-->
        <!--                    <span class="time">2 hrs</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a href="#">-->
        <!--                    <span class="label label-important"><i class="icon-bolt"></i></span>-->
        <!--                    2 user IP blocked.-->
        <!--                    <span class="time">5 hrs</span>-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            <li class="external">-->
        <!--                <a href="#">See all notifications <i class="m-icon-swapright"></i></a>-->
        <!--            </li>-->
    </ul>

    <!-- END NOTIFICATION DROPDOWN -->
    <!-- BEGIN INBOX DROPDOWN -->
    <!--    <li class="dropdown" id="header_inbox_bar">-->
    <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
    <!--            <i class="icon-envelope"></i>-->
    <!--            <span class="badge">5</span>-->
    <!--        </a>-->
    <ul class="dropdown-menu extended inbox">
        <li>
            <p>You have 12 new messages</p>
        </li>
        <li>
            <a href="<?php echo base_url('inbox.html?a=view')?>">
                <span class="photo"><img src="<?php echo base_url('./assets/img/avatar2.jpg')?>" alt="" /></span>
								<span class="subject">
								<span class="from">Lisa Wong</span>
								<span class="time">Just Now</span>
								</span>
								<span class="message">
								Vivamus sed auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('inbox.html?a=view')?>">
                <span class="photo"><img src="<?php echo base_url('./assets/img/avatar3.jpg')?>" alt="" /></span>
								<span class="subject">
								<span class="from">Richard Doe</span>
								<span class="time">16 mins</span>
								</span>
								<span class="message">
								Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('inbox.html?a=view')?>">
                <span class="photo"><img src="<?php echo base_url('./assets/img/avatar1.jpg')?>" alt="" /></span>
								<span class="subject">
								<span class="from">Bob Nilson</span>
								<span class="time">2 hrs</span>
								</span>
								<span class="message">
								Vivamus sed nibh auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>
            </a>
        </li>
        <li class="external">
            <a href="<?php echo base_url('inbox.html')?>">See all messages <i class="m-icon-swapright"></i></a>
        </li>
    </ul>
    </li>
    <!-- END INBOX DROPDOWN -->
    <!-- BEGIN TODO DROPDOWN -->
    <!--    <li class="dropdown" id="header_task_bar">-->
    <!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
    <!--            <i class="icon-tasks"></i>-->
    <!--            <span class="badge">5</span>-->
    <!--        </a>-->
    <ul class="dropdown-menu extended tasks">
        <li>
            <p>You have 12 pending tasks</p>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">New release v1.2</span>
								<span class="percent">30%</span>
								</span>
								<span class="progress progress-success ">
								<span style="width: 30%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">Application deployment</span>
								<span class="percent">65%</span>
								</span>
								<span class="progress progress-danger progress-striped active">
								<span style="width: 65%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">Mobile app release</span>
								<span class="percent">98%</span>
								</span>
								<span class="progress progress-success">
								<span style="width: 98%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">Database migration</span>
								<span class="percent">10%</span>
								</span>
								<span class="progress progress-warning progress-striped">
								<span style="width: 10%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">Web server upgrade</span>
								<span class="percent">58%</span>
								</span>
								<span class="progress progress-info">
								<span style="width: 58%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li>
            <a href="#">
								<span class="task">
								<span class="desc">Mobile development</span>
								<span class="percent">85%</span>
								</span>
								<span class="progress progress-success">
								<span style="width: 85%;" class="bar"></span>
								</span>
            </a>
        </li>
        <li class="external">
            <a href="#">See all tasks <i class="m-icon-swapright"></i></a>
        </li>
    </ul>
    </li>
    <!-- END TODO DROPDOWN -->
    <!-- BEGIN USER LOGIN DROPDOWN -->
    <li class="dropdown user">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img alt="" src="<?php echo base_url('assets/img/avatar1_small.jpg')?>" />
            <span class="username"><?PHP echo $this->session->userdata('session');$id= $this->session->userdata('id');?></span>
            <i class="icon-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('extra_profile.html')?>"><i class="icon-user"></i> My Profile</a></li>
            <li><a href="<?php echo base_url('page_calendar.html')?>"><i class="icon-calendar"></i> My Calendar</a></li>
            <li><a href="<?php echo base_url('inbox.html')?>"><i class="icon-envelope"></i> My Inbox(3)</a></li>
            <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url('extra_lock.html')?>"><i class="icon-lock"></i> Lock Screen</a></li>
            <li><a href="<?php echo base_url('admin/dashboard/logout')?>"><i class="icon-key"></i> Log Out</a></li>
        </ul>
    </li>
    <!-- END USER LOGIN DROPDOWN -->
</ul>
<!-- END TOP NAVIGATION MENU -->
</div>
</div>
<!-- END TOP NAVIGATION BAR -->
</div>

<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
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
                        <a href="javascript:;" class="remove"></a>
                        <input type="text" placeholder="Search..." />
                        <input type="button" class="submit" value=" " />
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start ">
                <a href="index.html">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/adminuser/')?>">
                    Admin Managment</a>
            </li>

            <li >
                <a href="<?php echo site_url('admin/product/')?>">
                    Product Managment</a>
            </li>


            <li >
                <a href="<?php echo site_url('admin/banner')?>">
                    Banner Managment</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/category')?>">
                    Category Management</a>
            </li>

            <li >
                <a href="<?php echo site_url('admin/dashboard/reply')?>">
                    Complints Book</a>
            </li>
            <li >
                <a href="<?php echo site_url('admin/userlist')?>">
                    User List</a>
            </li>
            <li >
                <a  href="<?php echo site_url('admin/dashboard/news')?>">news</a>
                <a  href="<?php echo site_url('admin/dashboard/done')?>">done</a>

            </li>
            <li >
                <a href="<?php echo site_url('admin/dashboard/setting')?>">
                    Setting</a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE -->
    <div class="page-content">
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
        <div class="container-fluid">
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
                    <h3 class="page-title">
                        Add New Product

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo base_url('admin/dashboard')?>">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/product')?>">Product List</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">New Product Details</a></li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <form  name="form" onsubmit="return product_valid()"  enctype="multipart/form-data" action="<?php echo site_url('admin/product/insert_product')?>" method="post">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box blue"></div>

                    <div class="control-group">
                        <label class="control-label">Category</label>
                        <div class="controls">
                            <select name="category" class="category" id='category'>
                                <?php
                                foreach($category as $value)
                                {
                                   ?>
                                    <option  value="<?php echo $value['category_name']?>"><?php echo $value['category_name']?></option>
                               <?php }?>
                                </select>
                            <span class="help-inline"></span>
                            <div style="display:inline; color: red">
                                <?php echo form_error('category_name'); ?>
                            </div>
                        </div>
                    </div>
<!--                    name-->
                    <div class="control-group col-06-sm">
                        <label class="control-label">Product Name</label>
                        <div class="controls">
                            <input type="text" class="span6 m-wrap form-control" style="width:905px" name="name" value="<?php echo set_value('name')?>">
                            <span class="help-inline"></span>
                            <div id="name" style="display:inline; color: red">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                    </div>
<!--                        sku-->
                    <div class="control-group">
                        <label class="control-label">SKU</label>
                        <div class="controls">
                            <input type="text" class="span6 m-wrap form-control " style="width:905px" name="sku"value="<?php echo set_value('sku')?>"/>
                            <span class="help-inline"></span>
                            <div id="sku" style="display:inline; color: red" >
                                <?php echo form_error('sku'); ?>
                            </div>
                        </div>
                    </div>
<!--                    short-desc-->
                    <div class="control-group">
                        <label class="control-label" >Description</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" style="width:905px"rows="3" name="short_description" value="<?php echo set_value('short_description')?>"><?php echo set_value('short_description')?></textarea>
                        </div>
                        <div id="short" style="display:inline; color: red" >
                            <?php echo form_error('short_description'); ?>
                        </div>
                    </div>
<!--                    long-desc-->
                    <div class="control-group">
                        <label class="control-label">CKEditor</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" style="width:905px"rows="3" name="long_description" value="<?php echo set_value('long_description')?>"><?php echo set_value('long_description')?></textarea>
                        </div>
                        <div id="long" style="display:inline; color: red" >
                            <?php echo form_error('long_description'); ?>
                        </div>
                    </div>
<!--                    price-->
                    <div class="control-group" style="display:inline;">
                        <label class="control-label">Price</label>
                        <div class="controls"style="display:inline;">
                            <div class="input-prepend input-append"style="display:inline;">
                                <span class="add-on">$</span><input  class="m-wrap " type="text" name="price"value="<?php echo set_value('price')?>"/><span class="add-on">.00</span>
                            </div>
                        </div>
                        <div id="price" style="display:inline; color: red" >
                            <?php echo form_error('price'); ?>
                        </div>
                    </div>
<!--                    special-price-->
                    <div class="control-group" style="display:inline;">
                        <label class="control-label">Special Price</label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on">$</span><input  class="m-wrap " type="text" name="special_price"value="<?php echo set_value('special_price')?>"/><span class="add-on">.00</span>
                            </div>
                        </div>
                        <div id="special" style="display:inline; color: red" >
                            <?php echo form_error('special_price'); ?>
                        </div>
                    </div>
<!--                    strat data-->
                    <div class="control-group" >
                        <label class="control-label"style="display:inline">Starts with years view</label>
                        <div class="controls">
                            <div class="input-append date date-picker"style="display:inline" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input  class="example1"   style="display:inline " name="special_price_from"class="m-wrap m-ctrl-medium " readonly size="16" type="text" value="<?php echo set_value('special_price_from')?>" /><span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <div id="date_from" style="display:inline; color: red" >
                            <?php echo form_error('special_price_from'); ?>
                        </div>
                    </div>
<!--                    end data-->
                    <div class="control-group">
                        <label style="display:inline" class="control-label">Limit the view mode to months</label>
                        <div class="controls" >
                            <div  style="display:inline" class="input-append date date-picker"  data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                <input class="example1" style="display:inline"style="width:905px" name="special_price_to"class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="<?php echo set_value('special_price_to')?>" /><span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <div id="date_to" style="display:inline; color: red" >
                            <?php echo form_error('special_price_to'); ?>
                        </div>
                    </div>
<!--                    status-->
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" name="status" value="1" />
                                Avalible
                            </label>
                            <label class="radio">
                                <input type="radio" name="status" value="0" checked />
                                Unavalible
                            </label>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('status'); ?>
                        </div>
                    </div>
<!--                    quntity-->
                    <div class="control-group">
                        <label class="control-label">Quntity</label>
                        <div class="controls">
                            <input type="text" style="width:905px"class="span6 m-wrap" name="quntity"value="<?php echo set_value('quntity')?>"/>
                            <span class="help-inline"></span>
                        </div>
                        <div id="qun" style="display:inline; color: red" >
                            <?php echo form_error('quntity'); ?>
                        </div>
                    </div>
<!--                    title-->
                    <div class="control-group">
                        <label class="control-label">Meta Title</label>
                        <div class="controls">
                            <input type="text" style="width:905px"class="span6 m-wrap" name="meta_title"value="<?php echo set_value('meta_title')?>"/>
                            <span class="help-inline"></span>
                        </div>
                        <div id="title" style="display:inline; color: red" >
                            <?php echo form_error('meta_title'); ?>
                        </div>
                    </div>
<!--                    meta-desc-->
                    <div class="control-group">
                        <label class="control-label">Meta-Description</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_description"value="<?php echo set_value('meta_description')?>"/><?php echo set_value('meta_description')?></textarea>
                        </div>
                        <div id="meta_desc" style="display:inline; color: red" >
                            <?php echo form_error('meta_description'); ?>
                        </div>
                    </div>
<!--                    meta_key-->
                    <div class="control-group">
                        <label class="control-label">Meta-Keywords</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_keywords"value="<?php echo set_value('meta_keywords')?>"/><?php echo set_value('meta_keywords')?></textarea>
                        </div>
                        <div id="meta_key" style="display:inline; color: red" >
                            <?php echo form_error('meta_keywords'); ?>
                        </div>
                    </div>
<!--                    Status-->
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" name="product_status" value="1" />
                                Option 1
                            </label>
                            <label class="radio">
                                <input type="radio" name="product_status" value="0" checked />
                                Option 2
                            </label>
                        </div>

                        <div style="display:inline; color: red" >
                            <?php echo form_error('product_status'); ?>
                        </div>
                    </div>
<!--                    img-->
                    <div class="control-group">
                        <label class="control-label">Image Upload</label>
                        <div class="controls">
                            <div>
                                <div>
                                    <span class="btn btn-file"><span class="fileupload-new">Select image</span>
<!--												<span class="fileupload-exists">Change</span>-->
                                        <input id="image" type="file" class="default" name="image_name[]" size="20" multiple />
<!--                                                    <a  onclick="add()"id="new">Add more</a>-->
                                    </span><br>
                                    <div id="image_error" style="display:inline; color: red" >
                                        <?php echo form_error('image_name'); ?>
                                    </div>
                                </div>
                                <div id="new"></div>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" value="upload" class="btn blue">Product Add In Store</button>
                        <a href="<?php echo base_url('admin/product');?>" type="button" class="btn">Cancel</a>

                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END EXTRAS PORTLET-->
    </div>
</div>
<!-- END PAGE CONTENT-->
        <!-- END PAGE CONTAINER-->

    <!-- END PAGE -->

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


<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('.example1').datepicker({
            dateFormat: "yy-mm-dd",
        });

    });
</script>



<!--<script>-->
<!--    jQuery(document).ready(function() {-->
<!--        // initiate layout and plugins-->
<!--        App.init();-->
<!--        FormComponents.init();-->
<!--    });-->
<!--</script>-->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>