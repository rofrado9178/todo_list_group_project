<?php

$host = "localhost:3306";
$db = "shima94_task_manager";
$user = "shima94_db_music";
$pass = "MohsenMohsen261710";

$link = mysqli_connect($host, $user , $pass, $db);

$db_response = [];
$db_response["success"] = "not set";

if(!$link){
  $db_response["success"] = false;
}
else{
  $db_response["success"] = true;
}

// echo json_encode($db_response);

?>