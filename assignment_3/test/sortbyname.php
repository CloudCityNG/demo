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


//if (isset($_POST['view'])) {
//    $ser = $_POST['view'];

    $show = "SELECT * FROM `customer` ORDER BY `first_name` DESC ";
    $qry = $conn->query($show);
    if ($qry->num_rows > 0) {
        // header("Location:main.php");
        //echo "See th record";
        while ($user = $qry->fetch_assoc())
        {
            $result[]=$user;

            //echo $display = " User is " . $user['first_name'] . " " . $user['last_name'];
        }
    } else {
        echo "No match found";
    }

//} else {
//    echo("NO search keyword given");
//
//}
