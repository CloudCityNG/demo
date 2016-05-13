<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie" lang="en" dir="ltr"><![endif]-->
<!--[if gt IE 8]> <html class="no-js gt-ie8 ie" lang="en" dir="ltr"><![endif]-->






<html xmlns="http://www.w3.org/1999/html"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="://wireframes.php-dev.in/training/php/assignment/favicon.ico">
    <title>Vital Partners Leading Dating and Introduction Agency in Sydney &amp; Canberra</title>
    <link href="<?php echo base_url('css/default.css')?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url('css/stylesheet.css')?>" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo base_url('js/jquery_003.js')?>"></script>
    <!-- bxSlider Javascript file -->
    <script src="<?php echo base_url('js/jquery_002.js')?>"></script>
    <script src="<?php echo base_url('js/script.js')?>" type="text/javascript"></script>

    <!-- bxSlider CSS file -->
    <link href="<?php echo base_url('css/jquery.bxslider.css')?>" rel="stylesheet">
    <!-- Responsive -->
    <link href="<?php echo base_url('css/responsive.css')?>" rel="stylesheet">

    <script>
        function delete_con()
        {
            {
                var x = confirm("Are you sure you want to delete?");
                if (x)
                    return true;
                else
                    return false;
            }
        }
    </script>






</head>
<body>
<!--wrapper-starts-->



    <div id="wrapper">
        <!--header-starts-->
        <header class="clearfix header_fixed">
            <div class="container"><!--container Start-->
                <div class="Logo_Cont left"><!--Logo_Cont Start-->
                    <a href="http://wireframes.php-dev.in/training/php/assignment/index.html"><img src="<?php base_url('images/logo.png')?>" alt=""></a>
                </div><!--Logo_Cont End-->
                <div class="Home_Cont_Right right"><!--Home_Cont_Right Start-->
                    <div class="Home_Cont_Right_Top left"><!--Home_Cont_Right_Top Start-->
                        <div class="Top_Search1 left">Call Us Today! (02) 9017 8413</div>
                        <div class="Top_Search2 right">
                            <input id="tags1" name="" onclick="this.value='';" onblur="validate_field('phone');" value="Type desired Job Location" type="text">
                        </div>
                    </div><!--Home_Cont_Right_Top End-->
                    <div class="Home_Cont_Right_Bottom left"><!--Home_Cont_Right_Bottom Start-->
                        <div class="toggle_menu"><a href="javascript:void(0)">Menu</a></div>
                        <div id="topMenu">
                            <ul>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/index.html">Home</a></li>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/blog_index.html">Dating Blog</a></li>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/who_we_help.html">Who We Help</a></li>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/why_vital.html">Why Vital</a></li>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/reviews.html">Reviews</a></li>
                                <li><a href="http://wireframes.php-dev.in/training/php/assignment/contact_us.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div><!--Home_Cont_Right_Bottom End-->
                </div><!--Home_Cont_Right End-->
            </div><!--container End-->
        </header>
        <!--header-ends-->
        <div class="section banner_section who_we_help">
            <div class="container">
                <h4>Manage Customer</h4>
            </div>
        </div>
        <!-- Content Section Start-->
        <div class="section content_section">
            <div class="container">
                <div class="filable_form_container">
                    <div class="mange_buttons">
                        <ul>
                            <li class="search_div">
                                <div class="Search" style="display: inline">
                                    <form style="display: inline;" method="post" action="<?php echo site_url('Practice/search');?>">
                                        <input value="<?php if(isset($keyword)){echo $keyword;}else{echo "";}?>" name="keyword" type="text" style="display:inline; width: 120px ; height: 33px">
                                        <input type="submit" name="Submit" style="display:inline;text-align: center;    margin-left: 10px;border-radius: 5px;;  font-family: 'roboto_slablight';width: 150px; height: 50px;background-color: #9fbc35 " type="SUBMIT" value="Search">
                                    </form>
                                </div>
                                <a href="<?php echo site_url('Practice/index');?>">View All</a>
                            </li>
                             <li>
                                 <a href="<?php echo site_url('Practice/entry');?>">Create Customer</a>
                             </li>
                            <li>
                                <form onclick="return delete_con()" action="<?php echo base_url('Practice/deleteall');?>"method="post">
                                <input type="submit" name="Submit" style="display:inline;text-align: center;    margin-left: 00px;border-radius: 5px;;  font-family: 'roboto_slablight';width: 150px; height: 50px;background-color: #9fbc35 " type="SUBMIT" value="Delete Customer">
                            </li>
                        </ul>
                    </div>
                    <center><?php echo $this->session->flashdata('msg');?></center>

                    <?php if(isset($oreder))
                    {
                        $sortof='desc';
                    }
                    else{
                        $sortof='asc';
                    }
                    ?>



                    <div class="table_container_block">
                        <table>
                        <thead>
                        <tr>
                            <th>
                                <input class='checkbox' id='checkbox_sample18' type='checkbox'> <label class='css-label mandatory_checkbox_fildes' for='checkbox_sample18'></label>
                            </th>
                            <th style='width:12%'>Name <a href='<?php echo site_url('Practice/?sortby=first_name');?>' class='sort_icon'><img src="<?php echo base_url('images/sort.png')?>"></a></th>
                            <th>Email<a href='<?php echo site_url('Practice/?sortby=email');?>' class='sort_icon'><img src="<?php echo base_url('images/sort.png')?>"</a></th>
                            <th>Phone<a href='<?php echo site_url('Practice/?sortby=phone_no');?>' class='sort_icon'><img src="<?php echo base_url('images/sort.png')?>"></a></th>
                            <th>Gender<a href='<?php echo site_url('Practice/?sortby=gender');?>' class='sort_icon'><img src="<?php echo base_url('images/sort.png')?>"></a></th>
                            <th>Pincode<a href='<?php echo site_url('Practice/?sortby=pincode');?>' class='sort_icon'><img src=<?php echo base_url('images/sort.png')?>></a></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(empty($customer))
                        {
                            echo "No Data Avalibale";
                        }else{
                        foreach($customer as $value)
                        {
                            $value = (array) $value;
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox"   name="data[]" value= '<?php echo $value['id']?>'>
                                </td>

                                <td><?php echo $value['first_name'];?></td>
                                <td><?php echo $value['email'];?></td>
                                <td><?php echo $value['phone_no'];?></td>
                                <td><?php echo $value['gender'];?></td>
                                <td><?php echo $value['pincode'];?></td>
                                <td>

                                    <div class="">
                                            <a onclick="return delete_con()"  href="<?php echo base_url('Practice/delete?id='.$value['id'])?>" style="display: inline" class="btn btn_edit"></a>
                                            <a  href="<?php echo base_url('Practice/edit?id='.$value['id'])?>" style="display: inline"class="btn btn_delete"></a>
                                    </div>
                                </td>
                            </tr> <?php }} ?>

                        </tbody>
                        </table>
                    </div>
                    <div class="pagination_listing">
                        <?php
                        foreach($links as $li)
                        {
                            echo "<li>" . $li . "</li>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <form>
        <!-- Content Section End-->
        <div class="section clearfix section-colored7"><!--section start-->

            <div class="container"><!--container Start-->

                <div class="Download_Cont_Top_Left left"><!--Download_Cont_Top Start-->
                    <img src="<?php echo base_url('images/icon5.png')?>" alt=""> <h1 style="display:inline;">FREE: Men Are From Mars</h1> <a href="#">Download Now</a>

                </div><!--Download_Cont_Top End-->

            </div><!--container End-->

        </div><!--section End-->
        <!--footer-starts-->
        <footer class="footer_wrapper">

            <div class="container"><!--container Start-->

                <div class="Footer_Cont_Top clearfix"><!--Footer_Cont_Top Start-->

                    <span class="left"><img src="<?php echo base_url('images/foot_logo.png')?>" alt=""></span>
                    <p class="right">Shortcut your search to happiness right now.
                        Live a life without regrets and take action today!</p>
                </div><!--Footer_Cont_Top End-->

                <div class="Footer_Cont_Top2 clearfix"><!--Footer_Cont_Top2 Start-->

                    <h1>Call Us Today! (02) 9017 8413</h1>
                    <a href="#">Book an Appointment <img src="<?php echo base_url('images/icon7.png')?>" alt=""></a>
                    <a href="#">Contact a Consultant <img src="<?php echo base_url('images/icon6.png')?>" alt=""></a>
                </div><!--Footer_Cont_Top2 End-->

                <div class="Footer_Cont_Top3 clearfix"><!--Footer_Cont_Top3 Start-->

                    <div class="Foot_Link1"><!--Foot_Link1 Start-->

                        <h1>CONTACT INFO</h1>

                        <div class="Foot_Link2"><!--Foot_Link2 Start-->

                            <span>4/220 George St, Sydney NSW 2000</span>
                            <p>Phone: (02) 9017 8413</p>
                            <p>Email: <a href="mailto:info@syd.vitalpartners.com.au" target="_blank">info@syd.vitalpartners.com.au</a></p>

                        </div><!--Foot_Link2 End-->

                        <div class="Foot_Link2"><!--Foot_Link2 Start-->

                            <span>Canberra City Act 2600 </span>
                            <p>Phone: (02) 9017 8426</p>
                            <p>Email: <a href="mailto:can@syd.vitalpartners.com.au" target="_blank">can@syd.vitalpartners.com.au</a></p>

                        </div><!--Foot_Link2 End-->

                    </div><!--Foot_Link1 End-->

                    <div class="Foot_Link1"><!--Foot_Link2 Start-->
                        <h1>RECENT POSTS</h1>

                        <div class="Foot_Link3"><!--Foot_Link3 Start-->
                            <ul>
                                <li><a href="#">How to Recover After a Bad Date</a></li>
                                <li><a href="#">Review | Vital Partners Review</a></li>
                                <li><a href="#">Review | Vital Partners Review</a></li>
                                <li><a href="#">Review | Vital Partners Derek and Julie</a></li>
                                <li><a href="#">7 Rules for a Happy Relationship | Vital Partners Dating Sydney</a></li>
                            </ul>
                        </div><!--Foot_Link3 End-->

                    </div><!--Foot_Link1 End-->

                    <div class="Foot_Link1"><!--Foot_Link2 Start-->
                        <h1>RECENT TWEETS</h1>

                        <div class="Foot_Link4"><!--Foot_Link4 Start-->
                            <ul>
                                <li class="left">
                                    <p>Are you being vulnerable to find love? via offline dating agency Sydney Canberra Vital Partners </p>
                                    <div class="Page_Link left"><a href="#">http://t.co/hGCgHEU6If</a></div>
                                    <div class="Page_Link right"> 1 week ago</div>
                                </li>
                                <li class="left">
                                    <p>Are you being vulnerable to find love? via offline dating agency Sydney Canberra Vital Partners </p>
                                    <div class="Page_Link left"><a href="#">http://t.co/hGCgHEU6If</a></div>
                                    <div class="Page_Link right"> 2 week ago</div>
                                </li>
                            </ul>
                        </div><!--Foot_Link4 End-->

                    </div><!--Foot_Link2 End-->

                </div><!--Footer_Cont_Top3 End-->

            </div><!--container End-->

            <div class="section clearfix section-colored9"><!--section section-colored9 start-->

                <div class="container"><!--container Start-->
                    <div class="Foot_Link5 left"><!--Foot_Link5 Start-->
                        © VitalPartners.com.au
                    </div><!--Foot_Link5 End-->
                    <div class="Foot_Link6 left"><!--Foot_Link5 Start-->
                        <a href="http://wireframes.php-dev.in/training/php/assignment/contact_us.html">Contact</a> |  <a href="http://wireframes.php-dev.in/training/php/assignment/terms_of_use.html">Terms of Use</a> |   <a href="http://wireframes.php-dev.in/training/php/assignment/privacy_policy.html">Privacy Policy</a> |  <a href="http://wireframes.php-dev.in/training/php/assignment/disclaimer.html">Disclaimer</a>
                    </div><!--Foot_Link6 End-->
                    <div class="Foot_Link7 right"><!--Foot_Link7 Start-->
                        <span>FOLLOW US:</span>
                        <ul class="social_media">
                            <li><a href="#" class="fb">facebook</a></li>
                            <li><a href="#" class="twitter">Twitter</a></li>
                            <li><a href="#" class="linkedin">LinkedIn</a></li>
                            <li><a href="#" class="you_tube">You Tube</a></li>
                            <li><a href="#" class="gplus">googl plus</a></li>
                        </ul>
                    </div><!--Foot_Link7 End-->

                </div><!--container End-->

            </div><!--section section-colored9 End-->

            <div class="section section-colored10"><!--section section-colored9 start-->

                <div class="container"><!--container Start-->
                    <div class="Foot_Link8 "><!--Foot_Link8 Start-->
                        <a href="#">Who Designed This Site?</a> <a href="#">Who  Built This Site?</a>
                    </div><!--Foot_Link8 End-->
                </div><!--container End-->

            </div><!--section section-colored9 End-->
        </footer>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.bxslider').bxSlider();
        });
    </script>
    <!--wrapper-starts-->
    <script type="text/javascript" src="<?php echo base_url('js/jquery.js')?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select').each(function(){
                var title = $(this).attr('title');
                if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
                $(this).css({'z-index':10,'opacity':0,'-khtml-appearance':'none'}).after('<span class="select">' + title + '</span>').change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
            });
        });
    </script>
</body>
</html>