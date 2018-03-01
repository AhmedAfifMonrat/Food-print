<?php
include_once('dbConf.php');
if($_SERVER['REQUEST_METHOD'] == "GET"){
$qur = mysql_query("select cat from category");
$result =array();
while($r = mysql_fetch_array($qur)){extract($r);
$result[] = array("category" => $cat);
}
@mysql_close($conn);
/* Output header */
header('Content-type: application/json');
echo json_encode($result);
}
?>