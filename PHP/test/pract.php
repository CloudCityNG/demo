<!---->
<?php

header("Location:main.php");
//
//$servername = "localhost";
//$username = "root";
//$password = "root";
//$dbname = "training";
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//// Check connection
//if ($conn->connect_error)
//{
//    die("Connection failed: " . $conn->connect_error);
//}
if(isset($_POST['delete_user']))
{
    $users=$_POST['delete_user'];
    foreach($users as $user)
    {
        echo "deleting $user";
        delete($conn,$user);
    }
}
function delete($conn,$id)
    {
    // sql to delete a record
       $del = "DELETE FROM `customer` WHERE `id`='$id'";

        if ($conn->query($del) === TRUE)
        {
            header("Location:main.php");
            echo "Record deleted successfully";
        }
        else
        {
            echo "Error deleting record: " . $conn->error;
        }

    }
//
//if(isset($_POST['search']))
//{
//    $ser=$_POST['search'];
//    echo "searching $ser";
//    search($conn,$ser);
//}
//function search($conn,$sch)
//{
//    $search_name="SELECT * FROM `customer` WHERE `phone_no`='$sch'";
//    if($conn->query($search_name))
//    {
//        header("Location:main.php");
//        echo "See th record";
//    }
//    else
//    {
//        echo $sch;
//        echo "Not match";
//    }
//}
//?>
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
