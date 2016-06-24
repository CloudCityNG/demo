<!DOCTYPE HTML>
<html>
<head>
    <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    title: {

                    },

                    data: [
                        {
                            // Change type to "doughnut", "line", "splineArea", etc.
                            type: "column",
                            dataPoints: [
                                { label: "<?php echo $month_m?>", y: <?php echo $total_m ?>},
                                { label: "<?php echo $month_j?>", y: <?php echo $total_j ?>}

                            ]
                        }
                    ]
                });
                chart.render();
            }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>




<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Data Tables - Editable Tables</title>
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
    <link href="<?php echo base_url('assets/css/pages/login.css"')?> rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="<?php echo base_url('favicon.ico')?>" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!--<body class="page-header-fixed">-->
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
<!--<a href="--><?php //echo base_url('javascript:;')?><!--" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">-->
<!--    <img src="--><?php //echo base_url('assets/img/menu-toggler.png')?><!--" alt="" />-->
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
    </li>
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
<body>
<!-- BEGIN INTERACTIVE CHART PORTLET-->
<div class="portlet box red">
    <div class="portlet-title">
        <div class="caption"><i class="icon-reorder"></i>Interactive Chart</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="chart_2" class="chart"></div>
    </div>
</div>
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
<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cookie.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js')?>" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/jquery.vmap.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.resize.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.pulsate.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/date.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/gritter/js/jquery.gritter.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.sparkline.min.js')?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/scripts/app.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/scripts/index.js')?>" type="text/javascript"></script>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.resize.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.pie.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.stack.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.crosshair.js')?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript"> $(document).ready(function () {
        var arrayOfPHPData = <?php echo json_encode($year_graph) ?>;
        arrayOfDataJS = new Array();}
</script>
<script src="<?php echo base_url('assets/scripts/app.js')?>"></script>
<script src="<?php echo base_url('assets/scripts/charts.js')?>"></script>
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        Charts.init();
        Charts.initCharts();
        Charts.initPieCharts();
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>















