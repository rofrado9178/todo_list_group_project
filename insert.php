
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form action="insert.php" method="post">
  <input type="number" placeholder="userID" name="user_id">
  <input type="text" placeholder="name" name="name">
  <input type="text" placeholder="desc" name="description">
  <input type="date" name="deadline">
  <input type="num" name="completed">

  <input type="submit">
</form>

  
</body>
</html>

<?php 
require_once "_includes/db_connect.php";

//insert query INSERT INTO `audiences`(`ticket_id`, `adult`, `kids_under_4`, `kids_4_to_18`, `senior_over60`, `date`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')

$query = "INSERT INTO tasks(user_id, name, description, deadline, completed) VALUES(? , ? , ? ,? ,?)";

$insertData = 0;
$results = [];

if($statement = mysqli_prepare($link, $query)){
  mysqli_stmt_bind_param($statement,"ssssi", $_POST["user_id"],$_POST["name"],$_POST["description"], $_POST["deadline"],$_POST["completed"]);

  mysqli_stmt_execute($statement);

  $insertData = mysqli_stmt_affected_rows($statement);

  if($insertData > 0){
    echo  json_encode("New TODO list has been added");
  }
  else{
    throw new Exception("Failed to add a new list");
  }

}

?>
