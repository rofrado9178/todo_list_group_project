<?php 

//require db connection from db_connect
require_once "_includes/db_connect.php";

$query = "SELECT * FROM tasks";
// $query = "SELECT * FROM tbl_lists";
// $query = "SELECT * FROM tbl_tasks";
// $query = "SELECT * FROM users";
// $query = "USE TABLE"
// $query =  "SHOW TABLES";

$statement = mysqli_prepare($link, $query);

//execute the query statement
  mysqli_stmt_execute($statement);

//get the result
  $result = mysqli_stmt_get_result($statement);

//loop through the row and give back the result as a json format
  
  while($row = mysqli_fetch_assoc($result)){

    $results[] = $row;
  }

  echo json_encode($results);

  mysqli_close($link);