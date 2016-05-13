<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie" lang="en" dir="ltr"><![endif]-->
<!--[if gt IE 8]> <html class="no-js gt-ie8 ie" lang="en" dir="ltr"><![endif]-->
<html><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="http://wireframes.php-dev.in/training/php/assignment/favicon.ico">
    <title>Vital Partners Leading Dating and Introduction Agency in Sydney &amp; Canberra</title>
    <link href="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/default.css" rel="stylesheet" type="text/css" media="all">
    <link href="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/stylesheet.css" rel="stylesheet" type="text/css" media="all">
    <!--<link href="css/small-resolution.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/medium-resolution.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/high-resolution.css" rel="stylesheet" type="text/css" media="all">-->

    <!-- jQuery library (served from Google) -->
    <script src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/jquery_003.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/jquery_002.js"></script>
    <script src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/script.js" type="text/javascript"></script>

    <!-- bxSlider CSS file -->
    <link href="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/jquery.css" rel="stylesheet">
    <!-- Responsive -->
    <link href="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/responsive.css" rel="stylesheet">



</head>

<body>
<!--wrapper-starts-->

<form action="<?php $_SERVER['PHP_SELF']?>">
<div id="wrapper">



    <?php
    $result=[];



    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "training";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    function delete($conn,$id)
    {
        // sql to delete a record
        echo 'inside function';
        $dele = "DELETE FROM `customer` WHERE `id`='$id'";

        $conn->query($dele);

        if ($conn->affected->rows>0)
        {
//            header("Location:main.php");
//            echo "Record deleted successfully";
        }
        else
        {
            echo "Error deleting record: " . $conn->error;
        }

    }

    $type=(isset($_GET['type'])&&!empty($_GET['type'])?$_GET['type']:"view_all");

        switch ($type)
        {
            case "search" :
                if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                {
                    $ser = $_GET['keyword'];
                    $search_name = "SELECT * FROM `customer` WHERE `first_name`='$ser'";
                    $qry=$conn->query($search_name);

                    if ($qry->num_rows>0)
                    {
                        while($user=$qry->fetch_assoc())
                        {
                          $result[]=$user;
                        }
                    }
                    else
                    {
                        echo "No match found";
                    }
                }
                else
                {
                    echo("NO search keyword given");
                }
                break;

            case "delete" :

                if(isset($_GET['data'])&&!empty($_GET['data']))
                {
                    $delete_data = $_GET['data'];
                    foreach ($delete_data as $item)
                    {
                        delete($conn, $item);
                    }
                }
                break;

            case "view_all":

                $sortby=(isset($_GET['sortby']))?$_GET['sortby']:"desc";
                $sortof=isset($_GET['sortof'])?$_GET['sortof']:"id";

                $qry=$conn->query("SELECT * FROM `customer` ORDER BY `$sortof` $sortby") or die();

                if ($qry->num_rows>0)
                {
                    while($use=$qry->fetch_assoc())
                    {
                       $result[]=$use;
                    }
                }
    }
    ?>
    <!--header-starts-->
    <header class="clearfix header_fixed">

        <div class="container"><!--container Start-->

            <div class="Logo_Cont left"><!--Logo_Cont Start-->

                <a href="http://wireframes.php-dev.in/training/php/assignment/index.html"><img src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/logo.png" alt=""></a>

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
                            <div class="Search">
                                <input value="" name="keyword" type="text">

                                <input class="submit" value="search" type="submit" name="type">

                                <input class="submit" value="view_all" type="submit" name="view">
                            </div>
                        </li>
                        <li><a href="index.php">Create Customer</a></li>
                        <li class="search_div"><div class="Search">
                                <input style="margin-left: 10px" class="submit" value="delete" type="submit" name="type">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="table_container_block">
               <?php



                    echo " <table>
                        <thead>
                        <tr>
                            <th>
                                <input class='checkbox' id='checkbox_sample18' type='checkbox'> <label class='css-label mandatory_checkbox_fildes' for='checkbox_sample18'></label>
                            </th>
                            <th style='width:12%'>Name <a href='main.php?sortby=desc&sortof=first_name' class='sort_icon'><img src='Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/sort.png'></a></th>
                            <th>Email<a href='main.php?sortby=desc&sortof=email' class='sort_icon'><img src='Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/sort.png'></a></th>
                            <th>Phone<a href='main.php?sortby=desc&sortof=phone_no' class='sort_icon'><img src='Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/sort.png'></a></th>
                            <th>Gender<a href='main.php?sortby=desc&sortof=gender' class='sort_icon'><img src='Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/sort.png'></a></th>
                            <th>Pincode<a href='main.php?sortby=desc&sortof=pincode' class='sort_icon'><img src='Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/sort.png'></a></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>";?>



                    <?php
                        foreach($result as $value)
                        {?>
                        <tr>
                            <td>
                                <input type="checkbox"  name="data[]" value= '<?php echo $value['id']?>'>
                            </td>
                            <td><?php echo $value['first_name'];?></td>
                            <td><?php echo $value['email'];?></td>
                            <td><?php echo $value['phone_no'];?></td>
                            <td><?php echo $value['gender'];?></td>
                            <td><?php echo $value['pincode'];?></td>

                            <td>
                                <div class="">

                                    <form action="delete.php?id=<?php echo $value['id']?>" method="post">
                                    <button class="btn btn_edit">Edit</button>

                                    </form><br>

                                    <form action="Edit.php?id=<?php echo $value['id']?>" method="post">
                                    <button class="btn btn_delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr> <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination_listing">
                    <ul>
                        <li><a href="#">first</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">Last</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Content Section End-->




    <div class="section clearfix section-colored7"><!--section start-->

        <div class="container"><!--container Start-->

            <div class="Download_Cont_Top_Left left"><!--Download_Cont_Top Start-->
                <img src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/icon5.png" alt=""> <h1 style="display:inline;">FREE: Men Are From Mars</h1> <a href="#">Download Now</a>

            </div><!--Download_Cont_Top End-->

        </div><!--container End-->

    </div><!--section End-->




    <!--footer-starts-->
    <footer class="footer_wrapper">

        <div class="container"><!--container Start-->

            <div class="Footer_Cont_Top clearfix"><!--Footer_Cont_Top Start-->

                <span class="left"><img src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/foot_logo.png" alt=""></span>
                <p class="right">Shortcut your search to happiness right now.
                    Live a life without regrets and take action today!</p>
            </div><!--Footer_Cont_Top End-->

            <div class="Footer_Cont_Top2 clearfix"><!--Footer_Cont_Top2 Start-->

                <h1>Call Us Today! (02) 9017 8413</h1>
                <a href="#">Book an Appointment <img src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/icon7.png" alt=""></a>
                <a href="#">Contact a Consultant <img src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/icon6.png" alt=""></a>
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


                    <!-- <p><a href="#"><img src="images/icon10.png" alt=""></a></p>
                    <p><a href="#"><img src="images/icon11.png" alt=""></a></p>
                    <p><a href="#"><img src="images/icon12.png" alt=""></a></p>
                    <p><a href="#"><img src="images/icon13.png" alt=""></a></p>
                    <p><a href="#"><img src="images/icon14.png" alt=""></a></p> -->
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
    <!--footer-ends-->

    <!-- Sticky Contact Number Start
    <div class="fixed_contact_number">
        <div class="container">
            <div class="contact_number">
                <span>Call Us Today! (02) 9017 8413</span>
                <a href="contact_us.html">Conatct Us</a>
            </div>
        </div>
    </div>
     Sticky Contact Number End-->

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });
</script>
<!--wrapper-starts-->

<script type="text/javascript" src="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&amp;%20Canberra_files/jquery.js"></script>
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

</body></html>