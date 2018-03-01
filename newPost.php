<?php
include_once('dbConf.php');
 if($_SERVER['REQUEST_METHOD'] == "POST"){
$name = (isset($_POST['name']))?$_POST['name']:'' ;
$description = (isset($_POST['description']))?$_POST['description']:'';
$category = (isset($_POST['category']))?$_POST['category']:'';
$cost = (isset($_POST['cost']))?$_POST['cost']:'';
$pickUpLocation = (isset($_POST['pickUpLocation']))?$_POST['pickUpLocation']:'';
$contactNo = (isset($_POST['contactNo']))?$_POST['contactNo']:'';
$postedTime = (isset($_POST['postedTime']))?$_POST['postedTime']:'';
$status = (isset($_POST['status']))?$_POST['status']:'';
$sql = "INSERT INTO `wastenofood`.`foodposts` (`name`, `description`, `category`, `cost`, `pickUpLocation`, `contactNo`, `postedTime`, `status`) VALUES ('$name', '$description', '$category', '$cost', '$pickUpLocation', '$contactNo', '$postedTime', '$status');";
$qur = mysql_query($sql);
if($qur){
$json = array("msg" => "Post added!");
}else{
$json = array("msg" => "Error posting!");
}
}else{
$json = array("msg" => "Request method not accepted");
}
@mysql_close($conn);
header('Content-type: application/json');
echo json_encode($json);
?>