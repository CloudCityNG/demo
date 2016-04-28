<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Form Stuff - Form Components</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap-responsive.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style-metro.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/style-responsive.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/css/themes/default.css"')?> rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo base_url('assets/plugins/uniform/css/uniform.default.css')?>" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/gritter/css/jquery.gritter.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/chosen-bootstrap/chosen/chosen.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/select2_metro.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jquery-tags-input/jquery.tagsinput.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/clockface/css/clockface.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/datepicker.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-timepicker/compiled/timepicker.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-colorpicker/css/colorpicker.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jquery-multi-select/css/multi-select-metro.css')?>" />
    <link href="<?php echo base_url('assets/plugins/bootstrap-modal/css/bootstrap-modal.css')?>" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico')?>" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <a class="brand" href="index.html">
                <img src="<?php echo base_url('assets/img/logo.png')?>" alt="logo" />
            </a>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                <img src="<?php echo base_url('assets/img/menu-toggler.png')?>" alt="" />
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <li class="dropdown" id="header_notification_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-warning-sign"></i>
                        <span class="badge">6</span>
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <li>
                            <p>You have 14 new notifications</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-success"><i class="icon-plus"></i></span>
                                New user registered.
                                <span class="time">Just now</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-important"><i class="icon-bolt"></i></span>
                                Server #12 overloaded.
                                <span class="time">15 mins</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-warning"><i class="icon-bell"></i></span>
                                Server #2 not respoding.
                                <span class="time">22 mins</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                Application error.
                                <span class="time">40 mins</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-important"><i class="icon-bolt"></i></span>
                                Database overloaded 68%.
                                <span class="time">2 hrs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="label label-important"><i class="icon-bolt"></i></span>
                                2 user IP blocked.
                                <span class="time">5 hrs</span>
                            </a>
                        </li>
                        <li class="external">
                            <a href="#">See all notifications <i class="m-icon-swapright"></i></a>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN INBOX DROPDOWN -->
                <li class="dropdown" id="header_inbox_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-envelope"></i>
                        <span class="badge">5</span>
                    </a>
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
                                <span class="photo"><img src=".<?php echo base_url('./assets/img/avatar3.jpg')?>" alt="" /></span>
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
                <li class="dropdown" id="header_task_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-tasks"></i>
                        <span class="badge">5</span>
                    </a>
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
                        <img alt="" src="assets/img/avatar1_small.jpg" />
                        <span class="username">Bob Nilson</span>
                        <i class="icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="extra_profile.html"><i class="icon-user"></i> My Profile</a></li>
                        <li><a href="page_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
                        <li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox(3)</a></li>
                        <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="extra_lock.html"><i class="icon-lock"></i> Lock Screen</a></li>
                        <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
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
            <li class="">
                <a href="javascript:;">
                    <i class="icon-cogs"></i>
                    <span class="title">Layouts</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="layout_horizontal_sidebar_menu.html">
                            Horzontal & Sidebar Menu</a>
                    </li>
                    <li >
                        <a href="layout_horizontal_menu1.html">
                            Horzontal Menu 1</a>
                    </li>
                    <li >
                        <a href="layout_horizontal_menu2.html">
                            Horzontal Menu 2</a>
                    </li>
                    <li >
                        <a href="layout_promo.html">
                            Promo Page</a>
                    </li>
                    <li >
                        <a href="layout_email.html">
                            Email Templates</a>
                    </li>
                    <li >
                        <a href="layout_ajax.html">
                            Content Loading via Ajax</a>
                    </li>
                    <li >
                        <a href="layout_sidebar_closed.html">
                            Sidebar Closed Page</a>
                    </li>
                    <li >
                        <a href="layout_blank_page.html">
                            Blank Page</a>
                    </li>
                    <li >
                        <a href="layout_boxed_page.html">
                            Boxed Page</a>
                    </li>
                    <li >
                        <a href="layout_boxed_not_responsive.html">
                            Non-Responsive Boxed Layout</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-bookmark-empty"></i>
                    <span class="title">UI Features</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="ui_general.html">
                            General</a>
                    </li>
                    <li >
                        <a href="ui_buttons.html">
                            Buttons</a>
                    </li>
                    <li >
                        <a href="ui_modals.html">
                            Enhanced Modals</a>
                    </li>
                    <li >
                        <a href="ui_tabs_accordions.html">
                            Tabs & Accordions</a>
                    </li>
                    <li >
                        <a href="ui_jqueryui.html">
                            jQuery UI Components</a>
                    </li>
                    <li >
                        <a href="ui_sliders.html">
                            Sliders</a>
                    </li>
                    <li >
                        <a href="ui_tiles.html">
                            Tiles</a>
                    </li>
                    <li >
                        <a href="ui_typography.html">
                            Typography</a>
                    </li>
                    <li >
                        <a href="ui_tree.html">
                            Tree View</a>
                    </li>
                    <li >
                        <a href="ui_nestable.html">
                            Nestable List</a>
                    </li>
                </ul>
            </li>
            <li class="active ">
                <a href="javascript:;">
                    <i class="icon-table"></i>
                    <span class="title">Form Stuff</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="form_layout.html">
                            Form Layouts</a>
                    </li>
                    <li >
                        <a href="form_samples.html">
                            Advance Form Samples</a>
                    </li>
                    <li class="active">
                        <a href="form_component.html">
                            Form Components</a>
                    </li>
                    <li >
                        <a href="form_wizard.html">
                            Form Wizard</a>
                    </li>
                    <li >
                        <a href="form_validation.html">
                            Form Validation</a>
                    </li>
                    <li >
                        <a href="form_fileupload.html">
                            Multiple File Upload</a>
                    </li>
                    <li >
                        <a href="form_dropzone.html">
                            Dropzone File Upload</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-briefcase"></i>
                    <span class="title">Pages</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="page_timeline.html">
                            <i class="icon-time"></i>
                            Timeline</a>
                    </li>
                    <li >
                        <a href="page_coming_soon.html">
                            <i class="icon-cogs"></i>
                            Coming Soon</a>
                    </li>
                    <li >
                        <a href="page_blog.html">
                            <i class="icon-comments"></i>
                            Blog</a>
                    </li>
                    <li >
                        <a href="page_blog_item.html">
                            <i class="icon-font"></i>
                            Blog Post</a>
                    </li>
                    <li >
                        <a href="page_news.html">
                            <i class="icon-coffee"></i>
                            News</a>
                    </li>
                    <li >
                        <a href="page_news_item.html">
                            <i class="icon-bell"></i>
                            News View</a>
                    </li>
                    <li >
                        <a href="page_about.html">
                            <i class="icon-group"></i>
                            About Us</a>
                    </li>
                    <li >
                        <a href="page_contact.html">
                            <i class="icon-envelope-alt"></i>
                            Contact Us</a>
                    </li>
                    <li >
                        <a href="page_calendar.html">
                            <i class="icon-calendar"></i>
                            Calendar</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-gift"></i>
                    <span class="title">Extra</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="extra_profile.html">
                            User Profile</a>
                    </li>
                    <li >
                        <a href="extra_lock.html">
                            Lock Screen</a>
                    </li>
                    <li >
                        <a href="extra_faq.html">
                            FAQ</a>
                    </li>
                    <li >
                        <a href="inbox.html">
                            Inbox</a>
                    </li>
                    <li >
                        <a href="extra_search.html">
                            Search Results</a>
                    </li>
                    <li >
                        <a href="extra_invoice.html">
                            Invoice</a>
                    </li>
                    <li >
                        <a href="extra_pricing_table.html">
                            Pricing Tables</a>
                    </li>
                    <li >
                        <a href="extra_image_manager.html">
                            Image Manager</a>
                    </li>
                    <li >
                        <a href="extra_404_option1.html">
                            404 Page Option 1</a>
                    </li>
                    <li >
                        <a href="extra_404_option2.html">
                            404 Page Option 2</a>
                    </li>
                    <li >
                        <a href="extra_404_option3.html">
                            404 Page Option 3</a>
                    </li>
                    <li >
                        <a href="extra_500_option1.html">
                            500 Page Option 1</a>
                    </li>
                    <li >
                        <a href="extra_500_option2.html">
                            500 Page Option 2</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="active" href="javascript:;">
                    <i class="icon-sitemap"></i>
                    <span class="title">3 Level Menu</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            Item 1
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#">Sample Link 1</a></li>
                            <li><a href="#">Sample Link 2</a></li>
                            <li><a href="#">Sample Link 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            Item 1
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#">Sample Link 1</a></li>
                            <li><a href="#">Sample Link 1</a></li>
                            <li><a href="#">Sample Link 1</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            Item 3
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-folder-open"></i>
                    <span class="title">4 Level Menu</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="icon-cogs"></i>
                            Item 1
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-user"></i>
                                    Sample Link 1
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="icon-remove"></i> Sample Link 1</a></li>
                                    <li><a href="#"><i class="icon-pencil"></i> Sample Link 1</a></li>
                                    <li><a href="#"><i class="icon-edit"></i> Sample Link 1</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon-user"></i>  Sample Link 1</a></li>
                            <li><a href="#"><i class="icon-external-link"></i>  Sample Link 2</a></li>
                            <li><a href="#"><i class="icon-bell"></i>  Sample Link 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-globe"></i>
                            Item 2
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#"><i class="icon-user"></i>  Sample Link 1</a></li>
                            <li><a href="#"><i class="icon-external-link"></i>  Sample Link 1</a></li>
                            <li><a href="#"><i class="icon-bell"></i>  Sample Link 1</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-folder-open"></i>
                            Item 3
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Login Options</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="login.html">
                            Login Form 1</a>
                    </li>
                    <li >
                        <a href="login_soft.html">
                            Login Form 2</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-th"></i>
                    <span class="title">Data Tables</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="table_basic.html">
                            Basic Tables</a>
                    </li>
                    <li >
                        <a href="table_responsive.html">
                            Responsive Tables</a>
                    </li>
                    <li >
                        <a href="table_managed.html">
                            Managed Tables</a>
                    </li>
                    <li >
                        <a href="table_editable.html">
                            Editable Tables</a>
                    </li>
                    <li >
                        <a href="table_advanced.html">
                            Advanced Tables</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-file-text"></i>
                    <span class="title">Portlets</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="portlet_general.html">
                            General Portlets</a>
                    </li>
                    <li >
                        <a href="portlet_draggable.html">
                            Draggable Portlets</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="icon-map-marker"></i>
                    <span class="title">Maps</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="maps_google.html">
                            Google Maps</a>
                    </li>
                    <li >
                        <a href="maps_vector.html">
                            Vector Maps</a>
                    </li>
                </ul>
            </li>
            <li class="last ">
                <a href="charts.html">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Visual Charts</span>
                </a>
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
                        Form Components
                        <small>form components and widgets</small>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="#">Form Stuff</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">Form Components</a></li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <form enctype="multipart/form-data" action="<?php echo site_url('welcome/insert_product')?>" method="post">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box blue"></div>
