
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
//    if($month==0){
//        $month_error.='<p style="color:#ff0000">Select Month</p>';
//    }



    if(!$hasError){

        $insert_query = "insert into customer (first_name,last_name,phone_no,office_no,email,gender,password,dob,age,pincode,aboutus)
    VALUES
    ('$first','$last','$phone','$office','$email','$gender','$password','$dob','$age','$pincode','$about')";

        $q=mysqli_query($conn, $insert_query);


 if ($conn->affected_rows>0)
    {
        $display_output= "User added successfully";
        header("Location: main.php");
    }
    else
    {
        $display_output= "Error: " . $conn->error . "<br>";
        $hasError=true;
    }

    }
}





















//else
//{
//    $server_name = 'localhost';
//    $user = 'root';
//    $pass = 'root';
//    $db = 'training';
//    $conn = new mysqli($server_name, $user, $pass, $db);
//    if ($conn->connect_error)
//    {
//        die("Connection failed: " . mysqli_connect_error());
//    }
//    $insert_query = "insert into customer (id,first_name,last_name,phone_no,office_no,email,gender,password,dob,age,pincode,aboutus)
//    VALUES
//    ('$id','$first','$last','$phone','$office','$email','$gender','$password','$dob','$age','$pincode','$about')";
//    if (mysqli_query($conn, $insert_query))
//    {
//        echo "New record created successfully";
//        header("Location: main.php");
//    }
//    else
//    {
//        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
//    }
//
//
//}
//
//?>
