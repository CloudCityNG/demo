<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "training";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if((isset($_GET['type']))&&!empty($_GET['type'])) {

    $type = $_GET['type'];

    switch ($type) {
        case "search" :


            if (isset($_GET['keyword'])) {
                $ser = $_GET['keyword'];


                $search_name = "SELECT * FROM `customer` WHERE `first_name`='$ser' ORDER BY `id`";
                $qry = $conn->query($search_name);

                //var_dump($search_name);

                if ($qry->num_rows > 0) {
                    // header("Location:main.php");
                    //echo "See th record";
                    //  $i="";
                    while ($user = $qry->fetch_array()) {
                        //     $i++;








                     echo   $display = " User is " . $user['first_name'] . " " . $user['last_name'];
                        //    echo "in loop".$i;

                    }
                } else {
                    echo "No match found";
                }

            } else {
                echo("NO search keyword given");
            }
    }
}
?>
<form  method="get" action="<?php $_SERVER['PHP_SELF']?>">
    <input type="text" name="keyword">
    <input type="submit" name='type' value="search">
</form>