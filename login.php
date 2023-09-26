<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
   <form action="login.php" id="login" method="post">
            <label for="">Input User</label>
            <input type="text" placeholder="Input Username" name="username" />
            <label for="">Input Password</label>
            <input
              type="password"
              placeholder="Input password"
              name="password"
            />

            <input type="submit" value="Login" class="btn" />
          </form>
</body>
</html>
<?php 

require_once "_includes/db_connect.php";

session_start();

if(isset($_REQUEST["username"]) && isset($_REQUEST["password"])){
  
  
  $query = "SELECT * FROM users WHERE username = ?";

  $results = [];

  $password = $_REQUEST["password"];

  if($statement = mysqli_prepare($link, $query)){
    mysqli_stmt_bind_param($statement,"s", $_REQUEST["username"]);
  
    mysqli_stmt_execute($statement);
  
    $result = mysqli_stmt_get_result($statement);
  
    if($results = mysqli_fetch_assoc($result)){
     if(password_verify($password, $results["password"])){
      $_SESSION["username"] = $results["username"];
      $_SESSION["user_id"] = $results["id"];
      $_SESSION["loggedIn"] = true;
      // header("Location: userBook.html");
      // $results = 
      echo json_encode("Hi there, ".$_SESSION["username"] . "your id is" . $_SESSION["user_id"] . $_SESSION["loggedIn"]); 
     }
     else{
      // echo json_encode("Password Does Not Match");
      $error = throw new Error("Password Does Not Match");
     }
    }
  }
  else {
    throw new Error("User Does Not Exists");
  }
}


