<?php
$_GET['id'];

$ids=$_GET['id'];
echo $ids;

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


$dele = "DELETE FROM `customer` WHERE `id`='$ids'";
//  echo "hello";


if ($conn->query($dele) === TRUE) {
    header("Location:main.php");
    echo "Record deleted successfully";

} else {
    echo "Error deleting record: " . $conn->error;
}
?>