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

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pagination</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<table style="border: 1px #000000 solid;" width="400" cellspacing="2" cellpadding="2" align="center">
<?php

$perpage = 2;

if(isset($_GET["page"])){
	$page = intval($_GET["page"]);
}
else {
$page = 2;
}
$calc = $perpage * $page;
$start = $calc - $perpage;
$result = mysqli_query($conn, "select * from `customer` Limit $start, $perpage");

$rows = mysqli_num_rows($result);

if($rows){
	$i = 0;
	while($post = mysqli_fetch_assoc($result)) {
?>


<tbody>
<tr style="background-color: #cccccc;">

<td style="font-weight: bold;font-family: arial;"><?php echo $post["first_name"]; ?></td>

</tr>

<tr>

<td style="font-family: arial;padding-left: 20px;"><?php echo $post["last_name"]; ?></td>

</tr>
<?php
}
}
?>



</tbody>
</table>

<!--<table width="400" cellspacing="2" cellpadding="2" align="center">-->
<!--<tbody>-->
<!--<tr>-->
<!--<td align="center">-->



<?php

if(isset($page))

{

$result = mysqli_query($conn,"select count(*) As Totals from `customer`");

	//echo $result;

$rows = mysqli_num_rows($result);

	if($rows)
{
	//echo $rows;
$rs = mysqli_fetch_assoc($result);

	//var_dump($rs);
$total = $rs["Totals"];
	echo $total;
}

$totalPages = ceil($total / $perpage);

if($page <=1 ){

echo "<span id='page_links' style='font-weight: bold;'>Prev</span>";

}

else

{

$j = $page - 1;

echo "<span><a id='page_a_link' href='pagination.php?page=$j'>< Prev</a></span>";

}

for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<span><a id='page_a_link' href='pagination.php?page=$i'>$i</a></span>";

}

else

{

echo "<span id='page_links' style='font-weight: bold;'>$i</span>";

}

}

if($page == $totalPages )

{

echo "<span id='page_links' style='font-weight: bold;'>Next ></span>";

}

else

{

$j = $page + 1;

echo "<span><a id='page_a_link' href='pagination.php?page=$j'>Next</a></span>";

}

}

?>

<!--</td>-->
<!--<td></td>-->
<!--</tr>-->
<!--</tbody>-->
<!--</table>-->


</body>
</html>