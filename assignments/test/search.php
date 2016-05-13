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
$display="";

if((isset($_GET['type']))&&!empty($_GET['type']))
{

    $type = $_GET['type'];

    switch ($type)
    {
        case "search" :


            if (isset($_GET['keyword']))
            {
                $ser = $_GET['keyword'];


                $search_name = "SELECT * FROM `customer` WHERE `phone_no`='$ser'";
                $qry=$conn->query($search_name);



                if ($qry->num_rows>0)
                {
                    // header("Location:main.php");
                    //echo "See th record";
                    while($user=$qry->fetch_assoc()){
                        $display=" User is ".$user['first_name']." ".$user['last_name'];
                    }
                } else {
                    echo "No match found";
                }

            }else{
                echo("NO search keyword given");
            }



break;


        case "delete" :
            if(isset($_GET['data']))
            {

                $del=$_GET['data'];

                $delete_query="DELETE  FROM `customer` WHERE `id`='$del'";
                $qrye=$conn->query($delete_query);
                if($qrye->num_rows>0)
                {
                    while($use=$qrye->fetch_assoc())
                    {
                        $display="User is".$use['id'];
                    }
                }else{
                    echo "NO MATCH FOUND";
                }

            }else{
                echo("no data found");
            }
        break;
    }
}
?>

<?php echo $display;?>

<form  method="get" action="<?php $_SERVER['PHP_SELF']?>">
    <input type="text" name="keyword[]">
    <input type="submit" name='type' value="search">
    <input type="text" name="data">
    <input type="submit" name='type' value="delete">
</form>