<!--                        <div class="portlet-title">-->
<!--                            <div class="caption"><i class="icon-reorder"></i>Sample Form</div>-->
<!--                            <div class="tools">-->
<!--                                <a href="javascript:;" class="collapse"></a>-->
<!--                                <a href="#portlet-config" data-toggle="modal" class="config"></a>-->
<!--                                <a href="javascript:;" class="reload"></a>-->
<!--                                <a href="javascript:;" class="remove"></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="portlet-body form">-->
<!--                            <!-- BEGIN FORM-->
<!--                            <form action="#" class="form-horizontal">-->
                    <div class="control-group">
                        <label class="control-label">Category</label>
                        <div class="controls">
                            <select name="category" class="category" id='category'>
<!--                                <option value="none"></option>-->
                                <option  value="Software">Software</option>
                                <option  value="Hardware">Hardware</option>
                                </select>
                            <span class="help-inline"></span>
                            <div style="display:inline; color: red">
                                <?php echo form_error('category_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Product Name</label>
                        <div class="controls">
                            <input type="text" class="span6 m-wrap" style="width:905px" name="name"/>
                            <span class="help-inline"></span>
                            <div style="display:inline; color: red">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">SKU</label>
                        <div class="controls">
                            <input type="text" class="span6 m-wrap" style="width:905px" name="sku"/>
                            <span class="help-inline"></span>
                            <div style="display:inline; color: red" >
                                <?php echo form_error('sku'); ?>
                            </div>
                        </div>

                    </div>
                    <div class="control-group">
                        <label class="control-label" >Description</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" style="width:905px"rows="3" name="short_description"></textarea>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('short_description'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">CKEditor</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" style="width:905px"rows="3" name="long_description"></textarea>

<!--                            <textarea class="span12 ckeditor m-wrap" name="long_description" rows="6"></textarea>-->
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('long_description'); ?>
                        </div>
                    </div>
                    <div class="control-group" style="display:inline;">
                        <label class="control-label">Price</label>
                        <div class="controls"style="display:inline;">
                            <div class="input-prepend input-append"style="display:inline;">
                                <span class="add-on">$</span><input  class="m-wrap " type="text" name="price"/><span class="add-on">.00</span>
                            </div>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('price'); ?>
                        </div>
                    </div>
                    <div class="control-group" style="display:inline;">
                        <label class="control-label">Special Price</label>
                        <div class="controls">
                            <div class="input-prepend input-append">
                                <span class="add-on">$</span><input  class="m-wrap " type="text" name="special_price"/><span class="add-on">.00</span>
                            </div>
                        </div>

                        <div style="display:inline; color: red" >
                            <?php echo form_error('special_price'); ?>
                        </div>
                    </div>
                    <div></div>
                    <div class="control-group" style="display:inline">
                        <label class="control-label"style="display:inline">Starts with years view</label>
                        <div class="controls"style="display:inline">
                            <div class="input-append date date-picker"style="display:inline" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input style="display:inline " name="special_price_from"class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="" /><span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('special_price_from'); ?>
                        </div>
                    </div>
                    <div class="control-group"style="display:inline">
                        <label style="display:inline" class="control-label">Limit the view mode to months</label>
                        <div class="controls" style="display:inline">
                            <div style="display:inline" class="input-append date date-picker"  data-date="102/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                <input style="display:inline"style="width:905px" name="special_price_to"class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" value="" /><span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('special_price_to'); ?>
                        </div>
                    </div>
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
                    <div class="control-group">
                        <label class="control-label">Quntity</label>
                        <div class="controls">
                            <input type="text" style="width:905px"class="span6 m-wrap" name="quntity"/>
                            <span class="help-inline"></span>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('quntity'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Meta Title</label>
                        <div class="controls">
                            <input type="text" style="width:905px"class="span6 m-wrap" name="meta_title"/>
                            <span class="help-inline"></span>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('meta_title'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Meta-Description</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_description"></textarea>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('meta_description'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Meta-Keywords</label>
                        <div class="controls">
                            <textarea class="span6 m-wrap" rows="3"style="width:905px"name="meta_keywords"></textarea>
                        </div>
                        <div style="display:inline; color: red" >
                            <?php echo form_error('meta_keywords'); ?>
                        </div>
                    </div>
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
                    <div class="control-group">
                        <label class="control-label">Image Upload</label>
                        <div class="controls">
                            <div >

                                <div>
													<span class="btn btn-file"><span class="fileupload-new">Select image</span>
<!--													<span class="fileupload-exists">Change</span>-->
													<input type="file" class="default" name="image_name" size="20"/></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" value="upload" class="btn blue">Product Add In Store</button>
                        <button type="button" class="btn">Cancel</button>
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
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('assets/plugins/jquery-1.10.1.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js')?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
<!--[if lt IE 9]-->
<script src="<?php echo base_url('assets/plugins/excanvas.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/respond.min.js')?>"></script>
<!--[endif]-->
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('')?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('')?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('')?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('')?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url('')?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
<script src="<?php echo base_url('')?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('')?>assets/scripts/app.js"></script>
<script src="<?php echo base_url('')?>assets/scripts/form-components.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        FormComponents.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>