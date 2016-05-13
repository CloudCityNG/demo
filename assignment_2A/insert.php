<!--<form action="Vital%20Partners%20Leading%20Dating%20and%20Introduction%20Agency%20in%20Sydney%20&%20Canberra.html" method="post">-->
<!--<input type="text">-->
<!--<input type="text">-->
<!--<input type="submit" value="submit">-->
<!--</form>-->
<?php


$ser='localhost';
$user='root';
$pass='root';
$conn= new mysqli($ser,$user,$pass);
if ($conn->connect_error) {
  echo 'hello';
   // die("Connection failed: " . mysqli_connect_error());
}
$data='create database mydb';
if(mysqli_query($conn,$data))
{
    echo 'done';
}
else
{
    die('failed');
}


mysqli_close($conn);





?>