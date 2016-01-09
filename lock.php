<?php
	include('connect.php');
	session_start();
	$user_check=$_SESSION['login_user'];
	$color = $_SESSION['color'];
	
	$q = "SELECT username FROM users WHERE username='$user_check' ";

	$result = mysqli_query($conn, $q);
	 
	$row = mysqli_fetch_assoc($result);
	 
	$login_session=$row['username'];
	
	if(!isset($login_session))
	{

		//header("Location: login.php");
	}
?>