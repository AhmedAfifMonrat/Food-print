<?php
include('./httpful.phar');
if($_SERVER['REQUEST_METHOD'] == "GET"){
$id=$_GET["id"];
if(empty($id))
{
   echo 'No Id Specified!';
}
else{
$wastenofood = \Httpful\Request::get('https://foodprint-madhubalaganesan.c9users.io/searchbyId.php?id='.$id)->send();
$input = str_replace(array( '[', ']' ), '', $wastenofood);
$op = json_decode($input);
$idd =  $op->{"id"};
$name = $op->{"name"};
$description = $op->{"description"};
$category = $op->{"category"};
$cost = $op->{"cost"};
$pickUpLocation = $op->{"pickUpLocation"};
$contactNo = $op->{"contactNo"};
$postedTime = $op->{"postedTime"};
$status = $op->{"status"}; 

$socrata = \Httpful\Request::get('https://opendata.socrata.com/resource/8nz9-yn2p.json?food='.$name)->addHeader('X-App-Token', 'gDZkOVDF3TPBzE8LpeICriMf8')->send();
$socdata = str_replace(array( '[', ']' ), '', $socrata);
$opsocdata = json_decode($socdata);
$serving_size =  $opsocdata->{"serving_size"};
$ss_unit =  $opsocdata->{"ss_unit"};
$grams_co2e_per_serving = $opsocdata->{"grams_co2e_per_serving"};
$calories_per_serving = $opsocdata->{"calories_per_serving"};

$food2fork = \Httpful\Request::get('http://food2fork.com/api/search/?key=9d1e4246f4abdc726047dced14f99ecc&q='.$name.'&sort=r&count=5')->addHeader('X-App-Token', 'gDZkOVDF3TPBzE8LpeICriMf8')->send();
$rec = json_decode($food2fork);
foreach($rec->recipes as $recipelist)
{
    $title = $recipelist->title;
    $recipe_url = $recipelist->source_url;
    $image_url =  $recipelist->image_url;
    $recipes[] = array("title" => $title, "recipe_url" => $recipe_url, 'image_url' => $image_url);
}  

$result = array();
$result[] = array("id" => $idd, "name" => $name, 'description' => $description, 'category' => $cat
egory, 'cost' => $cost, 'pickUpLocation' => $pickUpLocation, 'contactNo' => $contactNo, 'postedTime' => $postedTime, 'status' => $status, 'serving_size' => $serving_size, 'ss_unit' => $ss_unit, 'grams_co2e_per_serving' => $grams_co2e_per_serving, 'calories_per_serving' => $calories_per_serving, 'recipes' => $recipes);
echo json_encode($result);
}
}
?>









