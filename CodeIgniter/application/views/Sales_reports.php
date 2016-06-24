<!DOCTYPE html>
<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {

            },

            data: [
                {
                    // Change type to "doughnut", "line", "splineArea", etc.
                    // type: "splineArea",
                    // dataPoints: [
                        { label: "May", y: <?php echo $total_m ?>},
                        { label: "June", y: <?php echo $total_j ?>}
                    ]
                }
            ]
        });
        chart.render();
    }
</script>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
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
                <a href="<?php echo site_url('admin/orders/')?>">
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
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Visual Charts <small>visual charts & graphs</small>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.html">Home</a>
                            <i class="icon-angle-right"></i>
                        </li>
                        <li><a href="#">Visual Charts</a></li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN CHART PORTLETS-->
            <div class="row-fluid">
                <div class="span12">

                        <div class="portlet-body">
                            <div id="chart_1" class="chart"></div>
                        </div>
<!--                        <div class="portlet-body">-->
<!--                            <div id="chart_2" class="chart"></div>-->
<!--                        </div>-->
                    <div id="chartContainer" style="width: 1000px;height: 200px"></div>
                    </div>
                    <!-- END INTERACTIVE CHART PORTLET-->
                </div>


            </div>
            <!-- END CHART PORTLETS-->
            <!-- BEGIN PIE CHART PORTLET-->
            <div class="row-fluid">
                <div class="span6">

                </div>
                <div class="span6">
                </div>
            </div>
            <!-- END PIE CHART PORTLET-->
            <!-- BEGIN PIE CHART PORTLET-->
            <div class="row-fluid">
                <div class="span6">

                </div>
                <div class="span6">

                </div>
            </div>
            <!-- END PIE CHART PORTLET-->
            <!-- BEGIN PIE CHART PORTLET-->
            <div class="row-fluid">
                <div class="span6">
                </div>
                <div class="span6">

                </div>
            </div>
            <!-- END PIE CHART PORTLET-->
            <!-- END PAGE CONTENT-->
        </div>
        <!-- BEGIN PAGE CONTAINER-->
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
<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cookie.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js')?>" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.resize.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.pie.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.stack.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.crosshair.js')?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" >
    <?php echo $total_m?>
//        var arrayOfPHPData = <?php //echo json_encode($year_graph) ?>//;
        var arrayOfPHPData = [[5,<?php echo $total_m?>],[6,<?php echo $total_j?>]];
        var orderOfPHPData = [[5,<?php echo $order_m?>],[6,<?php echo $order_j?>]];

        var amount =arrayOfPHPData;
        var order=orderOfPHPData;

//        arrayOfDataJS = new Array();
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