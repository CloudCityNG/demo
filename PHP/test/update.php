
<?php

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


session_start();
$upid=$_SESSION['i'];


$ferror="";
$display_output="";
$lastname_error="";
$phone_error="";
$password_error="";
$compass_error="";
$email_error="";
$gender_error="";
$age_error="";
$pin_error="";
$about_error="";
$month_error="";
$day_error="";
$year_error="";


$first = "";
$last = "";
$phone = "";
$password = "";
$office="";
$compass = "";
$email = "";
$gender = "";
$age = "";
$pincode = "";
$about ="";



if (isset($_POST['SUBMIT'])) {

    $hasError=false;

    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $phone = $_POST['phone'];
    $office=$_POST['office'];
    $password = $_POST['password'];
    $compass = $_POST['compass'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $pincode = $_POST['pincode'];
    $about = $_POST['about'];
    $month=$_POST['month'];
    $day=$_POST['day'];
    $year=$_POST['year'];

    if (!preg_match('/^[a-zA-Z]*$/', $first)||empty($first)) {
        $hasError=true;
        $ferror = '<p style="color:#ff0000">First name required</p>';
    }

    if (!preg_match('/^[a-zA-Z]*$/', $last)||empty($last)) {
        $hasError=true;
        $lastname_error = '<p style="color:#ff0000">Last name required</p>';
    }
    if ($phone == "") {
        $hasError=true;
        $phone_error = '<p style="color:#ff0000">Phone number required</p>';
    } else if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $hasError=true;
        $phone_error = '<p style="color:#ff0000">10 Digit number Required</p>';
    }
    if ($password == "") {
        $hasError=true;
        $password_error = '<p style="color:#ff0000">Password required</p>';
    } else if ((strlen($password) < 6) || (strlen($password) > 8)) {
        $hasError=true;
        $password_error = '<p style="color:#ff0000">length between 6-8 required</p>';
    }
    if ($compass == "") {
        $hasError=true;
        $compass_error = '<p style="color:#ff0000">Re-Enter password</p>';
    } else if ($compass != $password) {
        $hasError=true;
        $compass_error = '<p style="color:#ff0000">Password not match</p>';
    }
    if ($email == "") {
        $hasError=true;
        $email_error = '<p style="color:#ff0000">Enter email</p>';
    }
//    if ($month == 0) {
//        $hasError=true;
//        $month_error = '<p style="color:#ff0000">Select Month</p>';
//    }
//    if ($day == 0) {
//        $hasError=true;
//        $day_error = '<p style="color:#ff0000">Select Day</p>';
//    }
//    if ($year == 0) {
//        $hasError=true;
//        $year_error = '<p style="color:#ff0000">Select Year</p>';
//    }
    if ($age == "") {
        $hasError=true;
        $age_error = '<p style="color:#ff0000">Enter age</p>';
    }
    elseif((2016-$year)<18){
        $hasError=true;
        $age_error = '<p style="color:#ff0000">Sorry,age below 18years</p>';
    }
    if ($pincode == "") {
        $hasError=true;
        $pin_error .= '<p style="color:#ff0000">Pincode Required</p>';
    } else if (!preg_match('/^[0-9]{6}$/', $pincode)) {
        $hasError=true;
        $pin_error .= '<p style="color:#ff0000">6 Digit pin Required</p>';
    }
    if ($about == "") {
        $hasError=true;
        $about_error .= '<p style="color:#ff0000">Please Wirte in About us </p>';
    }

echo $hasError;
    if(!$hasError)
    {
      //  echo 'hello';// $dob=$year."-".$month."-".$day;

        $upddate_qurey="update `customer` set `first_name`='$first', `last_name`='$last',`phone_no`='$phone',`office_no`='$office',`email`='$email',`gender`='$gender',`dob`='$dob',`age`='$age',`pincode`='$pincode',`aboutus`='$about'
      WHERE `id`=".$upid;

        $q=mysqli_query($conn, $upddate_qurey) or die(mysqli_error($conn));


        if ($conn->affected_rows>0)
        {header("Location: main.php");
           echo $display_output= "User added successfully";

        }
        else
        {
            //echo 'sorry';
            $display_output= "Error : " . $conn->error . "<br>";
            $hasError=true;
        }

    }

}




?>
