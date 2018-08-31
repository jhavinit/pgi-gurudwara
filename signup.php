<?php
	require 'db.php';
	$name = $_POST['name'];
	$password = $_POST['psw'];
	$query = "SELECT * FROM admin WHERE name = '$name'";
	$result = mysqli_query($conn, $query);
	if($row = mysqli_fetch_array($result))
	{
		header("Location: index.html?status=2");	
	}

	else
	{
		$phash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
		$query = "INSERT INTO admin(name, password) VALUES ('$name', '$phash')";
		mysqli_query($conn, $query);
		header("Location: login.html"); 
	}
?>