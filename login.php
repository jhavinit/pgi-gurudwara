 <?php
  session_start(); 
  $name = $_POST['name'];
  $password = $_POST['psw'];
  require 'db.php';
  $_SESSION["auth"] = 0;

  $result = mysqli_query($conn, "select * from admin where name = '$name'")
            or die("Failed to query database".mysql_error());

  $row = mysqli_fetch_array($result);
  if(password_verify($password, $row['password'])){
    $_SESSION["name"] = $row['name'];
    $_SESSION["user"] = $name; 
    $_SESSION["auth"] = 1;
    header("Location: dashboard.php");
  }           
  else{
  	header("Location: login.html?status=2");
  }
 ?>
