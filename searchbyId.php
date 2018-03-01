<?php
include_once('dbConf.php');
if($_SERVER['REQUEST_METHOD'] == "GET"){
$id=$_GET["id"];
if(empty($id))
{
   echo 'No Id Specified!';
}
else{
$qur = mysql_query("select * from `foodposts` where id = '$id'");
//$result =array();
while($r = mysql_fetch_array($qur)){extract($r);
$result[] = array("id" => $id, "name" => $name, 'description' => $description, 'category' => $category, 'cost' => $cost, 'pickUpLocation' => $pickUpLocation, 'contactNo' => $contactNo, 'postedTime' => $postedTime, 'status' => $status);
}
$json = $result;
@mysql_close($conn);
/* Output header */
header('Content-type: application/json');
echo json_encode($json);
}
}
?>