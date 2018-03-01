<?php
include_once('dbConf.php');
if($_SERVER['REQUEST_METHOD'] == "GET"){
$category=$_GET["category"];
if(empty($category))
{
   echo 'No Category Specified!';
}
else{
$qur = mysql_query("select * from `foodposts` where category = '$category'");
$result =array();
while($r = mysql_fetch_array($qur)){extract($r);
$result[] = array("id" => $id, "name" => $name, 'description' => $description, 'category' => $category, 'cost' => $cost, 'pickUpLocation' => $pickUpLocation, 'contactNo' => $contactNo, 'postedTime' => $postedTime, 'status' => $status);
}
@mysql_close($conn);
/* Output header */
header('Content-type: application/json');
echo json_encode($result);
}
}
?>